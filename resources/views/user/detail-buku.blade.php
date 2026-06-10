<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Detail Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x: hidden; }

        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4, 0, .2, 1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity 0.2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar.collapsed .brand-subtitle { display:none; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background 0.2s, color 0.2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }

        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all 0.2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity 0.2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top: auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; cursor: pointer; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248, 113, 113, 0.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main Content */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Top Header */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
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
        
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:32px; height:32px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.9rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
        .user-header-info { display:flex; flex-direction:column; gap:0; text-align: left; }
        .user-header-name { font-weight:700; font-size:.875rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.7rem; color:var(--text-muted); line-height:1.2; font-weight: 500; }

        /* User Dropdown */
        .user-dropdown {
            position:absolute; top:calc(100% + 12px); right:0; width:220px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:12px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189,0.08); display:none; flex-direction:column; z-index:1000; overflow:hidden;
            transform-origin: top right; animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes dropdownFadeIn { from { opacity:0; transform:scale(0.95) translateY(-10px); } to { opacity:1; transform:scale(1) translateY(0); } }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:12px 16px; display:flex; align-items:center; gap:12px; color:var(--text-secondary); text-decoration:none; font-size:.85rem; font-weight:500; transition:all 0.2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:20px; }
        .user-dropdown-item i { width:18px; font-size:1rem; text-align:center; color:var(--text-muted); transition:color 0.2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:6px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248, 113, 113, 0.08); color:#f87171; }

        /* Custom Styles for Detail Buku page */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin-top: 24px;
            margin-bottom: 16px;
        }
        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 500;
        }
        .breadcrumb a:hover {
            color: var(--primary);
        }
        .breadcrumb i {
            font-size: 0.75rem;
        }
        .breadcrumb span.active {
            color: var(--primary);
            font-weight: 600;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 24px;
            transition: color 0.2s, transform 0.2s;
        }
        .back-link:hover {
            color: var(--primary);
            transform: translateX(-4px);
        }

        /* Detail Grid Layout */
        .detail-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
            align-items: start;
        }

        .cover-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .cover-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            display: flex;
            justify-content: center;
        }
        .cover-wrapper {
            aspect-ratio: 3/4;
            width: 100%;
            background: var(--bg-elevated);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }
        .cover-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .action-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .action-card h3 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 10px;
            margin-bottom: 4px;
        }
        .btn-action-outline {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-action-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
        }

        .info-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-top: 3px solid var(--primary-dim);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .info-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%);
            pointer-events: none;
        }

        .info-section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-section-title span {
            width: 4px;
            height: 20px;
            background: var(--primary);
            border-radius: 2px;
        }

        .metadata-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 28px;
        }
        .metadata-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .metadata-item.full-width {
            grid-column: 1 / -1;
        }
        .metadata-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .metadata-value {
            font-size: 0.95rem;
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .synopsis-value {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.6;
            font-weight: 400;
            text-align: justify;
        }

        .isbn-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(59, 195, 189, 0.12);
            border: 1px solid rgba(59, 195, 189, 0.25);
            color: var(--primary-bright);
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            width: fit-content;
        }
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
                <a href="/user/buku-terbit" class="nav-link active">
                    <i class="fa-solid fa-book"></i>
                    <span class="nav-link-text">Buku Terbit</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket" style="transform: rotate(180deg);"></i>
                <span>Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari buku, penulis, atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" id="notificationBtn" title="Notifikasi">
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
                        <a href="#" class="user-dropdown-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Breadcrumbs -->
        <div class="breadcrumb">
            <a href="#">Portal</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="/user/buku-terbit">Buku Terbit</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="active" id="breadcrumbTitle">{{ $buku->judul }}</span>
        </div>

        <!-- Back Button -->
        <a href="/user/buku-terbit" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Buku
        </a>

        <!-- Detail Layout -->
        <div class="detail-layout">
            <!-- Left Side Cover -->
            <div class="cover-section">
                <div class="cover-card">
                    <div class="cover-wrapper">
                        <img src="{{ $buku->cover_url }}" alt="Cover Buku" id="bookCover">
                    </div>
                </div>

                <div class="action-card">
                    <h3>Aksi Dokumen</h3>
                    <a href="{{ route('user.detail-buku.sertifikat', $buku) }}" class="btn-action-outline">
                        <i class="fa-solid fa-file-pdf"></i> Unduh Sertifikat ISBN
                    </a>
                    <a href="{{ route('user.detail-buku.cover', $buku) }}" class="btn-action-outline">
                        <i class="fa-solid fa-download"></i> Unduh Mockup Cover
                    </a>
                </div>
            </div>

            <!-- Right Side Info -->
            <div class="info-card">
                <div class="info-section-title">
                    <span></span> Detail Informasi Buku
                </div>

                <div class="metadata-grid">
                    <!-- Judul Buku -->
                    <div class="metadata-item full-width">
                        <div class="metadata-label">Judul Buku</div>
                        <div class="metadata-value" id="detailTitle" style="font-size: 1.4rem; color: #FFFFFF; font-weight: 800; line-height: 1.3;">{{ $buku->judul }}</div>
                    </div>

                    <!-- Kode ISBN -->
                    <div class="metadata-item">
                        <div class="metadata-label">Nomor ISBN Resmi</div>
                        <div class="isbn-badge">
                            <i class="fa-solid fa-barcode"></i>
                            <span id="detailIsbn">{{ $buku->isbn }}</span>
                        </div>
                    </div>

                    <!-- Tanggal Terbit -->
                    <div class="metadata-item">
                        <div class="metadata-label">Tanggal Terbit</div>
                        <div class="metadata-value" id="detailDate">{{ $buku->tanggal_terbit->locale('id')->translatedFormat('d M Y') }}</div>
                    </div>

                    <!-- Penulis Utama -->
                    <div class="metadata-item">
                        <div class="metadata-label">Penulis Utama</div>
                        <div class="metadata-value" id="detailAuthor">{{ $buku->penulis }}</div>
                    </div>

                    <!-- Kategori / Genre -->
                    <div class="metadata-item">
                        <div class="metadata-label">Kategori Buku</div>
                        <div class="metadata-value" id="detailCategory">{{ $buku->kategori }}</div>
                    </div>

                    <!-- Penerbit -->
                    <div class="metadata-item">
                        <div class="metadata-label">Penerbit</div>
                        <div class="metadata-value">{{ $buku->penerbit }}</div>
                    </div>

                    <!-- Halaman -->
                    <div class="metadata-item">
                        <div class="metadata-label">Jumlah Halaman</div>
                        <div class="metadata-value">{{ $buku->jumlah_halaman }} Halaman</div>
                    </div>

                    <!-- Sinopsis -->
                    <div class="metadata-item full-width" style="margin-top: 10px; border-top: 1px solid var(--border-light); padding-top: 20px;">
                        <div class="metadata-label" style="margin-bottom: 8px;">Sinopsis Buku</div>
                        <div class="synopsis-value" id="detailSynopsis">{{ $buku->sinopsis }}</div>
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

        document.getElementById('searchInput').addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                window.location.href = '/user/buku-terbit?q=' + encodeURIComponent(e.target.value);
            }
        });
        document.getElementById('notificationBtn').addEventListener('click', () => {
            alert('Belum ada notifikasi baru.');
        });
        // User dropdown toggle
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
    </script>
</body>
</html>
