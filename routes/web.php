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
