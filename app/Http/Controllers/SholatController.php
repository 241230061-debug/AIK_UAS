<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Gerakan;

class SholatController extends Controller
{
    // Menampilkan halaman daftar gerakan berdasarkan mode (F-01 & F-07)
    public function index()
    {
        // Mengambil semua gerakan sholat diurutkan dari awal sampai akhir, 
        // sekaligus mengambil variasi bacaannya (Eager Loading)
        $daftarGerakan = Gerakan::with('bacaan')->orderBy('urutan', 'asc')->get();

        // Kirim data ke view bernama 'sholat.index'
        return view('sholat.index', compact('daftarGerakan'));
    }
}