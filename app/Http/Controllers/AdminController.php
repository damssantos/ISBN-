<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 1. DASHBOARD
    public function dashboard()
    {
        $totalNaskah = Naskah::count();
        $totalPengguna = DB::table('akun_pengguna')->count();
        $naskahDisetujui = Naskah::where('status', 'Disetujui')->count();
        $dalamPeninjauan = Naskah::where('status', 'Dalam Peninjauan')->count();

        $naskahTerbaru = Naskah::with('penuliss')->latest()->take(5)->get();
        $usersTerbaru = DB::table('akun_pengguna')->latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalNaskah',
            'totalPengguna',
            'naskahDisetujui',
            'dalamPeninjauan',
            'naskahTerbaru',
            'usersTerbaru'
        ));
    }

    // 2. LIST NASKAH UNTUK REVIEWS
    public function reviewNaskah(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = Naskah::with('penuliss');

        if ($status !== 'all') {
            if ($status === 'peninjauan') {
                $query->where('status', 'Dalam Peninjauan');
            } elseif ($status === 'disetujui') {
                $query->where('status', 'Disetujui');
            } elseif ($status === 'revisi') {
                $query->where('status', 'Revisi');
            } elseif ($status === 'ditolak') {
                $query->where('status', 'Ditolak');
            }
        }

        $naskahs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.review-naskah', compact('naskahs', 'status'));
    }

    // 3. DETAIL REVIEW NASKAH
    public function detailReviewNaskah($id)
    {
        $naskah = Naskah::with('penuliss')->findOrFail($id);
        return view('admin.detail-review-naskah', compact('naskah'));
    }

    // 4. PROSES UPDATE STATUS NASKAH
    public function updateStatus(Request $request, $id)
    {
        $naskah = Naskah::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'setujui') {
            $naskah->status = 'Disetujui';
            // Generate dummy ISBN if not already exists (978-623-XXXX-XXX-X)
            if (!$naskah->isbn) {
                $naskah->isbn = '978-623-' . rand(1000, 9999) . '-' . rand(100, 999) . '-' . rand(0, 9);
            }
            $naskah->catatan_revisi = null; // Clear revision notes upon approval
        } elseif ($action === 'revisi') {
            $naskah->status = 'Revisi';
            $naskah->catatan_revisi = $request->input('catatan_revisi');
        } elseif ($action === 'tolak') {
            $naskah->status = 'Ditolak';
            $naskah->catatan_revisi = null;
        }

        $naskah->save();

        return redirect()->route('admin.review-naskah')->with('status', 'Status naskah berhasil diperbarui!');
    }

    // 5. BUKU TERBIT
    public function bukuTerbit(Request $request)
    {
        $sort = $request->query('sort', 'newest');
        $query = Naskah::with('penuliss')->where('status', 'Disetujui');

        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $naskahs = $query->paginate(10)->withQueryString();

        return view('admin.buku-terbit', compact('naskahs', 'sort'));
    }

    // 6. DAFTAR PENGGUNA
    public function pengguna(Request $request)
    {
        $search = $request->query('search');
        $query = DB::table('akun_pengguna');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        $totalPengguna = DB::table('akun_pengguna')->count();

        return view('admin.pengguna', compact('users', 'totalPengguna', 'search'));
    }
}
