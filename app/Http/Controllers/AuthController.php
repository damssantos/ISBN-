<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login yang aseli
    public function showLogin()
    {
        return view('auth.login'); // diarahkan ke folder auth/login.blade.php
    }

    // 2. Tampilkan Halaman Register yang aseli
    // 2. Tampilkan Halaman Register yang asli
    public function showRegister()
    {
        return view('auth.register'); // Pastikan tulisannya begini ya!
    }

    // 3. Proses Registrasi Akun Baru
    public function register(Request $request)
    {
        // Validasi inputan dari form register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan ke database tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash/enkripsi!
        ]);

        // Lempar ke halaman login dengan pesan sukses
        return redirect('/auth-login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // 4. Proses Verifikasi Login
    public function login(Request $request)
    {
        // Validasi inputan login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email dan password cocok dengan di databaseS
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Kalau sukses, lempar ke halaman Dashboard utama
            return redirect()->intended('/');
        }

        // Kalau gagal, balikin ke login dengan error
        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->withInput();
    }

    // 5. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}