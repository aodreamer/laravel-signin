<?php

namespace App\Http\Controllers;

use App\Models\Request as CertificateRequest;
use App\Models\Certificate;
use App\Models\User;
use App\Models\File;
use App\Models\DocumentLabel;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showRequests()
    {
        $files = File::with('author')->get();
        $requests = CertificateRequest::all();
        $labels = DocumentLabel::all();
        return view('admin.index', compact('requests','files','labels'));
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
        Storage::disk('p12')->delete($certificate->p12_name);
        $certificate->update([
            'p12_name' => $file->getClientOriginalName(),
            'pass' => $pass,
            'last_modified' => now(),
        ]);
        DB::table('requests')
            ->where('user_id', $id)
            ->update(['status' => 'Success']);
    }else {
        // Jika data sertifikat tidak ditemukan, lakukan insert
        $certificate = new Certificate([
            'user_id' => $id,
            'p12_name' => $file->getClientOriginalName(),
            'pass' => $pass,
            'last_modified' => now(),
        ]);
        $certificate->save();
        DB::table('requests')
            ->where('user_id', $id)
            ->update(['status' => 'Success']);
    }

    // Simpan file P12 ke storage
    $file->storeAs('files/p12', $file->getClientOriginalName());

    return back()->with('success', 'File P12 berhasil diperbarui.');
    }

    public function deleteFile($fileId)
{
    $file = File::findOrFail($fileId);

    // Hapus file dari storage
    Storage::disk('pdf_files')->delete(($file->hash).'.pdf');

    // Hapus data file dari database
    $file->delete();

    return back()->with('success', 'File berhasil dihapus.');
}

public function showupdateFile($id)
{
    $file = File::findOrFail($id);   
    return view('admin.edit_file', compact('file'));
}

public function updateFile(Request $request, File $file)
{
    $request->validate([
        'filename' => 'required|string|max:255',
        'pdf_file' => 'nullable|file|mimetypes:application/pdf',
    ]);

    if ($request->hasFile('pdf_file')) {
        // Delete the old file from storage
        Storage::disk('pdf_files')->delete($file->filename);

        // Store the new file in storage
        $request->file('pdf_file')->store('pdf_files', 'pdf_files');
        $file->hash = hash_file('sha256', $file->path());
    }

    // Update the file information in the database
    $file->filename = $request->input('filename');
    $file->save();

    return redirect()->route('admin.requests')->with('success', 'File has been updated.');
}

public function storeLabel(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required', // pastikan 'name' harus diisi
            // tambahkan aturan validasi lainnya jika diperlukan
        ]);

        DocumentLabel::create($validatedData);
        return redirect()->route('admin.requests')->with('success', 'Label created successfully');
    }

    public function destroyLabel(DocumentLabel $document_label)
    {
        $document_label->delete();
        return redirect()->route('admin.requests')->with('success', 'Label deleted successfully');
    }

}
