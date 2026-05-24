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
            session([
                'user_id'    => $user->id, 
                'user_name'  => $user->name, 
                'user_email' => $user->email
            ]);
            \Auth::loginUsingId($user->id); 
            return redirect()->route('dashboard')->with('status', 'Selamat Datang Kembali, Penulis Hebat!');
        }

        return redirect()->back()->withErrors(['error' => 'Aduh, Email atau Password kamu salah nih!']);
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

        // KUNCI SAKTI: Mengarah ke 'login' kustom dan membawa pesan sukses untuk Maria!
        return redirect()->route('login')->with('status', 'Akun berhasil dibuat. Silakan masukkan email dan password Anda untuk masuk ke sistem.');
    }

    // 5. PROSES KELUAR SISTEM
    public function logout()
    {
        session()->forget(['user_id', 'user_name']);
        \Auth::logout();      
        return redirect()->route('login');
    }
}