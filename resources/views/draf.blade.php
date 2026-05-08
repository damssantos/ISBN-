<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Draf Naskah</title>
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
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
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
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color .2s,box-shadow .2s; }
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
        
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
        .user-header-info { display:flex; flex-direction:column; gap:0; }
        .user-header-name { font-weight:700; font-size:.9375rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.2; font-weight: 500; }

        /* User Dropdown */
        .user-wrapper { position:relative; }
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
        @keyframes dropdownFadeIn { from { opacity:0; transform:scale(0.95) translateY(-10px); } to { opacity:1; transform:scale(1) translateY(0); } }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition:color .2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,0.08); color:#f87171; }

        /* Page Layout */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; margin-top: 10px; }
        .page-title-section h1 { font-size:1.75rem; font-weight:700; color:var(--text-primary); letter-spacing:-0.5px; }
        .page-subtitle { font-size:.875rem; color:var(--text-muted); margin-top:4px; }

        .card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:14px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,.2); position:relative; overflow:hidden; transition:transform .25s, box-shadow .25s; }
        .card::after { content:''; position:absolute; inset:0; border-radius:14px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(59, 195, 189,0.1); }

        /* Table */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:0 0 14px; font-size:.75rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.4px; border-bottom:1px solid var(--border-color); }
        td { padding:16px 0; border-bottom:1px solid var(--border-light); vertical-align:middle; font-size:.875rem; }
        tr:last-child td { border-bottom:none; }
        .ms-title { font-weight:600; font-size:.875rem; color:var(--text-primary); }
        .ms-id { font-size:.75rem; color:var(--text-muted); margin-top:2px; }
        
        .status-badge { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border-radius:20px; font-size:.75rem; font-weight:600; background:rgba(107, 114, 128, 0.1); color:#9CA3AF; }
        .status-badge::before { content:''; width:6px; height:6px; border-radius:50%; flex-shrink:0; background:#9CA3AF; }

        .date-text { font-size:.875rem; color:var(--text-secondary); }
        .action-btn { width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; background:rgba(59, 195, 189,.1); color:var(--primary); text-decoration:none; font-size:.875rem; transition:all .2s; }
        .action-btn:hover { background:var(--primary); color:#0f1d26; transform: translateY(-2px); }
        .action-btn.delete { color: #f87171; background: rgba(248, 113, 113, 0.1); }
        .action-btn.delete:hover { background: #f87171; color: #0f1d26; }

        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#ffffff; border:none; padding:10px 20px; border-radius:8px; font-size:.875rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; text-decoration:none; box-shadow:0 4px 12px rgba(59, 195, 189,.2); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(59, 195, 189,.3); }

        .empty-state { padding:40px; text-align:center; color:var(--text-muted); display:none; }
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
                <a href="/pengajuan" class="nav-link">
                    <i class="fa-regular fa-file-lines"></i>
                    <span class="nav-link-text">Pengajuan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/daftar-pengajuan" class="nav-link">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="nav-link-text">Daftar Naskah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/draf" class="nav-link active">
                    <i class="fa-solid fa-inbox"></i>
                    <span class="nav-link-text">Draf Naskah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/informasi" class="nav-link">
                    <i class="fa-regular fa-user"></i>
                    <span class="nav-link-text">Informasi Penulis</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/table-penulis" class="nav-link">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span class="nav-link-text">Daftar Penulis</span>
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari draf naskah atau ID draf...">
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
                        <a href="#" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-header">
            <div class="page-title-section">
                <h1>Draf Naskah</h1>
                <p class="page-subtitle">Kelola naskah yang belum Anda ajukan ke sistem.</p>
            </div>
            <a href="/pengajuan" class="btn-primary">
                <i class="fa-solid fa-plus"></i> Buat Draf Baru
            </a>
        </div>

        <div class="card">
            <div class="table-container">
                <table id="draftTable">
                    <thead>
                        <tr>
                            <th>Judul Naskah</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="ms-title">Dinamika Perencanaan Kota</div>
                                <div class="ms-id">ID: DRAF-4122</div>
                            </td>
                            <td><span class="status-badge">Draf</span></td>
                            <td><div class="date-text">15 Sep 2023</div></td>
                            <td style="text-align:center">
                                <a href="/pengajuan" class="action-btn" title="Lanjutkan Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="action-btn delete" title="Hapus Draf"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="ms-title">Manajemen Limbah Industri Modern</div>
                                <div class="ms-id">ID: DRAF-2291</div>
                            </td>
                            <td><span class="status-badge">Draf</span></td>
                            <td><div class="date-text">02 Okt 2023</div></td>
                            <td style="text-align:center">
                                <a href="/pengajuan" class="action-btn" title="Lanjutkan Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="action-btn delete" title="Hapus Draf"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="ms-title">Studi Literatur Keamanan Siber</div>
                                <div class="ms-id">ID: DRAF-1104</div>
                            </td>
                            <td><span class="status-badge">Draf</span></td>
                            <td><div class="date-text">20 Okt 2023</div></td>
                            <td style="text-align:center">
                                <a href="/pengajuan" class="action-btn" title="Lanjutkan Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="action-btn delete" title="Hapus Draf"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="emptyState" class="empty-state">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 2rem; margin-bottom: 12px; display: block;"></i>
                    Draf tidak ditemukan.
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
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });

        // Search Filtering Logic
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('draftTable');
        const emptyState = document.getElementById('emptyState');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            let hasResults = false;

            for (let i = 0; i < rows.length; i++) {
                const title = rows[i].querySelector('.ms-title').textContent.toLowerCase();
                const id = rows[i].querySelector('.ms-id').textContent.toLowerCase();
                
                if (title.includes(query) || id.includes(query)) {
                    rows[i].style.display = '';
                    hasResults = true;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            table.style.display = hasResults ? '' : 'none';
            emptyState.style.display = hasResults ? 'none' : 'block';
        });
    </script>
</body>
</html>
