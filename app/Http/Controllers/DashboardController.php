<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah; 
use App\Models\Penulis; // Menambahkan model Penulis agar hitungan total penulis unik aktif riil

class DashboardController extends Controller
{
    // ==========================================
    // FUNGSI UTAMA UNTUK MENAMPILKAN DASHBOARD REAL
    // ==========================================
    public function index()
    {
        // 1. HITUNG JUMLAH DATA REAL TIME DARI DATABASE SECARA DINAMIS
        $jumlahPeninjauan  = Naskah::where('status', 'Dalam Peninjauan')->count();
        $jumlahDiterbitkan = Naskah::where('status', 'Diterbitkan')->count();
        $jumlahDraf        = Naskah::where('status', 'Draf')->count();
        
        // Hitung total penulis unik yang sudah mendaftarkan naskah di database
        $jumlahPenulis     = Penulis::distinct('nama')->count();

        // 2. AMBIL MAKSIMAL 5 DATA NASKAH PALING TERBARU UNTUK TABEL BAWAH DASHBOARD
        $naskahTerbaru     = Naskah::latest()->take(5)->get();

        // 3. OPER SEMUA VARIABEL DATABASE REAL KE BLADE WELCOME MILIK FE
        return view('welcome', compact(
            'jumlahPeninjauan', 
            'jumlahDiterbitkan', 
            'jumlahDraf', 
            'jumlahPenulis', 
            'naskahTerbaru'
        ));
    }
}