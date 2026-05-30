<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTerbit extends Model
{
    protected $table = 'buku_terbit';

    protected $fillable = [
        'judul',
        'penulis',
        'isbn',
        'tanggal_terbit',
        'cover_url',
        'kategori',
        'penerbit',
        'jumlah_halaman',
        'sinopsis',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'jumlah_halaman' => 'integer',
    ];
}
