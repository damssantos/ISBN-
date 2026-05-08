<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #8B5CF6;
            --primary-bright: #A78BFA;
            --primary-dim:    #6D28D9;
            --primary-glow:   rgba(139, 92, 246, 0.15);
            --accent:         #8B5CF6;
            --bg-body:        #15131E;
            --bg-sidebar:     #1E1B2E;
            --bg-card:        #231F36;
            --bg-card-hover:  #2D2845;
            --bg-input:       #1B1829;
            --bg-elevated:    #2D2845;
            --border-color:   #342E4A;
            --border-light:   #231F36;
            --text-primary:   #E2D8F0;
            --text-secondary: #A59EBA;
            --text-muted:     #6F6987;
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
        .nav-link.active { background:linear-gradient(90deg,rgba(139,92,246,.14),rgba(139,92,246,.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all .2s; white-space:nowrap; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 40px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }

        /* Header */
        .header-actions { 
            display:flex; 
            align-items:center; 
            background: rgba(30, 27, 46, 0.6);
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
        .user-avatar-sm { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(139,92,246,0.3); }
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
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(139,92,246,0.08);
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

        /* Profile Layout */
        .profile-grid { display:grid; grid-template-columns:300px 1fr; gap:24px; margin-top:10px; }
        
        /* Left Column: Profile Overview */
        .profile-sidebar-col { height: 100%; }
        .profile-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:20px; padding:32px 24px; text-align:center; position:relative; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.3); height: 100%; display: flex; flex-direction: column; justify-content: center; transition: transform .25s, box-shadow .25s; }
        .profile-card::after { content:''; position:absolute; inset:0; border-radius:20px; background:linear-gradient(145deg,rgba(139,92,246,0.03),transparent 60%); pointer-events:none; }
        .profile-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 40px rgba(0,0,0,0.4),0 0 0 1px rgba(139,92,246,0.1); }
        .profile-card::before { content:''; position:absolute; top:0; left:0; width:100%; height:100px; background:linear-gradient(135deg,var(--primary-dim),var(--bg-card)); opacity:0.2; z-index:0; }
        .profile-avatar-lg { width:120px; height:120px; border-radius:30px; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:white; font-size:3rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; position:relative; z-index:1; border:4px solid var(--bg-card); box-shadow:0 8px 24px rgba(139,92,246,0.2); }
        .profile-name { font-size:1.5rem; font-weight:700; color:var(--text-primary); margin-bottom:4px; position:relative; z-index:1; }
        .profile-username { font-size:.875rem; color:var(--primary); font-weight:600; margin-bottom:16px; position:relative; z-index:1; }
        .profile-badge { display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:6px 12px; background:var(--primary-glow); color:var(--primary-bright); border-radius:20px; font-size:.75rem; font-weight:700; margin:0 auto 24px; position:relative; z-index:1; border:1px solid rgba(139,92,246,0.1); align-self:center; }
        
        .profile-stats { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:24px; position:relative; z-index:1; }
        .stat-box { background:rgba(255,255,255,0.03); border-radius:14px; padding:14px; border:1px solid rgba(255,255,255,0.05); }
        .stat-val { font-size:1.25rem; font-weight:700; color:var(--text-primary); }
        .stat-lbl { font-size:.7rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; }
        
        .profile-actions { display:flex; flex-direction:column; gap:10px; position:relative; z-index:1; }
        .btn-profile-action { width:100%; padding:12px; border-radius:12px; border:1px solid var(--border-color); background:transparent; color:var(--text-secondary); font-size:.875rem; font-weight:600; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:10px; }
        .btn-profile-action:hover { background:var(--bg-elevated); color:var(--primary); border-color:var(--primary-dim); }
        .btn-profile-action.logout { color:#f87171; border-color:rgba(248,113,113,0.2); }
        .btn-profile-action.logout:hover { background:rgba(248,113,113,0.05); border-color:#f87171; }

        /* Right Column: Settings */
        .settings-container { display:flex; flex-direction:column; gap:24px; height: 100%; }
        .settings-section { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:20px; padding:28px; box-shadow:0 10px 30px rgba(0,0,0,0.3); height: 100%; position:relative; overflow:hidden; transition:transform .25s, box-shadow .25s; }
        .settings-section::after { content:''; position:absolute; inset:0; border-radius:20px; background:linear-gradient(145deg,rgba(139,92,246,0.03),transparent 60%); pointer-events:none; }
        .settings-section:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 40px rgba(0,0,0,0.4),0 0 0 1px rgba(139,92,246,0.1); }
        .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; position:relative; z-index:1; }
        .section-title { font-size:1.125rem; font-weight:700; color:var(--text-primary); display:flex; align-items:center; gap:12px; }
        .section-title i { color:var(--primary); }
        
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; position:relative; z-index:1; }
        .form-group { display:flex; flex-direction:column; gap:8px; }
        .form-group.full { grid-column: span 2; }
        label { font-size:.8125rem; font-weight:600; color:var(--text-muted); }
        .input-wrapper { position:relative; }
        .input-wrapper i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .form-control { width:100%; padding:11px 14px 11px 40px; background:var(--bg-body); border:1px solid var(--border-color); border-radius:10px; color:var(--text-primary); font-family:'Inter',sans-serif; font-size:.875rem; transition:all .2s; }
        .form-control:focus { outline:none; border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        
        .btn-save { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border:none; padding:12px 24px; border-radius:10px; font-size:.875rem; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:10px; transition:all .2s; margin-top:10px; }
        .btn-save:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(139,92,246,0.3); }

        /* Breadcrumb */
        .breadcrumb { display:flex; align-items:center; gap:8px; font-size:.8125rem; color:var(--text-muted); margin-bottom:16px; margin-top:10px; }
        .breadcrumb a { color:var(--text-muted); text-decoration:none; transition:color .2s; }
        .breadcrumb a:hover { color:var(--primary); }
        .breadcrumb .active { color:var(--primary); font-weight:500; }
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
            <a href="#" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="top-header" style="display: flex; justify-content: flex-end; padding: 12px 0;">
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar-sm">P</div>
                        <div class="user-header-info">
                            <div class="user-header-name">Pradama</div>
                            <div class="user-header-role">Kontributor</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item active"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <a href="/akun" class="user-dropdown-item"><i class="fa-regular fa-id-badge"></i><span>Informasi Akun</span></a>
                        <a href="/pengaturan" class="user-dropdown-item"><i class="fa-solid fa-gear"></i><span>Pengaturan</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="#" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>



        <div class="profile-grid">
            <!-- Left Column -->
            <div class="profile-sidebar-col">
                <div class="profile-card">
                    <div class="profile-avatar-lg" id="avatarPreview">P</div>
                    <input type="file" id="avatarInput" accept="image/*" style="display:none">
                    <h2 class="profile-name">Pradama Wijaya</h2>
                    <p class="profile-username">@pradama_wj</p>
                    <div class="profile-badge">
                        <i class="fa-solid fa-award"></i> Kontributor Ahli
                    </div>
                    
                    <div class="profile-stats">
                        <div class="stat-box">
                            <div class="stat-val">24</div>
                            <div class="stat-lbl">Naskah</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-val">18</div>
                            <div class="stat-lbl">Published</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <button class="btn-profile-action" id="changeAvatarBtn"><i class="fa-solid fa-camera"></i> Ubah Foto</button>
                        <a href="/akun" class="btn-profile-action" style="text-decoration: none;"><i class="fa-solid fa-key"></i> Ganti Password</a>
                        <button class="btn-profile-action logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</button>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="settings-container">
                <!-- Personal Info -->
                <div class="settings-section">
                    <div class="section-header">
                        <h2 class="section-title"><i class="fa-solid fa-user-gear"></i> Pengaturan Akun</h2>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" class="form-control" value="Pradama Wijaya">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Utama</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" class="form-control" value="pradama.wijaya@gmail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-at"></i>
                                <input type="text" class="form-control" value="pradama_wj">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-phone"></i>
                                <input type="text" class="form-control" value="0812-3456-7890">
                            </div>
                        </div>
                        <div class="form-group full">
                            <label>Bio Singkat</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-pen-nib"></i>
                                <input type="text" class="form-control" value="Penulis dan Akademisi di Universitas Indonesia. Fokus pada Arsitektur Berkelanjutan.">
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn-save" id="btnSave">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
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

        // Save feedback
        document.getElementById('btnSave').addEventListener('click', () => {
            const btn = document.getElementById('btnSave');
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Berhasil Disimpan!';
            btn.style.background = 'var(--primary-dim)';
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.style.background = '';
            }, 2000);
        });

        // User Dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });

        // Profile Photo Change Logic
        const changeAvatarBtn = document.getElementById('changeAvatarBtn');
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');

        changeAvatarBtn.addEventListener('click', () => {
            avatarInput.click();
        });

        avatarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update main profile avatar
                    avatarPreview.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:inherit;">`;
                    
                    // Update small header avatar if it exists
                    const headerAvatar = document.querySelector('.user-avatar-sm');
                    if (headerAvatar) {
                        headerAvatar.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:inherit;">`;
                    }

                    // Optional: Show success notification
                    const btn = document.getElementById('btnSave');
                    const orig = btn.innerHTML;
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Foto Diperbarui!';
                    btn.style.background = 'var(--primary-dim)';
                    setTimeout(() => {
                        btn.innerHTML = orig;
                        btn.style.background = '';
                    }, 2000);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
