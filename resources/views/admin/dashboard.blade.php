<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        }
        .user-avatar-circle img { width: 100%; height: 100%; object-fit: cover; }

        /* Stats Grid */
        .stats-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-top: 10px; }
        
        .stat-card { 
            background:var(--bg-card); 
            border:1px solid var(--border-color); 
            border-top:3px solid var(--primary-dim); 
            border-radius:18px; 
            padding:24px; 
            box-shadow:0 10px 25px rgba(0,0,0,0.2); 
            position:relative; 
            overflow:hidden; 
            transition:all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
        }
        .stat-card::after { content:''; position:absolute; inset:0; border-radius:18px; background:linear-gradient(145deg, rgba(59, 195, 189, 0.05), transparent 60%); pointer-events:none; }
        .stat-card:hover { 
            transform:translateY(-8px); 
            border-top-color:var(--primary); 
            box-shadow:0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(59, 195, 189, 0.1); 
        }
        .stat-main { display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; }
        .stat-title { font-size:.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; }
        .stat-value { font-size:2rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.5px; }
        .stat-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; transition: transform 0.3s; }
        .stat-card:hover .stat-icon { transform: scale(1.1) rotate(5deg); }
        
        /* Stat Icon Themes */
        .stat-icon.blue   { background: rgba(59, 130, 246, 0.15); color: #60A5FA; box-shadow: 0 8px 20px rgba(59, 130, 246, 0.1); }
        .stat-icon.purple { background: rgba(168, 85, 247, 0.15); color: #C084FC; box-shadow: 0 8px 20px rgba(168, 85, 247, 0.1); }
        .stat-icon.green  { background: rgba(16, 185, 129, 0.15); color: #34D399; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1); }
        .stat-icon.orange { background: rgba(245, 158, 11, 0.15); color: #FBBF24; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.1); }

        .stat-badge-green { 
            background: rgba(16, 185, 129, 0.15); 
            color: #34D399; 
            font-size: 0.7rem; 
            font-weight: 700; 
            padding: 4px 10px; 
            border-radius: 12px; 
            border: 1px solid rgba(16, 185, 129, 0.2);
            display: inline-block;
        }

        .stat-subtitle { font-size:.875rem; color:var(--text-secondary); margin-bottom:16px; font-weight: 500; }
        .stat-link { font-size:.75rem; color:var(--primary-bright); text-decoration:none; font-weight:700; display:flex; align-items:center; gap:6px; transition:gap 0.2s; }
        .stat-link:hover { gap:10px; }

        /* Bottom Layout */
        .bottom-layout { display:grid; grid-template-columns: 2.2fr 1fr; gap:24px; margin-top:28px; }
        
        .card { 
            background:var(--bg-card); 
            border:1px solid var(--border-color); 
            border-top:2px solid var(--primary-dim); 
            border-radius:20px; 
            padding:28px; 
            box-shadow:0 10px 30px rgba(0,0,0,0.2); 
            position:relative; 
            overflow:hidden;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .card::after { content:''; position:absolute; inset:0; border-radius:20px; background:linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%); pointer-events:none; }
        .card:hover { 
            transform: translateY(-4px);
            border-top-color:var(--primary); 
            box-shadow: 0 12px 32px rgba(0,0,0,.3), 0 0 0 1px rgba(59, 195, 189, 0.1); 
        }

        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .card-title { font-size:1.15rem; font-weight:700; color:var(--text-primary); }
        .link-teal { font-size:.85rem; color:var(--primary-bright); text-decoration:none; font-weight:600; transition: opacity 0.2s; }
        .link-teal:hover { opacity: 0.8; }

        /* Table Components */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:0 0 16px; font-size:.75rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.8px; border-bottom:1px solid var(--border-color); }
        td { padding:18px 0; border-bottom:1px solid var(--border-light); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        
        .judul-naskah { font-weight:600; font-size:.9rem; color:var(--text-primary); line-height: 1.4; }
        .penulis-name { font-size:.875rem; color:var(--text-secondary); font-weight: 500; }
        
        /* Status Badges */
        .status-badge { 
            display: inline-flex; 
            align-items: center;
            gap: 5px;
            padding: 5px 12px; 
            border-radius: 20px; 
            font-size: .75rem; 
            font-weight: 600; 
            white-space: nowrap;
        }
        .status-badge::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .status-badge.disetujui { background: rgba(59, 195, 189, 0.15); color: #3BC3BD; }
        .status-badge.disetujui::before { background: #3BC3BD; }
        .status-badge.peninjauan { background: rgba(59, 130, 246, 0.12); color: #60A5FA; }
        .status-badge.peninjauan::before { background: #60A5FA; }
        .status-badge.revisi { background: rgba(156, 163, 175, 0.15); color: #9CA3AF; }
        .status-badge.revisi::before { background: #9CA3AF; }
        .status-badge.ditolak { background: rgba(239, 68, 68, 0.12); color: #F87171; }
        .status-badge.ditolak::before { background: #F87171; }
        
        .waktu-text { font-size:.825rem; color:var(--text-muted); font-weight: 500; }
        
        /* Action Button */
        .btn-review { 
            background: var(--primary); 
            color: var(--bg-body); 
            border: none;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-review:hover { 
            background: var(--primary-bright); 
            transform: translateY(-2px); 
            box-shadow: 0 4px 12px var(--primary-glow); 
        }

        /* User List Components */
        .user-list { display: flex; flex-direction: column; gap: 14px; }
        .user-item { display: flex; align-items: center; justify-content: space-between; padding: 6px 0; }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar-sm { 
            width: 38px; 
            height: 38px; 
            border-radius: 50%; 
            overflow: hidden; 
            background: var(--bg-elevated); 
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 0.9rem;
        }
        .user-avatar-sm img { width: 100%; height: 100%; object-fit: cover; }
        
        .user-name { font-size: 0.9rem; font-weight: 600; color: var(--text-primary); }
        
        .btn-outline-users {
            width: 100%;
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 12px;
            padding: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 16px;
        }
        .btn-outline-users:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
        }
    
        /* User Wrapper & Dropdown from User Profile */
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar-sm { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
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
        @keyframes dropdownFadeIn {
            from { opacity:0; transform:scale(0.95) translateY(-10px); }
            to { opacity:1; transform:scale(1) translateY(0); }
        }
        .user-dropdown-item {
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 18px;
            color:var(--text-secondary);
            text-decoration:none;
            font-size:.875rem;
            font-weight:600;
            transition:all 0.15s ease;
        }
        .user-dropdown-item:hover { background:rgba(59, 195, 189, 0.08); color:var(--primary-bright); }
        .user-dropdown-item.active { background:var(--primary-glow); color:var(--primary-bright); }
        .user-dropdown-item i { font-size:1.05rem; width:20px; text-align:center; }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:4px 0; }
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
                <a href="/admin/dashboard" class="nav-link active">
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari naskah atau ISBN...">
            </div>
            <div class="header-actions" style="padding: 4px; border-radius: 16px;">
                <div class="user-wrapper">
                    @php
                        $db_user_name = Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', session('user_id'))->value('name') ?? session('user_name') ?? 'Admin';
                    @endphp
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar-sm">{{ substr($db_user_name, 0, 1) }}</div>
                        <div class="user-header-info">
                            <div class="user-header-name">{{ $db_user_name }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/admin/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="#" class="user-dropdown-item logout" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        </header>

        <!-- Stats Grid -->
        <section class="stats-grid">
            <!-- Total Naskah Terupload -->
            <div class="stat-card">
                <div class="stat-main">
                    <div>
                        <div class="stat-title">Total Naskah</div>
                        <div class="stat-value">{{ number_format($totalNaskah) }}</div>
                    </div>
                    <div class="stat-icon blue"><i class="fa-regular fa-file-lines"></i></div>
                </div>
                <div class="stat-subtitle">Total naskah yang diupload</div>
                <a href="/admin/review-naskah" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            
            <!-- Total Pengguna -->
            <div class="stat-card">
                <div class="stat-main">
                    <div>
                        <div class="stat-title">Total Pengguna</div>
                        <div class="stat-value">{{ number_format($totalPengguna) }}</div>
                    </div>
                    <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
                </div>
                <div class="stat-subtitle">Total pengguna terdaftar</div>
                <a href="/admin/pengguna" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            
            <!-- Naskah Disetujui -->
            <div class="stat-card">
                <div class="stat-main">
                    <div>
                        <div class="stat-title">Naskah Disetujui</div>
                        <div class="stat-value">{{ number_format($naskahDisetujui) }}</div>
                    </div>
                    <div class="stat-icon green"><i class="fa-regular fa-circle-check"></i></div>
                </div>
                <div class="stat-subtitle">Naskah telah disetujui</div>
                <a href="/admin/review-naskah?status=disetujui" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            
            <!-- Dalam Peninjauan -->
            <div class="stat-card">
                <div class="stat-main">
                    <div>
                        <div class="stat-title">Dalam Peninjauan</div>
                        <div class="stat-value">{{ number_format($dalamPeninjauan) }}</div>
                    </div>
                    <div class="stat-icon orange"><i class="fa-solid fa-hourglass-half"></i></div>
                </div>
                <div class="stat-subtitle">Naskah dalam peninjauan</div>
                <a href="/admin/review-naskah?status=peninjauan" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
        </section>

        <!-- Bottom Layout -->
        <section class="bottom-layout">
            <!-- Review Naskah Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Review Naskah</h2>
                    <a href="/admin/review-naskah" class="link-teal">Lihat Semua</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>JUDUL NASKAH</th>
                                <th>PENULIS</th>
                                <th>STATUS</th>
                                <th>WAKTU</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($naskahTerbaru as $naskah)
                            <tr>
                                <td>
                                    <div class="judul-naskah">{{ $naskah->judul }}</div>
                                    @if($naskah->sub_judul)
                                    <div style="font-size:0.75rem; color:var(--text-muted);">{{ $naskah->sub_judul }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="penulis-name">{{ $naskah->penuliss->first()->nama ?? 'Anonim' }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        $statusLabel = $naskah->status;
                                        switch(strtolower($naskah->status)) {
                                            case 'disetujui':
                                                $statusClass = 'disetujui';
                                                break;
                                            case 'dalam peninjauan':
                                                $statusClass = 'peninjauan';
                                                $statusLabel = 'Peninjauan';
                                                break;
                                            case 'revisi':
                                                $statusClass = 'revisi';
                                                break;
                                            case 'ditolak':
                                                $statusClass = 'ditolak';
                                                break;
                                            default:
                                                $statusClass = 'revisi';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>
                                    <span class="waktu-text">{{ $naskah->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.detail-review-naskah', $naskah->id) }}" class="btn-review">Review</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada naskah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pengguna Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pengguna</h2>
                </div>
                <div class="user-list">
                    @forelse($usersTerbaru as $user)
                    <div class="user-item">
                        <div class="user-info">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ $user->name }}</span>
                        </div>
                    </div>
                    @empty
                    <div style="color: var(--text-muted); padding: 12px; text-align: center;">Belum ada pengguna.</div>
                    @endforelse
                </div>
                <button class="btn-outline-users" onclick="window.location.href='/admin/pengguna'">Lihat Semua Pengguna</button>
            </div>
        </section>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
    </script>

    <script>
        // Toggle user dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.style.display = userDropdown.style.display === 'flex' ? 'none' : 'flex';
            });
            document.addEventListener('click', () => {
                userDropdown.style.display = 'none';
            });
        }
    </script>
</body>
</html>
