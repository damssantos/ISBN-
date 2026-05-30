<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NaskahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AuthController; 

// ==========================================
// 1. GERBANG UTAMA & RE-DIRECTION PORTAL
// ==========================================
// Buka web pertama kali (/) langsung dipaksa oper ke halaman login kustom kita
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Dashboard Utama (Sudah dikunci namanya biar tidak memicu error Route Not Found)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// ==========================================
// 2. SISTEM AUTENTIKASI KUSTOM (TABEL: akun_pengguna)
// ==========================================
// Form Login (Sign In) - Menembak URL kustom /auth-login bawaan desain FE kamu
Route::get('/auth-login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth-login', [AuthController::class, 'login'])->name('login.store');
Route::get('/pembayaran', function () {
    return view('pembayaran');
});

use App\Http\Controllers\AuthController;

// Form Register (Sign Up) - Menembak URL kustom /auth-register bawaan desain FE kamu
Route::get('/auth-register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth-register', [AuthController::class, 'register'])->name('register.store');

// Jalur Keluar Sistem (Logout)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// JURUS SAKTI ANTI-404: Kalau ada yang nyasar ngetik /login atau /register, otomatis dioper ke rute asli FE!
Route::redirect('/login', '/auth-login');
Route::redirect('/register', '/auth-register');


// ==========================================
// 3. MODUL MANAGEMENT NASKAH & DRAF
// ==========================================
Route::get('/pengajuan', function () { return view('pengajuan'); })->name('naskah.create');
Route::post('/pengajuan', [NaskahController::class, 'store'])->name('naskah.store');
Route::get('/daftar-pengajuan', [NaskahController::class, 'index'])->name('naskah.index');
Route::get('/pengajuan/{id}', [NaskahController::class, 'show'])->name('naskah.show');
Route::get('/draf', [NaskahController::class, 'draf'])->name('naskah.draf');
Route::get('/pengajuan/{id}/edit', [NaskahController::class, 'edit'])->name('naskah.edit');
Route::delete('/pengajuan/{id}', [NaskahController::class, 'destroy'])->name('naskah.destroy');


// ==========================================
// 4. MODUL INFORMASI PENULIS (TABEL: profil_penulis)
// ==========================================
Route::get('/informasi-penulis', [ProfilController::class, 'index'])->name('profil.informasi');
Route::post('/informasi-penulis/update', [ProfilController::class, 'update'])->name('profil.update');
Route::redirect('/informasi', '/informasi-penulis');


// ==========================================
// 5. COMPONENT PORTAL STATIS SUB-MENU FE
// ==========================================
Route::get('/profile', function () { return view('profile'); });
Route::get('/akun', function () { return view('akun'); });
Route::get('/pengaturan', function () { return view('pengaturan'); });
Route::get('/table-penulis', function () { return view('table-penulis'); });
Route::get('/pengajuan/detail', function () { return view('table-pengajuan'); });

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/review-naskah', function () {
    return view('admin.review-naskah');
})->name('admin.review-naskah');

Route::get('/admin/detail-review-naskah', function () {
    return view('admin.detail-review-naskah');
});

// Admin Buku Terbit page
Route::get('/admin/buku-terbit', function () {
    return view('admin.buku-terbit');
})->name('admin.buku-terbit');

// Admin Pengguna page
Route::get('/admin/pengguna', function () {
    return view('admin.pengguna');
})->name('admin.pengguna');

// Superadmin Dashboard
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard-superadmin');
})->name('superadmin.dashboard');

// Superadmin Cek Pembayaran
Route::get('/superadmin/cek-pembayaran', function () {
    return view('superadmin.cek-pembayaran');
})->name('superadmin.cek-pembayaran');

// User routes
Route::get('/user/buku-terbit', function () {
    return view('user.buku-terbit');
})->name('user.buku-terbit');

Route::get('/user/detail-buku', function () {
    return view('user.detail-buku');
})->name('user.detail-buku');
