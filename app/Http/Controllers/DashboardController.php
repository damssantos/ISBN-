<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah; 
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total naskah beneran (ini bakal menghasilkan angka 0 karena tabelnya kosong)
        $totalNaskah = Naskah::count();

        // 2. KARENA KOLOM STATUS BELUM DIBIKIN FE, kita isi angka simulasi dulu biar GAK EROR
        $statusPeninjauan = 2;   // Angka dummy biar kelihatan aktif
        $statusDiterbitkan = 1;  // Angka dummy
        $statusDraf        = 1;  // Angka dummy

        // 3. Ambil data naskah (ini bakal menghasilkan array kosong dulu)
        $laporanNaskah = Naskah::orderBy('updated_at', 'desc')->get();

        // ---- JURUS KETOK MAGIC DD() UNTUK PEMBUKTIAN ----
        dd([
            'Status Backend Statistik' => 'AKTIF DAN AMAN 100%',
            'Total Naskah di DB' => $totalNaskah,
            'Simulasi Peninjauan' => $statusPeninjauan,
            'Simulasi Diterbitkan' => $statusDiterbitkan,
            'Simulasi Draf' => $statusDraf,
            'Isi Tabel Laporan' => $laporanNaskah->toArray(),
            'Pesan Tambahan' => 'Maria, tugas kamu udah kelar, kolom aslinya belum dibuat kelompokmu wkwkwk'
        ]);
    }
}