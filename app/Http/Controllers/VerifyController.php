<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class VerifyController extends Controller
{
    public function showUploadForm()
    {
        return view('public.verify');
    }

    public function uploadPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf',
        ]);

        $file = $request->file('pdf_file');
        $filename = $file->getClientOriginalName(); // Mendapatkan nama asli file

        // Cek apakah hash file sudah ada di database
        $hash = hash_file('sha256', $file->path());
        $existingFile = File::where('hash', $hash)->first();

        if ($existingFile) {
            // File sudah terverifikasi
            return back()->with('message', 'File terverifikasi');
        } else {
            return back()->with('message', 'File belum/tidak terverifikasi');
        }
    }
}
