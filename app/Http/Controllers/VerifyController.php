<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use mikehaertl\pdftk\FdfFile;
use mikehaertl\pdftk\Pdf;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
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

    public function showCheckForm(){
        $files = Storage::files('files/pdf_files');
        return view('public.check', compact('files'));
    }

    public function checkPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required',
        ]);

        // Ambil path file PDF dari storage
        $pdfPath = Storage::path($request->pdf_file);

        // Ekstrak data dari PDF menggunakan pustaka pdftk
        $parserPath = 'C:\Program Files (x86)\PDFtk Server\bin\pdftk.exe'; // Ganti dengan path ke binary pdftk
        $fdfFile = new FdfFile($parserPath);
        $pdf = new Pdf($pdfPath, ['command' => $parserPath]);
        $data = $pdf->getDataFields(true, $fdfFile);

        // Tampilkan hasilnya
        return view('check_result', compact('data'));
    }
    

}
