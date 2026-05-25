<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah;
use App\Models\Penulis; // Menambahkan model Penulis agar relasi aman

class NaskahController extends Controller
{
    // ==========================================
    // 1. FUNGSI UNTUK MENAMPILKAN DAFTAR NASKAH
    // ==========================================
    public function index()
    {
        // Ambil semua data naskah dari database beserta urutan terbaru
        $naskahs = Naskah::latest()->get(); 
        
        // Lempar variabel $naskahs ke file blade FE
        return view('daftar-pengajuan', compact('naskahs'));
    }

    // ==========================================
    // 2. FUNGSI UNTUK MENAMPILKAN DETAIL NASKAH Satuan
    // ==========================================
    public function show($id)
    {
        // 1. Cari data naskah berdasarkan ID, kalau gak ada langsung auto-404 yang beneran
        $naskah = Naskah::findOrFail($id);
        
        // 2. Ambil data penulis yang terikat dengan naskah_id ini
        $penuliss = Penulis::where('naskah_id', $id)->orderBy('urutan', 'asc')->get();
        
        // 3. Lempar ke halaman detail milik FE (table-pengajuan.blade.php)
        return view('table-pengajuan', compact('naskah', 'penuliss'));
    }

    // ==========================================
    // 3. FUNGSI UNTUK MENYIMPAN DATA (TERBITKAN / DRAF)
    // ==========================================
    public function store(Request $request)
    {
        // 1. Validasi tetap sama dan aman
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'sinopsis' => 'nullable|string',
            'penulis' => 'required|array', // Memastikan data penulis terkirim dalam bentuk array
            'penulis.*.nama' => 'required|string|max:255',
            'penulis.*.email' => 'required|email',
            'penulis.*.urutan' => 'required|integer',
            'penulis.*.biodata' => 'nullable|string',
        ]);

        // 2. Simpan Data Naskah Utama
        $naskah = new Naskah();
        $naskah->judul = $request->judul;
        $naskah->sub_judul = $request->sub_judul;
        $naskah->sinopsis = $request->sinopsis;
        
        // JURUS SAKTI PENDETEKSI TOMBOL DRAF:
        // Jika user mengeklik tombol yang punya name="action" dan value="draft"
        if ($request->input('action') === 'draft') {
            $naskah->status = 'Draf';
        } else {
            $naskah->status = 'Dalam Peninjauan';
        }
        
        // Proses upload file tetap aman di bawahnya
        if ($request->hasFile('foto_sampul')) {
            $naskah->foto_sampul = $request->file('foto_sampul')->store('covers', 'public');
        }
        if ($request->hasFile('file_naskah')) {
            $naskah->file_naskah = $request->file('file_naskah')->store('naskahs', 'public');
        }
        
        $naskah->save(); // Eksekusi simpan ke database untuk generate naskah_id

        // 3. Loop Penulis tetap sama
        foreach ($request->penulis as $dataPenulis) {
            $penulis = new Penulis();
            $penulis->naskah_id = $naskah->id; // Mengaitkan dengan ID naskah yang baru tersimpan
            $penulis->nama = $dataPenulis['nama'];
            $penulis->email = $dataPenulis['email'];
            $penulis->urutan = $dataPenulis['urutan'];
            $penulis->biodata = $dataPenulis['biodata'];
            $penulis->save();
        }

        // Redirect sesuai jenis simpanan agar FE-nya makin pinter
        if ($naskah->status === 'Draf') {
            return redirect()->route('naskah.draf')->with('status', 'MANTAP! Draf berhasil disimpan ke database!');
        }

        return redirect()->route('naskah.index')->with('status', 'MANTAP! Data naskah berhasil diterbitkan!');
    }

    // ==========================================
    // 4. FUNGSI UNTUK MENAMPILKAN DAFTAR DRAF
    // ==========================================
    public function draf()
    {
        // Ambil data naskah yang statusnya 'Draf' dari database
        $naskahs = Naskah::where('status', 'Draf')->latest()->get();
        return view('draf', compact('naskahs'));
    }

    // ======================================================
    // 5. FIXED ABSOLUT: FORM EDIT BEBAS EROR RELATIONSHIP!
    // ======================================================
    public function edit($id)
    {
        // 1. Ambil data naskah drafnya secara mandiri tanpa "with"
        $naskah = Naskah::findOrFail($id); 
        
        // 2. Ambil data penulisnya secara manual lewat query Penulis biasa
        $penuliss = Penulis::where('naskah_id', $id)->orderBy('urutan', 'asc')->get();
        
        // 3. Lempar kedua variabel ini ke form pengajuan buat diedit!
        return view('pengajuan', compact('naskah', 'penuliss')); 
    }

    // ======================================================
    // 6. FIXED: MENGHAPUS DATA & LOCK TETAP DI HALAMAN DRAF
    // ======================================================
    public function destroy($id)
    {
        $naskah = Naskah::findOrFail($id);
        $naskah->delete(); // Hapus naskah dari DB

        // LOCK REDIRECT: Dipaksa balik wajib ke halaman draf, gak boleh mental!
        return redirect()->route('naskah.draf')->with('status', 'MANTAP! Data draf berhasil dihapus secara permanen!');
    }
}