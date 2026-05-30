<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Memakai DB Query Builder biar aman tanpa bikin model baru

class ProfilController extends Controller
{
    // 1. MENAMPILKAN DATA PROFIL DARI TABEL BARU
    public function index()
    {
        // Ambil data profil baris pertama (ID: 1) yang tadi kita insert
        $user = DB::table('profil_penulis')->where('id', 1)->first();

        return view('informasi', compact('user'));
    }

    // 2. MEMPROSES UPDATE PROFIL SECARA NYATA KE DATABASE
    public function update(Request $request)
    {
        // Update baris ID nomor 1 dengan data inputan form FE Maria
        DB::table('profil_penulis')->where('id', 1)->update([
            'gelar_depan'    => $request->gelar_depan,
            'name'           => $request->name,
            'gelar_belakang' => $request->gelar_belakang,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'agama'          => $request->agama,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nik'            => $request->nik,
            'alamat_ktp'     => $request->alamat_ktp,
        ]);

        return redirect()->back()->with('status', 'MANTAP! Informasi profil Anda berhasil diperbarui secara permanen di database!');
    }
}