<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\File;
use App\Models\DocumentLabel;
use App\Models\VerificationResult;
use Illuminate\Support\Facades\Response;
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
        $labels = DocumentLabel::all();
        $labelCounts = [];

        foreach ($files as $file) {
            $labelIDs = explode(',', $file->labels);
            foreach ($labelIDs as $labelID) {
                $labelID = trim($labelID);
                $labelName = DocumentLabel::find($labelID)->name;
                
                if (isset($labelCounts[$labelName])) {
                    $labelCounts[$labelName]++;
                } else {
                    $labelCounts[$labelName] = 1;
                }
            }
        }

        $uploadsPerMonth = [];

        foreach ($files as $file) {
            $uploadMonth = date('Y-m', strtotime($file->date_upload));

            if (isset($uploadsPerMonth[$uploadMonth])) {
                $uploadsPerMonth[$uploadMonth]++;
            } else {
                $uploadsPerMonth[$uploadMonth] = 1;
            }
        }

        $topDownloads = File::orderBy('download_count', 'desc')->take(3)->get();
        $verifications = VerificationResult::first();


        return view('jdih', compact('files', 'labels','labelCounts','uploadsPerMonth','topDownloads',"verifications"));
    }

    public function downloadJDIH($id)
    {
        $file = File::findOrFail($id);
        if ($file) {
            $file->incrementDownloadCount();
            $filePath = storage_path("app/files/pdf_files/{$file->hash}.pdf");
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File tidak ditemukan.');
        }
    }
}
