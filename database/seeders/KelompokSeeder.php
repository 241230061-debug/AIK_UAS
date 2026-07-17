<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use Illuminate\Database\Seeder;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelompok::create([
            'nama_kelompok' => 'Muhammad Nabil Junaidi, Dharma Ady Khara, Indoko Banderas',
            'prodi'         => 'Sistem Informasi',
            'mata_kuliah'   => 'Al-Islam dan Kemuhammadiyahan',
            'dosen'         => 'Dedy Susanto',
        ]);
    }
}
