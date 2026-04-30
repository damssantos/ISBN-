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
            --primary:        #34d399;
            --primary-bright: #6ee7b7;
            --primary-dim:    #059669;
            --primary-glow:   rgba(52, 211, 153, 0.15);
            --accent:         #a7f3d0;
            --bg-body:        #0f1f1a;
            --bg-sidebar:     #0a1814;
            --bg-card:        #1a2e28;
            --bg-card-hover:  #213830;
            --bg-input:       #132520;
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

        /* Main Content */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left .3s cubic-bezier(.4,0,.2,1); position: relative; }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Header */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; border-bottom: 1px solid var(--border-color); margin-bottom: 30px; }
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

        /* Page Content */
        .page-header { margin-bottom: 32px; }
        .page-title { font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
        .page-subtitle { color: var(--text-muted); font-size: 0.875rem; }

        .section-container { margin-bottom: 40px; }
        .section-header { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .section-header i { color: var(--primary); font-size: 1.1rem; }
        .section-title { font-size: 1rem; font-weight: 600; color: var(--text-primary); }

        /* Cards */
        .profile-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; padding: 24px; display: flex; align-items: center; gap: 24px; position: relative; }
        .author-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; background: var(--bg-elevated); }
        .card-info-group { display: flex; gap: 48px; flex: 1; }
        .info-item { display: flex; flex-direction: column; gap: 4px; }
        .info-label { font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-size: 0.9375rem; font-weight: 600; color: var(--text-primary); }
        .author-order { width: 24px; height: 24px; background: var(--primary-glow); color: var(--primary); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; }
        .lock-icon { position: absolute; right: 24px; color: var(--text-muted); font-size: 1rem; opacity: 0.5; }

        /* Collaborators Section */
        .collaborator-box { border: 1px dashed var(--border-color); border-radius: 16px; padding: 24px; background: rgba(52, 211, 153, 0.01); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 24px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-label { font-size: 0.8125rem; font-weight: 600; color: var(--text-secondary); }
        .form-input { background: var(--bg-input); border: 1px solid var(--border-color); border-radius: 10px; padding: 12px 16px; color: var(--text-primary); font-size: 0.875rem; outline: none; transition: border-color 0.2s; }
        .form-input:focus { border-color: var(--primary); }
        .form-select { background: var(--bg-input); border: 1px solid var(--border-color); border-radius: 10px; padding: 12px 16px; color: var(--text-primary); font-size: 0.875rem; outline: none; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236ba898'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 16px center; background-size: 16px; }

        .add-btn { display: inline-flex; align-items:center; gap: 8px; color: var(--primary); font-weight: 600; font-size: 0.875rem; text-decoration: none; cursor: pointer; transition: color 0.2s; }
        .add-btn:hover { color: var(--primary-bright); }

        /* Alert Box */
        .info-alert { background: rgba(52, 211, 153, 0.05); border: 1px solid var(--primary-glow); border-radius: 12px; padding: 20px; display: flex; gap: 16px; margin-top: 32px; }
        .info-alert i { color: var(--primary); font-size: 1.25rem; margin-top: 2px; }
        .alert-content { flex: 1; }
        .alert-title { font-size: 0.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 4px; }
        .alert-text { font-size: 0.8125rem; color: var(--text-secondary); line-height: 1.6; }

        /* Footer Actions */
        .footer-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 48px; padding-top: 32px; border-top: 1px solid var(--border-color); }
        .btn { padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; font-family: 'Inter', sans-serif; text-decoration: none; }
        .btn-ghost { background: transparent; border: 1px solid var(--border-color); color: var(--text-secondary); }
        .btn-ghost:hover { background: var(--bg-elevated); color: var(--text-primary); }
        .btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background: var(--primary-glow); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dim)); border: none; color: white; box-shadow: 0 4px 15px rgba(52, 211, 153, 0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(52, 211, 153, 0.35); }
        
        .right-actions { display: flex; gap: 12px; }
        
        /* Dropdowns */
        .notif-wrapper, .user-wrapper { position:relative; }
        .notif-dropdown, .user-dropdown {
            position:absolute;
            top:calc(100% + 12px);
            right:0;
            width:320px;
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:14px;
            box-shadow:0 10px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(52,211,153,0.05);
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
        .user-dropdown { width: 220px; }
        .show { display:flex; }
        .dropdown-item { padding:12px 16px; display:flex; align-items:center; gap:12px; color:var(--text-secondary); text-decoration:none; font-size:.8125rem; font-weight:500; transition:all .2s; cursor:pointer; }
        .dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left: 20px; }
        .dropdown-item i { width:18px; text-align:center; }
        .divider { height:1px; background:var(--border-color); margin:4px 0; }
        .logout-item { color:#f87171 !important; }
        .logout-item:hover { background:rgba(248,113,113,0.08) !important; }

    </style>
</head>
<body>

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
                <a href="/informasi-penulis" class="nav-link active">
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
                <input type="text" class="search-input" placeholder="Cari naskah, penulis...">
            </div>
            <div class="header-actions">
                <div class="notif-wrapper">
                    <button class="header-icon-btn" id="notifToggle">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notif-dot"></span>
                    </button>
                    <!-- Dropdown mock logic needed -->
                </div>
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
                        <a href="#" class="dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <a href="#" class="dropdown-item logout-item"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <section class="page-header">
            <h1 class="page-title">Informasi Penulis</h1>
            <p class="page-subtitle">Lengkapi detail informasi penulis dan kolaborator untuk naskah ini.</p>
        </section>

        <section class="section-container">
            <div class="section-header">
                <i class="fa-solid fa-shield-check"></i>
                <h2 class="section-title">Penulis Utama</h2>
            </div>
            <div class="profile-card">
                <img src="https://ui-avatars.com/api/?name=Pradama&background=059669&color=fff&size=128" alt="Avatar" class="author-img">
                <div class="card-info-group">
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">Pradama</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">pradama@institution.edu</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Urutan Penulis</span>
                        <div class="author-order">1</div>
                    </div>
                </div>
                <i class="fa-solid fa-lock lock-icon"></i>
            </div>
        </section>

        <section class="section-container">
            <div class="section-header">
                <i class="fa-solid fa-users"></i>
                <h2 class="section-title">Penulis Lainnya / Kolaborator</h2>
            </div>
            <div class="collaborator-box">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-input" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" placeholder="contoh@email.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan Penulis</label>
                        <select class="form-select">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <a class="add-btn">
                    <i class="fa-solid fa-circle-plus"></i>
                    Tambah Penulis Lain
                </a>
            </div>

            <div class="info-alert">
                <i class="fa-solid fa-circle-info"></i>
                <div class="alert-content">
                    <h3 class="alert-title">Informasi Penting</h3>
                    <p class="alert-text">Pastikan urutan penulis sesuai dengan urutan yang akan dipublikasikan. Anda dapat menarik dan melepas (drag and drop) kartu penulis untuk mengubah urutan setelah menambahkannya.</p>
                </div>
            </div>
        </section>

        <footer class="footer-actions">
            <a href="/pengajuan" class="btn btn-ghost">
                <i class="fa-solid fa-arrow-left"></i>
                Sebelumnya
            </a>
            <div class="right-actions">
                <button class="btn btn-outline">Simpan Draft</button>
                <button class="btn btn-primary">
                    Simpan dan Lanjut
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </footer>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');

        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        userToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        document.addEventListener('click', () => {
            userDropdown.classList.remove('show');
        });
    </script>
</body>
</html>
