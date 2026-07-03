<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gerakan extends Model
{
    // Mengarahkan model ke tabel tunggal 'gerakan' sesuai migration Anda
    protected $table = 'gerakan';
    protected $guarded = [];

    // Definisikan relasi ke model Bacaan
    public function bacaans(): HasMany
    {
        return $this->hasMany(Bacaan::class, 'id_gerakan')->orderBy('urutan', 'asc');
    }
}