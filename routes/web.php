<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute login dan registrasi untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    // Rute login
    Route::get('login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');

    // Rute registrasi
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

});

// Rute dashboard dan signout hanya untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
    
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

    Route::get('upload-pdf', [FileController::class,'showUploadForm'])->name('upload.form');
    Route::post('upload-pdf', [FileController::class,'uploadPdf'])->name('upload.pdf');

    Route::get('upload-p12', [CertificateController::class, 'showUploadForm'])->name('p12.form');
    Route::post('upload-p12', [CertificateController::class, 'upload'])->name('upload.p12');
    
    Route::get('showP12Password', [CertificateController::class, 'chooseUserWithP12'])->name('showP12Password.form');
    Route::post('showP12Password', [CertificateController::class, 'showPassword'])->name('showP12Password');

    Route::get('change-password', [CustomAuthController::class,'showChangePasswordForm'])->name('user.change-password');
    Route::post('change-password', [CustomAuthController::class,'changePassword'])->name('user.change-password');

    Route::get('certificate', [CertificateController::class,'showCertificate'])->name('cert.show');
    
    Route::get('/download-certificate', [CertificateController::class, 'downloadP12'])->name('cert.download');

    Route::post('/request-certificate', [CertificateController::class, 'submitRequest'])->name('cert.request');    

    
});

Route::middleware('admin')->group(function () {
    Route::get('admin', [AdminController::class, 'showRequests'])->name('admin.requests');
    Route::post('accrequest/{request}/{status}', [AdminController::class, 'changeStatusRequest'])->name('changeStatus.request');

    Route::get('admin/reuploadcertificate/{id}', [AdminController::class, 'showUploadForm'])->name('reupload.certificate.form');
    Route::post('admin/reuploadcertificate', [AdminController::class, 'reuploadCertificate'])->name('reupload.certificate');

    Route::delete('admin/deletefile/{fileId}', [AdminController::class, 'deleteFile'])->name('delete.file');
    
    Route::get('/admin/updatefile/{fileId}', [AdminController::class, 'showupdateFile'])->name('update.file.form');
    Route::put('/admin/updatefile/{file}', [AdminController::class, 'updateFile'])->name('update.file');
    

});

Route::get('/',[App\Http\Controllers\Controller::class,'landing'])->name("landing");

Route::get('/verify', [VerifyController::class, 'showUploadForm'])->name('verify.upload.form');
Route::post('/verify', [VerifyController::class, 'uploadPdf'])->name('verify.upload.pdf');

Route::get('/jdih', [App\Http\Controllers\Controller::class, 'showJDIH'])->name('jdih.index');
Route::get('/jdih/download/{id}', [App\Http\Controllers\Controller::class, 'downloadJDIH'])->name('jdih.download');

Route::get('/check', [VerifyController::class, 'showCheckForm'])->name('verify.check.form');
Route::post('/check', [VerifyController::class, 'checkPdf'])->name('verify.check.pdf');

Route::get('/verifycert', [VerifyController::class, 'showVerifCert'])->name('verify.cert.form');
Route::post('/verifycert', [VerifyController::class, 'uploadSigned'])->name('verify.cert');