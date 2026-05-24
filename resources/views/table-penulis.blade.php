<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Daftar Penulis</title>
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
            transform-origin:top right; 
            animation:dropdownFadeIn .25s cubic-bezier(.16,1,.3,1); 
        }
        @keyframes dropdownFadeIn { from{opacity:0;transform:scale(.95) translateY(-10px)} to{opacity:1;transform:scale(1) translateY(0)} }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left: 24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition: color .2s; }
        .user-dropdown-item:hover i { color: var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,.08); color:#f87171; }

        /* Content Header */
        .content-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; margin-top:10px; }
        .page-title { font-size:1.5rem; font-weight:700; color:var(--text-primary); }
        .btn-add { background:var(--primary); color:#ffffff; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:700; font-size:.875rem; display:flex; align-items:center; gap:8px; transition:all .2s; border:none; cursor:pointer; box-shadow:0 4px 15px rgba(59, 195, 189,0.2); }
        .btn-add:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 6px 20px rgba(59, 195, 189,0.3); }

        /* Table Card */
        .table-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.2); position:relative; transition:transform .25s,box-shadow .25s; }
        .table-card::after { content:''; position:absolute; inset:0; border-radius:16px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .table-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 40px rgba(0,0,0,0.3), 0 0 0 1px rgba(59, 195, 189,0.1); }
        .table-responsive { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; text-align:left; }
        th { background:rgba(255,255,255,0.02); padding:16px 20px; font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); border-bottom:1px solid var(--border-color); }
        td { padding:16px 20px; font-size:.875rem; color:var(--text-secondary); border-bottom:1px solid var(--border-light); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(255,255,255,0.01); }

        .author-info { display:flex; align-items:center; gap:12px; }
        .author-avatar { width:32px; height:32px; border-radius:8px; background:var(--bg-elevated); color:var(--primary); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.75rem; }
        .author-name { font-weight:600; color:var(--text-primary); }
        .author-meta { font-size:.75rem; color:var(--text-muted); }

        .badge { padding:4px 10px; border-radius:6px; font-size:.7rem; font-weight:700; text-transform:uppercase; }
        .badge-active { background:rgba(59, 195, 189,0.1); color:var(--primary); }
        
        .action-btns { display:flex; gap:8px; }
        .action-btn { width:32px; height:32px; border-radius:8px; border:1px solid var(--border-color); background:transparent; color:var(--text-muted); cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; }
        .action-btn:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--bg-elevated); }
        .action-btn.delete:hover { border-color:#f87171; color:#f87171; background:rgba(248,113,113,0.05); }

        .file-link { color:var(--primary); text-decoration:none; display:flex; align-items:center; gap:6px; font-size:.8125rem; font-weight:600; }
        .file-link:hover { text-decoration:underline; }

        /* Modal Detail */
        .modal-overlay { position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); backdrop-filter:blur(4px); display:none; align-items:center; justify-content:center; z-index:2000; padding:20px; }
        .modal-overlay.show { display:flex; }
        .modal-card { background:var(--bg-card); border:1px solid var(--border-color); border-radius:24px; width:100%; max-width:600px; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); overflow:hidden; animation:modalSlideUp .3s ease-out; }
        @keyframes modalSlideUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .modal-header { padding:24px; border-bottom:1px solid var(--border-light); display:flex; justify-content:space-between; align-items:center; }
        .modal-body { padding:24px; }
        .modal-footer { padding:20px 24px; border-top:1px solid var(--border-light); text-align:right; }
        .detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
        .detail-item { margin-bottom:16px; }
        .detail-label { font-size:.75rem; color:var(--text-muted); text-transform:uppercase; margin-bottom:4px; font-weight:600; }
        .detail-val { font-size:.9375rem; color:var(--text-primary); font-weight:500; }
        .close-modal { cursor:pointer; font-size:1.25rem; color:var(--text-muted); transition:color .2s; }
        .close-modal:hover { color:#f87171; }
        .btn-modal { padding:10px 20px; border-radius:10px; font-weight:600; cursor:pointer; border:1px solid var(--border-color); background:var(--bg-elevated); color:var(--text-primary); }
        
        .empty-state { padding:40px; text-align:center; color:var(--text-muted); display:none; }
    </style>
</head>
<body>

    <!-- Detail Modal -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-header">
                <h2 class="section-title"><i class="fa-solid fa-address-card"></i> Detail Penulis</h2>
                <i class="fa-solid fa-xmark close-modal" onclick="closeModal()"></i>
            </div>
            <div class="modal-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-val" id="detNama">Dr. Pradama Wijaya, M.Kom</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-val" id="detEmail">pradama.w@univ.ac.id</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Afiliasi</div>
                        <div class="detail-val" id="detAfiliasi">Universitas Teknologi Indonesia</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Telepon</div>
                        <div class="detail-val" id="detTelp">08123456789</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Identitas</div>
                        <div class="detail-val">KTP TERVERIFIKASI</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">ID Penulis</div>
                        <div class="detail-val">AUTH-7729</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN TIRTA JAYA</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
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
                <a href="/draf" class="nav-link">
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
                <a href="/table-penulis" class="nav-link active">
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari nama penulis, email, atau ID...">
            </div>
            
            <div class="header-actions">
                <div class="notif-wrapper" style="position: relative; display: inline-block;">
                    <button type="button" class="header-icon-btn" id="notifToggle" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i><span class="notif-dot"></span>
                    </button>

                    <div class="notif-dropdown" id="notifDropdown" style="position: absolute; top: calc(100% + 12px); right: 0; width: 320px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 14px; display: none; flex-direction: column; z-index: 1000; box-shadow: 0 10px 40px rgba(0,0,0,0.5); overflow: hidden;">
                        <div style="font-weight: 700; font-size: 0.875rem; padding: 14px 18px; border-bottom: 1px solid var(--border-color); color: var(--text-primary); display: flex; justify-content: space-between; align-items: center;">
                            <span>Notifikasi</span>
                            <span style="font-size: 0.75rem; color: var(--primary); font-weight: 500; cursor: pointer;">Tandai dibaca</span>
                        </div>
                        
                        <div style="max-height: 280px; overflow-y: auto;">
                            <div style="padding: 14px 18px; border-bottom: 1px solid var(--border-light); font-size: 0.8125rem; color: var(--text-secondary); transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='var(--bg-card-hover)'" onmouseout="this.style.background='transparent'">
                                <div style="display: flex; gap: 10px;">
                                    <i class="fa-solid fa-circle-info" style="color: var(--primary); margin-top: 3px;"></i>
                                    <div>
                                        <p style="margin: 0; line-height: 1.4;">Naskah <strong>"ya udah"</strong> Anda statusnya berubah menjadi <span style="color: var(--primary);">Dalam Peninjauan</span>.</p>
                                        <span style="font-size: 0.7rem; color: var(--text-muted); display: block; margin-top: 4px;">Hari ini, 13:37</span>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 14px 18px; border-bottom: 1px solid var(--border-light); font-size: 0.8125rem; color: var(--text-secondary); transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='var(--bg-card-hover)'" onmouseout="this.style.background='transparent'">
                                <div style="display: flex; gap: 10px;">
                                    <i class="fa-solid fa-circle-check" style="color: #4ade80; margin-top: 3px;"></i>
                                    <div>
                                        <p style="margin: 0; line-height: 1.4;">Selamat! Akun Kontributor Anda berhasil diverifikasi oleh sistem.</p>
                                        <span style="font-size: 0.7rem; color: var(--text-muted); display: block; margin-top: 4px;">Kemarin, 10:15</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-divider"></div>
                
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar">{{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}</div>
                        <div class="user-header-info">
                            <div class="user-header-name">{{ explode(' ', trim(session('user_name', 'User')))[0] }}</div>
                            <div class="user-header-role">Kontributor</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <a href="/akun" class="user-dropdown-item"><i class="fa-regular fa-id-badge"></i><span>Informasi Akun</span></a>
                        <a href="/pengaturan" class="user-dropdown-item"><i class="fa-solid fa-gear"></i><span>Pengaturan</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="/logout" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-header">
            <div>
                <h1 class="page-title">Daftar Penulis Terdaftar</h1>
                <p style="color:var(--text-muted); font-size:.875rem; margin-top:4px;">Kelola dan pantau data penulis yang telah Anda daftarkan.</p>
            </div>
            <a href="/informasi" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Penulis
            </a>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table id="authorTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penulis</th>
                            <th>Kontak / Identitas</th>
                            <th>Institusi / Afiliasi</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="author-info">
                                    <div class="author-avatar">PW</div>
                                    <div>
                                        <div class="author-name">Dr. Pradama Wijaya, M.Kom</div>
                                        <div class="author-meta">ID: AUTH-001</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-text" style="font-size:.8125rem;">
                                    <i class="fa-regular fa-envelope" style="width:16px;"></i> <span class="author-email">pradama.w@univ.ac.id</span><br>
                                    <i class="fa-solid fa-phone" style="width:16px; margin-top:4px;"></i> 08123456789
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500;">Universitas Teknologi Indonesia</div>
                                <div class="author-meta">Fakultas Ilmu Komputer</div>
                            </td>
                            <td>
                                <a href="#" class="file-link"><i class="fa-solid fa-id-card"></i> KTP_Pradama.pdf</a>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Detail" onclick="viewDetail('Dr. Pradama Wijaya, M.Kom', 'pradama.w@univ.ac.id', 'Universitas Teknologi Indonesia', '08123456789')"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn" title="Edit" onclick="editAuthor()"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Hapus" onclick="deleteRow(this)"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="author-info">
                                    <div class="author-avatar" style="background:rgba(59, 195, 189,0.05);">SS</div>
                                    <div>
                                        <div class="author-name">Siti Sarah, M.Pd</div>
                                        <div class="author-meta">ID: AUTH-002</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-text" style="font-size:.8125rem;">
                                    <i class="fa-regular fa-envelope" style="width:16px;"></i> <span class="author-email">siti.sarah@gmail.com</span><br>
                                    <i class="fa-solid fa-phone" style="width:16px; margin-top:4px;"></i> 08987654321
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500;">SMA Negeri 1 Jakarta</div>
                                <div class="author-meta">Guru Bahasa Indonesia</div>
                            </td>
                            <td>
                                <a href="#" class="file-link"><i class="fa-solid fa-id-card"></i> KTP_Siti_Sarah.jpg</a>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Detail" onclick="viewDetail('Siti Sarah, M.Pd', 'siti.sarah@gmail.com', 'SMA Negeri 1 Jakarta', '08987654321')"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn" title="Edit" onclick="editAuthor()"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Hapus" onclick="deleteRow(this)"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="emptyState" class="empty-state">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 2rem; margin-bottom: 12px; display: block;"></i>
                    Penulis tidak ditemukan.
                </div>
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');

        if (sidebar && sidebarToggle) {
            document.getElementById('sidebarToggle').addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        }
        
        // Toggle User Dropdown
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', (e) => { 
                e.stopPropagation(); 
                userDropdown.classList.toggle('show'); 
            });
        }

        // ==========================================
        // 🌟 SUNTIK LOGIC DROPDOWN NOTIFIKASI SAKTI
        // ==========================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle && notifDropdown) {
            notifToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = notifDropdown.style.display === 'none' || notifDropdown.style.display === '';
                notifDropdown.style.display = isHidden ? 'flex' : 'none';
                
                // Biar pas notif dibuka, dropdown profil otomatis ngumpet (anti-tabrakan)
                if (userDropdown) userDropdown.classList.remove('show');
            });
        }

        // Global Click Event (Tutup semua dropdown kalau klik di luar area)
        document.addEventListener('click', (e) => { 
            if (userDropdown && userToggle && !userDropdown.contains(e.target) && !userToggle.contains(e.target)) {
                userDropdown.classList.remove('show'); 
            }
            if (notifDropdown && notifToggle && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.style.display = 'none';
            }
        });

        // Search Filtering Logic bawaan tabel penulis
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('authorTable');
        const emptyState = document.getElementById('emptyState');
        
        if (searchInput && table) {
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();
                let hasResults = false;

                for (let i = 0; i < rows.length; i++) {
                    const nameEl = rows[i].querySelector('.author-name');
                    const idEl = rows[i].querySelector('.author-meta');
                    const emailEl = rows[i].querySelector('.author-email');
                    
                    if (nameEl && idEl && emailEl) {
                        const name = nameEl.textContent.toLowerCase();
                        const id = idEl.textContent.toLowerCase();
                        const email = emailEl.textContent.toLowerCase();
                        
                        if (name.includes(query) || id.includes(query) || email.includes(query)) {
                            rows[i].style.display = '';
                            hasResults = true;
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                }

                table.style.display = hasResults ? '' : 'none';
                if (emptyState) emptyState.style.display = hasResults ? 'none' : 'block';
            });
        }

        // Action Functions Modal & Delete Row bawaan
        function viewDetail(nama, email, afiliasi, telp) {
            document.getElementById('detNama').textContent = nama;
            document.getElementById('detEmail').textContent = email;
            document.getElementById('detAfiliasi').textContent = afiliasi;
            document.getElementById('detTelp').textContent = telp;
            document.getElementById('detailModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
        }

        // Ubah redirect link biar sesuai rute
        function editAuthor() {
            window.location.href = '/informasi-penulis';
        }

        function deleteRow(btn) {
            if (confirm('Apakah Anda yakin ingin menghapus data penulis ini?')) {
                const row = btn.closest('tr');
                if (row) {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    row.style.transition = 'all .3s ease';
                    setTimeout(() => {
                        row.remove();
                        alert('Data penulis berhasil dihapus.');
                    }, 300);
                }
            }
        }
    </script>
</body>
</html>
