<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Informasi Akun</title>
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
            --sidebar-width: 280px;
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
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 40px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }
        
        .top-header { display:flex; justify-content:flex-end; align-items:center; padding:12px 0; }
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
        .page-grid { display:grid; grid-template-columns:300px 1fr; gap:24px; margin-top:10px; }
        
        .card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:20px; padding:28px; box-shadow:0 4px 20px rgba(0,0,0,0.2); position:relative; overflow:hidden; transition:transform .25s, box-shadow .25s; }
        .card::after { content:''; position:absolute; inset:0; border-radius:20px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(59, 195, 189,0.1); }
        .card-full { height: 100%; }
        
        .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .section-title { font-size:1.125rem; font-weight:700; color:var(--text-primary); display:flex; align-items:center; gap:12px; }
        .section-title i { color:var(--primary); }

        /* Account Status Card */
        .status-card { text-align:center; }
        .status-icon { width:80px; height:80px; border-radius:24px; background:var(--primary-glow); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:2.5rem; margin:0 auto 20px; border:1px solid rgba(59, 195, 189,0.2); }
        .status-label { display:inline-block; padding:4px 12px; border-radius:20px; background:#10b98120; color:#10b981; font-size:.75rem; font-weight:700; margin-bottom:12px; border:1px solid #10b98140; }
        .status-text { font-size:.875rem; color:var(--text-muted); margin-bottom:24px; }
        
        /* Account Info List */
        .info-list { display:flex; flex-direction:column; gap:20px; }
        .info-item { display:flex; justify-content:space-between; align-items:center; padding-bottom:15px; border-bottom:1px solid var(--border-light); }
        .info-label { color:var(--text-muted); font-size:.8125rem; }
        .info-value { color:var(--text-primary); font-weight:600; font-size:.875rem; }
        
        /* Security Badges */
        .badge-list { display:flex; flex-wrap:wrap; gap:10px; margin-top:10px; }
        .badge { padding:6px 12px; border-radius:8px; background:rgba(255,255,255,0.03); border:1px solid var(--border-color); font-size:.75rem; color:var(--text-secondary); display:flex; align-items:center; gap:8px; }
        .badge i { color:var(--primary); }
        .badge.warning i { color:#fbbf24; }
        
        /* Session List */
        .session-item { display:flex; align-items:center; gap:16px; padding:14px; border-radius:12px; background:rgba(255,255,255,0.02); border:1px solid var(--border-light); margin-bottom:12px; }
        .session-icon { width:40px; height:40px; border-radius:10px; background:var(--bg-elevated); display:flex; align-items:center; justify-content:center; color:var(--text-secondary); }
        .session-info { flex:1; }
        .session-title { font-weight:600; color:var(--text-primary); font-size:.875rem; }
        .session-meta { font-size:.75rem; color:var(--text-muted); }
        .session-status { font-size:.7rem; font-weight:700; color:var(--primary); text-transform:uppercase; }

        .btn-action { background:transparent; border:1px solid var(--border-color); color:var(--text-secondary); padding:8px 16px; border-radius:8px; font-size:.8125rem; font-weight:600; cursor:pointer; transition:all .2s; }
        .btn-action:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--bg-elevated); }
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
                <a href="/dashboard" class="nav-link">
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
                <a href="/table-penulis" class="nav-link">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span class="nav-link-text">Daftar Penulis</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>
 
    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="header-actions">
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar-sm">{{ strtoupper(substr(session('user_name', 'P'), 0, 1)) }}</div>
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

        <div class="page-grid">
            <div class="left-col">
                <div class="card status-card card-full">
                    <div class="status-icon">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="status-label">AKUN TERVERIFIKASI</div>
                    <h2 style="font-size:1.25rem; margin-bottom:8px;">Akun {{ $akun->name ?? 'User' }}</h2>
                    <p class="status-text">Terdaftar sejak 12 Januari 2024. Status akun Anda dalam keadaan baik dan aman.</p>
                    
                    <div class="info-list" style="text-align:left;">
                        <div class="info-item">
                            <span class="info-label">ID Akun</span>
                            <span class="info-value">#TJ-{{ str_pad($akun->id ?? 1, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tipe Akun</span>
                            <span class="info-value">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Batas Naskah</span>
                            <span class="info-value">Tanpa Batas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-col">
                <div style="display:flex; flex-direction:column; gap:24px;">
                    <div class="card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="fa-solid fa-key"></i> Keamanan Akun</h2>
                        </div>
                        <div class="info-list" id="accountInfoList">
                            <div class="info-item">
                                <span class="info-label">Email</span>
                                <span class="info-value" id="emailValue">{{ $akun->email ?? '' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Password</span>
                                <span class="info-value" id="passwordValue">••••••••••••</span>
                            </div>
                            <div class="info-item" style="border-bottom:none; padding-bottom:0;">
                                <span class="info-label">Autentikasi 2 Faktor</span>
                                <span class="info-value" style="color:#f87171;"><i class="fa-solid fa-circle-xmark"></i> Belum Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="fa-solid fa-desktop"></i> Sesi Aktif</h2>
                        </div>
                        <div class="session-item">
                            <div class="session-icon"><i class="fa-solid fa-laptop"></i></div>
                            <div class="session-info">
                                <div class="session-title">Chrome di Windows 11</div>
                                <div class="session-meta">Jakarta, Indonesia • Sedang Aktif</div>
                            </div>
                            <div class="session-status">Sesi Ini</div>
                        </div>
                        <div class="session-item">
                            <div class="session-icon"><i class="fa-solid fa-mobile-screen"></i></div>
                            <div class="session-info">
                                <div class="session-title">iPhone 14 Pro Max</div>
                                <div class="session-meta">Jakarta, Indonesia • 2 jam yang lalu</div>
                            </div>
                            <button class="btn-action" style="color:#f87171; border-color:rgba(248,113,113,0.2);">Keluar</button>
                        </div>
                    </div>
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

        // Edit Account Info Logic
        const editBtn = document.getElementById('editBtn');
        const emailValue = document.getElementById('emailValue');
        const passwordValue = document.getElementById('passwordValue');
        let isEditing = false;

        if (editBtn) {
            editBtn.addEventListener('click', () => {
                if (!isEditing) {
                    // Switch to Edit Mode
                    const currentEmail = emailValue.innerText;
                    emailValue.innerHTML = `<input type="email" id="emailInput" class="form-control" value="${currentEmail}" style="padding: 4px 8px; font-size: 0.875rem; background: var(--bg-body); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px; width: 200px;">`;
                    passwordValue.innerHTML = `<input type="password" id="passwordInput" class="form-control" value="password" style="padding: 4px 8px; font-size: 0.875rem; background: var(--bg-body); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px; width: 200px;">`;
                    editBtn.innerText = 'Simpan';
                    isEditing = true;
                } else {
                    // Switch to View Mode (Save)
                    const newEmail = document.getElementById('emailInput').value;
                    emailValue.innerText = newEmail;
                    passwordValue.innerText = '••••••••••••';
                    
                    // Show feedback
                    const origText = editBtn.innerText;
                    editBtn.innerText = 'Berhasil!';
                    editBtn.style.color = 'var(--primary)';
                    setTimeout(() => {
                        editBtn.innerText = 'Ubah';
                        editBtn.style.color = '';
                    }, 2000);
                    
                    isEditing = false;
                }
            });
        }
    </script>
</body>
</html>
