<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Informasi Penulis</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #3BC3BD;
            --primary-bright: #5CD9D4;
            --primary-dim:    #2E9B96;
            --primary-glow:   rgba(59, 195, 189, 0.15);
            --accent:         #3BC3BD;
            --bg-body:        #0f1d26;
            --bg-sidebar:     #0c1a22;
            --bg-card:        #1B2B38;
            --bg-card-hover:  #2e4255;
            --bg-input:       #111f2a;
            --bg-elevated:    #2B3D49;
            --border-color:   #2e4459;
            --border-light:   #1e3040;
            --text-primary:   #F0F6FA;
            --text-secondary: #B8CDD8;
            --text-muted:     #7A9BAA;
            --sidebar-width:           250px;
            --sidebar-collapsed-width: 64px;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; }

        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width .3s cubic-bezier(.4,0,.2,1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity .2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background .2s,color .2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }

        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all .2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity .2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all .2s; white-space:nowrap; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 40px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Header */
        .top-header { display:flex; justify-content:flex-end; align-items:center; padding:12px 0; }
        .header-actions { 
            display:flex; 
            align-items:center; 
            background: rgba(15, 29, 38, 0.7);
            border: 1px solid var(--border-color);
            padding: 4px 12px 4px 4px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            gap: 0;
        }
        .header-icon-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:12px; border:none; background:transparent; color:var(--text-secondary); cursor:pointer; transition:all 0.2s; position:relative; font-size:1.1rem; }
        .header-icon-btn:hover { background:rgba(255,255,255,0.05); color:var(--primary-bright); }
        .header-divider { width:1px; height:24px; background:var(--border-color); margin:0 12px 0 8px; opacity: 0.6; }
        .notif-dot { position:absolute; top:10px; right:10px; width:6px; height:6px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
        .user-header-info { display:flex; flex-direction:column; gap:0; }
        .user-header-name { font-weight:700; font-size:.9375rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.2; font-weight: 500; }
        .user-dropdown {
            position:absolute;
            top:calc(100% + 12px);
            right:0;
            width:240px;
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:16px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189,0.08);
            display:none;
            flex-direction:column;
            z-index:1000;
            overflow:hidden;
            transform-origin: top right;
            animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition:color .2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,0.08); color:#f87171; }

        /* Profile Header */
        .profile-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; padding-top: 8px; }
        .profile-header-left { display:flex; align-items:center; gap:16px; }
        .profile-avatar { width:56px; height:56px; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border-radius:14px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.5rem; border:2px solid rgba(59, 195, 189,0.3); box-shadow:0 4px 16px rgba(59, 195, 189,0.2); }
        .profile-name { font-size:1.5rem; font-weight:700; color:var(--text-primary); }
        .profile-role { font-size:.875rem; color:var(--text-muted); margin-top:2px; }
        .btn-save { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border:none; padding:10px 22px; border-radius:10px; font-size:.875rem; font-weight:600; font-family:'Inter',sans-serif; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; box-shadow:0 4px 15px rgba(59, 195, 189,.25); }
        .btn-save:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(59, 195, 189,.35); }

        /* Section Cards */
        .profile-section { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:14px; padding:28px; margin-bottom:24px; box-shadow:0 4px 20px rgba(0,0,0,.2); position:relative; overflow:hidden; transition:transform .25s, box-shadow .25s; }
        .profile-section::after { content:''; position:absolute; inset:0; border-radius:14px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .profile-section:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(59, 195, 189,0.1); }
        .section-title { font-size:1.125rem; font-weight:600; color:var(--text-primary); display:flex; align-items:center; gap:10px; margin-bottom:24px; position:relative; z-index:1; }
        .section-title i { color:var(--primary); font-size:1rem; }

        /* Form */
        .form-grid { display:grid; gap:20px; position:relative; z-index:1; }
        .form-grid-2 { grid-template-columns:1fr 1fr; }
        .form-grid-3 { grid-template-columns:1fr 1fr 1fr; }
        .form-grid-1 { grid-template-columns:1fr; }
        .form-group { display:flex; flex-direction:column; gap:8px; }
        .form-label { font-size:.75rem; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:.5px; }
        .form-control { width:100%; padding:10px 14px; background:var(--bg-input); border:1px solid var(--border-color); border-radius:8px; color:var(--text-primary); font-family:'Inter',sans-serif; font-size:.875rem; transition:all .2s; }
        .form-control:focus { outline:none; border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        select.form-control { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233BC3BD'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:14px; padding-right:36px; }

        /* Upload Area */
        .upload-group { display:flex; flex-direction:column; gap:8px; }
        .upload-area { border:1px dashed var(--border-color); border-radius:10px; padding:16px; background:rgba(26,46,40,0.4); cursor:pointer; transition:all .2s; text-align:center; }
        .upload-area:hover { border-color:var(--primary-dim); background:rgba(59, 195, 189,0.03); }
        .upload-link { color:var(--primary); font-weight:600; font-size:.8125rem; }
        .upload-hint { font-size:.7rem; color:var(--text-muted); }
        .upload-preview { width:100%; height:120px; border-radius:8px; background:var(--bg-elevated); border:1px solid var(--border-color); margin-top:8px; overflow:hidden; display:flex; align-items:center; justify-content:center; }
        .upload-preview img { width:100%; height:100%; object-fit:cover; display:block; }
        .upload-preview i { font-size:2rem; color:var(--text-muted); }
        .upload-preview.has-image i { display:none; }
        .upload-file-input { display:none; }
        .upload-filename { font-size:.75rem; color:var(--primary); margin-top:6px; text-align:center; word-break:break-all; }
        input[type="date"]::-webkit-calendar-picker-indicator { filter:invert(0.7) sepia(1) saturate(3) hue-rotate(100deg); cursor:pointer; }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN TIRTA JAYA</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="nav-link"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link"><i class="fa-regular fa-file-lines"></i><span class="nav-link-text">Pengajuan</span></a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i><span class="nav-link-text">Daftar Naskah</span></a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i><span class="nav-link-text">Draf Naskah</span></a></li>
            <li class="nav-item"><a href="/informasi-penulis" class="nav-link active"><i class="fa-regular fa-user"></i><span class="nav-link-text">Informasi Penulis</span></a></li>
            <li class="nav-item"><a href="/table-penulis" class="nav-link"><i class="fa-solid fa-users-viewfinder"></i><span class="nav-link-text">Daftar Penulis</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <header class="top-header">
                <div class="header-actions">
                    <button type="button" class="header-icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i><span class="notif-dot"></span>
                    </button>
                    <div class="header-divider"></div>
                    <div class="user-wrapper">
                        <div class="user-header" id="userToggle">
                            <div class="user-avatar">{{ substr($user->name ?? 'P', 0, 1) }}</div>
                            <div class="user-header-info">
                                <div class="user-header-name">{{ $user->name ?? 'User' }}</div>
                                <div class="user-header-role">Kontributor</div>
                            </div>
                            <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                        </div>
                        <div class="user-dropdown" id="userDropdown">
                            <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                            <a href="/id-akun" class="user-dropdown-item"><i class="fa-regular fa-id-badge"></i><span>Informasi Akun</span></a>
                            <a href="/pengaturan" class="user-dropdown-item"><i class="fa-solid fa-gear"></i><span>Pengaturan</span></a>
                            <div class="user-dropdown-divider"></div>
                            <a href="#" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="profile-header">
                <div class="profile-header-left">
                    <div class="profile-avatar">{{ substr($user->name ?? 'P', 0, 1) }}</div>
                    <div>
                        <div class="profile-name">{{ $user->name ?? 'Informasi Penulis' }}</div>
                        <div class="profile-role">Kelola detail informasi profil Anda secara realtime</div>
                    </div>
                </div>
                <button type="submit" class="btn-save" id="btnSave" style="padding: 10px 24px; border-radius: 8px; font-weight: 600; border:none; cursor:pointer;">
                    <i class="fa-solid fa-pen-to-square"></i> Perbarui Data
                </button>
            </div>

            @if(session('status'))
                <div style="background: rgba(59, 195, 189, 0.15); border: 1px solid var(--primary); color: var(--primary-bright); padding: 14px; border-radius: 10px; margin-bottom: 24px; font-weight: 600; display:flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                </div>
            @endif

            <div class="profile-section">
                <h2 class="section-title"><i class="fa-solid fa-user-circle"></i> Informasi Pribadi</h2>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Gelar Depan</label>
                        <input type="text" name="gelar_depan" class="form-control" value="{{ $user->gelar_depan ?? '' }}" placeholder="Contoh: Dr. / Prof.">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Penulis</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}" required placeholder="Masukkan nama penulis...">
                    </div>
                </div>
                <div class="form-grid form-grid-3" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Gelar Belakang</label>
                        <input type="text" name="gelar_belakang" class="form-control" value="{{ $user->gelar_belakang ?? '' }}" placeholder="Contoh: M.Kom / Ph.D">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ ($user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ ($user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-control">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ ($user->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen Protestan" {{ ($user->agama ?? '') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                            <option value="Katolik" {{ ($user->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ ($user->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ ($user->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ ($user->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $user->tempat_lahir ?? '' }}" placeholder="Masukkan kota lahir...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title"><i class="fa-solid fa-id-card"></i> Identitas & Kontak</h2>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ $user->nik ?? '' }}" placeholder="Masukkan 16 digit NIK...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Sesuai KTP</label>
                        <input type="text" class="form-control" value="{{ $user->name ?? '' }}" placeholder="Nama sesuai KTP..." disabled style="opacity:0.6;">
                    </div>
                </div>
                <div class="form-grid form-grid-1" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Alamat Sesuai KTP</label>
                        <input type="text" name="alamat_ktp" class="form-control" value="{{ $user->alamat_ktp ?? '' }}" placeholder="Masukkan alamat lengkap sesuai KTP...">
                    </div>
                </div>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email ?? 'email@gmail.com' }}" disabled style="opacity: 0.6;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" value="081234567890" disabled style="opacity: 0.5;">
                    </div>
                </div>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" value="0215550123" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group"></div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title"><i class="fa-solid fa-building"></i> Informasi Institusi & Pajak</h2>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Nama Kantor</label>
                        <input type="text" class="form-control" value="Universitas Indonesia" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Mengajar</label>
                        <input type="text" class="form-control" value="Depok, Jawa Barat" disabled style="opacity: 0.5;">
                    </div>
                </div>
                <div class="form-grid form-grid-1" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Alamat Surat Menyurat</label>
                        <input type="text" class="form-control" value="Gedung Dekanat Lt. 2, Kampus UI Depok" disabled style="opacity: 0.5;">
                    </div>
                </div>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">NPWP</label>
                        <input type="text" class="form-control" value="01.234.567.8-901.000" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama NPWP</label>
                        <input type="text" class="form-control" value="{{ $user->name ?? 'Pradama Wijaya' }}" disabled style="opacity: 0.5;">
                    </div>
                </div>
                <div class="form-grid form-grid-1">
                    <div class="form-group">
                        <label class="form-label">Alamat NPWP</label>
                        <input type="text" class="form-control" value="Jl. Kebon Jeruk No. 45, Jakarta Barat" disabled style="opacity: 0.5;">
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title"><i class="fa-solid fa-credit-card"></i> Informasi Rekening</h2>
                <div class="form-grid form-grid-2" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control" value="1234567890" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Rekening</label>
                        <input type="text" class="form-control" value="{{ $user->name ?? 'Pradama Wijaya' }}" disabled style="opacity: 0.5;">
                    </div>
                </div>
                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" value="Bank Mandiri" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cabang Bank</label>
                        <input type="text" class="form-control" value="Jakarta Thamrin" disabled style="opacity: 0.5;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kota Bank</label>
                        <input type="text" class="form-control" value="Jakarta Pusat" disabled style="opacity: 0.5;">
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title"><i class="fa-solid fa-file-arrow-up"></i> Dokumen & Lampiran</h2>
                <div class="form-grid form-grid-2">
                    <div class="upload-group">
                        <label class="form-label">Upload KTP</label>
                        <input type="file" class="upload-file-input" id="uploadKtp" accept="image/jpeg,image/png">
                        <div class="upload-area" id="uploadKtpArea">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.25rem;color:var(--primary);margin-bottom:6px;"></i>
                            <div><span class="upload-link">Pilih berkas atau tarik ke sini</span></div>
                            <div class="upload-hint">Format JPG, PNG (Maks 5MB)</div>
                        </div>
                        <div class="upload-preview" id="previewKtp">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div class="upload-filename" id="filenameKtp"></div>
                    </div>
                    <div class="upload-group">
                        <label class="form-label">Upload Foto Penulis</label>
                        <input type="file" class="upload-file-input" id="uploadFoto" accept="image/jpeg,image/png">
                        <div class="upload-area" id="uploadFotoArea">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.25rem;color:var(--primary);margin-bottom:6px;"></i>
                            <div><span class="upload-link">Pilih berkas atau tarik ke sini</span></div>
                            <div class="upload-hint">Format JPG, PNG (Maks 5MB)</div>
                        </div>
                        <div class="upload-preview" id="previewFoto">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <div class="upload-filename" id="filenameFoto"></div>
                    </div>
                </div>
            </div>

        </form>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Upload KTP & Foto preview handlers
        function setupUpload(areaId, inputId, previewId, filenameId) {
            const area = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const filename = document.getElementById(filenameId);

            area.addEventListener('click', () => input.click());
            area.addEventListener('dragover', (e) => { e.preventDefault(); area.style.borderColor = 'var(--primary)'; });
            area.addEventListener('dragleave', () => { area.style.borderColor = ''; });
            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.style.borderColor = '';
                if (e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    handleFile(input.files[0], preview, filename);
                }
            });
            input.addEventListener('change', () => {
                if (input.files.length) handleFile(input.files[0], preview, filename);
            });
        }

        function handleFile(file, preview, filenameEl) {
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) { alert('Ukuran file maksimal 5MB'); return; }
            if (!['image/jpeg','image/png'].includes(file.type)) { alert('Format harus JPG atau PNG'); return; }
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.classList.add('has-image');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                filenameEl.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }

        setupUpload('uploadKtpArea', 'uploadKtp', 'previewKtp', 'filenameKtp');
        setupUpload('uploadFotoArea', 'uploadFoto', 'previewFoto', 'filenameFoto');

        // User Dropdown logic
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });
    </script>
</body>
</html>