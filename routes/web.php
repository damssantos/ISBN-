<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengajuan', function () {
    return view('pengajuan');
});

Route::get('/informasi', function () {
    return view('informasi'); 
});

use App\Http\Controllers\NaskahController;

Route::post('/pengajuan', [NaskahController::class, 'store'])->name('naskah.store');

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

Route::get('/draf', function () {
    return view('draf');
});

Route::get('/daftar-pengajuan', function () {
    return view('daftar-pengajuan');
});

use App\Http\Controllers\AuthController;

// Ganti url /register jadi /auth-register biar gak nabrak
Route::get('/auth-register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth-register', [AuthController::class, 'register'])->name('register.store');

// Ganti url /login jadi /auth-login biar aman
Route::get('/auth-login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth-login', [AuthController::class, 'login'])->name('login.store');

// Route untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');