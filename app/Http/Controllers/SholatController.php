<?php

namespace App\Http\Controllers;

use App\Models\Gerakan;
use Illuminate\Http\Request;

class SholatController extends Controller
{
    // Tambahkan parameter $mode dengan nilai default 'dewasa'
    public function index($mode = 'dewasa')
    {
        // Validasi agar jika user mengetik asal selain anak/dewasa, otomatis ke dewasa
        if (!in_array($mode, ['dewasa', 'anak'])) {
            $mode = 'dewasa';
        }

        // Tentukan id_kategori berdasarkan mode (1 = Dewasa, 2 = Anak)
        $idKategori = ($mode === 'anak') ? 2 : 1;

        // Ambil gerakan khusus untuk kategori yang dipilih saja (MANDIRI 100%)
        $daftarGerakan = Gerakan::with('bacaans')
            ->where('id_kategori', $idKategori)
            ->orderBy('urutan', 'asc')
            ->get()
            ->map(function($item) {
                return (object)[
                    'urutan' => $item->urutan,
                    'nama' => $item->nama,
                    'audio_url' => $item->bacaans->first()->audio_url ?? null,
                    'foto' => $item->gambar_url ?? '',
                    'deskripsi' => $item->deskripsi ?? '',
                    'bacaan' => $item->bacaans->map(function($b) {
                        return (object)[
                            'teks_arab' => $b->teks_arab,
                            'teks_latin' => $b->teks_latin,
                            'terjemahan' => $b->terjemahan,
                            'sumber' => $b->sumber
                        ];
                    })
                ];
            });

        // Kembalikan ke view yang sesuai dengan nama modenya
        // Jika $mode = 'dewasa', memanggil view sholat.dewasa
        // Jika $mode = 'anak', memanggil view sholat.anak
        return view("sholat.{$mode}", compact('daftarGerakan'));
    }
}