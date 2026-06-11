<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Dashboard</title>
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
            --status-review-bg:      rgba(59, 130, 246, 0.12);
            --status-review-text:    #60A5FA;
            --status-published-bg:   rgba(59, 195, 189, 0.15);
            --status-published-text: #3BC3BD;
            --status-draft-bg:       rgba(122, 155, 170, 0.15);
            --status-draft-text:     #7A9BAA;
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
        
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); display: flex; flex-direction: column; gap: 4px; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248, 113, 113, 0.08); }

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

        .search-results {
            position: absolute; top:calc(100% + 12px); left:0; width:100%; background:var(--bg-card); border:1px solid var(--border-color); border-radius:14px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5); display:none; flex-direction:column; z-index:1000; overflow:hidden;
            animation: dropdownFadeIn 0.2s ease-out;
        }
        .search-results.show { display:flex; }
        .search-section-title { padding:12px 16px 6px; font-size:.7rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; }
        .search-result-item { padding:10px 16px; display:flex; align-items:center; gap:12px; text-decoration:none; color:var(--text-secondary); transition:all 0.2s; }
        .search-result-item:hover { background:var(--bg-card-hover); color:var(--primary-bright); }
        .search-result-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; background:var(--bg-elevated); color:var(--primary); font-size:.875rem; }

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

        /* User Dropdown */
        .user-dropdown {
            position:absolute; top:calc(100% + 12px); right:0; width:240px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:16px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189,0.08); display:none; flex-direction:column; z-index:1000; overflow:hidden;
            transform-origin: top right; animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes dropdownFadeIn { from { opacity:0; transform:scale(0.95) translateY(-10px); } to { opacity:1; transform:scale(1) translateY(0); } }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all 0.2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition:color 0.2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248, 113, 113, 0.08); color:#f87171; }

        /* Enhanced Welcome Banner */
        .welcome-section { 
            margin: 10px 0 28px; 
            padding: 36px 40px; 
            background: linear-gradient(135deg, #1B2B38 0%, #0c1a22 100%);
            border: 1px solid rgba(59, 195, 189, 0.2); 
            border-radius: 24px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: relative; 
            overflow: hidden; 
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.05);
        }
        
        /* Glass/Glow Effects */
        .welcome-section::before { 
            content: ''; 
            position: absolute; 
            top: -100px; 
            right: -50px; 
            width: 300px; 
            height: 300px; 
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%); 
            filter: blur(60px); 
            opacity: 0.2; 
            z-index: 0;
        }
        .welcome-section::after { 
            content: ''; 
            position: absolute; 
            bottom: -50px; 
            left: -20px; 
            width: 200px; 
            height: 200px; 
            background: radial-gradient(circle, var(--primary-dim) 0%, transparent 70%); 
            filter: blur(50px); 
            opacity: 0.1; 
            z-index: 0;
        }

        .welcome-content { position: relative; z-index: 1; }
        .welcome-content h1 { font-size: 1.85rem; font-weight: 800; color: #FFFFFF; letter-spacing: -0.8px; margin-bottom: 6px; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .welcome-content h1 .highlight { color: var(--primary-bright); text-shadow: 0 0 20px rgba(59, 195, 189, 0.4); }
        .welcome-content p { color: rgba(226, 216, 240, 0.7); font-size: 0.95rem; font-weight: 400; }
        
        .welcome-meta { text-align: right; position: relative; z-index: 1; }
        .welcome-date { 
            display: inline-flex; 
            align-items:center; 
            gap:10px; 
            padding:10px 20px; 
            background: rgba(15, 29, 38, 0.7); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08); 
            border-radius:16px; 
            color: var(--text-primary); 
            font-size: 0.85rem; 
            font-weight: 600; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .welcome-date i { color: var(--primary-bright); font-size: 1rem; }

        /* Stats Grid */
        .stats-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; }
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
        .stat-main { display:flex; align-items:flex-start; justify-content:space-between; gap:16px; }
        .stat-info { display:flex; flex-direction:column; flex:1; }
        .stat-title { font-size:.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; }
        .stat-value { font-size:2rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.5px; margin-bottom: 6px; }
        .stat-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; transition: transform 0.3s; }
        .stat-card:hover .stat-icon { transform: scale(1.1) rotate(5deg); }
        
        .icon-purple { background:rgba(59, 195, 189, 0.15); color:var(--primary-bright); box-shadow: 0 8px 20px rgba(59, 195, 189, 0.1); }
        .icon-emerald { background:rgba(16, 185, 129, 0.15); color:#5CD9D4; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1); }
        .icon-orange { background:rgba(245, 158, 11, 0.15); color:#FBBF24; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.1); }
        .icon-gray { background:rgba(107, 114, 128, 0.15); color:#D1D5DB; box-shadow: 0 8px 20px rgba(107, 114, 128, 0.1); }
        
        .stat-subtitle { font-size:.875rem; color:var(--text-secondary); margin-bottom:12px; font-weight: 500; }
        .stat-link { font-size:.75rem; color:var(--primary-bright); text-decoration:none; font-weight:700; display:flex; align-items:center; gap:6px; transition:gap 0.2s; }
        .stat-link:hover { gap:10px; }

        /* Content Layout */
        .content-layout { display:grid; grid-template-columns:2fr 1fr; gap:20px; margin-top:32px; }
        .card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:20px; padding:28px; box-shadow:0 10px 30px rgba(0,0,0,0.2); }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .card-title { font-size:1.15rem; font-weight:700; color:var(--text-primary); }
        .link-teal { font-size:.85rem; color:var(--primary-bright); text-decoration:none; font-weight:600; transition: opacity 0.2s; }
        .link-teal:hover { opacity: 0.8; }

        /* Table */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:0 0 16px; font-size:.75rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.8px; border-bottom:1px solid var(--border-color); }
        td { padding:18px 0; border-bottom:1px solid var(--border-light); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        .ms-title { font-weight:600; font-size:.9375rem; color:var(--text-primary); margin-bottom: 2px; }
        .ms-id { font-size:.75rem; color:var(--text-muted); font-weight: 500; }
        
        .status-badge { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:24px; font-size:.75rem; font-weight:700; }
        .status-badge::before { content:''; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
        .status-review { background:var(--status-review-bg); color:var(--status-review-text); }
        .status-review::before { background:var(--status-review-text); }
        .status-published { background:var(--status-published-bg); color:var(--status-published-text); }
        .status-published::before { background:var(--status-published-text); }
        .status-draft { background:var(--status-draft-bg); color:var(--status-draft-text); }
        .status-draft::before { background:var(--status-draft-text); }
        
        .date-text { font-size:.8125rem; color:var(--text-secondary); font-weight: 500; }
        .action-btn { width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; background:rgba(59, 195, 189, 0.12); color:var(--primary-bright); text-decoration:none; font-size:.95rem; transition:all 0.2s; }
        .action-btn:hover { background:var(--primary); color:#FFFFFF; transform: translateY(-3px) scale(1.05); box-shadow: 0 5px 15px rgba(59, 195, 189, 0.3); }

        /* Activity Feed */
        .activity-feed { display:flex; flex-direction:column; gap:22px; }
        .activity-item { display:flex; gap:16px; }
        .activity-icon { width:38px; height:38px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:1rem; }
        .activity-body { flex:1; }
        .activity-content { font-size:.875rem; color:var(--text-secondary); margin-bottom:4px; line-height: 1.4; }
        .highlight-activity { color:var(--primary-bright); font-weight:700; }
        .activity-time { font-size:.75rem; color:var(--text-muted); font-weight: 500; }
        
        .btn-outline { 
            width:100%; 
            padding:12px; 
            border:1.5px solid var(--border-color); 
            background:transparent; 
            color:var(--text-secondary); 
            border-radius:12px; 
            font-size:.85rem; 
            font-weight:700; 
            cursor:pointer; 
            margin-top:12px; 
            transition:all 0.2s; 
        }
        .btn-outline:hover { background:rgba(248, 113, 113, 0.08); color:#f87171; border-color:rgba(248, 113, 113, 0.4); }

        /* Notifications Dropdown */
        .notif-dropdown {
            position: absolute; top: calc(100% + 12px); right: 0; width: 320px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189, 0.08); display: none; flex-direction: column; z-index: 1000; overflow: hidden;
            transform-origin: top right; animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .notif-dropdown.show { display: flex; }
        .notif-dropdown-header { padding: 14px 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .notif-dropdown-header span { font-weight: 700; font-size: 0.9rem; color: var(--text-primary); }
        .notif-count { font-size: 0.75rem; background: var(--primary-glow); color: var(--primary-bright); padding: 2px 8px; border-radius: 10px; font-weight: 600; }
        .notif-dropdown-body { max-height: 280px; overflow-y: auto; }
        .notif-dropdown-item { padding: 14px 20px; display: flex; gap: 14px; border-bottom: 1px solid var(--border-light); transition: background 0.2s; }
        .notif-dropdown-item:last-child { border-bottom: none; }
        .notif-dropdown-item:hover { background: var(--bg-card-hover); }
        .notif-dropdown-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .notif-dropdown-content { display: flex; flex-direction: column; gap: 4px; }
        .notif-dropdown-text { font-size: 0.825rem; color: var(--text-secondary); line-height: 1.35; }
        .notif-dropdown-text span.highlight-activity { color: var(--primary-bright); font-weight: 700; }
        .notif-dropdown-time { font-size: 0.7rem; color: var(--text-muted); font-weight: 500; }
        .notif-dropdown-empty { padding: 30px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 10px; color: var(--text-muted); }
        .notif-dropdown-empty i { font-size: 1.5rem; color: var(--text-muted); }
        .notif-dropdown-empty span { font-size: 0.85rem; }
        @include('partials.responsive-css')
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
            <li class="nav-item"><a href="/dashboard" class="nav-link active"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link"><i class="fa-regular fa-file-lines"></i><span class="nav-link-text">Pengajuan</span></a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i><span class="nav-link-text">Daftar Naskah</span></a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i><span class="nav-link-text">Draf Naskah</span></a></li>
            <li class="nav-item"><a href="/informasi-penulis" class="nav-link"><i class="fa-regular fa-user"></i><span class="nav-link-text">Informasi Penulis</span></a></li>
            <li class="nav-item"><a href="/table-penulis" class="nav-link"><i class="fa-solid fa-users-viewfinder"></i><span class="nav-link-text">Daftar Penulis</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="/auth-login" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari naskah, penulis, atau ISBN...">
                <div class="search-results" id="searchResults">
                    <div class="search-section-title">Naskah Terkait</div>
                    <a href="/pengajuan/detail" class="search-result-item">
                        <div class="search-result-icon"><i class="fa-solid fa-book"></i></div>
                        <div>
                            <div style="font-weight:600; font-size:.875rem;">Analisis Perubahan Iklim</div>
                            <div style="font-size:.75rem; color:var(--text-muted);">ID: MS-8829 • Peninjauan</div>
                        </div>
                    </a>
                    <a href="/pengajuan/detail" class="search-result-item">
                        <div class="search-result-icon"><i class="fa-solid fa-book"></i></div>
                        <div>
                            <div style="font-weight:600; font-size:.875rem;">Metodologi Medan Kuantum</div>
                            <div style="font-size:.75rem; color:var(--text-muted);">ID: MS-7741 • Diterbitkan</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="header-actions">
                <div style="position: relative; display: flex; align-items: center;">
                    <button class="header-icon-btn" id="notifToggle">
                        <i class="fa-regular fa-bell"></i>
                        @if(count($aktivitas) > 0)
                            <span class="notif-dot"></span>
                        @endif
                    </button>
                    <!-- Dropdown Notifikasi -->
                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-dropdown-header">
                            <span>Notifikasi</span>
                            <span class="notif-count">{{ count($aktivitas) }} Baru</span>
                        </div>
                        <div class="notif-dropdown-body">
                            @forelse($aktivitas as $act)
                                <div class="notif-dropdown-item">
                                    <div class="notif-dropdown-icon {{ $act['class'] }}"><i class="fa-solid {{ $act['icon'] }}"></i></div>
                                    <div class="notif-dropdown-content">
                                        <div class="notif-dropdown-text">{!! $act['content'] !!}</div>
                                        <div class="notif-dropdown-time">{{ $act['time'] }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="notif-dropdown-empty">
                                    <i class="fa-regular fa-bell-slash"></i>
                                    <span>Tidak ada notifikasi baru</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="header-divider"></div>
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar">{{ strtoupper(substr(session('user_name', 'P'), 0, 1)) }}</div>
                        <div class="user-header-info">
                            <div class="user-header-name">{{ session('user_name', 'Pradama') }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="/logout" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <section class="welcome-section">
            <div class="welcome-content">
                <h1>Selamat Datang Kembali, <span class="highlight">{{ session('user_name', 'User') }}!</span></h1>
                <p>Kelola naskah dan pantau status publikasi Anda dengan mudah di sini.</p>
            </div>
            <div class="welcome-meta">
                <div class="welcome-date">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-main">
                    <div class="stat-info">
                        <div class="stat-title">Peninjauan</div>
                        <div class="stat-value">{{ $jumlahPeninjauan }}</div>
                        <div class="stat-subtitle">Naskah dalam peninjauan</div>
                        <a href="/daftar-pengajuan" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
                    </div>
                    <div class="stat-icon icon-purple"><i class="fa-regular fa-file-lines"></i></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-main">
                    <div class="stat-info">
                        <div class="stat-title">Diterbitkan</div>
                        <div class="stat-value">{{ $jumlahDiterbitkan }}</div>
                        <div class="stat-subtitle">Naskah telah diterbitkan</div>
                        <a href="/daftar-pengajuan" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
                    </div>
                    <div class="stat-icon icon-emerald"><i class="fa-solid fa-check-double"></i></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-main">
                    <div class="stat-info">
                        <div class="stat-title">Penulis</div>
                        <div class="stat-value">{{ $jumlahPenulis ?? 0 }}</div>
                        <div class="stat-subtitle">Total penulis terdaftar</div>
                        <a href="/table-penulis" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
                    </div>
                    <div class="stat-icon icon-orange"><i class="fa-regular fa-user"></i></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-main">
                    <div class="stat-info">
                        <div class="stat-title">Draf</div>
                        <div class="stat-value">{{ str_pad($jumlahDraf, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="stat-subtitle">Total draf naskah</div>
                        <a href="/draf" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
                    </div>
                    <div class="stat-icon icon-gray"><i class="fa-solid fa-inbox"></i></div>
                </div>
            </div>
        </section>

        <section class="content-layout">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Naskah Terbaru</h2>
                    <a href="/daftar-pengajuan" class="link-teal">Lihat semua →</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Judul Naskah</th><th>Status</th><th>Terakhir Diperbarui</th><th style="text-align:center">Aksi</th></tr></thead>
                        <tbody>
                            @forelse($naskahTerbaru as $naskah)
                                <tr>
                                    <td>
                                        <div class="ms-title">{{ $naskah->judul }}</div>
                                        <div class="ms-id">ID: MS-{{ str_pad($naskah->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td>
                                        @if($naskah->status == 'Draf')
                                            <span class="status-badge status-draft">Draf</span>
                                        @elseif($naskah->status == 'Diterbitkan')
                                            <span class="status-badge status-published">Diterbitkan</span>
                                        @else
                                            <span class="status-badge status-review">Peninjauan</span>
                                        @endif
                                    </td>
                                    <td><div class="date-text">{{ $naskah->updated_at->translatedFormat('d M Y') }}</div></td>
                                    <td style="text-align:center">
                                        <a href="/pengajuan/{{ $naskah->id }}" class="action-btn" title="Lihat detail"><i class="fa-regular fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                        <i class="fa-solid fa-folder-open" style="font-size: 2rem; margin-bottom: 12px; display: block;"></i>
                                        Belum ada aktivitas naskah terbaru di database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2 class="card-title">Aktivitas Terbaru</h2></div>
                <div class="activity-feed">
                    @forelse($aktivitas as $act)
                        <div class="activity-item">
                            <div class="activity-icon {{ $act['class'] }}"><i class="fa-solid {{ $act['icon'] }}"></i></div>
                            <div class="activity-body">
                                <div class="activity-content">{!! $act['content'] !!}</div>
                                <div class="activity-time">{{ $act['time'] }}</div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 20px 0; color: var(--text-muted);">
                            <i class="fa-regular fa-bell-slash" style="font-size: 1.5rem; margin-bottom: 8px; display: block;"></i>
                            Belum ada aktivitas terbaru.
                        </div>
                    @endforelse
                </div>
                @if(count($aktivitas) > 0)
                    <button class="btn-outline" id="clearNotifBtn">Hapus Semua Notifikasi</button>
                @endif
            </div>
        </section>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); notifDropdown.classList.remove('show'); });

        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        notifToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            notifDropdown.classList.toggle('show');
            userDropdown.classList.remove('show');
        });

        searchInput.addEventListener('input', (e) => {
            if (e.target.value.length > 0) searchResults.classList.add('show');
            else searchResults.classList.remove('show');
        });

        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && !userToggle.contains(e.target)) userDropdown.classList.remove('show');
            if (!notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) notifDropdown.classList.remove('show');
            if (!searchResults.contains(e.target) && e.target !== searchInput) searchResults.classList.remove('show');
        });

        const clearNotifBtn = document.getElementById('clearNotifBtn');
        if (clearNotifBtn) {
            clearNotifBtn.addEventListener('click', () => {
                const notifDot = document.querySelector('.notif-dot');
                if (notifDot) notifDot.remove();
                
                const notifCount = document.querySelector('.notif-count');
                if (notifCount) notifCount.textContent = '0 Baru';
                
                const notifDropdownBody = document.querySelector('.notif-dropdown-body');
                if (notifDropdownBody) {
                    notifDropdownBody.innerHTML = `
                        <div class="notif-dropdown-empty">
                            <i class="fa-regular fa-bell-slash"></i>
                            <span>Tidak ada notifikasi baru</span>
                        </div>
                    `;
                }

                const activityFeed = document.querySelector('.activity-feed');
                if (activityFeed) {
                    activityFeed.innerHTML = `
                        <div style="text-align: center; padding: 20px 0; color: var(--text-muted);">
                            <i class="fa-regular fa-bell-slash" style="font-size: 1.5rem; margin-bottom: 8px; display: block;"></i>
                            Belum ada aktivitas terbaru.
                        </div>
                    `;
                }

                clearNotifBtn.remove();
            });
        }
    </script>
</body>
</html>