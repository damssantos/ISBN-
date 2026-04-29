<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #34d399;
            --primary-bright: #6ee7b7;
            --primary-dim:    #059669;
            --primary-glow:   rgba(52, 211, 153, 0.15);
            --accent:         #a7f3d0;
            --bg-body:        #0f1f1a;
            --bg-sidebar:     #0a1814;
            --bg-card:        #1a2e28;
            --bg-card-hover:  #213830;
            --bg-input:       #1a2e28;
            --bg-elevated:    #243f37;
            --border-color:   #2d4f45;
            --border-light:   #243f37;
            --text-primary:   #ecfdf5;
            --text-secondary: #9ecfbf;
            --text-muted:     #6ba898;
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
        .nav-link.active { background:linear-gradient(90deg,rgba(52,211,153,.14),rgba(52,211,153,.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all .2s; white-space:nowrap; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left .3s cubic-bezier(.4,0,.2,1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Header */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; font-family:'Inter',sans-serif; outline:none; color:var(--text-primary); transition:border-color .2s,box-shadow .2s; }
        .search-input::placeholder { color:var(--text-muted); }
        .search-input:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        .header-actions { display:flex; align-items:center; gap:8px; }
        .header-icon-btn { width:40px; height:40px; display:flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-secondary); cursor:pointer; transition:all .2s; position:relative; font-size:1rem; }
        .header-icon-btn:hover { background:var(--bg-elevated); border-color:var(--primary-dim); color:var(--primary); }
        .notif-dot { position:absolute; top:9px; right:10px; width:7px; height:7px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        .header-divider { width:1px; height:28px; background:var(--border-color); margin:0 8px; }
        .user-header { display:flex; align-items:center; gap:10px; padding:6px 10px 6px 6px; border-radius:10px; cursor:pointer; transition:background .2s; }
        .user-header:hover { background:var(--bg-card); }
        .user-avatar { width:36px; height:36px; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.875rem; }
        .user-header-name { font-weight:600; font-size:.8125rem; color:var(--text-primary); line-height:1.3; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.3; }

        /* Page title */
        .page-title-section { margin:20px 0 32px; }
        .page-title-section h1 { font-size:1.625rem; font-weight:700; color:var(--text-primary); }
        .page-subtitle { font-size:.875rem; color:var(--text-muted); margin-top:4px; }
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
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/pengajuan" class="nav-link active">
                    <i class="fa-regular fa-file-lines"></i>
                    <span class="nav-link-text">Pengajuan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-regular fa-user"></i>
                    <span class="nav-link-text">Informasi Penulis</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <main class="main-content" id="mainContent">

        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" placeholder="Cari naskah, penulis, atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-header">
                    <div class="user-avatar">P</div>
                    <div class="user-header-info">
                        <div class="user-header-name">Pradama</div>
                        <div class="user-header-role">Kontributor</div>
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                </div>
            </div>
        </header>

        <section class="page-title-section">
            <h1>Pengajuan</h1>
            <p class="page-subtitle">Kelola dan pantau status pengajuan naskah Anda</p>
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

</body>
</html>
