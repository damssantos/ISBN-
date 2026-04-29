<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Dashboard</title>
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
            --status-review-bg:      rgba(251, 191, 36, 0.1);
            --status-review-text:    #fcd34d;
            --status-published-bg:   rgba(52, 211, 153, 0.12);
            --status-published-text: #6ee7b7;
            --status-draft-bg:       rgba(148, 163, 184, 0.08);
            --status-draft-text:     #cbd5e1;
            --sidebar-width:           250px;
            --sidebar-collapsed-width: 64px;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; }

        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4,0,.2,1); overflow:hidden; z-index:100; }
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
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; background:var(--bg-body); position:sticky; top:0; z-index:10; }
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

        /* Welcome banner */
        .welcome-section { display:flex; justify-content:space-between; align-items:center; margin:16px 0 28px; background:linear-gradient(125deg,#0d3d30,#0f5040 45%,#136b54); border:1px solid rgba(52,211,153,.18); border-radius:16px; padding:32px; position:relative; overflow:hidden; box-shadow:0 8px 32px rgba(5,150,105,.12); }
        .welcome-section::before { content:''; position:absolute; top:-60px; right:-40px; width:240px; height:240px; background:rgba(52,211,153,.06); border-radius:50%; }
        .welcome-section::after  { content:''; position:absolute; bottom:-80px; right:80px; width:180px; height:180px; background:rgba(52,211,153,.04); border-radius:50%; }
        .welcome-text h1 { font-size:1.5rem; font-weight:700; color:#fff; line-height:1.3; }
        .welcome-text p  { font-size:.875rem; color:var(--accent); margin-top:6px; opacity:.85; }
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#0a1814; border:none; padding:11px 22px; border-radius:10px; font-size:.875rem; font-weight:700; font-family:'Inter',sans-serif; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; position:relative; z-index:1; box-shadow:0 4px 15px rgba(52,211,153,.25); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(52,211,153,.35); }

        /* Stats */
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px; }
        .stat-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:12px; padding:22px; display:flex; flex-direction:column; position:relative; transition:transform .25s,box-shadow .25s; box-shadow:0 4px 16px rgba(0,0,0,.25); }
        .stat-card::after { content:''; position:absolute; inset:0; border-radius:12px; background:linear-gradient(145deg,rgba(52,211,153,.04),transparent 60%); pointer-events:none; }
        .stat-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(52,211,153,.12); }
        .stat-card-top { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:10px; }
        .stat-icon { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.15rem; flex-shrink:0; }
        .icon-teal   { background:rgba(52,211,153,.12); color:var(--primary); }
        .icon-orange { background:rgba(251,191,36,.1);  color:#fcd34d; }
        .icon-blue   { background:rgba(96,165,250,.1);  color:#93c5fd; }
        .icon-gray   { background:rgba(148,163,184,.1); color:#94a3b8; }
        .stat-title { font-size:.75rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.6px; margin-bottom:4px; }
        .stat-value { font-size:2rem; font-weight:700; color:var(--text-primary); line-height:1; }
        .stat-subtitle { font-size:.75rem; color:var(--text-muted); margin-top:6px; margin-bottom:20px; }
        .stat-link { color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:500; display:flex; align-items:center; gap:6px; margin-top:auto; transition:color .2s,gap .2s; }
        .stat-link:hover { color:var(--primary-bright); gap:10px; }

        /* Content layout */
        .content-layout { display:grid; grid-template-columns:1.6fr 1fr; gap:20px; }
        .card { background:var(--bg-card); border:1px solid var(--border-color); border-radius:14px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,.2); }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .card-title { font-size:1rem; font-weight:600; color:var(--text-primary); }
        .link-teal { color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:500; transition:color .2s; }
        .link-teal:hover { color:var(--primary-bright); }

        /* Table */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:0 0 14px; font-size:.75rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.4px; border-bottom:1px solid var(--border-color); }
        td { padding:14px 0; border-bottom:1px solid var(--border-light); vertical-align:middle; font-size:.875rem; }
        tr:last-child td { border-bottom:none; padding-bottom:0; }
        tr:hover td { background:var(--bg-card-hover); }
        .ms-title { font-weight:600; font-size:.875rem; color:var(--text-primary); }
        .ms-id { font-size:.75rem; color:var(--text-muted); margin-top:2px; }
        .status-badge { display:inline-flex; align-items:center; gap:5px; padding:5px 10px; border-radius:6px; font-size:.75rem; font-weight:500; }
        .status-badge::before { content:''; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
        .status-review   { background:var(--status-review-bg);    color:var(--status-review-text); }
        .status-review::before { background:var(--status-review-text); }
        .status-published { background:var(--status-published-bg); color:var(--status-published-text); }
        .status-published::before { background:var(--status-published-text); }
        .status-draft    { background:var(--status-draft-bg);      color:var(--status-draft-text); }
        .status-draft::before { background:var(--status-draft-text); }
        .date-text { font-size:.875rem; color:var(--text-secondary); }
        .action-btn { width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; border-radius:8px; background:rgba(52,211,153,.1); color:var(--primary); text-decoration:none; font-size:.875rem; transition:all .2s; }
        .action-btn:hover { background:var(--primary); color:#0a1814; }

        /* Activity */
        .activity-feed { display:flex; flex-direction:column; gap:20px; }
        .activity-item { display:flex; gap:14px; align-items:flex-start; }
        .activity-icon { width:34px; height:34px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:.8rem; flex-shrink:0; }
        .activity-body { flex:1; min-width:0; }
        .activity-content { font-size:.8125rem; color:var(--text-secondary); line-height:1.5; }
        .activity-content strong { font-weight:600; color:var(--text-primary); }
        .activity-content .highlight { color:var(--primary-bright); font-weight:600; }
        .activity-time { font-size:.75rem; color:var(--text-muted); margin-top:3px; }
        .btn-outline { width:100%; padding:10px; background:transparent; border:1px solid var(--border-color); border-radius:8px; color:var(--text-secondary); font-weight:500; font-size:.8125rem; font-family:'Inter',sans-serif; cursor:pointer; margin-top:16px; transition:all .2s; }
        .btn-outline:hover { background:var(--bg-elevated); border-color:var(--primary-dim); color:var(--primary); }
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
                <a href="/" class="nav-link active">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/pengajuan" class="nav-link">
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

        <section class="welcome-section">
            <div class="welcome-text">
                <h1>Selamat datang kembali, Pradama 👋</h1>
                <p>Berikut ringkasan aktivitas naskah Anda hari ini.</p>
            </div>
            <button class="btn-primary">
                <i class="fa-solid fa-plus"></i> Pengajuan Baru
            </button>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-top">
                    <div>
                        <div class="stat-title">Naskah Aktif</div>
                        <div class="stat-value">12</div>
                    </div>
                    <div class="stat-icon icon-teal"><i class="fa-regular fa-file-alt"></i></div>
                </div>
                <div class="stat-subtitle">Total Naskah</div>
                <a href="#" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div>
                        <div class="stat-title">Dalam Peninjauan</div>
                        <div class="stat-value">04</div>
                    </div>
                    <div class="stat-icon icon-orange"><i class="fa-regular fa-eye"></i></div>
                </div>
                <div class="stat-subtitle">Total Naskah</div>
                <a href="#" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div>
                        <div class="stat-title">Diterbitkan</div>
                        <div class="stat-value">08</div>
                    </div>
                    <div class="stat-icon icon-blue"><i class="fa-regular fa-circle-check"></i></div>
                </div>
                <div class="stat-subtitle">Total Naskah</div>
                <a href="#" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div>
                        <div class="stat-title">Draf</div>
                        <div class="stat-value">03</div>
                    </div>
                    <div class="stat-icon icon-gray"><i class="fa-solid fa-inbox"></i></div>
                </div>
                <div class="stat-subtitle">Total Naskah</div>
                <a href="#" class="stat-link">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
        </section>

        <section class="content-layout">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Naskah Terbaru</h2>
                    <a href="#" class="link-teal">Lihat semua →</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Naskah</th>
                                <th>Status</th>
                                <th>Terakhir Diperbarui</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="ms-title">Analisis Perubahan Iklim 2024</div>
                                    <div class="ms-id">ID: MS-8829</div>
                                </td>
                                <td><span class="status-badge status-review">Dalam Peninjauan</span></td>
                                <td><div class="date-text">12 Okt 2023</div></td>
                                <td style="text-align:center"><a href="#" class="action-btn" title="Lihat detail"><i class="fa-regular fa-eye"></i></a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Metodologi Medan Kuantum</div>
                                    <div class="ms-id">ID: MS-7741</div>
                                </td>
                                <td><span class="status-badge status-published">Diterbitkan</span></td>
                                <td><div class="date-text">28 Sep 2023</div></td>
                                <td style="text-align:center"><a href="#" class="action-btn" title="Lihat detail"><i class="fa-regular fa-eye"></i></a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Dinamika Perencanaan Kota</div>
                                    <div class="ms-id">ID: MS-4122</div>
                                </td>
                                <td><span class="status-badge status-draft">Draf</span></td>
                                <td><div class="date-text">15 Sep 2023</div></td>
                                <td style="text-align:center"><a href="#" class="action-btn" title="Lihat detail"><i class="fa-regular fa-eye"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Aktivitas Terbaru</h2>
                </div>
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon icon-teal"><i class="fa-regular fa-comment-dots"></i></div>
                        <div class="activity-body">
                            <div class="activity-content"><strong>Editor Julian Smith</strong> menambahkan komentar pada <span class="highlight">Analisis Perubahan Iklim.</span></div>
                            <div class="activity-time">2 jam yang lalu</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon icon-blue"><i class="fa-solid fa-check"></i></div>
                        <div class="activity-body">
                            <div class="activity-content">Naskah <span class="highlight">Metodologi Medan Kuantum</span> telah resmi diterbitkan.</div>
                            <div class="activity-time">Kemarin</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon icon-orange"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        <div class="activity-body">
                            <div class="activity-content">Peninjauan tahap ke-2 dimulai untuk <span class="highlight">Kerangka Keberlanjutan.</span></div>
                            <div class="activity-time">10 Okt 2023</div>
                        </div>
                    </div>
                </div>
                <button class="btn-outline">Hapus Semua Notifikasi</button>
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

</body>
</html>