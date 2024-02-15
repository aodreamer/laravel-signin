<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use mikehaertl\pdftk\FdfFile;
use mikehaertl\pdftk\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use App\Models\VerificationResult;
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
        $verificationResult = VerificationResult::firstOrCreate([]);
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
            $verificationResult->increment('verification_success');

            return back()->with('success', 'File terverifikasi resmi');
        } else {
            $verificationResult->increment('verification_failure');
            return back()->with('error', 'File belum diupload/palsu');
        }
    }

    public function showCheckForm(){
        $files = Storage::files('files/pdf_files');
        return view('public.check', compact('files'));
    }

    //ini ga guna
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
    
    public function showVerifCert(){
        return view('public.verifcert');
    }

    public function uploadSigned(Request $request)
    {
        // Validasi bahwa file PDF telah diunggah
        $request->validate([
            'pdf_file' => 'required|mimes:pdf',
        ]);

        $file = $request->file('pdf_file');
        $pdfContents = file_get_contents($file->getPathname());
        
        
        try {
            // $isUploaded = $this->uploadPdf($request);
            
            $response = Http::attach('file', $pdfContents, $file->getClientOriginalName())
                ->post('http://127.0.0.1:5000/verify_pdf_signature'); // Ganti dengan URL endpoint yang sesuai

            $data = $response->json();
            // Tampilkan atau proses data response sesuai kebutuhan
            return view('public.verifcertresult', compact('data'));
        } catch (RequestException $e) {
            // Tangani kesalahan jika ada
            return back()->withErrors('Error uploading and processing PDF.');
        }
    }

}
