<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FileController;

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
});

Route::get('/',[App\Http\Controllers\Controller::class,'landing'])->name("landing");