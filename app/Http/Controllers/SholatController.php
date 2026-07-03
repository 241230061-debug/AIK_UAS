<?php

namespace App\Http\Controllers;

use App\Models\Gerakan;
use Illuminate\Http\Request;

class SholatController extends Controller
{
    public function index()
    {
        // Ambil semua gerakan beserta relasi bacaannya
        $semuaGerakan = Gerakan::with('bacaans')->orderBy('urutan', 'asc')->get();

        // Kelompokkan berdasarkan id_kategori (1 = Dewasa, 2 = Anak)
        $dewasa = $semuaGerakan->where('id_kategori', 1)->values();
        $anak = $semuaGerakan->where('id_kategori', 2)->values();

        // Transformasi data agar sesuai dengan struktur Blade lama Anda
        $daftarGerakan = $dewasa->map(function($item, $index) use ($anak) {
            $itemAnak = $anak[$index] ?? null;
            
            return (object)[
                'urutan' => $item->urutan,
                'nama' => $item->nama,
                'audio_url' => $item->bacaans->first()->audio_url ?? null,
                'foto_dewasa' => $item->gambar_url ?? '',
                'foto_anak' => $itemAnak->gambar_url ?? '',
                'deskripsi_dewasa' => $item->deskripsi ?? '',
                'deskripsi_anak' => $itemAnak->deskripsi ?? '',
                'bacaan' => $item->bacaans->map(function($b, $bIdx) use ($itemAnak) {
                    // Mengambil bacaan anak pada indeks yang sama secara aman
                    $bacaanAnak = ($itemAnak && $itemAnak->bacaans) ? $itemAnak->bacaans->values()->get($bIdx) : null;
                    
                    return (object)[
                        'teks_arab' => $b->teks_arab,
                        'teks_latin' => $b->teks_latin,
                        'terjemahan_dewasa' => $b->terjemahan,
                        'terjemahan_anak' => $bacaanAnak->terjemahan ?? $b->terjemahan,
                        'sumber' => $b->sumber
                    ];
                })
            ];
        }); // <-- Di sini letak perbaikannya, harus ditutup dengan }); bukan );

        return view('sholat.index', compact('daftarGerakan'));
    }
}