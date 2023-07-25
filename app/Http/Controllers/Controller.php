<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\File;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function landing()
    {
        return view('landing');
    }

    public function showJDIH()
    {
        $files = File::with('author')->get();
        return view('jdih', compact('files'));
    }

    public function downloadJDIH($id)
    {
        $file = File::find($id);
        if ($file) {
            $filePath = storage_path("app/files/pdf_files/{$file->hash}.pdf");
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File tidak ditemukan.');
        }
    }
}
