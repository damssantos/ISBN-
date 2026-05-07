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
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:10px; padding:6px 10px 6px 6px; border-radius:10px; cursor:pointer; transition:background .2s; }
        .user-header:hover { background:var(--bg-card); }
        .user-avatar { width:36px; height:36px; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.875rem; }
        .user-header-name { font-weight:600; font-size:.8125rem; color:var(--text-primary); line-height:1.3; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.3; }
        .user-dropdown {
            position:absolute;
            top:calc(100% + 12px);
            right:0;
            width:240px;
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:16px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(52,211,153,0.08);
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

        /* Breadcrumb */
        .breadcrumb { display:flex; align-items:center; gap:8px; font-size:.8125rem; color:var(--text-muted); margin-bottom:16px; }
        .breadcrumb a { color:var(--text-muted); text-decoration:none; transition:color .2s; }
        .breadcrumb a:hover { color:var(--primary); }
        .breadcrumb .active { color:var(--primary); font-weight:500; }

        /* Page Header */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; }
        .page-title-section { display:flex; flex-direction:column; gap:6px; margin:0; }
        .page-title-section h1 { font-size:2rem; font-weight:700; color:var(--text-primary); letter-spacing:-0.5px; line-height:1; margin:0; }
        .page-subtitle { font-size:.875rem; color:var(--text-muted); margin:0; max-width:none; line-height:1.4; }
        .page-actions { display:flex; gap:12px; align-items:center; }
        
        /* Buttons */
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#ffffff; border:none; padding:10px 20px; border-radius:8px; font-size:.875rem; font-weight:600; font-family:'Inter',sans-serif; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; box-shadow:0 4px 12px rgba(52,211,153,.2); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(52,211,153,.3); }
        .btn-outline-action { background:transparent; color:var(--text-secondary); border:1px solid var(--border-color); padding:10px 20px; border-radius:8px; font-size:.875rem; font-weight:500; font-family:'Inter',sans-serif; cursor:pointer; transition:all .2s; }
        .btn-outline-action:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--bg-elevated); }

        /* Form Layout */
        .form-layout { display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:stretch; }
        .form-main { display:flex; flex-direction:column; gap:24px; height:100%; }
        .form-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:12px; padding:28px; position:relative; transition:transform .25s,box-shadow .25s; box-shadow:0 4px 16px rgba(0,0,0,.15); overflow:hidden; }
        .form-card::after { content:''; position:absolute; inset:0; border-radius:12px; background:linear-gradient(145deg,rgba(52,211,153,.03),transparent 60%); pointer-events:none; }
        .form-card:hover { transform:translateY(-2px); border-top-color:var(--primary); box-shadow:0 8px 24px rgba(0,0,0,.25),0 0 0 1px rgba(52,211,153,.08); }
        
        .form-sidebar { display:flex; flex-direction:column; height:100%; }
        .form-sidebar .form-card { flex:1; display:flex; flex-direction:column; }
        
        .section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; position:relative; z-index:1; }
        .section-title { font-size:1.125rem; font-weight:600; color:var(--text-primary); display:flex; align-items:center; gap:10px; margin-bottom:24px; position:relative; z-index:1; }
        .section-header .section-title { margin-bottom:0; }
        .title-bar { width:4px; height:18px; background:var(--primary); border-radius:2px; }
        
        .link-teal { color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:500; transition:color .2s; display:flex; align-items:center; gap:6px; }
        .link-teal:hover { color:var(--primary-bright); }

        /* Form Controls */
        .form-group { margin-bottom:20px; }
        .form-row { display:flex; gap:20px; margin-bottom:20px; }
        .form-row .form-group { margin-bottom:0; flex:1; }
        label { display:block; font-size:.8125rem; font-weight:500; color:var(--text-secondary); margin-bottom:8px; }
        .form-control { width:100%; padding:10px 14px; background:var(--bg-body); border:1px solid var(--border-color); border-radius:8px; color:var(--text-primary); font-family:'Inter',sans-serif; font-size:.875rem; transition:all .2s; }
        .form-control:focus { outline:none; border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        textarea.form-control { resize:vertical; min-height:80px; }
        select.form-control { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236ba898'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:14px; padding-right:36px; }

        /* Upload Areas */
        .upload-area { border:1px dashed var(--border-color); border-radius:10px; padding:40px 20px; text-align:center; background:rgba(26,46,40,0.4); cursor:pointer; transition:all .2s; display:flex; flex-direction:column; align-items:center; justify-content:center; }
        .upload-area:hover { border-color:var(--primary-dim); background:rgba(52,211,153,0.03); }
        .upload-icon { font-size:2rem; color:var(--text-muted); margin-bottom:12px; }
        .upload-text { font-size:.875rem; color:var(--text-secondary); margin-bottom:4px; }
        .text-primary { color:var(--primary); }
        .font-semibold { font-weight:600; }
        .upload-hint { font-size:.75rem; color:var(--text-muted); }
        
        .upload-area-primary { border-color:rgba(52,211,153,0.3); background:rgba(52,211,153,0.02); }
        .upload-area-primary:hover { border-color:var(--primary); background:rgba(52,211,153,0.05); }
        .upload-icon-circle { width:48px; height:48px; background:var(--primary-dim); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.25rem; margin:0 auto 12px; box-shadow:0 4px 12px rgba(5,150,105,.3); }
        .mt-4 { margin-top:24px; }
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
                <input type="text" class="search-input" placeholder="Cari naskah, penulis, atau ISBN...">
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

        <div class="breadcrumb">
            <a href="#">Portal</a> <span>/</span> <span class="active">Pengajuan</span>
        </div>

        <div class="page-header">
            <div class="page-title-section">
                <h1>Detail Naskah</h1>
                <p class="page-subtitle">Lengkapi informasi di bawah ini untuk mendaftarkan draf Anda ke dalam sistem.</p>
            </div>
            <div class="page-actions">
                <button class="btn-outline-action" id="btnDraft">Simpan sebagai Draf</button>
                <button class="btn-primary" id="btnAjukan">Ajukan</button>
            </div>
        </div>

        <div class="form-layout">
            <div class="form-main">
                <!-- Informasi Naskah -->
                <div class="form-card">
                    <h2 class="section-title"><span class="title-bar"></span>Informasi Naskah</h2>
                    
                    <div class="form-group">
                        <label>Judul Naskah</label>
                        <input type="text" class="form-control" placeholder="Masukkan judul naskah...">
                    </div>

                    <div class="form-group">
                        <label>Sub Judul Naskah</label>
                        <input type="text" class="form-control" placeholder="Masukkan sub judul naskah...">
                    </div>

                    <div class="form-group" style="margin-bottom:0; position:relative; z-index:1;">
                        <label>Sinopsis</label>
                        <textarea class="form-control" rows="8" placeholder="Tuliskan sinopsis singkat mengenai naskah Anda..."></textarea>
                    </div>
                </div>

                <!-- Informasi Penulis -->
                <div class="form-card">
                    <div class="section-header">
                        <h2 class="section-title"><span class="title-bar"></span>Informasi Penulis</h2>
                        <a href="#" class="link-teal"><i class="fa-solid fa-plus-circle"></i> Tambahkan Penulis Lainnya</a>
                    </div>
                    
                    <div class="form-row" style="position:relative; z-index:1;">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama lengkap penulis...">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan alamat email aktif...">
                        </div>
                    </div>

                    <div class="form-row" style="margin-bottom:0; position:relative; z-index:1;">
                        <div class="form-group" style="flex: 0 0 160px;">
                            <label>Urutan Penulis</label>
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Biodata Narasi</label>
                            <textarea class="form-control" rows="4" placeholder="Tuliskan biodata narasi singkat..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-sidebar">
                <!-- Lampiran -->
                <div class="form-card" style="padding:28px 24px;">
                    <h2 class="section-title"><span class="title-bar"></span>Lampiran</h2>
                    
                    <div class="form-group" style="position:relative; z-index:1; flex:1; display:flex; flex-direction:column;">
                        <label>Foto Cover</label>
                        <input type="file" id="inputCover" accept="image/jpeg,image/png" style="display:none;">
                        <div class="upload-area" id="areaCover" style="min-height:240px; flex:1;">
                            <div class="upload-icon" id="iconCover"><i class="fa-regular fa-image"></i></div>
                            <div class="upload-text" id="textCover" style="line-height: 1.6;">Seret & lepas foto sampul atau<br><span class="text-primary font-semibold">Cari File</span></div>
                            <div class="upload-hint mt-2" id="hintCover">Format JPEG, PNG (Maks 10MB)</div>
                            <img id="previewCover" style="display:none; max-width:100%; max-height:200px; border-radius:8px; margin-top:8px;" alt="Preview">
                        </div>
                    </div>

                    <div class="form-group mt-4" style="margin-bottom:0; position:relative; z-index:1;">
                        <label>Unggah Naskah</label>
                        <input type="file" id="inputNaskah" accept=".pdf,.docx,.epub" style="display:none;">
                        <div class="upload-area upload-area-primary" id="areaNaskah" style="border-style:dashed; padding:32px 20px;">
                            <div class="upload-icon-circle" id="iconNaskah"><i class="fa-solid fa-file-arrow-up"></i></div>
                            <div class="upload-text text-primary font-semibold" id="textNaskah" style="font-size:1rem;">Unggah Naskah</div>
                            <div class="upload-hint mt-2" id="hintNaskah">Format PDF, DOCX, EPUB (Maks 50MB)</div>
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

        // Upload Foto Cover
        function setupImageUpload(areaId, inputId, iconId, textId, hintId, previewId, maxMB) {
            const area = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const text = document.getElementById(textId);
            const hint = document.getElementById(hintId);
            const preview = document.getElementById(previewId);

            area.addEventListener('click', () => input.click());
            area.addEventListener('dragover', (e) => { e.preventDefault(); area.style.borderColor='var(--primary)'; });
            area.addEventListener('dragleave', () => { area.style.borderColor=''; });
            area.addEventListener('drop', (e) => {
                e.preventDefault(); area.style.borderColor='';
                if(e.dataTransfer.files.length){ input.files=e.dataTransfer.files; showPreview(input.files[0]); }
            });
            input.addEventListener('change', () => { if(input.files.length) showPreview(input.files[0]); });

            function showPreview(file) {
                if(file.size > maxMB*1024*1024){ alert('Ukuran file maksimal '+maxMB+'MB'); return; }
                icon.style.display='none'; hint.style.display='none';
                if(file.type.startsWith('image/')){
                    const reader = new FileReader();
                    reader.onload = (e) => { preview.src=e.target.result; preview.style.display='block'; };
                    reader.readAsDataURL(file);
                    text.innerHTML='<span class="text-primary font-semibold">'+file.name+'</span>';
                } else {
                    preview.style.display='none';
                    text.innerHTML='<i class="fa-solid fa-file-check" style="font-size:2rem;color:var(--primary);margin-bottom:8px;"></i><br><span class="text-primary font-semibold">'+file.name+'</span>';
                }
            }
        }

        // Upload Naskah
        function setupFileUpload(areaId, inputId, iconId, textId, hintId, maxMB) {
            const area = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const text = document.getElementById(textId);
            const hint = document.getElementById(hintId);

            area.addEventListener('click', () => input.click());
            area.addEventListener('dragover', (e) => { e.preventDefault(); area.style.borderColor='var(--primary)'; });
            area.addEventListener('dragleave', () => { area.style.borderColor=''; });
            area.addEventListener('drop', (e) => {
                e.preventDefault(); area.style.borderColor='';
                if(e.dataTransfer.files.length){ input.files=e.dataTransfer.files; showFile(input.files[0]); }
            });
            input.addEventListener('change', () => { if(input.files.length) showFile(input.files[0]); });

            function showFile(file) {
                if(file.size > maxMB*1024*1024){ alert('Ukuran file maksimal '+maxMB+'MB'); return; }
                icon.innerHTML='<i class="fa-solid fa-file-circle-check" style="font-size:1.5rem;"></i>';
                icon.style.background='var(--primary)'; icon.style.boxShadow='0 4px 16px rgba(52,211,153,.4)';
                text.innerHTML=file.name;
                hint.innerHTML='<i class="fa-solid fa-check" style="color:var(--primary);"></i> File berhasil diunggah';
            }
        }

        setupImageUpload('areaCover','inputCover','iconCover','textCover','hintCover','previewCover',10);
        setupFileUpload('areaNaskah','inputNaskah','iconNaskah','textNaskah','hintNaskah',50);

        // Ajukan button -> redirect to detail
        document.getElementById('btnAjukan').addEventListener('click', () => {
            const btn = document.getElementById('btnAjukan');
            btn.innerHTML='<i class="fa-solid fa-spinner fa-spin"></i> Mengajukan...';
            setTimeout(() => { window.location.href='/pengajuan/detail'; }, 1000);
        });

        // Draft button feedback
        document.getElementById('btnDraft').addEventListener('click', () => {
            const btn = document.getElementById('btnDraft');
            const orig = btn.innerHTML;
            btn.innerHTML='<i class="fa-solid fa-check"></i> Draf Tersimpan!';
            btn.style.borderColor='var(--primary)'; btn.style.color='var(--primary)';
            setTimeout(() => { btn.innerHTML=orig; btn.style.borderColor=''; btn.style.color=''; }, 2000);
        });

        // User Dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });
    </script>

</body>
</html>
