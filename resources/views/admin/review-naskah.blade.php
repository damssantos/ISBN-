<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Review Naskah</title>
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
            --bg-card:        #12222d;
            --bg-card-hover:  #1b2e3c;
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
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:rgba(18, 34, 45, 0.8); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
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
        
        .user-avatar-circle { 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, var(--primary), var(--primary-dim)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            overflow: hidden; 
            border: 1px solid var(--border-color); 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .user-avatar-circle img { width: 100%; height: 100%; object-fit: cover; }

        /* Page Layout */
        .page-title { font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-top: 10px; margin-bottom: 24px; }

        /* Filter Pills Container */
        .filter-container {
            display: inline-flex;
            background: rgba(12, 26, 34, 0.6);
            border: 1px solid var(--border-color);
            padding: 4px;
            border-radius: 12px;
            gap: 4px;
            margin-bottom: 24px;
        }
        .filter-pill {
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-pill:hover {
            color: var(--text-primary);
        }
        .filter-pill.active {
            background: var(--primary);
            color: var(--bg-body);
            font-weight: 700;
        }

        /* Review Naskah Main Card Table */
        .table-card {
            background: rgba(18, 34, 45, 0.7);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            margin-bottom: 24px;
        }

        .table-container { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { 
            text-align: left; 
            padding: 12px 16px 20px; 
            font-size: .75rem; 
            color: var(--text-muted); 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.8px; 
            border-bottom: 1px solid var(--border-color); 
        }
        td { 
            padding: 20px 16px; 
            border-bottom: 1px solid rgba(46, 68, 89, 0.3); 
            vertical-align: middle; 
        }
        tr:last-child td { border-bottom: none; }
        
        .judul-wrapper { display: flex; flex-direction: column; gap: 4px; }
        .judul-naskah { font-weight: 700; font-size: .95rem; color: var(--text-primary); line-height: 1.45; }
        .naskah-id { font-size: 0.75rem; font-weight: 600; color: var(--primary); }
        
        .penulis-name { font-size: .875rem; color: var(--text-secondary); font-weight: 500; }
        
        /* Status Badges */
        .status-badge { 
            display: inline-flex; 
            align-items: center; 
            padding: 5px 14px; 
            border-radius: 24px; 
            font-size: .725rem; 
            font-weight: 700; 
            text-align: center;
        }
        .status-badge.disetujui { background: rgba(16, 185, 129, 0.1); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.2); }
        .status-badge.peninjauan { background: rgba(245, 158, 11, 0.1); color: #FBBF24; border: 1px solid rgba(245, 158, 11, 0.2); }
        .status-badge.ditolak { background: rgba(239, 68, 68, 0.1); color: #F87171; border: 1px solid rgba(239, 68, 68, 0.2); }
        
        .waktu-wrapper { display: flex; flex-direction: column; gap: 2px; }
        .waktu-text { font-size: .825rem; color: var(--text-primary); font-weight: 500; }
        .waktu-jam { font-size: .775rem; color: var(--text-muted); }

        /* Action Button */
        .btn-review { 
            background: var(--primary); 
            color: var(--bg-body); 
            border: none;
            border-radius: 20px;
            padding: 8px 22px;
            font-size: 0.825rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-review:hover { 
            background: var(--primary-bright); 
            transform: translateY(-2px); 
            box-shadow: 0 4px 12px var(--primary-glow); 
        }

        /* Pagination & Footer */
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            padding: 4px 16px;
        }
        .footer-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .pagination-container {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .page-btn:hover:not(.disabled):not(.active) {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
        }
        .page-btn.active {
            background: var(--primary);
            color: var(--bg-body);
            border-color: var(--primary);
            font-weight: 700;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon" style="font-size: 1.25rem; color: var(--primary);"></i>
                <div style="display: flex; flex-direction: column; overflow: hidden;">
                    <span class="brand-text">ISBN YPIK PAM JAYA</span>
                    <span class="brand-subtitle" style="font-size: 0.7rem; color: var(--text-muted); font-weight: 500; margin-top: -2px;">Admin Portal</span>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/review-naskah" class="nav-link active">
                    <i class="fa-solid fa-file-signature"></i>
                    <span class="nav-link-text">Review Naskah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/buku-terbit" class="nav-link">
                    <i class="fa-solid fa-book"></i>
                    <span class="nav-link-text">Buku Terbit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/pengguna" class="nav-link">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-link-text">Pengguna</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket" style="transform: rotate(180deg);"></i>
                <span>Logout</span>
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
                <input type="text" class="search-input" id="searchInput" placeholder="Cari naskah atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-avatar-circle">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&fit=crop&q=80" alt="Admin Avatar">
                </div>
            </div>
        </header>

        <h1 class="page-title">Review Naskah</h1>

        <!-- Filter Pills Container -->
        <div class="filter-container">
            <button class="filter-pill active" onclick="filterStatus('all', this)">Semua</button>
            <button class="filter-pill" onclick="filterStatus('disetujui', this)">Disetujui</button>
            <button class="filter-pill" onclick="filterStatus('peninjauan', this)">Peninjauan</button>
            <button class="filter-pill" onclick="filterStatus('ditolak', this)">Ditolak</button>
        </div>

        <!-- Main Card Table -->
        <div class="table-card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>JUDUL NASKAH</th>
                            <th>PENULIS</th>
                            <th>STATUS</th>
                            <th>WAKTU</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="naskahTableBody">
                        <!-- Row 1 -->
                        <tr data-status="disetujui">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Analisis Ekonomi Digital di Asia Tenggara 2024</span>
                                    <span class="naskah-id">ID: MS-8829</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Dr. Aris Setiawan</span>
                            </td>
                            <td>
                                <span class="status-badge disetujui">Disetujui</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">24 Okt 2023</span>
                                    <span class="waktu-jam">14:20</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr data-status="peninjauan">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Implementasi AI dalam Sistem Kesehatan Nasional</span>
                                    <span class="naskah-id">ID: MS-7741</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Siti Aminah, M.Kom</span>
                            </td>
                            <td>
                                <span class="status-badge peninjauan">Peninjauan</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">25 Okt 2023</span>
                                    <span class="waktu-jam">09:15</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr data-status="ditolak">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Sejarah Maritim Nusantara: Perspektif Baru</span>
                                    <span class="naskah-id">ID: MS-3356</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Prof. Bambang Hidayat</span>
                            </td>
                            <td>
                                <span class="status-badge ditolak">Ditolak</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">25 Okt 2023</span>
                                    <span class="waktu-jam">16:45</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr data-status="disetujui">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Teknik Budidaya Hidroponik Skala Industri</span>
                                    <span class="naskah-id">ID: MS-9120</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Ir. Hendra Wijaya</span>
                            </td>
                            <td>
                                <span class="status-badge disetujui">Disetujui</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">26 Okt 2023</span>
                                    <span class="waktu-jam">11:30</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr data-status="peninjauan">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Psikologi Pendidikan di Era Gen-Z</span>
                                    <span class="naskah-id">ID: MS-4482</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Rina Kartika, M.Psi</span>
                            </td>
                            <td>
                                <span class="status-badge peninjauan">Peninjauan</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">27 Okt 2023</span>
                                    <span class="waktu-jam">08:50</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr data-status="disetujui">
                            <td>
                                <div class="judul-wrapper">
                                    <span class="judul-naskah">Optimasi Jaringan 5G untuk Kota Cerdas</span>
                                    <span class="naskah-id">ID: MS-1593</span>
                                </div>
                            </td>
                            <td>
                                <span class="penulis-name">Andi Pratama, Ph.D</span>
                            </td>
                            <td>
                                <span class="status-badge disetujui">Disetujui</span>
                            </td>
                            <td>
                                <div class="waktu-wrapper">
                                    <span class="waktu-text">27 Okt 2023</span>
                                    <span class="waktu-jam">15:10</span>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/detail-review-naskah" class="btn-review">Review</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="table-footer">
                <span class="footer-text" id="footerText">Menampilkan 1–6 dari 48 naskah</span>
                <div class="pagination-container">
                    <button class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Sidebar collapse logic
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Filter status simulation logic
        function filterStatus(status, element) {
            // Remove active class from all pills
            const pills = document.querySelectorAll('.filter-pill');
            pills.forEach(pill => pill.classList.remove('active'));
            // Add active class to clicked pill
            element.classList.add('active');

            const rows = document.querySelectorAll('#naskahTableBody tr');
            let visibleCount = 0;
            let totalCount = rows.length;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update footer text based on visibility
            const footerText = document.getElementById('footerText');
            if (status === 'all') {
                footerText.textContent = `Menampilkan 1–${visibleCount} dari 48 naskah`;
            } else {
                footerText.textContent = `Menampilkan 1–${visibleCount} dari ${visibleCount} naskah (Filter: ${status.charAt(0).toUpperCase() + status.slice(1)})`;
            }
        }
    </script>
</body>
</html>
