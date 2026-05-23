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
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main Content Luas Maksimal */
        .main-content { 
            flex:1 !important; 
            margin-left:var(--sidebar-width) !important; 
            padding: 0 40px 48px !important; 
            transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1) !important;
            width: calc(100% - var(--sidebar-width)) !important;
            max-width: 100% !important;
        }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width) !important; width: calc(100% - var(--sidebar-collapsed-width)) !important; }

        /* Header */
        .top-header { display:flex; justify-content:flex-end; align-items:center; padding:16px 0 8px; }
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
        .breadcrumb { display:flex; align-items:center; gap:8px; font-size:.8125rem; color:var(--text-muted); margin-bottom:12px; }
        .breadcrumb a { color:var(--text-muted); text-decoration:none; transition:color .2s; }
        .breadcrumb a:hover { color:var(--primary); }
        .breadcrumb .active { color:var(--primary); font-weight:500; }

        /* Page Header */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; padding-top: 4px; }
        .page-title-section { display:flex; flex-direction:column; gap:6px; margin:0; }
        .page-title-section h1 { font-size:2rem; font-weight:700; color:var(--text-primary); letter-spacing:-0.5px; line-height:1; margin:0; }
        .page-subtitle { font-size:.875rem; color:var(--text-muted); margin:0; line-height:1.4; }
        .page-actions { display:flex; gap:12px; align-items:center; }
        
        /* Buttons */
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#ffffff; border:none; padding:10px 20px; border-radius:8px; font-size:.875rem; font-weight:600; font-family:'Inter',sans-serif; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; box-shadow:0 4px 12px rgba(59, 195, 189,.2); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(59, 195, 189,.3); }
        .btn-outline-action { background:transparent; color:var(--text-secondary); border:1px solid var(--border-color); padding:10px 20px; border-radius:8px; font-size:.875rem; font-weight:500; font-family:'Inter',sans-serif; cursor:pointer; transition:all .2s; }
        .btn-outline-action:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--bg-elevated); }

        /* JURUS GRID UTAMA 2 KOLOM */
        .form-layout { 
            display: grid !important; 
            grid-template-columns: 1.6fr 1fr !important; 
            gap: 24px !important; 
            align-items: start !important; 
            width: 100% !important;
        }
        .form-main { display: flex !important; flex-direction: column !important; gap: 24px !important; }
        .form-sidebar { display: flex !important; flex-direction: column !important; gap: 24px !important; }

        .form-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:12px; padding:28px; position:relative; transition:transform .25s,box-shadow .25s; box-shadow:0 4px 16px rgba(0,0,0,.15); overflow:hidden; display: flex; flex-direction: column; }
        .form-card::after { content:''; position:absolute; inset:0; border-radius:12px; background:linear-gradient(145deg,rgba(59, 195, 189,.03),transparent 60%); pointer-events:none; }
        .form-card:hover { transform:translateY(-2px); border-top-color:var(--primary); box-shadow:0 8px 24px rgba(0,0,0,.25),0 0 0 1px rgba(59, 195, 189,.08); }
        
        .section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; position:relative; z-index:1; }
        .section-title { font-size:1.125rem; font-weight:600; color:var(--text-primary); display:flex; align-items:center; gap:10px; position:relative; z-index:1; }
        .title-bar { width:4px; height:18px; background:var(--primary); border-radius:2px; }
        
        .link-teal { color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:500; transition:color .2s; display:flex; align-items:center; gap:6px; }
        .link-teal:hover { color:var(--primary-bright); }

        /* Form Controls */
        .form-group { margin-bottom:20px; width: 100%; }
        .form-row { display:flex; gap:20px; margin-bottom:20px; width: 100%; }
        .form-row .form-group { margin-bottom:0; flex:1; }
        label { display:block; font-size:.8125rem; font-weight:500; color:var(--text-secondary); margin-bottom:8px; }
        .form-control { width:100% !important; padding:10px 14px; background:var(--bg-input); border:1px solid var(--border-color); border-radius:8px; color:var(--text-primary); font-family:'Inter',sans-serif; font-size:.875rem; transition:all .2s; }
        .form-control:focus { outline:none; border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        textarea.form-control { resize:vertical; min-height:80px; }
        select.form-control { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233BC3BD'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:14px; padding-right:36px; }

        /* Upload Areas */
        .upload-area { border:1px dashed var(--border-color); border-radius:10px; padding:40px 20px; text-align:center; background:rgba(255,255,255,0.02); cursor:pointer; transition:all .2s; display:flex; flex-direction:column; align-items:center; justify-content:center; width: 100%; }
        .upload-area:hover { border-color:var(--primary); background:rgba(59, 195, 189,0.03); transform: translateY(-2px); }
        
        .upload-area-primary { 
            border: 1px dashed rgba(59, 195, 189, 0.4); 
            background: rgba(59, 195, 189, 0.02); 
            border-radius: 16px;
            padding: 40px 20px;
        }
        .upload-area-primary:hover { 
            border-color: var(--primary); 
            background: rgba(59, 195, 189, 0.05); 
            box-shadow: 0 0 20px rgba(59, 195, 189, 0.1);
        }
        .upload-icon-circle { 
            width: 64px; 
            height: 64px; 
            background: var(--primary); 
            color: white; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 1.5rem; 
            margin: 0 auto 16px; 
            box-shadow: 0 8px 24px rgba(59, 195, 189, 0.4); 
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .upload-area-primary:hover .upload-icon-circle { transform: scale(1.1); }
        .upload-text-vibrant { color: var(--primary-bright); font-weight: 700; font-size: 1.125rem; margin-bottom: 8px; }
        .upload-hint { font-size:.75rem; color:var(--text-muted); }
        .text-primary { color:var(--primary); }
        .font-semibold { font-weight:600; }
        .btn-remove-author { background:rgba(248,113,113,0.05); border:1px solid rgba(248,113,113,0.2); color:#f87171; padding:8px 16px; border-radius:8px; font-size:0.75rem; font-weight:600; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:8px; }
        .btn-remove-author:hover { background:rgba(248,113,113,0.1); border-color:#f87171; transform:translateY(-1px); }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN TIRTA JAYA</span>
            </div>
            <button type="button" class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="nav-link"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link active"><i class="fa-regular fa-file-lines"></i><span class="nav-link-text">Pengajuan</span></a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i><span class="nav-link-text">Daftar Naskah</span></a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i><span class="nav-link-text">Draf Naskah</span></a></li>
            <li class="nav-item">
                <a href="/informasi-penulis" class="nav-link">
                    <i class="fa-regular fa-user"></i>
                    <span class="nav-link-text">Informasi Penulis</span>
                </a>
            </li>
            <li class="nav-item"><a href="/table-penulis" class="nav-link"><i class="fa-solid fa-users-viewfinder"></i><span class="nav-link-text">Daftar Penulis</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        
        <form action="{{ route('naskah.store') }}" method="POST" id="formNaskah" enctype="multipart/form-data" style="display: block;">
            @csrf
            
            <header class="top-header">
                <div class="header-actions">
                    <button type="button" class="header-icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i><span class="notif-dot"></span>
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
                <a href="/">Portal</a> <span style="opacity: 0.5; margin: 0 4px;">/</span> <span class="active">Pengajuan</span>
            </div>

            <div class="page-header">
                <div class="page-title-section">
                    <h1>Detail Naskah</h1>
                    <p class="page-subtitle">Lengkapi informasi di bawah ini untuk mendaftarkan naskah Anda ke sistem.</p>
                </div>
                <div class="page-actions" style="display: flex; gap: 12px;">
                    <button type="submit" name="action" value="draft" class="btn-outline-action" id="btnDraft">Simpan sebagai Draf</button>
                    <button type="submit" name="action" value="publish" class="btn-primary" id="btnAjukan">Terbitkan</button>
                </div>
            </div>

            @if (session('status'))
                <div style="background: rgba(5, 150, 105, 0.2); color: #6ee7b7; padding: 16px; border: 1px solid #059669; border-radius: 10px; margin-bottom: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-layout">
                
                <div class="form-main">
                    
                    <div class="form-card">
                        <h2 class="section-title"><span class="title-bar"></span>Informasi Naskah</h2>
                        
                        <div class="form-group">
                            <label>Judul Naskah</label>
                            <input type="text" name="judul" class="form-control" value="{{ isset($naskah) ? $naskah->judul : '' }}" placeholder="Masukkan judul naskah..." required>
                        </div>

                        <div class="form-group">
                            <label>Sub Judul Naskah</label>
                            <input type="text" name="sub_judul" class="form-control" value="{{ isset($naskah) ? $naskah->sub_judul : '' }}" placeholder="Masukkan sub judul naskah...">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" rows="8" placeholder="Tuliskan sinopsis singkat mengenai naskah Anda...">{{ isset($naskah) ? $naskah->sinopsis : '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-card" id="authorCard">
                        <div class="section-header">
                            <h2 class="section-title"><span class="title-bar"></span>Informasi Penulis</h2>
                            <a href="javascript:void(0)" class="link-teal" id="addAuthorBtn"><i class="fa-solid fa-plus-circle"></i> Tambahkan Penulis Lainnya</a>
                        </div>
                        
                        <div id="authorsContainer">
                            <div class="author-item" style="padding-bottom: 24px; margin-bottom: 24px; border-bottom: 1px solid var(--border-light);">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="penulis[0][nama]" class="form-control" placeholder="Masukkan nama lengkap penulis..." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="penulis[0][email]" class="form-control" placeholder="Masukkan alamat email aktif..." required>
                                    </div>
                                </div>

                                <div class="form-row" style="margin-bottom:0;">
                                    <div class="form-group" style="flex: 0 0 160px;">
                                        <label>Urutan Penulis</label>
                                        <select name="penulis[0][urutan]" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="flex: 1; display: flex; flex-direction: column;">
                                        <label>Biodata Narasi</label>
                                        <textarea name="penulis[0][biodata]" class="form-control" style="min-height: 80px;" placeholder="Tuliskan biodata narasi singkat..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-sidebar">
                    
                    <div class="form-card">
                        <h2 class="section-title"><span class="title-bar"></span>Unggah Foto Sampul</h2>
                        
                        <div class="form-group" style="flex:1; display:flex; flex-direction:column; margin-bottom:0;">
                            <input type="file" name="foto_sampul" id="inputCover" accept="image/jpeg,image/png" style="display:none;">
                            <div class="upload-area upload-area-primary" id="areaCover" style="flex:1;">
                                <div class="upload-icon-circle" id="iconCover"><i class="fa-regular fa-image"></i></div>
                                <div class="upload-text-vibrant" id="textCover">Unggah Foto Sampul</div>
                                <div class="upload-hint" id="hintCover">Format JPEG, PNG (Maks 10MB)</div>
                                <img id="previewCover" style="display:none; max-width:100%; max-height:240px; border-radius:12px; margin-top:12px; border: 1px solid var(--border-color);" alt="Preview">
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <h2 class="section-title"><span class="title-bar"></span>Unggah Naskah</h2>
                        
                        <div class="form-group" style="flex: 1; display: flex; flex-direction: column; margin-bottom:0;">
                            <input type="file" name="file_naskah" id="inputNaskah" accept=".pdf,.docx,.epub" style="display:none;">
                            <div class="upload-area upload-area-primary" id="areaNaskah" style="flex: 1;">
                                <div class="upload-icon-circle" id="iconNaskah"><i class="fa-solid fa-file-arrow-up"></i></div>
                                <div class="upload-text-vibrant" id="textNaskah">Unggah Naskah</div>
                                <div class="upload-hint" id="hintNaskah">Format PDF, DOCX, EPUB (Maks 50MB)</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
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

        // Upload Berkas Naskah
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
                icon.style.background='var(--primary)'; icon.style.boxShadow='0 4px 16px rgba(59, 195, 189,.4)';
                text.innerHTML=file.name;
                hint.innerHTML='<i class="fa-solid fa-check" style="color:var(--primary);"></i> File berhasil diunggah';
            }
        }

        setupImageUpload('areaCover','inputCover','iconCover','textCover','hintCover','previewCover',10);
        setupFileUpload('areaNaskah','inputNaskah','iconNaskah','textNaskah','hintNaskah',50);

        // User Dropdown Menu Toggle
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });

        // Dynamic Multiple Authors Array
        const authorsContainer = document.getElementById('authorsContainer');
        const addAuthorBtn = document.getElementById('addAuthorBtn');
        let authorCount = 1;

        addAuthorBtn.addEventListener('click', () => {
            authorCount++;
            const index = authorCount - 1;
            const authorHtml = `
                <div class="author-item" style="padding-bottom: 24px; margin-bottom: 24px; border-bottom: 1px solid var(--border-light); animation: fadeIn 0.3s ease-out;">
                    <div class="section-header" style="margin-bottom: 16px;">
                        <h3 style="font-size: 0.875rem; color: var(--primary); font-weight: 600;">Penulis #${authorCount}</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="penulis[${index}][nama]" class="form-control" placeholder="Masukkan nama lengkap penulis..." required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="penulis[${index}][email]" class="form-control" placeholder="Masukkan alamat email aktif..." required>
                        </div>
                    </div>
                    <div class="form-row" style="margin-bottom:0;">
                        <div class="form-group" style="flex: 0 0 160px;">
                            <label>Urutan Penulis</label>
                            <select name="penulis[${index}][urutan]" class="form-control">
                                <option value="1" ${authorCount===1?'selected':''}>1</option>
                                <option value="2" ${authorCount===2?'selected':''}>2</option>
                                <option value="3" ${authorCount===3?'selected':''}>3</option>
                                <option value="4" ${authorCount===4?'selected':''}>4</option>
                                <option value="5" ${authorCount===5?'selected':''}>5</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; display: flex; flex-direction: column;">
                            <label>Biodata Narasi</label>
                            <textarea name="penulis[${index}][biodata]" class="form-control" style="min-height: 80px;" placeholder="Tuliskan biodata narasi singkat..."></textarea>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                        <button type="button" class="btn-remove-author" onclick="this.closest('.author-item').remove()">
                            <i class="fa-solid fa-trash-can"></i> Hapus Penulis
                        </button>
                    </div>
                </div>
            `;
            authorsContainer.insertAdjacentHTML('beforeend', authorHtml);
        });

        // Inject CSS Animation Keyframe
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>