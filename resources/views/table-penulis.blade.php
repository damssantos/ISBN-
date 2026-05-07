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
        
        /* Search Results */
        .search-results { position:absolute; top:calc(100% + 8px); left:0; width:100%; background:var(--bg-card); border:1px solid var(--border-color); border-radius:12px; box-shadow:0 15px 40px rgba(0,0,0,0.4); display:none; flex-direction:column; z-index:1000; overflow:hidden; }
        .search-results.show { display:flex; }
        .search-result-category { padding:12px 16px 6px; font-size:.65rem; font-weight:700; text-transform:uppercase; color:var(--text-muted); letter-spacing:1px; }
        .search-result-item { padding:10px 16px; display:flex; align-items:center; gap:12px; color:var(--text-secondary); text-decoration:none; transition:all .2s; font-size:.8125rem; }
        .search-result-item:hover { background:var(--bg-card-hover); color:var(--primary); }
        .search-result-item i { width:16px; text-align:center; color:var(--text-muted); }
        .header-actions { display:flex; align-items:center; gap:8px; }
        .header-icon-btn { width:40px; height:40px; display:flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-secondary); cursor:pointer; transition:all .2s; position:relative; }
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
        .btn-add { background:var(--primary); color:#ffffff; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:700; font-size:.875rem; display:flex; align-items:center; gap:8px; transition:all .2s; border:none; cursor:pointer; box-shadow:0 4px 15px rgba(52,211,153,0.2); }
        .btn-add:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 6px 20px rgba(52,211,153,0.3); }

        /* Table Card */
        .table-card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.2); position:relative; transition:transform .25s,box-shadow .25s; }
        .table-card::after { content:''; position:absolute; inset:0; border-radius:16px; background:linear-gradient(145deg,rgba(52,211,153,0.03),transparent 60%); pointer-events:none; }
        .table-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 40px rgba(0,0,0,0.3), 0 0 0 1px rgba(52,211,153,0.1); }
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
        .badge-active { background:rgba(52,211,153,0.1); color:var(--primary); }
        
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari penulis atau data lainnya...">
                <div class="search-results" id="searchResults">
                    <div class="search-result-category">Hasil Terkait</div>
                    <a href="#" class="search-result-item">
                        <i class="fa-regular fa-user"></i>
                        <span>Dr. Pradama Wijaya, M.Kom</span>
                    </a>
                    <a href="#" class="search-result-item">
                        <i class="fa-regular fa-user"></i>
                        <span>Siti Sarah, M.Pd</span>
                    </a>
                </div>
            </div>
            <div class="header-actions">
                <button class="header-icon-btn"><i class="fa-regular fa-bell"></i><span class="notif-dot"></span></button>
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
                <table>
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
                                <div style="font-size:.8125rem;">
                                    <i class="fa-regular fa-envelope" style="width:16px;"></i> pradama.w@univ.ac.id<br>
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
                                    <div class="author-avatar" style="background:rgba(52,211,153,0.05);">SS</div>
                                    <div>
                                        <div class="author-name">Siti Sarah, M.Pd</div>
                                        <div class="author-meta">ID: AUTH-002</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size:.8125rem;">
                                    <i class="fa-regular fa-envelope" style="width:16px;"></i> siti.sarah@gmail.com<br>
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

        // Search Interactivity
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        if (searchInput && searchResults) {
            searchInput.addEventListener('focus', () => { if(searchInput.value.length > 0) searchResults.classList.add('show'); });
            searchInput.addEventListener('input', () => {
                if(searchInput.value.length > 0) searchResults.classList.add('show');
                else searchResults.classList.remove('show');
            });
            document.addEventListener('click', (e) => {
                if(!searchInput.contains(e.target) && !searchResults.contains(e.target)) searchResults.classList.remove('show');
            });
        }

        // Action Functions
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

        function editAuthor() {
            window.location.href = '/informasi';
        }

        function deleteRow(btn) {
            if (confirm('Apakah Anda yakin ingin menghapus data penulis ini?')) {
                const row = btn.closest('tr');
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
                row.style.transition = 'all .3s ease';
                setTimeout(() => {
                    row.remove();
                    alert('Data penulis berhasil dihapus.');
                }, 300);
            }
        }
    </script>
</body>
</html>
