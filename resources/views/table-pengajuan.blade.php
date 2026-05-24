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
            --status-review-bg:      rgba(59, 130, 246, 0.12);
            --status-review-text:    #60A5FA;
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
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; padding-top: 8px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; }
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

        /* Page Header */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; }
        .page-title { font-size:1.75rem; font-weight:700; color:var(--text-primary); letter-spacing:-0.5px; }
        .btn-back { display:flex; align-items:center; gap:8px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:color .2s; }
        .btn-back:hover { color:var(--primary); }

        /* Detail Card */
        .detail-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:14px; padding:32px; box-shadow:0 4px 20px rgba(0,0,0,.2); position:relative; overflow:hidden; transition:transform .25s, box-shadow .25s; }
        .detail-card::after { content:''; position:absolute; inset:0; border-radius:14px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .detail-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(59, 195, 189,0.1); }

        /* Status Bar */
        .status-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; position:relative; z-index:1; }
        .status-left { display:flex; align-items:center; gap:12px; }
        .status-label { font-size:.875rem; font-weight:600; color:var(--text-secondary); }
        .status-badge { display:inline-flex; align-items:center; gap:5px; padding:6px 14px; border-radius:20px; font-size:.8125rem; font-weight:600; }
        .status-review { background:var(--status-review-bg); color:var(--status-review-text); }
        .manuscript-id { font-size:.875rem; color:var(--text-muted); font-weight:500; }

        /* Detail Section */
        .detail-section { padding:24px 0; border-top:1px solid var(--border-color); position:relative; z-index:1; }
        .detail-section:first-of-type { border-top:none; padding-top:0; }
        .detail-label { font-size:.75rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px; }
        .detail-value { font-size:.9rem; color:var(--text-primary); line-height:1.7; }
        .detail-value p { margin:0; }

        /* Authors */
        .author-list { list-style:none; padding:0; }
        .author-list li { font-size:.9rem; color:var(--text-primary); padding:2px 0; }

        /* File Row */
        .file-row { display:grid; grid-template-columns:1fr 1fr; gap:24px; padding:24px 0; border-top:1px solid var(--border-color); position:relative; z-index:1; }
        .file-group { display:flex; flex-direction:column; gap:6px; }
        .file-label { font-size:.75rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px; }
        .file-item { display:flex; align-items:center; justify-content:space-between; }
        .file-name { font-size:.875rem; color:var(--text-primary); }
        .file-link { display:inline-flex; align-items:center; gap:6px; color:var(--primary); text-decoration:none; font-size:.8125rem; font-weight:600; transition:color .2s; }
        .file-link:hover { color:var(--primary-bright); }
        .file-link i { font-size:.75rem; }

        /* Full-width file row */
        .file-row-full { padding:24px 0; border-top:1px solid var(--border-color); position:relative; z-index:1; }
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
        <header class="top-header">
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
            <h1 class="page-title">Detail Naskah</h1>
            <a href="/daftar-pengajuan" class="btn-back" style="text-decoration: none; font-size: 13px; color: var(--text-muted); display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Naskah
            </a>
        </div>

        <div class="detail-card">
            <!-- Status -->
            <div class="status-bar">
                <div class="status-left">
                    <span class="status-label">Status :</span>
                    <span class="status-badge status-review">Dalam Peninjauan</span>
                </div>
                <span class="manuscript-id">ID: MSN-2024-0892</span>
            </div>

            <!-- Judul Buku -->
            <div class="detail-section">
                <div class="detail-label">Judul Buku</div>
                <div class="detail-value">Membangun Masa Depan: Panduan Lengkap Arsitektur Berkelanjutan di Era Digital</div>
            </div>

            <!-- Sub Judul -->
            <div class="detail-section">
                <div class="detail-label">Sub Judul Buku</div>
                <div class="detail-value">Implementasi Teknologi Hijau dan Efisiensi Energi untuk Hunian Modern</div>
            </div>

            <!-- Sinopsis -->
            <div class="detail-section">
                <div class="detail-label">Sinopsis</div>
                <div class="detail-value">
                    <p>Buku ini mengeksplorasi pergeseran paradigma dalam dunia arsitektur yang kini lebih menitikberatkan pada keberlanjutan lingkungan. Penulis menjabarkan bagaimana integrasi teknologi cerdas dapat mengurangi jejak karbon bangunan tanpa mengorbankan estetika dan kenyamanan.</p>
                </div>
            </div>

            <!-- Nama Penulis -->
            <div class="detail-section">
                <div class="detail-label">Nama Penulis</div>
                <div class="detail-value">
                    <ol class="author-list" style="padding-left:18px;">
                        <li>Dr. Ahmad Subarjo, M.Arch.</li>
                        <li>Ir. Maya Sartika</li>
                    </ol>
                </div>
            </div>

            <!-- File Naskah & Foto -->
            <div class="file-row">
                <div class="file-group">
                    <div class="file-label">File Naskah</div>
                    <div class="file-item">
                        <span class="file-name">Manuscript_Final_V2.pdf</span>
                        <a href="#" class="file-link">Lihat File <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </div>
                </div>
                <div class="file-group">
                    <div class="file-label">File Foto (Halaman Cover Belakang)</div>
                    <div class="file-item">
                        <span class="file-name">Cover_Belakang.jpg</span>
                        <a href="#" class="file-link">Lihat File <i class="fa-regular fa-eye"></i></a>
                    </div>
                </div>
            </div>

            <!-- Dokumen Lainnya -->
            <div class="file-row-full">
                <div class="file-group">
                    <div class="file-label">Dokumen Lainnya</div>
                    <div class="file-item">
                        <span class="file-name">Pernyataan_Keaslian_Naskah.pdf</span>
                        <a href="#" class="file-link">Lihat File <i class="fa-solid fa-download"></i></a>
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
    </script>
</body>
</html>
