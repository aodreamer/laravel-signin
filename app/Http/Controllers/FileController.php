<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentLabel;

class FileController extends Controller
{
    public function showUploadForm()
    {
        $labels = DocumentLabel::all();
        return view('auth.upload_pdf', compact('labels'));
    }

    public function uploadPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf',
            'labels' => 'required',
            'file_name' => 'required'// Pastikan hanya menerima file PDF dengan ukuran maksimal 2MB
        ]);

        $selectedLabels = $request->input('labels');

        $file = $request->file('pdf_file');
        $hash = hash_file('sha256', $file->path()); // Menghasilkan hash dari isi file
        $existingFile = File::where('hash', $hash)->first();

        if ($existingFile) {
            // File sudah terverifikasi
            return back()->with('error', 'File sudah ada: '.$existingFile->filename);
        }

        $filename = $hash . '.' . $file->getClientOriginalExtension();

        // Simpan file ke folder yang aman
        $file->storeAs('pdf_files', $filename, 'files');

        // Simpan informasi file ke databas
        $user = Auth::user();


        // Simpan file bersama dengan label yang dipilih
        File::create([
            'id_author' => $user->id,
            'filename' => $request->input('file_name'),
            'hash' => $hash,
            'date_upload' => now(),
            'labels' => implode(',', $selectedLabels),
        ]);

        return redirect()->route('upload.form')->with('success', 'File PDF berhasil diunggah!');
    }
}
