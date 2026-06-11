<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    // 1. DAFTAR PENULIS (READ)
    public function list()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        // Ambil semua penulis yang dibuat oleh user ini dan bukan merupakan akun user itu sendiri
        $penuliss = DB::table('profil_penulis')
            ->where('user_id', $userId)
            ->where('is_self', false)
            ->latest()
            ->get();

        return view('table-penulis', compact('penuliss'));
    }

    // 2. FORM TAMBAH PENULIS (CREATE)
    public function create()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = null; // empty object for form
        return view('informasi', compact('user'));
    }

    // 3. SIMPAN PENULIS BARU (STORE)
    public function store(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $data = [
            'user_id' => $userId,
            'gelar_depan' => $request->gelar_depan,
            'name' => $request->name,
            'gelar_belakang' => $request->gelar_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'alamat_ktp' => $request->alamat_ktp,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nama_kantor' => $request->nama_kantor,
            'tempat_mengajar' => $request->tempat_mengajar,
            'nama_ktp' => $request->nama_ktp,
            'no_telepon' => $request->no_telepon,
            'alamat_surat' => $request->alamat_surat,
            'npwp' => $request->npwp,
            'nama_npwp' => $request->nama_npwp,
            'alamat_npwp' => $request->alamat_npwp,
            'no_rekening' => $request->no_rekening,
            'nama_rekening' => $request->nama_rekening,
            'nama_bank' => $request->nama_bank,
            'cabang_bank' => $request->cabang_bank,
            'kota_bank' => $request->kota_bank,
            'is_self' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($request->hasFile('file_ktp')) {
            $data['file_ktp'] = $request->file('file_ktp')->store('ktp', 'public');
        }
        if ($request->hasFile('foto_penulis')) {
            $data['foto_penulis'] = $request->file('foto_penulis')->store('penulis', 'public');
        }

        DB::table('profil_penulis')->insert($data);

        return redirect()->route('profil.list')->with('status', 'Penulis berhasil ditambahkan!');
    }

    // 4. FORM EDIT PENULIS (EDIT)
    public function edit($id)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = DB::table('profil_penulis')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$user) {
            return redirect()->route('profil.list')->withErrors(['error' => 'Data penulis tidak ditemukan!']);
        }

        return view('informasi', compact('user'));
    }

    // 5. UPDATE DATA PENULIS (UPDATE)
    public function update(Request $request, $id)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $data = [
            'gelar_depan' => $request->gelar_depan,
            'name' => $request->name,
            'gelar_belakang' => $request->gelar_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'alamat_ktp' => $request->alamat_ktp,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nama_kantor' => $request->nama_kantor,
            'tempat_mengajar' => $request->tempat_mengajar,
            'nama_ktp' => $request->nama_ktp,
            'no_telepon' => $request->no_telepon,
            'alamat_surat' => $request->alamat_surat,
            'npwp' => $request->npwp,
            'nama_npwp' => $request->nama_npwp,
            'alamat_npwp' => $request->alamat_npwp,
            'no_rekening' => $request->no_rekening,
            'nama_rekening' => $request->nama_rekening,
            'nama_bank' => $request->nama_bank,
            'cabang_bank' => $request->cabang_bank,
            'kota_bank' => $request->kota_bank,
            'updated_at' => now(),
        ];

        if ($request->hasFile('file_ktp')) {
            $data['file_ktp'] = $request->file('file_ktp')->store('ktp', 'public');
        }
        if ($request->hasFile('foto_penulis')) {
            $data['foto_penulis'] = $request->file('foto_penulis')->store('penulis', 'public');
        }

        DB::table('profil_penulis')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update($data);

        return redirect()->route('profil.list')->with('status', 'Data penulis berhasil diperbarui!');
    }

    // 6. HAPUS PENULIS (DELETE)
    public function destroy($id)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        DB::table('profil_penulis')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->route('profil.list')->with('status', 'Penulis berhasil dihapus!');
    }
}