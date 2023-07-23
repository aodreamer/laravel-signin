<?php

// app/Http/Controllers/CertificateController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
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
            'user_id' => 'required',
        ]);

        $certificate = Certificate::where('user_id', $request->input('user_id'))->first();

        if ($certificate) {
            $password = Crypt::decryptString($certificate->pass);
            return back()->with('password', $password);
        } else {
            return back()->with('error', 'Pengguna dengan P12 tidak ditemukan.');
        }
    }
}
