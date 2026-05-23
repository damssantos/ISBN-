<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NaskahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;

// ==========================================
// RUTE UTAMA & HALAMAN PORTAL STATIC (FE BUNDLE)
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/akun', function () {
    return view('akun');
});

Route::get('/pengaturan', function () {
    return view('pengaturan');
});

Route::get('/table-penulis', function () {
    return view('table-penulis');
});

Route::get('/pengajuan/detail', function () {
    return view('table-pengajuan');
});


// ==========================================
// MODUL MANAGEMENT NASKAH & DRAF (BACKEND OPERATIONAL)
// ==========================================

// Form Pengajuan Baru
Route::get('/pengajuan', function () {
    return view('pengajuan');
})->name('naskah.create');

// Simpan Data Pengajuan Baru (POST)
Route::post('/pengajuan', [NaskahController::class, 'store'])->name('naskah.store');

// Daftar Naskah Utama
Route::get('/daftar-pengajuan', [NaskahController::class, 'index'])->name('naskah.index');

// Detail Naskah Satuan Berdasarkan ID
Route::get('/pengajuan/{id}', [NaskahController::class, 'show'])->name('naskah.show');

// Menampilkan Halaman Draf dari DB
Route::get('/draf', [NaskahController::class, 'draf'])->name('naskah.draf');

// Aksi Edit & Update Draf
Route::get('/pengajuan/{id}/edit', [NaskahController::class, 'edit'])->name('naskah.edit');

// Aksi Delete Draf Permanen (DELETE)
Route::delete('/pengajuan/{id}', [NaskahController::class, 'destroy'])->name('naskah.destroy');

// Rute Utama Informasi Penulis (Database Real)
Route::get('/informasi-penulis', [ProfilController::class, 'index'])->name('profil.informasi');
Route::post('/informasi-penulis/update', [ProfilController::class, 'update'])->name('profil.update');

// JURUS ANTI NYASAR: Kalau ada yang nekat nembak /informasi, otomatis dioper ke /informasi-penulis!
Route::redirect('/informasi', '/informasi-penulis');

// ==========================================
// SISTEM AUTHENTICATION (LOGIN & REGISTER)
// ==========================================

// Register Route
Route::get('/auth-register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth-register', [AuthController::class, 'register'])->name('register.store');

// Login Route
Route::get('/auth-login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth-login', [AuthController::class, 'login'])->name('login.store');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// MONITORING DASHBOARD
// ==========================================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');