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

    public function acceptRequest(CertificateRequest $request)
    {
        $request->status = 'Progress';
        $request->save();


        return back()->with('success', 'Status berhasil diubah.');
    }
}
