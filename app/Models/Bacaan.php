<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bacaan extends Model
{
    // Mengarahkan model ke tabel tunggal 'bacaan' sesuai migration Anda
    protected $table = 'bacaan';
    protected $guarded = [];

    public function gerakan(): BelongsTo
    {
        return $this->belongsTo(Gerakan::class, 'id_gerakan');
    }
}