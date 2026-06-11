<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Memakai DB Query Builder biar aman tanpa bikin model baru

class ProfilController extends Controller
{
    // 1. MENAMPILKAN DATA PROFIL DARI TABEL BARU
    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        // Ambil data akun_pengguna
        $akun = DB::table('akun_pengguna')->where('id', $userId)->first();
        if (!$akun) {
            return redirect()->route('login');
        }

        // Ambil data profil_penulis
        $user = DB::table('profil_penulis')->where('user_id', $userId)->first();
        if (!$user) {
            // Jika belum ada, buat profil baru
            DB::table('profil_penulis')->insert([
                'user_id' => $userId,
                'name' => $akun->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $user = DB::table('profil_penulis')->where('user_id', $userId)->first();
        }

        // Gabungkan data dari akun ke object $user agar dibaca di blade
        $user->email = $akun->email;
        $user->no_hp = $akun->no_hp;

        return view('informasi', compact('user'));
    }

    // 2. MEMPROSES UPDATE PROFIL SECARA NYATA KE DATABASE
    public function update(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // Update profil_penulis
        DB::table('profil_penulis')->where('user_id', $userId)->update([
            'gelar_depan'    => $request->gelar_depan,
            'name'           => $request->name,
            'gelar_belakang' => $request->gelar_belakang,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'agama'          => $request->agama,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nik'            => $request->nik,
            'alamat_ktp'     => $request->alamat_ktp,
            'updated_at'     => now(),
        ]);

        // Update akun_pengguna agar sinkron
        DB::table('akun_pengguna')->where('id', $userId)->update([
            'name'  => $request->name,
            'no_hp' => $request->no_hp,
        ]);

        // Perbarui session name
        session(['user_name' => $request->name]);

        return redirect()->back();
    }
}