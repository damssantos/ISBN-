<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Pengajuan Naskah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #3BC3BD;
            --primary-bright: #5CD9D4;
            --primary-dim:    #2E9B96;
            --primary-glow:   rgba(59, 195, 189, 0.15);
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
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x:hidden; }

        /* ─── Sidebar ─────────────────────────────────────────── */
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
        .nav-link.active { background:linear-gradient(90deg, rgba(59,195,189,0.16), rgba(59,195,189,0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all .2s; white-space:nowrap; background:none; border:none; cursor:pointer; width:100%; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* ─── Main Content ─────────────────────────────────────── */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 40px 48px; transition:margin-left 0.3s cubic-bezier(.4,0,.2,1); min-width:0; }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* ─── Header ───────────────────────────────────────────── */
        .top-header { display:flex; justify-content:flex-end; align-items:center; padding:16px 0 8px; }
        .header-actions { display:flex; align-items:center; background:rgba(15,29,38,0.7); border:1px solid var(--border-color); padding:4px 12px 4px 4px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.2); gap:0; }
        .header-icon-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:12px; border:none; background:transparent; color:var(--text-secondary); cursor:pointer; transition:all 0.2s; position:relative; font-size:1.1rem; }
        .header-icon-btn:hover { background:rgba(255,255,255,0.05); color:var(--primary-bright); }
        .header-divider { width:1px; height:24px; background:var(--border-color); margin:0 12px 0 8px; opacity:0.6; }
        .notif-dot { position:absolute; top:10px; right:10px; width:6px; height:6px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow:0 4px 12px rgba(59,195,189,0.3); }
        .user-header-info { display:flex; flex-direction:column; }
        .user-header-name { font-weight:700; font-size:.9375rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.2; font-weight:500; }
        .user-dropdown { position:absolute; top:calc(100% + 12px); right:0; width:240px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.5); display:none; flex-direction:column; z-index:1000; overflow:hidden; animation:dropdownFadeIn 0.25s cubic-bezier(0.16,1,0.3,1); }
        @keyframes dropdownFadeIn { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition:color .2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,0.08); color:#f87171; }

        /* ─── Breadcrumb ───────────────────────────────────────── */
        .breadcrumb { display:flex; align-items:center; gap:8px; font-size:.8125rem; color:var(--text-muted); margin-bottom:12px; }
        .breadcrumb a { color:var(--text-muted); text-decoration:none; transition:color .2s; }
        .breadcrumb a:hover { color:var(--primary); }
        .breadcrumb .sep { opacity:0.4; }
        .breadcrumb .active { color:var(--primary); font-weight:500; }

        /* ─── Page Header ──────────────────────────────────────── */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; padding-top:4px; }
        .page-title-section h1 { font-size:2rem; font-weight:700; color:var(--text-primary); letter-spacing:-0.5px; margin-bottom:4px; }
        .page-subtitle { font-size:.875rem; color:var(--text-muted); }
        .page-actions { display:flex; gap:12px; align-items:center; }

        /* ─── Buttons ──────────────────────────────────────────── */
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary-dim)); color:#fff; border:none; padding:10px 20px; border-radius:10px; font-size:.875rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:all .2s; box-shadow:0 4px 12px rgba(59,195,189,.2); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(59,195,189,.3); }
        .btn-outline-action { background:transparent; color:var(--text-secondary); border:1px solid var(--border-color); padding:10px 20px; border-radius:10px; font-size:.875rem; font-weight:500; cursor:pointer; transition:all .2s; display:inline-flex; align-items:center; gap:8px; }
        .btn-outline-action:hover { border-color:var(--primary-dim); color:var(--primary); background:rgba(59,195,189,0.05); }

        /* ─── Form Layout ──────────────────────────────────────── */
        .form-layout { display:grid; grid-template-columns:1.6fr 1fr; gap:24px; align-items:start; }
        .form-main { display:flex; flex-direction:column; gap:24px; }
        .form-sidebar { display:flex; flex-direction:column; gap:24px; }

        /* ─── Form Card ────────────────────────────────────────── */
        .form-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:16px; padding:28px; position:relative; box-shadow:0 4px 16px rgba(0,0,0,.15); transition:transform 0.2s,box-shadow 0.2s; }
        .form-card:hover { transform:translateY(-2px); border-top-color:var(--primary); box-shadow:0 8px 24px rgba(0,0,0,.25),0 0 0 1px rgba(59,195,189,.08); }

        .section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .section-title { font-size:1.125rem; font-weight:600; color:var(--text-primary); display:flex; align-items:center; gap:10px; margin-bottom:0; }
        .title-bar { width:4px; height:18px; background:var(--primary); border-radius:2px; flex-shrink:0; }
        .link-teal { color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:600; transition:color .2s; display:flex; align-items:center; gap:6px; cursor:pointer; }
        .link-teal:hover { color:var(--primary-bright); }

        /* ─── Form Controls ────────────────────────────────────── */
        .form-group { margin-bottom:20px; }
        .form-group:last-child { margin-bottom:0; }
        .form-row { display:flex; gap:20px; margin-bottom:20px; }
        .form-row:last-child { margin-bottom:0; }
        .form-row .form-group { flex:1; margin-bottom:0; }
        label { display:block; font-size:.8125rem; font-weight:600; color:var(--text-secondary); margin-bottom:8px; }
        .form-control { width:100%; padding:11px 14px; background:var(--bg-input); border:1px solid var(--border-color); border-radius:10px; color:var(--text-primary); font-family:'Inter',sans-serif; font-size:.875rem; transition:all .2s; outline:none; }
        .form-control:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        .form-control::placeholder { color:var(--text-muted); opacity:0.6; }
        textarea.form-control { resize:vertical; min-height:120px; }
        select.form-control { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233BC3BD'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:14px; padding-right:36px; }

        /* ─── Upload Areas ─────────────────────────────────────── */
        .upload-area { border:1px dashed rgba(59,195,189,0.4); border-radius:16px; padding:32px 20px; text-align:center; background:rgba(59,195,189,0.02); cursor:pointer; transition:all 0.2s; display:flex; flex-direction:column; align-items:center; justify-content:center; }
        .upload-area:hover { border-color:var(--primary); background:rgba(59,195,189,0.06); box-shadow:0 0 20px rgba(59,195,189,0.1); transform:translateY(-2px); }
        .upload-icon-circle { width:56px; height:56px; background:var(--primary); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.25rem; margin-bottom:16px; box-shadow:0 8px 20px rgba(59,195,189,0.3); transition:transform 0.3s cubic-bezier(0.34,1.56,0.64,1); }
        .upload-area:hover .upload-icon-circle { transform:scale(1.1); }
        .upload-text-vibrant { color:var(--primary-bright); font-weight:700; font-size:1rem; margin-bottom:6px; }
        .upload-hint { font-size:.75rem; color:var(--text-muted); }

        /* ─── Remove Author Button ─────────────────────────────── */
        .btn-remove-author { background:rgba(248,113,113,0.05); border:1px solid rgba(248,113,113,0.2); color:#f87171; padding:8px 14px; border-radius:8px; font-size:0.75rem; font-weight:600; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:8px; }
        .btn-remove-author:hover { background:rgba(248,113,113,0.1); border-color:#f87171; }

        /* ─── Alert ────────────────────────────────────────────── */
        .alert-success { background:rgba(5,150,105,0.1); color:#6ee7b7; padding:16px; border:1px solid rgba(5,150,105,0.3); border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px; }

        /* ─── Animation ────────────────────────────────────────── */
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .fade-in { animation:fadeIn 0.3s ease-out; }

        /* ─── Responsive ───────────────────────────────────────── */
        @media (max-width:1024px) {
            .form-layout { grid-template-columns:1fr; }
            .main-content { padding:0 20px 48px; }
        }
    </style>
</head>
<body>

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN YPIK PAM JAYA</span>
            </div>
            <button type="button" class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/dashboard" class="nav-link"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link active"><i class="fa-regular fa-file-lines"></i><span class="nav-link-text">Pengajuan</span></a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i><span class="nav-link-text">Daftar Naskah</span></a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i><span class="nav-link-text">Draf Naskah</span></a></li>
            <li class="nav-item"><a href="/informasi-penulis" class="nav-link"><i class="fa-regular fa-user"></i><span class="nav-link-text">Informasi Penulis</span></a></li>
            <li class="nav-item"><a href="/table-penulis" class="nav-link"><i class="fa-solid fa-users-viewfinder"></i><span class="nav-link-text">Daftar Penulis</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="/logout" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>

    <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
    <main class="main-content" id="mainContent">

        <!-- Top Header -->
        <header class="top-header">
            <div class="header-actions">
                <button type="button" class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
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

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/dashboard">Portal</a>
            <span class="sep">/</span>
            <span class="active">Pengajuan Naskah</span>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1>Detail Naskah</h1>
                <p class="page-subtitle">Lengkapi informasi di bawah ini untuk mendaftarkan naskah Anda ke sistem.</p>
            </div>
            <div class="page-actions">
                <button type="button" class="btn-outline-action" id="btnDraft">
                    <i class="fa-regular fa-floppy-disk"></i> Simpan Draf
                </button>
                <button type="submit" form="formNaskah" class="btn-primary" id="btnAjukan">
                    <i class="fa-solid fa-paper-plane"></i> Ajukan Naskah
                </button>
            </div>
        </div>

        @if (session('status'))
            <div class="alert-success fade-in">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('naskah.store') }}" method="POST" id="formNaskah" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">

                <!-- ── Kolom Kiri ── -->
                <div class="form-main">

                    <!-- Informasi Naskah -->
                    <div class="form-card">
                        <h2 class="section-title" style="margin-bottom:24px;"><span class="title-bar"></span>Informasi Naskah</h2>

                        <div class="form-group">
                            <label>Judul Naskah</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul utama naskah Anda..." required>
                        </div>

                        <div class="form-group">
                            <label>Sub Judul Naskah <span style="font-weight:400;color:var(--text-muted);">(Opsional)</span></label>
                            <input type="text" name="sub_judul" class="form-control" placeholder="Masukkan sub judul atau keterangan tambahan...">
                        </div>

                        <div class="form-group">
                            <label>Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" placeholder="Tuliskan ringkasan singkat mengenai isi naskah Anda..." required></textarea>
                        </div>
                    </div>

                </div>

                <!-- ── Kolom Kanan ── -->
                <div class="form-sidebar">

                    <!-- Informasi Penulis -->
                    <div class="form-card" id="authorCard">
                        <div class="section-header">
                            <h2 class="section-title"><span class="title-bar"></span>Informasi Penulis</h2>
                            <a href="javascript:void(0)" class="link-teal" id="addAuthorBtn">
                                <i class="fa-solid fa-plus-circle"></i> Tambah
                            </a>
                        </div>

                        <div id="authorsContainer">
                            <div class="author-item">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="penulis[0][nama]" class="form-control" placeholder="Nama sesuai identitas..." required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="penulis[0][email]" class="form-control" placeholder="Alamat email aktif..." required>
                                </div>
                                <div class="form-group">
                                    <label>Urutan Penulis</label>
                                    <select name="penulis[0][urutan]" class="form-control">
                                        <option value="1">Utama (1)</option>
                                        <option value="2">Kedua (2)</option>
                                        <option value="3">Ketiga (3)</option>
                                        <option value="4">Keempat (4)</option>
                                        <option value="5">Kelima (5)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Biodata Singkat</label>
                                    <textarea name="penulis[0][biodata]" class="form-control" style="min-height:80px;" placeholder="Profil singkat penulis..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unggah Sampul -->
                    <div class="form-card">
                        <h2 class="section-title" style="margin-bottom:24px;"><span class="title-bar"></span>Sampul Naskah</h2>
                        <input type="file" name="foto_sampul" id="inputCover" accept="image/jpeg,image/png" style="display:none;">
                        <div class="upload-area" id="areaCover">
                            <div class="upload-icon-circle" id="iconCover"><i class="fa-regular fa-image"></i></div>
                            <div class="upload-text-vibrant" id="textCover">Unggah Foto Sampul</div>
                            <div class="upload-hint" id="hintCover">Format JPEG, PNG (Maks 10MB)</div>
                            <img id="previewCover" style="display:none;max-width:100%;border-radius:12px;margin-top:12px;border:1px solid var(--border-color);" alt="Preview">
                        </div>
                    </div>

                    <!-- Unggah File Naskah -->
                    <div class="form-card">
                        <h2 class="section-title" style="margin-bottom:24px;"><span class="title-bar"></span>File Naskah</h2>
                        <input type="file" name="file_naskah" id="inputNaskah" accept=".pdf,.docx,.epub" style="display:none;" required>
                        <div class="upload-area" id="areaNaskah">
                            <div class="upload-icon-circle" id="iconNaskah"><i class="fa-solid fa-file-arrow-up"></i></div>
                            <div class="upload-text-vibrant" id="textNaskah">Unggah File Naskah</div>
                            <div class="upload-hint" id="hintNaskah">Format PDF, DOCX, EPUB (Maks 50MB)</div>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </main>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // User Dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && !userToggle.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });

        // Universal Upload Handler
        function setupUpload(areaId, inputId, iconId, textId, hintId, previewId = null) {
            const area    = document.getElementById(areaId);
            const input   = document.getElementById(inputId);
            const icon    = document.getElementById(iconId);
            const text    = document.getElementById(textId);
            const hint    = document.getElementById(hintId);
            const preview = previewId ? document.getElementById(previewId) : null;

            area.addEventListener('click', () => input.click());

            input.addEventListener('change', () => {
                if (input.files.length) {
                    const file = input.files[0];
                    text.innerHTML = `<span style="color:var(--primary-bright)">${file.name}</span>`;
                    hint.innerHTML = '<i class="fa-solid fa-check" style="color:var(--primary)"></i> File terpilih';

                    if (preview && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            icon.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else if (preview) {
                        preview.style.display = 'none';
                        icon.style.display = 'flex';
                    }
                }
            });
        }

        setupUpload('areaCover',  'inputCover',  'iconCover',  'textCover',  'hintCover',  'previewCover');
        setupUpload('areaNaskah', 'inputNaskah', 'iconNaskah', 'textNaskah', 'hintNaskah');

        // Dynamic Add Author
        const authorsContainer = document.getElementById('authorsContainer');
        const addAuthorBtn     = document.getElementById('addAuthorBtn');
        let authorIndex = 1;

        addAuthorBtn.addEventListener('click', () => {
            const idx = authorIndex++;
            const html = `
                <div class="author-item fade-in" style="padding-top:24px;margin-top:24px;border-top:1px solid var(--border-light);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                        <h3 style="font-size:.875rem;color:var(--primary);font-weight:700;">Penulis Tambahan</h3>
                        <button type="button" class="btn-remove-author" onclick="this.closest('.author-item').remove()">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="penulis[${idx}][nama]" class="form-control" placeholder="Masukkan nama lengkap penulis..." required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="penulis[${idx}][email]" class="form-control" placeholder="Masukkan alamat email aktif..." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="flex:0 0 160px;">
                            <label>Urutan Penulis</label>
                            <select name="penulis[${idx}][urutan]" class="form-control">
                                <option value="1">Utama (1)</option>
                                <option value="2" selected>Kedua (2)</option>
                                <option value="3">Ketiga (3)</option>
                                <option value="4">Keempat (4)</option>
                                <option value="5">Kelima (5)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Biodata Singkat</label>
                            <textarea name="penulis[${idx}][biodata]" class="form-control" style="min-height:80px;" placeholder="Profil singkat penulis..."></textarea>
                        </div>
                    </div>
                </div>
            `;
            authorsContainer.insertAdjacentHTML('beforeend', html);
        });

        // Simpan Draf button feedback
        document.getElementById('btnDraft').addEventListener('click', function() {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyimpan...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersimpan!';
                btn.style.borderColor = 'var(--primary)';
                btn.style.color = 'var(--primary)';
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.disabled = false;
                    btn.style.borderColor = '';
                    btn.style.color = '';
                }, 2000);
            }, 1000);
        });
    </script>

</body>
</html>