<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Detail Review Naskah</title>
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
            --bg-card:        #12222d;
            --bg-card-hover:  #1b2e3c;
            --bg-input:       #111f2a;
            --bg-elevated:    #1c2e3c;
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
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:rgba(18, 34, 45, 0.8); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
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

        /* Page Layout */
        .back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: var(--primary); font-weight: 600; font-size: 0.9rem; margin-top: 12px; transition: color 0.2s; }
        .back-link:hover { color: var(--primary-bright); }
        
        .title-bar { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; margin-bottom: 28px; }
        .page-title { font-size: 1.75rem; font-weight: 700; color: var(--text-primary); }
        
        .status-badge-lg { 
            background: rgba(245, 158, 11, 0.1); 
            color: #FBBF24; 
            border: 1px solid rgba(245, 158, 11, 0.2); 
            padding: 8px 18px; 
            border-radius: 20px; 
            font-size: 0.825rem; 
            font-weight: 700; 
        }

        /* Detail Layout Split Columns */
        .detail-layout { display: grid; grid-template-columns: 280px 1fr; gap: 36px; align-items: start; }

        /* Left Column Cover Style */
        .cover-section { display: flex; flex-direction: column; gap: 12px; }
        .label-muted { font-size: 0.725rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }
        
        .cover-card { 
            background: rgba(18, 34, 45, 0.7); 
            border: 1px solid var(--border-color); 
            border-radius: 20px; 
            padding: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .cover-image { width: 100%; border-radius: 12px; object-fit: cover; aspect-ratio: 2 / 3; display: block; }

        /* Right Column Detail Form Styles */
        .info-section { display: flex; flex-direction: column; gap: 24px; }
        .info-item { display: flex; flex-direction: column; gap: 6px; }
        
        .info-value-title { font-size: 1.5rem; font-weight: 700; color: var(--primary); }
        .info-value-text { font-size: 0.95rem; font-weight: 500; color: var(--text-primary); }
        .info-value-paragraph { font-size: 0.925rem; font-weight: 400; color: var(--text-secondary); line-height: 1.6; text-align: justify; }

        /* Naskah Download Card */
        .naskah-card {
            background: rgba(18, 34, 45, 0.7);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: border-color 0.2s, background-color 0.2s;
        }
        .naskah-card:hover {
            border-color: var(--primary);
            background: rgba(18, 34, 45, 0.9);
        }
        .naskah-info { display: flex; align-items: center; gap: 16px; }
        .naskah-icon-wrapper { 
            width: 44px; 
            height: 44px; 
            background: rgba(59, 195, 189, 0.1); 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 1.25rem; 
            color: var(--primary); 
        }
        .naskah-name-group { display: flex; flex-direction: column; gap: 2px; }
        .naskah-filename { font-weight: 600; font-size: 0.9rem; color: var(--text-primary); }
        .naskah-meta { font-size: 0.775rem; color: var(--text-muted); font-weight: 500; }
        .naskah-link { font-size: 1.15rem; color: var(--primary); cursor: pointer; transition: color 0.2s; text-decoration: none; }
        .naskah-link:hover { color: var(--primary-bright); }

        /* Action Buttons Grid */
        .actions-grid { display: grid; grid-template-columns: 1fr 1fr 1.2fr; gap: 16px; margin-top: 10px; }
        
        .btn-action-lg {
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn-action-lg.tolak {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.3);
            color: #F87171;
        }
        .btn-action-lg.tolak:hover {
            background: rgba(239, 68, 68, 0.12);
            border-color: #F87171;
            transform: translateY(-1px);
        }

        .btn-action-lg.revisi {
            background: var(--bg-elevated);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        .btn-action-lg.revisi:hover {
            background: var(--bg-card-hover);
            border-color: var(--text-secondary);
            transform: translateY(-1px);
        }

        .btn-action-lg.setujui {
            background: var(--primary);
            color: var(--bg-body);
            font-weight: 800;
        }
        .btn-action-lg.setujui:hover {
            background: var(--primary-bright);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(59, 195, 189, 0.3);
        }

        /* Revision Notes Styles */
        .catatan-label { color: var(--primary); font-size: 0.775rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 10px; }
        
        .textarea-revisi {
            width: 100%;
            height: 120px;
            background: rgba(17, 31, 42, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            color: var(--text-primary);
            font-size: 0.9rem;
            outline: none;
            resize: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            line-height: 1.5;
        }
        .textarea-revisi::placeholder { color: var(--text-muted); }
        .textarea-revisi:focus {
            border-color: var(--primary-dim);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .naskah-card {
            cursor: pointer;
        }

        /* Document Viewer Modal */
        .doc-viewer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 28, 0.85);
            backdrop-filter: blur(8px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .doc-viewer-backdrop.show {
            display: flex;
            opacity: 1;
        }
        .doc-viewer-container {
            width: 90%;
            max-width: 1000px;
            height: 90vh;
            background: var(--bg-sidebar);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .doc-viewer-backdrop.show .doc-viewer-container {
            transform: scale(1);
        }
        .doc-viewer-header {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(18, 34, 45, 0.8);
        }
        .doc-viewer-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .doc-viewer-title i {
            color: var(--primary);
        }
        .doc-viewer-controls {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .control-btn {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 1rem;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .control-btn:hover {
            background: var(--bg-card-hover);
            color: var(--primary);
        }
        .zoom-text {
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--text-muted);
            min-width: 48px;
            text-align: center;
        }
        .doc-viewer-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-close-viewer {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            color: #F87171;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-close-viewer:hover {
            background: #F87171;
            color: var(--bg-body);
        }
        .doc-viewer-body {
            flex: 1;
            background: #09131a;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            overflow: hidden;
        }
        /* Simulated Page Style */
        .doc-page {
            width: 612px; /* Standard letter/A4 ratio width */
            min-height: 792px;
            background: #ffffff;
            color: #2D3748;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            border-radius: 4px;
            padding: 54px 64px;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .doc-page-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 8px;
            margin-bottom: 24px;
            font-size: 0.725rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
        }
        .doc-page-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .doc-page-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1A202C;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .doc-page-subtitle {
            font-size: 1rem;
            font-weight: 700;
            color: #4A5568;
            margin-bottom: 8px;
        }
        .doc-page-p {
            font-size: 0.85rem;
            line-height: 1.7;
            text-align: justify;
            margin-bottom: 8px;
        }
        .doc-page-footer {
            margin-top: 24px;
            border-top: 1px solid #E2E8F0;
            padding-top: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.725rem;
            color: #718096;
            font-weight: 600;
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
                <a href="/admin/dashboard" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/review-naskah" class="nav-link active">
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

        <!-- Back Link & Title Bar -->
        <a href="/admin/review-naskah" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        
        <div class="title-bar">
            <h1 class="page-title">Detail Review Naskah</h1>
            <span class="status-badge-lg">{{ $naskah->status }}</span>
        </div>

        <!-- Detail Layout Split Column -->
        <div class="detail-layout">
            
            <!-- Left Column: Book Cover -->
            <div class="cover-section">
                <span class="label-muted">Foto Cover</span>
                <div class="cover-card">
                    <img src="{{ $naskah->foto_sampul ? asset('storage/' . $naskah->foto_sampul) : 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300&fit=crop&q=80' }}" alt="{{ $naskah->judul }} Cover" class="cover-image">
                </div>
            </div>

            <!-- Right Column: Info & Form Details -->
            <div class="info-section">
                
                <!-- Judul Buku -->
                <div class="info-item">
                    <span class="label-muted">Judul Buku</span>
                    <span class="info-value-title">{{ $naskah->judul }}</span>
                </div>

                <!-- Sub Judul -->
                <div class="info-item">
                    <span class="label-muted">Sub Judul</span>
                    <span class="info-value-text">{{ $naskah->sub_judul ?? '-' }}</span>
                </div>

                <!-- Nama Penulis -->
                <div class="info-item">
                    <span class="label-muted">Nama Penulis</span>
                    <span class="info-value-text">{{ $naskah->penuliss->pluck('nama')->implode(', ') ?: 'Anonim' }}</span>
                </div>

                <!-- Sinopsis -->
                <div class="info-item">
                    <span class="label-muted">Sinopsis</span>
                    <p class="info-value-paragraph">
                        {{ $naskah->sinopsis }}
                    </p>
                </div>

                <!-- File Naskah -->
                <div class="info-item">
                    <span class="label-muted">File Naskah</span>
                    @if($naskah->file_naskah)
                    <div class="naskah-card" onclick="window.open('{{ asset('storage/' . $naskah->file_naskah) }}', '_blank')">
                        <div class="naskah-info">
                            <div class="naskah-icon-wrapper">
                                <i class="fa-regular fa-file-pdf"></i>
                            </div>
                            <div class="naskah-name-group">
                                <span class="naskah-filename">{{ basename($naskah->file_naskah) }}</span>
                                <span class="naskah-meta">PDF • Klik untuk Membuka</span>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $naskah->file_naskah) }}" download class="naskah-link" title="Unduh File Naskah" onclick="event.stopPropagation();">
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                    @else
                    <div style="color:var(--text-muted); font-style:italic;">File naskah tidak tersedia.</div>
                    @endif
                </div>

                <!-- Form untuk Update Status -->
                <form action="{{ route('admin.update-status', $naskah->id) }}" method="POST">
                    @csrf
                    
                    <!-- Action Buttons -->
                    <div class="actions-grid">
                        <button type="submit" name="action" value="tolak" class="btn-action-lg tolak" onclick="return confirm('Apakah Anda yakin ingin menolak naskah ini?')">
                            <i class="fa-solid fa-xmark"></i> Tolak
                        </button>
                        <button type="submit" name="action" value="revisi" class="btn-action-lg revisi">
                            <i class="fa-solid fa-list-check"></i> Revisi
                        </button>
                        <button type="submit" name="action" value="setujui" class="btn-action-lg setujui" onclick="return confirm('Apakah Anda yakin ingin menyetujui naskah ini?')">
                            <i class="fa-regular fa-circle-check"></i> Setujui
                        </button>
                    </div>

                    <!-- Catatan Revisi -->
                    <div class="info-item" style="margin-top: 20px;">
                        <span class="catatan-label">Catatan Revisi (Diperlukan jika status Revisi)</span>
                        <textarea name="catatan_revisi" class="textarea-revisi" placeholder="Tuliskan poin-poin perbaikan yang diperlukan...">{{ $naskah->catatan_revisi }}</textarea>
                    </div>
                </form>

            </div>
        </div>
    </main>
    <script>
        // Sidebar collapse logic
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
