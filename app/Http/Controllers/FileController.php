<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('auth.upload_pdf');
    }

    public function uploadPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf', // Pastikan hanya menerima file PDF dengan ukuran maksimal 2MB
        ]);

        $file = $request->file('pdf_file');
        $hash = hash_file('sha256', $file->path());; // Menghasilkan hash dari isi file
        $filename = $hash . '.' . $file->getClientOriginalExtension();

        // Simpan file ke folder yang aman
        $file->storeAs('pdf_files', $filename, 'files');

        // Simpan informasi file ke databas
        $user = Auth::user();
        $fileData = [
            'id_author' => $user->id,
            'filename' => $file->getClientOriginalName(),
            'hash' => $hash,
            'date_upload' => now(),
        ];

        File::create($fileData);

        return redirect()->route('upload.form')->with('success', 'File PDF berhasil diunggah!');
    }
}
