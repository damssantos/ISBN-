<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Profil Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #3BC3BD;
            --primary-bright: #5CD9D4;
            --primary-dim:    #2E9B96;
            --primary-glow:   rgba(59, 195, 189, 0.15);
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
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 64px;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x: hidden; }

        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4, 0, .2, 1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity 0.2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar.collapsed .brand-subtitle { display:none; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background 0.2s, color 0.2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }

        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all 0.2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity 0.2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top: auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; cursor: pointer; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248, 113, 113, 0.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main Content */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Top Header */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
        .search-input::placeholder { color:var(--text-muted); }
        .search-input:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }

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
        
        .user-avatar-circle { 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, var(--primary), var(--primary-dim)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            overflow: hidden; 
            border: 1px solid var(--border-color); 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            font-weight: 700;
            font-size: 0.8rem;
            color: #fff;
        }

        /* Profile Header */
        .profile-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding: 28px 32px;
            background: linear-gradient(135deg, rgba(59, 195, 189, 0.08), rgba(59, 195, 189, 0.02));
            border: 1px solid rgba(59, 195, 189, 0.15);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }
        .profile-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 195, 189, 0.08), transparent 70%);
        }
        .profile-hero-left { display: flex; align-items: center; gap: 20px; position: relative; z-index: 1; }
        .profile-avatar-lg {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dim));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: #fff;
            border: 2px solid rgba(59, 195, 189, 0.3);
            box-shadow: 0 8px 24px rgba(59, 195, 189, 0.25);
            flex-shrink: 0;
        }
        .profile-hero-info { display: flex; flex-direction: column; gap: 4px; }
        .profile-hero-name { font-size: 1.5rem; font-weight: 700; color: var(--text-primary); }
        .profile-hero-role { 
            font-size: 0.8rem; 
            font-weight: 600; 
            color: var(--primary); 
            background: rgba(59, 195, 189, 0.1);
            border: 1px solid rgba(59, 195, 189, 0.2);
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
            width: fit-content;
        }
        .profile-hero-email { font-size: 0.85rem; color: var(--text-muted); margin-top: 2px; }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), var(--primary-dim));
            color: #fff;
            border: none;
            padding: 11px 24px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(59, 195, 189, 0.3);
            position: relative;
            z-index: 1;
        }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59, 195, 189, 0.4); }

        /* Section Cards */
        .profile-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-top: 2px solid var(--primary-dim);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,.2);
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }
        .profile-section::after { content:''; position:absolute; inset:0; border-radius:16px; background:linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%); pointer-events:none; }
        .profile-section:hover { transform:translateY(-3px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3), 0 0 0 1px rgba(59, 195, 189, 0.1); }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }
        .section-title i { 
            color: var(--primary);
            font-size: 1rem;
            width: 34px;
            height: 34px;
            background: rgba(59, 195, 189, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form */
        .form-grid { display:grid; gap:18px; position:relative; z-index:1; }
        .form-grid-2 { grid-template-columns:1fr 1fr; }
        .form-grid-3 { grid-template-columns:1fr 1fr 1fr; }
        .form-grid-1 { grid-template-columns:1fr; }
        .form-group { display:flex; flex-direction:column; gap:7px; }
        .form-label { font-size:.72rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.7px; }
        .form-control { 
            width:100%; 
            padding:10px 14px; 
            background:var(--bg-input); 
            border:1px solid var(--border-color); 
            border-radius:9px; 
            color:var(--text-primary); 
            font-family:'Inter', sans-serif; 
            font-size:.875rem; 
            transition:all .2s; 
        }
        .form-control:focus { outline:none; border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        .form-control:disabled { opacity: 0.5; cursor: not-allowed; }

        /* Alert */
        .alert-success {
            background: rgba(59, 195, 189, 0.12);
            border: 1px solid rgba(59, 195, 189, 0.3);
            color: var(--primary-bright);
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Stats Row */
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
        .mini-stat {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .mini-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .mini-stat-icon.teal { background: rgba(59, 195, 189, 0.12); color: var(--primary); }
        .mini-stat-icon.blue { background: rgba(59, 130, 246, 0.12); color: #60A5FA; }
        .mini-stat-icon.purple { background: rgba(168, 85, 247, 0.12); color: #C084FC; }
        .mini-stat-label { font-size: 0.72rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        .mini-stat-value { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon" style="font-size: 1.25rem; color: var(--primary);"></i>
                <div style="display: flex; flex-direction: column; overflow: hidden;">
                    <span class="brand-text">ISBN YPIK PAM JAYA</span>
                    <span class="brand-subtitle" style="font-size: 0.7rem; color: var(--text-muted); font-weight: 500; margin-top: -2px;">Admin Portal</span>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/review-naskah" class="nav-link">
                    <i class="fa-solid fa-file-signature"></i>
                    <span class="nav-link-text">Review Naskah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/buku-terbit" class="nav-link">
                    <i class="fa-solid fa-book"></i>
                    <span class="nav-link-text">Buku Terbit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/pengguna" class="nav-link">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-link-text">Pengguna</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/profile" class="nav-link active">
                    <i class="fa-regular fa-user"></i>
                    <span class="nav-link-text">Profil</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket" style="transform: rotate(180deg);"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" placeholder="Cari...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-avatar-circle">
                    {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Alert Sukses --}}
        @if(session('status'))
        <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('status') }}
        </div>
        @endif

        {{-- Profile Hero --}}
        <div class="profile-hero">
            <div class="profile-hero-left">
                <div class="profile-avatar-lg">
                    {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                </div>
                <div class="profile-hero-info">
                    <div class="profile-hero-name">{{ $admin->name ?? 'Admin' }}</div>
                    <div class="profile-hero-role">
                        <i class="fa-solid fa-shield-halved" style="font-size: 0.7rem;"></i>
                        {{ ucfirst($admin->role ?? 'Admin') }}
                    </div>
                    <div class="profile-hero-email">{{ $admin->email ?? '' }}</div>
                </div>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST" id="profileForm">
                @csrf
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Mini Stats --}}
        <div class="stats-row">
            <div class="mini-stat">
                <div class="mini-stat-icon teal"><i class="fa-solid fa-shield-halved"></i></div>
                <div>
                    <div class="mini-stat-label">Role Akun</div>
                    <div class="mini-stat-value">{{ ucfirst($admin->role ?? 'Admin') }}</div>
                </div>
            </div>
            <div class="mini-stat">
                <div class="mini-stat-icon blue"><i class="fa-solid fa-envelope"></i></div>
                <div>
                    <div class="mini-stat-label">Email</div>
                    <div class="mini-stat-value" style="font-size: 0.85rem; word-break: break-all;">{{ $admin->email ?? '-' }}</div>
                </div>
            </div>
            <div class="mini-stat">
                <div class="mini-stat-icon purple"><i class="fa-solid fa-phone"></i></div>
                <div>
                    <div class="mini-stat-label">No. HP</div>
                    <div class="mini-stat-value">{{ $admin->no_hp ?? 'Belum diisi' }}</div>
                </div>
            </div>
        </div>

        {{-- Form Profil --}}
        <form action="{{ route('admin.profile.update') }}" method="POST" id="profileFormMain">
            @csrf

            {{-- Informasi Akun --}}
            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-user-shield"></i>
                    Informasi Akun
                </h2>
                <div class="form-grid form-grid-2" style="margin-bottom: 18px;">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $admin->name ?? '' }}" required placeholder="Masukkan nama lengkap...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $admin->email ?? '' }}" disabled placeholder="Email tidak dapat diubah">
                    </div>
                </div>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $admin->no_hp ?? '' }}" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($admin->role ?? 'Admin') }}" disabled>
                    </div>
                </div>
            </div>

            {{-- Keamanan Akun --}}
            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-lock"></i>
                    Keamanan Akun
                </h2>
                <div class="form-grid form-grid-2" style="margin-bottom: 18px;">
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru...">
                    </div>
                </div>
                <p style="font-size: 0.775rem; color: var(--text-muted); position: relative; z-index: 1;">
                    <i class="fa-solid fa-circle-info" style="color: var(--primary);"></i>
                    Kosongkan kolom password jika tidak ingin mengubah password akun Anda.
                </p>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 4px;">
                <button type="submit" class="btn-save" style="padding: 12px 32px; font-size: 0.9rem;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
                </button>
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
    </script>
</body>
</html>
