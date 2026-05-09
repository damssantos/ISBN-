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

Route::post('/pengajuan-naskah', [NaskahController::class, 'store'])->name('naskah.store');