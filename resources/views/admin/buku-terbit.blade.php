<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Registry - Buku Terbit</title>
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
            --sidebar-width:           250px;
            --sidebar-collapsed-width: 64px;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x:hidden; }
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width .3s; overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity .2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background .2s, color .2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }
        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all .2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity .2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59,195,189,.16), rgba(59,195,189,.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top:auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all .2s; cursor:pointer; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left .3s; }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:rgba(18,34,45,.8); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color .2s, box-shadow .2s; }
        .search-input::placeholder { color:var(--text-muted); }
        .search-input:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }
        .header-actions { display:flex; align-items:center; background:rgba(15,29,38,.7); border:1px solid var(--border-color); padding:4px 12px 4px 4px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,.2); gap:0; }
        .header-icon-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:12px; border:none; background:transparent; color:var(--text-secondary); cursor:pointer; transition:all .2s; position:relative; font-size:1.1rem; }
        .header-icon-btn:hover { background:rgba(255,255,255,.05); color:var(--primary-bright); }
        .header-divider { width:1px; height:24px; background:var(--border-color); margin:0 12px 0 8px; opacity:.6; }
        .notif-dot { position:absolute; top:10px; right:10px; width:6px; height:6px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        .user-avatar-circle { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--primary),var(--primary-dim)); display:flex; align-items:center; justify-content:center; overflow:hidden; border:1px solid var(--border-color); box-shadow:0 4px 10px rgba(0,0,0,.2); }
        .user-avatar-circle img { width:100%; height:100%; object-fit:cover; }
        .page-title { font-size:1.75rem; font-weight:700; color:var(--text-primary); margin-top:10px; margin-bottom:24px; }
        .filter-container { display:inline-flex; background:rgba(12,26,34,.6); border:1px solid var(--border-color); padding:4px; border-radius:12px; gap:4px; margin-bottom:24px; }
        .filter-pill { background:transparent; border:none; color:var(--text-muted); padding:8px 18px; border-radius:10px; font-size:.85rem; font-weight:600; cursor:pointer; transition:all .2s; }
        .filter-pill:hover { color:var(--text-primary); }
        .filter-pill.active { background:var(--primary); color:var(--bg-body); font-weight:700; }
        .sort-dropdown { position:relative; display:inline-block; }
        .sort-options { position:absolute; top:100%; left:0; background:var(--bg-card); border:1px solid var(--border-color); border-radius:10px; margin-top:4px; display:none; flex-direction:column; min-width:120px; z-index:10; }
        .sort-options button { width:100%; text-align:left; padding:8px 12px; border:none; background:none; color:var(--text-muted); font-size:.85rem; cursor:pointer; }
        .sort-options button:hover { background:var(--bg-card-hover); color:var(--text-primary); }
        .sort-options.show { display:flex; }
        .table-card { background:rgba(18,34,45,.7); border:1px solid var(--border-color); border-radius:20px; padding:24px; box-shadow:0 10px 30px rgba(0,0,0,.25); margin-bottom:24px; }
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:12px 16px 20px; font-size:.75rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:.8px; border-bottom:1px solid var(--border-color); }
        td { padding:20px 16px; border-bottom:1px solid rgba(46,68,89,.3); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        .status-badge { display:inline-flex; align-items:center; padding:5px 14px; border-radius:24px; font-size:.725rem; font-weight:700; text-align:center; }
        .status-badge.terbit { background:rgba(16,185,129,.1); color:#34D399; border:1px solid rgba(16,185,129,.2); }
        .action-btn { background:var(--primary); color:var(--bg-body); border:none; border-radius:20px; padding:8px 22px; font-size:.825rem; font-weight:700; cursor:pointer; transition:all .2s; text-decoration:none; display:inline-block; }
        .export-btn { background:var(--accent); color:var(--bg-body); border:none; border-radius:20px; padding:8px 22px; font-size:.825rem; font-weight:700; cursor:pointer; transition:all .2s; margin-left:auto; }
        .export-btn:hover { background:var(--accent); opacity:0.9; }
        .action-btn:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 4px 12px var(--primary-glow); }
        .table-footer { display:flex; align-items:center; justify-content:space-between; margin-top:24px; padding:4px 16px; }
        .footer-text { font-size:.85rem; color:var(--text-muted); font-weight:500; }
        .filter-export-container { display:flex; align-items:center; gap:12px; margin-bottom:24px; }
        .page-btn { width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border-color); background:transparent; color:var(--text-secondary); font-size:.85rem; font-weight:600; cursor:pointer; transition:all .2s; }
        .page-btn:hover:not(.disabled):not(.active) { border-color:var(--primary); color:var(--primary); background:var(--primary-glow); }
        .page-btn.active { background:var(--primary); color:var(--bg-body); border-color:var(--primary); font-weight:700; }
        .page-btn.disabled { opacity:.3; cursor:not-allowed; }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <div style="display:flex;flex-direction:column;overflow:hidden;">
                    <span class="brand-text">ISBN Registry</span>
                    <span class="brand-subtitle" style="font-size:0.7rem;color:var(--text-muted);font-weight:500;margin-top:-2px;">Admin Portal</span>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar"><i class="fa-solid fa-bars"></i></button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/admin/dashboard" class="nav-link"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/admin/review-naskah" class="nav-link"><i class="fa-solid fa-file-signature"></i><span class="nav-link-text">Review Naskah</span></a></li>
            <li class="nav-item"><a href="/admin/buku-terbit" class="nav-link active"><i class="fa-solid fa-book"></i><span class="nav-link-text">Buku Terbit</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-users"></i><span class="nav-link-text">Pengguna</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket" style="transform:rotate(180deg);"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>
    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari buku terbit atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi"><i class="fa-regular fa-bell"></i><span class="notif-dot"></span></button>
                <div class="header-divider"></div>
                <div class="user-avatar-circle"><img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&fit=crop&q=80" alt="Admin Avatar"></div>
            </div>
        </header>
            <h1 class="page-title">Buku Terbit</h1>
            <p class="subtitle-text">Daftar naskah yang telah disetujui dan mendapatkan ISBN secara resmi melalui sistem registrasi.</p>
            <div class="filter-export-container">
                <div class="filter-container">
                    <div class="sort-dropdown">
                        <button class="filter-pill" onclick="toggleSortOptions(this)">Urutkan ▼</button>
                        <div class="sort-options">
                            <button class="filter-pill" onclick="sortTable('newest')">Terbaru</button>
                            <button class="filter-pill" onclick="sortTable('oldest')">Terlama</button>
                        </div>
                    </div>
                </div>
                <button class="export-btn" onclick="exportData()">Ekspor Data</button>
            </div>
            <div class="table-card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>JUDUL NASKAH</th>
                            <th>NAMA PENULIS</th>
                            <th>WAKTU TERBIT</th>
                            <th>KODE ISBN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="bukuTableBody">
                        <!-- Example Rows -->
                        <tr data-status="terbit">
                            <td><div class="judul-wrapper"><span class="judul-naskah">Pemrograman Python untuk Pemula</span></div></td>
                            <td><span class="penulis-name">Rini Maulida</span></td>
                            <td><span class="waktu-text">12 Nov 2023</span></td>
                            <td><span class="isbn-code">978-602-12345-6-7</span></td>
                            <td><a href="/admin/buku-terbit/detail/1" class="action-btn">Detail</a></td>
                        </tr>
                        <tr data-status="draft">
                            <td><div class="judul-wrapper"><span class="judul-naskah">Belajar Laravel untuk Pemula</span></div></td>
                            <td><span class="penulis-name">Adi Santoso</span></td>
                            <td><span class="waktu-text">05 Oct 2022</span></td>
                            <td><span class="isbn-code">978-602-98765-4-3</span></td>
                            <td><a href="/admin/buku-terbit/detail/2" class="action-btn">Detail</a></td>
                        </tr>
                        <tr data-status="terbit">
                            <td><div class="judul-wrapper"><span class="judul-naskah">Advanced JavaScript Techniques</span></div></td>
                            <td><span class="penulis-name">Siti Nurhaliza</span></td>
                            <td><span class="waktu-text">20 Jan 2024</span></td>
                            <td><span class="isbn-code">978-602-54321-0-9</span></td>
                            <td><a href="/admin/buku-terbit/detail/3" class="action-btn">Detail</a></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                <span class="footer-text" id="footerTextBuku">Menampilkan 1–1 dari 1 buku</span>
                <div class="pagination-container">
                    <button class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
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
        function filterStatus(status, el) {
        // Existing filter functionality (kept for potential future use)
        // Note: filter pills are not displayed currently
        // This function remains unchanged
            const pills = document.querySelectorAll('.filter-pill');
            pills.forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            const rows = document.querySelectorAll('#bukuTableBody tr');
            let visible = 0;
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                    visible++;
                } else { row.style.display = 'none'; }
            });
            const footer = document.getElementById('footerTextBuku');
            if (status === 'all') footer.textContent = `Menampilkan 1–${visible} dari ${rows.length} buku`;
            else footer.textContent = `Menampilkan 1–${visible} dari ${visible} buku (Filter: ${status})`;
        }

        // Toggle visibility of sort options dropdown
        function toggleSortOptions(btn) {
            const dropdown = btn.parentElement;
            const options = dropdown.querySelector('.sort-options');
            options.classList.toggle('show');
        }

        // Sort table by publication date (Waktu Terbit) column
        function sortTable(order) {
            // Existing sorting logic
        }
        function exportData() {
            // Placeholder for export functionality. Implement CSV/Excel generation as needed.
            alert('Export data functionality is not implemented yet.');
        }
            const tbody = document.getElementById('bukuTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            rows.sort((a, b) => {
                const aText = a.cells[2].textContent.trim(); // Waktu Terbit column
                const bText = b.cells[2].textContent.trim();
                const aDate = new Date(aText);
                const bDate = new Date(bText);
                if (order === 'newest') {
                    return bDate - aDate; // descending
                } else {
                    return aDate - bDate; // ascending
                }
            });
            // Clear and re-append rows
            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
            // Hide sort options after selection
            const opts = document.querySelectorAll('.sort-options');
            opts.forEach(o => o.classList.remove('show'));
        }
    </script>
</body>
</html>
