<?php

namespace App\Http\Controllers;

use App\Models\Request as CertificateRequest;
use App\Models\Certificate;
use App\Models\User;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showRequests()
    {
        $requests = CertificateRequest::all();
        return view('admin.index', compact('requests'));
    }

    public function changeStatusRequest($id, $status)
{
    // Cari model Request berdasarkan id
    $request = CertificateRequest::findOrFail($id);

    // Validasi bahwa status yang dimasukkan adalah salah satu dari "Rejected", "Progress", atau "Success"
    if (!in_array($status, ['Rejected', 'Progress', 'Success'])) {
        return back()->with('error', 'Status tidak valid.');
    }

    // Lakukan operasi sesuai kebutuhan, contoh:
    $request->status = $status;
    $request->save();

    return back()->with('success', 'Status berhasil diubah.');
}

    public function showUploadForm($id)
    {
        $user = User::findOrFail($id);   
        return view('admin.reupload_certificate', compact('user'));
    }

    public function reuploadCertificate(Request $request)
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

    $certificate = Certificate::where('user_id', $id)->first();

    // Jika data sertifikat ditemukan, lakukan update
    if ($certificate) {
        $certificate->update([
            'p12_name' => $file->getClientOriginalName(),
            'pass' => $pass,
            'last_modified' => now(),
        ]);
        DB::table('requests')
            ->where('user_id', $id)
            ->update(['status' => 'Success']);
    }

    // Simpan file P12 ke storage
    $file->storeAs('files/p12', $file->getClientOriginalName());

    return back()->with('success', 'File P12 berhasil diperbarui.');
    }
}
