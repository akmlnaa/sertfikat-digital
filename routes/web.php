<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route login/logout
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

// Route dashboard & resource (hanya untuk admin login)
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('notifikasi', NotifikasiController::class);
});
