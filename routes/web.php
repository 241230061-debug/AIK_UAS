<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SholatController;

// Halaman utama otomatis mengarah ke mode dewasa
Route::get('/', function () {
    return redirect('/sholat/dewasa');
});

// Route untuk menampilkan daftar gerakan berdasarkan mode (dewasa/anak)
Route::get('/sholat/{mode}', [SholatController::class, 'index'])->name('sholat.index');

// Jika diakses tanpa parameter, arahkan ke fungsi index yang nanti otomatis membaca sebagai 'dewasa'
Route::get('/panduan-sholat', [SholatController::class, 'index'])->name('sholat.panduan');
Route::get('/sholat', [SholatController::class, 'index'])->name('sholat.default');