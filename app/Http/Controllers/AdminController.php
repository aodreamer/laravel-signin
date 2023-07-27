<?php

namespace App\Http\Controllers;

use App\Models\Request as CertificateRequest;

use Illuminate\Http\Request;

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
}
