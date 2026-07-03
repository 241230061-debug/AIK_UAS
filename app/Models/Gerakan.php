<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerakan extends Model
{
    protected $table = 'gerakan';
    protected $fillable = ['id_kategori', 'nama', 'urutan', 'deskripsi', 'gambar_url', 'video_url'];

    // Relasi ke Bacaan (Gunakan id_gerakan sebagai Foreign Key)
    public function bacaan()
    {
        return $this->hasMany(Bacaan::class, 'id_gerakan')->orderBy('urutan', 'asc');
    }
}