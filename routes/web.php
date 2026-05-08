<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengajuan', function () {
    return view('pengajuan');
});

Route::get('/informasi-penulis', function () {
    return view('informasi-penulis');
});

Route::get('/informasi', function () {
    return view('informasi-penulis');
});
