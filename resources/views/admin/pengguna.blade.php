<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Daftar Pengguna</title>
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

        /* Custom Styles for Pengguna page */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            margin-bottom: 28px;
        }
        .page-header h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        .page-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
            max-width: 600px;
            line-height: 1.5;
        }

        .stats-card-main {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--primary);
            border-radius: 12px;
            padding: 16px 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            min-width: 240px;
        }
        .stats-label {
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .stats-val-wrapper {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .stats-value {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text-primary);
        }
        .stats-subtext {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .table-card { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-top: 2px solid var(--primary-dim); 
            border-radius: 16px; 
            padding: 24px; 
            box-shadow: 0 4px 20px rgba(0,0,0,.2); 
            position: relative; 
            overflow: hidden; 
            transition: transform .25s, box-shadow .25s; 
        }
        .table-card::after { 
            content: ''; 
            position: absolute; 
            inset: 0; 
            border-radius: 16px; 
            background: linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%); 
            pointer-events: none; 
        }
        .table-card:hover { 
            transform: translateY(-4px); 
            border-top-color: var(--primary); 
            box-shadow: 0 12px 32px rgba(0,0,0,.3), 0 0 0 1px rgba(59, 195, 189, 0.1); 
        }

        /* Table */
        .table-container { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { 
            padding: 16px 24px; 
            font-size: .75rem; 
            color: var(--text-muted); 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            border-bottom: 1px solid var(--border-color); 
        }
        td { 
            padding: 18px 24px; 
            border-bottom: 1px solid var(--border-light); 
            vertical-align: middle; 
            font-size: .875rem; 
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.01); }

        .user-name {
            font-weight: 700;
            color: var(--text-primary);
        }
        .user-email, .user-phone {
            color: var(--text-secondary);
            font-weight: 500;
        }

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
            gap: 16px;
        }
        .page-arrow {
            background: transparent;
            border: none;
            color: var(--primary);
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .page-arrow:hover:not(.disabled) {
            color: var(--primary-bright);
            transform: scale(1.2);
        }
        .page-arrow.disabled {
            color: var(--text-muted);
            opacity: 0.3;
            cursor: not-allowed;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--text-muted);
            display: none;
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
                <a href="/admin/review-naskah" class="nav-link">
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
                <a href="/admin/pengguna" class="nav-link active">
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

        <!-- Header Section -->
        <div class="page-header">
            <div>
                <h1>Daftar Pengguna</h1>
                <p>Manajemen akses dan identitas pengguna sistem.</p>
            </div>
            <div class="stats-card-main">
                <span class="stats-label">Statistik Utama</span>
                <div class="stats-val-wrapper">
                    <span class="stats-value">1,284</span>
                    <span class="stats-subtext">Total Pengguna</span>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-container">
                <table id="userTable">
                    <thead>
                        <tr>
                            <th style="width: 35%;">Nama Pengguna</th>
                            <th style="width: 35%;">Email</th>
                            <th style="width: 30%;">Nomor. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><div class="user-name">Ahmad Hidayat</div></td>
                            <td><div class="user-email">ahmad.h@example.com</div></td>
                            <td><div class="user-phone">0812–3456–7890</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Budi Santoso</div></td>
                            <td><div class="user-email">budi.s@example.com</div></td>
                            <td><div class="user-phone">0812–4567–8901</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Citra Lestari</div></td>
                            <td><div class="user-email">citra.l@example.com</div></td>
                            <td><div class="user-phone">0813–5678–9012</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Dian Pratama</div></td>
                            <td><div class="user-email">dian.p@example.com</div></td>
                            <td><div class="user-phone">0815–6789–0123</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Eko Wahyudi</div></td>
                            <td><div class="user-email">eko.w@example.com</div></td>
                            <td><div class="user-phone">0856–7890–1234</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Fanny Kurniawan</div></td>
                            <td><div class="user-email">fanny.k@example.com</div></td>
                            <td><div class="user-phone">0817–8901–2345</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Gita Permata</div></td>
                            <td><div class="user-email">gita.p@example.com</div></td>
                            <td><div class="user-phone">0819–9012–3456</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Hendra Wijaya</div></td>
                            <td><div class="user-email">hendra.w@example.com</div></td>
                            <td><div class="user-phone">0812–0123–4567</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Indra Kusuma</div></td>
                            <td><div class="user-email">indra.k@example.com</div></td>
                            <td><div class="user-phone">0813–1234–5678</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Joko Susilo</div></td>
                            <td><div class="user-email">joko.s@example.com</div></td>
                            <td><div class="user-phone">0815–2345–6789</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Kartika Sari</div></td>
                            <td><div class="user-email">kartika.s@example.com</div></td>
                            <td><div class="user-phone">0856–3456–7890</div></td>
                        </tr>
                        <tr>
                            <td><div class="user-name">Luluk Amelia</div></td>
                            <td><div class="user-email">luluk.a@example.com</div></td>
                            <td><div class="user-phone">0817–4567–8901</div></td>
                        </tr>
                    </tbody>
                </table>
                <div id="emptyState" class="empty-state">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 2rem; margin-bottom: 12px; display: block;"></i>
                    Pengguna tidak ditemukan.
                </div>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="table-footer">
                <span class="footer-text">Menampilkan 1–12 dari 1,284</span>
                <div class="pagination-container">
                    <button class="page-arrow disabled" title="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-arrow" title="Berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
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

        // Search Filter
        const searchInput = document.getElementById('searchInput');
        const userTable = document.getElementById('userTable');
        const emptyState = document.getElementById('emptyState');
        const rows = userTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            let hasResults = false;

            for (let i = 0; i < rows.length; i++) {
                const name = rows[i].querySelector('.user-name').textContent.toLowerCase();
                const email = rows[i].querySelector('.user-email').textContent.toLowerCase();
                const phone = rows[i].querySelector('.user-phone').textContent.toLowerCase();

                if (name.includes(query) || email.includes(query) || phone.includes(query)) {
                    rows[i].style.display = '';
                    hasResults = true;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            userTable.style.display = hasResults ? '' : 'none';
            emptyState.style.display = hasResults ? 'none' : 'block';
        });
    </script>
</body>
</html>
