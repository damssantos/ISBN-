<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Buku Terbit</title>
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
        
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:32px; height:32px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.9rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
        .user-header-info { display:flex; flex-direction:column; gap:0; text-align: left; }
        .user-header-name { font-weight:700; font-size:.875rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.7rem; color:var(--text-muted); line-height:1.2; font-weight: 500; }

        /* User Dropdown */
        .user-dropdown {
            position:absolute; top:calc(100% + 12px); right:0; width:220px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:12px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189,0.08); display:none; flex-direction:column; z-index:1000; overflow:hidden;
            transform-origin: top right; animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes dropdownFadeIn { from { opacity:0; transform:scale(0.95) translateY(-10px); } to { opacity:1; transform:scale(1) translateY(0); } }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:12px 16px; display:flex; align-items:center; gap:12px; color:var(--text-secondary); text-decoration:none; font-size:.85rem; font-weight:500; transition:all 0.2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:20px; }
        .user-dropdown-item i { width:18px; font-size:1rem; text-align:center; color:var(--text-muted); transition:color 0.2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:6px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248, 113, 113, 0.08); color:#f87171; }

        /* Custom Styles for Buku Terbit page */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 24px;
            margin-bottom: 28px;
        }
        .page-header h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }
        .page-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .btn-filter {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: 1px solid var(--border-color);
            background: rgba(27, 43, 56, 0.5);
            color: var(--text-secondary);
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-filter:hover {
            background: var(--bg-card);
            border-color: var(--primary);
            color: var(--primary);
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--bg-elevated);
            min-width: 200px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            z-index: 10;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-top: 8px;
        }
        .dropdown-content a {
            color: var(--text-secondary);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 0.875rem;
            transition: background 0.2s, color 0.2s;
        }
        .dropdown-content a:hover {
            background-color: var(--bg-card-hover);
            color: var(--primary);
        }
        .dropdown-content.show { 
            display: block; 
            animation: fadeIn 0.2s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Grid Layout for Book Cards */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .book-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
        }
        .book-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            background: linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%);
            pointer-events: none;
        }
        .book-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(59, 195, 189, 0.1);
        }

        .book-cover-wrapper {
            aspect-ratio: 3/4;
            background: var(--bg-elevated);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-light);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            position: relative;
        }
        .book-cover-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .book-card:hover .book-cover-wrapper img {
            transform: scale(1.05);
        }

        .book-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex-grow: 1;
        }
        .book-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.7em;
        }
        .book-author {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        .book-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            padding-top: 12px;
            border-top: 1px solid var(--border-light);
            font-size: 0.8rem;
        }
        .book-isbn {
            font-weight: 600;
            color: var(--primary-bright);
        }
        .book-date {
            color: var(--text-muted);
        }

        .btn-detail {
            width: 100%;
            padding: 10px;
            background: rgba(59, 195, 189, 0.1);
            border: 1px solid rgba(59, 195, 189, 0.2);
            color: var(--primary-bright);
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: auto;
        }
        .book-card:hover .btn-detail {
            background: var(--primary);
            color: #0f1d26;
            border-color: var(--primary);
        }

        /* List Layout Table */
        .card-table-view {
            display: none;
        }

        .card { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-top: 2px solid var(--primary-dim); 
            border-radius: 14px; 
            padding: 24px; 
            box-shadow: 0 4px 20px rgba(0,0,0,.2); 
            position: relative; 
            overflow: hidden; 
        }

        /* Table view specific */
        .table-container { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { 
            text-align: left; 
            padding: 0 0 14px; 
            font-size: .75rem; 
            color: var(--text-muted); 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: .4px; 
            border-bottom: 1px solid var(--border-color); 
        }
        td { 
            padding: 16px 0; 
            border-bottom: 1px solid var(--border-light); 
            vertical-align: middle; 
            font-size: .875rem; 
        }
        tr:last-child td { border-bottom: none; }

        .judul-naskah-terbit {
            font-weight: 600;
            font-size: .875rem;
            color: var(--text-primary);
        }
        .penulis-naskah-terbit, .waktu-naskah-terbit {
            font-size: .875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        .isbn-naskah-terbit {
            font-weight: 600;
            font-size: .875rem;
            color: var(--text-primary);
        }

        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            padding: 4px 16px;
        }
        .footer-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .pagination-container {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .page-btn:hover:not(.disabled):not(.active) {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
        }
        .page-btn.active {
            background: var(--primary);
            color: var(--bg-body);
            border-color: var(--primary);
            font-weight: 700;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        /* View mode toggle */
        .view-toggle {
            display: flex;
            background: rgba(27, 43, 56, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 2px;
        }
        .view-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--text-muted);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
        }
        .view-btn.active {
            background: var(--bg-elevated);
            color: var(--primary-bright);
        }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN YPIK PAM JAYA</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/user/buku-terbit" class="nav-link active">
                    <i class="fa-solid fa-book"></i>
                    <span class="nav-link-text">Buku Terbit</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Keluar</span>
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari buku, penulis, atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar">P</div>
                        <div class="user-header-info">
                            <div class="user-header-name">Pradama</div>
                            <div class="user-header-role">Kontributor</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <a href="/akun" class="user-dropdown-item"><i class="fa-regular fa-id-badge"></i><span>Informasi Akun</span></a>
                        <a href="/pengaturan" class="user-dropdown-item"><i class="fa-solid fa-gear"></i><span>Pengaturan</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="#" class="user-dropdown-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Header Section -->
        <div class="page-header">
            <div>
                <h1>Buku Terbit</h1>
                <p>Daftar koleksi buku Anda yang telah resmi memperoleh nomor ISBN.</p>
            </div>
            <div class="action-buttons">
                <div class="view-toggle">
                    <button class="view-btn active" id="gridToggleBtn" title="Tampilan Grid">
                        <i class="fa-solid fa-table-cells-large"></i>
                    </button>
                    <button class="view-btn" id="listToggleBtn" title="Tampilan Tabel">
                        <i class="fa-solid fa-list"></i>
                    </button>
                </div>
                <div class="dropdown">
                    <button class="btn-filter" id="filterBtn">
                        <i class="fa-solid fa-filter"></i> Filter <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; margin-left: 4px;"></i>
                    </button>
                    <div id="filterDropdown" class="dropdown-content">
                        <a href="#" class="filter-option" data-sort="newest">Urutkan dari terbaru</a>
                        <a href="#" class="filter-option" data-sort="oldest">Urutkan dari terlama</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid View Layout -->
        <div class="books-grid" id="gridView">
            <!-- Book 1 -->
            <div class="book-card" data-title="Arsitektur Digital Masa Depan" data-isbn="978-602-433-123-4">
                <div class="book-cover-wrapper">
                    <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400&fit=crop&q=80" alt="Cover Buku">
                </div>
                <div class="book-details">
                    <div class="book-title">Arsitektur Digital Masa Depan</div>
                    <div class="book-author">Dr. Ahmad Subarjo</div>
                    <div class="book-meta-row">
                        <span class="book-isbn">978-602-433-123-4</span>
                        <span class="book-date">12 Okt 2023</span>
                    </div>
                </div>
                <a href="/user/detail-buku?id=1" class="btn-detail">Lihat Detail Buku</a>
            </div>

            <!-- Book 2 -->
            <div class="book-card" data-title="Logika Pemrograman Lanjut" data-isbn="978-623-111-567-8">
                <div class="book-cover-wrapper">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&fit=crop&q=80" alt="Cover Buku">
                </div>
                <div class="book-details">
                    <div class="book-title">Logika Pemrograman Lanjut</div>
                    <div class="book-author">Siti Aminah, M.Kom</div>
                    <div class="book-meta-row">
                        <span class="book-isbn">978-623-111-567-8</span>
                        <span class="book-date">10 Okt 2023</span>
                    </div>
                </div>
                <a href="/user/detail-buku?id=2" class="btn-detail">Lihat Detail Buku</a>
            </div>

            <!-- Book 3 -->
            <div class="book-card" data-title="Seni Menulis Kreatif" data-isbn="978-602-000-888-0">
                <div class="book-cover-wrapper">
                    <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&fit=crop&q=80" alt="Cover Buku">
                </div>
                <div class="book-details">
                    <div class="book-title">Seni Menulis Kreatif</div>
                    <div class="book-author">Budi Darmawan</div>
                    <div class="book-meta-row">
                        <span class="book-isbn">978-602-000-888-0</span>
                        <span class="book-date">08 Okt 2023</span>
                    </div>
                </div>
                <a href="/user/detail-buku?id=3" class="btn-detail">Lihat Detail Buku</a>
            </div>
        </div>

        <!-- Table View Layout -->
        <div class="card card-table-view" id="tableView">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40%;">Judul Buku</th>
                            <th style="width: 25%;">Nama Penulis</th>
                            <th style="width: 15%;">Tanggal Terbit</th>
                            <th style="width: 20%;">Nomor ISBN</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td>
                                <div class="judul-naskah-terbit">Arsitektur Digital Masa Depan</div>
                            </td>
                            <td>
                                <div class="penulis-naskah-terbit">Dr. Ahmad Subarjo</div>
                            </td>
                            <td>
                                <div class="waktu-naskah-terbit">12 Okt 2023</div>
                            </td>
                            <td>
                                <div class="isbn-naskah-terbit">978-602-433-123-4</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="judul-naskah-terbit">Logika Pemrograman Lanjut</div>
                            </td>
                            <td>
                                <div class="penulis-naskah-terbit">Siti Aminah, M.Kom</div>
                            </td>
                            <td>
                                <div class="waktu-naskah-terbit">10 Okt 2023</div>
                            </td>
                            <td>
                                <div class="isbn-naskah-terbit">978-623-111-567-8</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="judul-naskah-terbit">Seni Menulis Kreatif</div>
                            </td>
                            <td>
                                <div class="penulis-naskah-terbit">Budi Darmawan</div>
                            </td>
                            <td>
                                <div class="waktu-naskah-terbit">08 Okt 2023</div>
                            </td>
                            <td>
                                <div class="isbn-naskah-terbit">978-602-000-888-0</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="table-footer">
                <span class="footer-text" id="footerText">Menampilkan 3 buku</span>
                <div class="pagination-container">
                    <button class="page-btn disabled" title="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn disabled" title="Berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // View toggle
        const gridToggleBtn = document.getElementById('gridToggleBtn');
        const listToggleBtn = document.getElementById('listToggleBtn');
        const gridView = document.getElementById('gridView');
        const tableView = document.getElementById('tableView');

        gridToggleBtn.addEventListener('click', () => {
            gridToggleBtn.classList.add('active');
            listToggleBtn.classList.remove('active');
            gridView.style.display = 'grid';
            tableView.style.display = 'none';
        });

        listToggleBtn.addEventListener('click', () => {
            listToggleBtn.classList.add('active');
            gridToggleBtn.classList.remove('active');
            gridView.style.display = 'none';
            tableView.style.display = 'block';
        });

        // Dropdown toggle
        const filterBtn = document.getElementById('filterBtn');
        const filterDropdown = document.getElementById('filterDropdown');
        
        filterBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            filterDropdown.classList.toggle('show');
        });

        window.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                if (filterDropdown.classList.contains('show')) {
                    filterDropdown.classList.remove('show');
                }
            }
        });

        // User dropdown toggle
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');

        userToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && !userToggle.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });

        // Search feature
        const searchInput = document.getElementById('searchInput');
        const bookCards = document.querySelectorAll('.book-card');
        const tableRows = document.querySelectorAll('#tableBody tr');

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();

            // Grid filter
            bookCards.forEach(card => {
                const title = card.getAttribute('data-title').toLowerCase();
                const isbn = card.getAttribute('data-isbn').toLowerCase();
                if (title.includes(query) || isbn.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            // Table filter
            tableRows.forEach(row => {
                const title = row.cells[0].textContent.toLowerCase();
                const author = row.cells[1].textContent.toLowerCase();
                const isbn = row.cells[3].textContent.toLowerCase();
                if (title.includes(query) || author.includes(query) || isbn.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
