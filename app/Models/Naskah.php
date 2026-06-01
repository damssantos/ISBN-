<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naskah extends Model
{
    // Tambahkan baris sakti ini:
    protected $fillable = ['judul', 'sub_judul', 'sinopsis'];

    public function penuliss()
    {
        return $this->hasMany(Penulis::class, 'naskah_id')->orderBy('urutan', 'asc');
    }
}