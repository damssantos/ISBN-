<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah; 


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
        

        // 2. AMBIL MAKSIMAL 5 DATA NASKAH PALING TERBARU UNTUK TABEL BAWAH DASHBOARD
        $naskahTerbaru     = Naskah::latest()->take(5)->get();

        // 3. BANGUN DAFTAR AKTIVITAS DAN NOTIFIKASI SECARA DINAMIS
        $aktivitas = [];
        foreach ($naskahTerbaru as $naskah) {
            if ($naskah->status === 'Dalam Peninjauan') {
                $aktivitas[] = [
                    'icon' => 'fa-file-export',
                    'class' => 'icon-purple',
                    'content' => 'Naskah <span class="highlight-activity">' . e($naskah->judul) . '</span> telah dikirim ke peninjau.',
                    'time' => $naskah->updated_at->diffForHumans(),
                ];
            } elseif ($naskah->status === 'Diterbitkan') {
                $aktivitas[] = [
                    'icon' => 'fa-circle-check',
                    'class' => 'icon-emerald',
                    'content' => 'ISBN untuk <span class="highlight-activity">' . e($naskah->judul) . '</span> telah diterbitkan.',
                    'time' => $naskah->updated_at->diffForHumans(),
                ];
            } else {
                $aktivitas[] = [
                    'icon' => 'fa-inbox',
                    'class' => 'icon-gray',
                    'content' => 'Draf untuk <span class="highlight-activity">' . e($naskah->judul) . '</span> berhasil disimpan.',
                    'time' => $naskah->updated_at->diffForHumans(),
                ];
            }
        }

        // 4. OPER SEMUA VARIABEL DATABASE REAL KE BLADE WELCOME MILIK FE
        return view('welcome', compact(
            'jumlahPeninjauan', 
            'jumlahDiterbitkan', 
            'jumlahDraf', 
            'naskahTerbaru',
            'aktivitas'
        ));
    }
}