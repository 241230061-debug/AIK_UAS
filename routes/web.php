<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SholatController;

// Halaman utama menampilkan Beranda (landing page ke-Islaman SIM-IMO)
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

// Route untuk menampilkan daftar gerakan berdasarkan mode (dewasa/anak)
Route::get('/sholat/{mode}', [SholatController::class, 'index'])->name('sholat.index');

// Jika diakses tanpa parameter, arahkan ke fungsi index yang nanti otomatis membaca sebagai 'dewasa'
Route::get('/panduan-sholat', [SholatController::class, 'index'])->name('sholat.panduan');
Route::get('/sholat', [SholatController::class, 'index'])->name('sholat.default');