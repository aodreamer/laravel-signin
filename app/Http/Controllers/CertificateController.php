<?php

// app/Http/Controllers/CertificateController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ChangeRequest;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    public function showUploadForm()
    {
        $users = User::all();
        return view('auth.upload_p12', compact('users'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'p12_file' => 'required|file|mimetypes:application/octet-stream, application/x-pkcs12',
            'pass' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);
        $id = $user->id;
        $file = $request->file('p12_file');
        $pass = Crypt::encryptString($request->pass);

        // Simpan file P12 ke storage
        $file->storeAs('files/p12', $file->getClientOriginalName());

        // Simpan data ke database
        Certificate::create([
            'user_id' => $id,
            'p12_name' => $file->getClientOriginalName(),
            'pass' => $pass,
            'last_modified' => now(),
        ]);

        return redirect()->route('upload.form')->with('success', 'File P12 berhasil diupload.');
    }

    public function chooseUserWithP12()
    {
        $userIdsWithP12 = Certificate::groupBy('user_id')->pluck('user_id');
        $usersWithP12 = User::whereIn('id', $userIdsWithP12)->get();


        return view('auth.showpassword_p12', compact('usersWithP12'));
    }

    // Fungsi untuk menampilkan password dari pengguna yang dipilih
    public function showPassword(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    $user = Auth::user();
    $certificate = Certificate::where('user_id', $user->id)->first();

    if ($certificate) {
        $decryptedPassword = Crypt::decryptString($certificate->pass);
        if (password_verify($request->input('password'), $user->password)) {
            return back()->with('password', $decryptedPassword);
        } else {
            return back()->with('error', 'Password akun tidak sesuai.');
        }
    } else {
        return back()->with('error', 'Anda tidak memiliki sertifikat.');
    }
}
    
    public function showCertificate()
    {
        $user = auth()->user();

        // Mendapatkan data sertifikat milik user yang sedang login (jika ada)
        $certificate = Certificate::where('user_id', $user->id)->first();

        return view('auth.certificate', compact('certificate'));
    }

    public function downloadP12()
    {
        $user = auth()->user();

        // Pengecekan apakah user yang sedang login memiliki sertifikat
        $certificate = Certificate::where('user_id', $user->id)->first();

        if ($certificate) {
            $filePath = "files/p12/" . $certificate->p12_name;
            $fileName = $certificate->p12_name;

            // Pengecekan apakah sertifikat tersebut milik user yang sedang login
            if ($certificate->user_id === $user->id) {
                return Storage::download($filePath, $fileName);
            }
        }

        return redirect()->route('cert.show')->with('error', 'Anda tidak memiliki sertifikat.');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Ambil data user yang sedang login
        $user = auth()->user();

        // Buat pengajuan perubahan baru
        ChangeRequest::create([
            'user_id' => $user->id,
            'reason' => $request->input('reason'),
            'status' => 'pending', // Set status pengajuan ke "pending" (Anda bisa ganti sesuai kebutuhan)
        ]);

        return back()->with('success', 'Pengajuan perubahan sertifikat berhasil diajukan.');
    }
}
