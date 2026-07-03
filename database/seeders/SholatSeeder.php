<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SholatSeeder extends Seeder
{
    public function run(): void
    {
            // Ganti DB::table('kategori')->insert([...]) menjadi:
        DB::table('kategori')->updateOrInsert(
            ['id' => 1],
            ['nama' => 'Dewasa', 'created_at' => now(), 'updated_at' => now()]
        );

        DB::table('kategori')->updateOrInsert(
            ['id' => 2],
            ['nama' => 'Anak', 'created_at' => now(), 'updated_at' => now()]
        );

        // 2. Contoh Gerakan Dewasa (id_kategori = 1)
        $gerakanDewasaId = DB::table('gerakan')->insertGetId([
            'id_kategori' => 1,
            'nama' => 'Takbiratul Ihram',
            'urutan' => 1,
            'deskripsi' => 'Berdiri tegak menghadap kiblat, lalu mengangkat kedua tangan sejajar telinga...',
            'gambar_url' => 'images/dewasa/takbir.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Contoh Gerakan Anak (id_kategori = 2) - Urutan disamakan agar klop saat di-map
        $gerakanAnakId = DB::table('gerakan')->insertGetId([
            'id_kategori' => 2,
            'nama' => 'Takbiratul Ihram',
            'urutan' => 1,
            'deskripsi' => 'Yuk angkat kedua tanganmu sampai sejajar telinga sambil membaca takbir ya!',
            'gambar_url' => 'images/anak/takbir.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Isi Bacaan untuk Dewasa
        DB::table('bacaan')->insert([
            'id_gerakan' => $gerakanDewasaId,
            'urutan' => 1,
            'teks_arab' => 'Allāhu Akbar',
            'teks_latin' => 'Allahu Akbar',
            'terjemahan' => 'Allah Maha Besar',
            'audio_url' => 'audio/takbir.mp3',
            'sumber' => 'HPT Muhammadiyah Bab Sholat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}