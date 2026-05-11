<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah;

class NaskahController extends Controller
{
    public function store(Request $request)
    {
        // 1. Simpan data ke database
        Naskah::create([
            'judul'     => $request->judul,
            'sub_judul' => $request->sub_judul,
            'sinopsis'  => $request->sinopsis,
        ]);

        // 2. Balik ke halaman awal dan bawa pesan "MANTAP!"
        return redirect()->back()->with('status', 'MANTAP! Data naskah sudah aman di database!');
    }
}