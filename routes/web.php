<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NaskahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\AdminController;

// ==========================================
// 1. GERBANG UTAMA & RE-DIRECTION PORTAL
// ==========================================
// Buka web pertama kali (/) langsung dipaksa oper ke halaman login kustom kita
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Dashboard Utama (Sudah dikunci namanya biar tidak memicu error Route Not Found)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// ==========================================
// 2. SISTEM AUTENTIKASI KUSTOM (TABEL: akun_pengguna)
// ==========================================
// Form Login (Sign In) - Menembak URL kustom /auth-login bawaan desain FE kamu
Route::get('/auth-login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth-login', [AuthController::class, 'login'])->name('login.store');
Route::get('/pembayaran', function () {
    return view('pembayaran');
});


// Form Register (Sign Up) - Menembak URL kustom /auth-register bawaan desain FE kamu
Route::get('/auth-register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth-register', [AuthController::class, 'register'])->name('register.store');

// Jalur Keluar Sistem (Logout)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// JURUS SAKTI ANTI-404: Kalau ada yang nyasar ngetik /login atau /register, otomatis dioper ke rute asli FE!
Route::redirect('/login', '/auth-login');
Route::redirect('/register', '/auth-register');


// ==========================================
// 3. MODUL MANAGEMENT NASKAH & DRAF
// ==========================================
Route::get('/pengajuan', function () { return view('pengajuan'); })->name('naskah.create');
Route::post('/pengajuan', [NaskahController::class, 'store'])->name('naskah.store');
Route::get('/daftar-pengajuan', [NaskahController::class, 'index'])->name('naskah.index');
Route::get('/pengajuan/{id}', [NaskahController::class, 'show'])->name('naskah.show');
Route::get('/draf', [NaskahController::class, 'draf'])->name('naskah.draf');
Route::get('/pengajuan/{id}/edit', [NaskahController::class, 'edit'])->name('naskah.edit');
Route::delete('/pengajuan/{id}', [NaskahController::class, 'destroy'])->name('naskah.destroy');


// ==========================================
// 4. MODUL INFORMASI PENULIS (TABEL: profil_penulis)
// ==========================================
Route::get('/informasi-penulis', [ProfilController::class, 'create'])->name('profil.informasi');
Route::post('/informasi-penulis', [ProfilController::class, 'store'])->name('profil.store');
Route::get('/informasi-penulis/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
Route::post('/informasi-penulis/{id}/update', [ProfilController::class, 'update'])->name('profil.update');
Route::delete('/informasi-penulis/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');
Route::redirect('/informasi', '/informasi-penulis');


// ==========================================
// 5. COMPONENT PORTAL STATIS SUB-MENU FE
// ==========================================
Route::get('/profile', function () {
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login');
    }

    $akun = Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $userId)->first();
    if (!$akun) {
        return redirect()->route('login');
    }

    $user = Illuminate\Support\Facades\DB::table('profil_penulis')->where('user_id', $userId)->where('is_self', true)->first();
    if (!$user) {
        Illuminate\Support\Facades\DB::table('profil_penulis')->insert([
            'user_id' => $userId,
            'name' => $akun->name,
            'is_self' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = Illuminate\Support\Facades\DB::table('profil_penulis')->where('user_id', $userId)->where('is_self', true)->first();
    }

    $user->email = $akun->email;
    $user->no_hp = $akun->no_hp;

    return view('profile', compact('user'));
})->name('profile');

Route::post('/profile', function (Illuminate\Http\Request $request) {
    $userId = session('session_id') ?? session('user_id');
    if (!$userId) {
        return redirect()->route('login');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'no_hp' => 'nullable|string|max:20',
    ]);

    // Update profil_penulis
    Illuminate\Support\Facades\DB::table('profil_penulis')->where('user_id', $userId)->where('is_self', true)->update([
        'name' => $request->name,
        'updated_at' => now(),
    ]);

    // Update akun_pengguna
    Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $userId)->update([
        'name' => $request->name,
        'no_hp' => $request->no_hp,
    ]);

    // Perbarui session name
    session(['user_name' => $request->name]);

    return redirect()->route('profile')->with('status', 'Profil berhasil diperbarui!');
})->name('profile.update');
Route::get('/akun', function () {
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login');
    }

    $akun = Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $userId)->first();
    if (!$akun) {
        return redirect()->route('login');
    }

    return view('akun', compact('akun'));
})->name('akun');

Route::post('/akun/update', function (Illuminate\Http\Request $request) {
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login');
    }

    $request->validate([
        'email' => 'required|email|unique:akun_pengguna,email,' . $userId,
    ]);

    Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $userId)->update([
        'email' => $request->email,
    ]);

    return redirect()->route('akun')->with('status', 'Email berhasil diperbarui!');
})->name('akun.update');
Route::get('/pengaturan', function () { return view('pengaturan'); });
Route::get('/table-penulis', [ProfilController::class, 'list'])->name('profil.list');
Route::get('/pengajuan/detail', function () { return view('table-pengajuan'); });

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/review-naskah', [AdminController::class, 'reviewNaskah'])->name('admin.review-naskah');
Route::get('/admin/detail-review-naskah/{id}', [AdminController::class, 'detailReviewNaskah'])->name('admin.detail-review-naskah');
Route::post('/admin/detail-review-naskah/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.update-status');

// Admin Buku Terbit page
Route::get('/admin/buku-terbit', [AdminController::class, 'bukuTerbit'])->name('admin.buku-terbit');

// Admin Pengguna page
Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');

// Admin Profile page
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

// Superadmin Dashboard
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard-superadmin');
})->name('superadmin.dashboard');

// Superadmin Cek Pembayaran
Route::get('/superadmin/cek-pembayaran', function () {
    return view('superadmin.cek-pembayaran');
})->name('superadmin.cek-pembayaran');

// Superadmin Profile
Route::get('/superadmin/profile', function () {
    $superadminId = session('user_id');
    if (!$superadminId) {
        return redirect()->route('login');
    }
    $superadmin = Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $superadminId)->first();
    if (!$superadmin) {
        return redirect()->route('login');
    }
    return view('superadmin.profile-superadmin', compact('superadmin'));
})->name('superadmin.profile');

Route::post('/superadmin/profile/update', function (Illuminate\Http\Request $request) {
    $superadminId = session('user_id');
    if (!$superadminId) {
        return redirect()->route('login');
    }

    $request->validate([
        'name'     => 'required|string|max:255',
        'no_hp'    => 'nullable|string|max:20',
    ]);

    Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', $superadminId)->update([
        'name'  => $request->name,
        'no_hp' => $request->no_hp,
    ]);

    session(['user_name' => $request->name]);

    return redirect()->back()->with('status', 'Profil super admin berhasil diperbarui!');
})->name('superadmin.profile.update');

// User routes
Route::get('/user/buku-terbit', function () {
    return view('user.buku-terbit');
})->name('user.buku-terbit');

Route::get('/user/detail-buku', function () {
    return view('user.detail-buku');
})->name('user.detail-buku');
