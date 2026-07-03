<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bacaan extends Model
{
    protected $table = 'bacaan';
    protected $fillable = ['id_gerakan', 'urutan', 'teks_arab', 'teks_latin', 'terjemahan', 'audio_url', 'sumber'];

    // Relasi balik ke Gerakan
    public function gerakan()
    {
        return $this->belongsTo(Gerakan::class, 'id_gerakan');
    }
}