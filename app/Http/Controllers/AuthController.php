<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. TAMPILKAN FORM LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. PROSES MASUK VALIDASI AKUN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('akun_pengguna')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Tentukan role (default: penulis jika tidak diset)
            $role = $user->role ?? 'penulis';

            // Simpan session lengkap dengan role
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $role,
            ]);

            // Redirect berdasarkan role
            if ($role === 'superadmin') {
                return redirect()->route('superadmin.dashboard')->with('status', 'Selamat Datang, Super Admin!');
            } elseif ($role === 'admin') {
                return redirect()->route('admin.dashboard')->with('status', 'Selamat Datang, Admin!');
            } else {
                return redirect()->route('dashboard')->with('status', 'Selamat Datang Kembali, Penulis Hebat!');
            }
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['error' => 'Email atau Password salah!']);
    }

    // 3. TAMPILKAN FORM DAFTAR
    public function showRegister()
    {
        return view('auth.register');
    }

    // 4. PROSES SAVE DATA REGISTRASI BARU KE DATABASE REAL TIME
    public function register(Request $request)
    {
        // Validasi inputan form - DISESUAIKAN KE TABEL AKUN_PENGGUNA
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:akun_pengguna,email',
            'password' => 'required|min:6',
        ]);

        // Eksekusi simpan permanen ke tabel akun_pengguna database asli!
        DB::table('akun_pengguna')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password aman
        ]);

        // Mengarah ke 'login' kustom
        return redirect()->route('login');
    }

    // 5. PROSES KELUAR SISTEM
    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_role']);
        return redirect()->route('login');
    }
}