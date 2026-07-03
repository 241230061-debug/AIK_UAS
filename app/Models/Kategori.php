<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    // TAMBAHKAN KODE INI DI SINI:
    public function gerakan()
    {
        return $this->hasMany(Gerakan::class, 'id_kategori');
    }
}