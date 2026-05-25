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
            --bg-body:        #0f1d26;
            --bg-sidebar:     #0c1a22;
            --bg-card:        #1B2B38;
            --bg-input:       #111f2a;
            --border-color:   #2e4459;
            --border-light:   #1e3040;
            --text-primary:   #F0F6FA;
            --text-secondary: #B8CDD8;
            --text-muted:     #7A9BAA;
            --sidebar-width: 280px;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; }

        /* Sidebar Style */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; z-index:100; }
        .brand { padding:18px 14px; display:flex; align-items:center; gap:10px; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); }
        .nav-menu { list-style:none; padding:12px 8px; flex:1; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; }

        /* Main Content Luas Maksimal Ke Samping (Anti Sesak) */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:40px; width: calc(100% - var(--sidebar-width)) !important; max-width: 100% !important; }
        .top-header { display:flex; justify-content:flex-end; padding-bottom:24px; }

        /* JURUS GRID UTAMA 2 KOLOM SEJAJAR */
        .grid-container { display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; max-width: 1200px; margin: 0 auto; width: 100%; }
        .card { background:var(--bg-card); border:1px solid var(--border-color); border-top:2px solid var(--primary-dim); border-radius:20px; padding:28px; box-shadow:0 4px 20px rgba(0,0,0,0.2); }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 8px; font-weight: 500; }
        .form-control { width: 100%; padding: 12px 14px; background: var(--bg-input); border: 1px solid var(--border-color); border-radius: 10px; color: var(--text-primary); outline: none; font-size: 0.9rem; transition: border-color 0.2s; }
        .form-control:focus { border-color: var(--primary); }
        
        .btn-submit { width: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dim)); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 0.95rem; margin-top: 10px; transition: all 0.2s; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(59, 195, 189, 0.3); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-book-bookmark" style="color:var(--primary); font-size:1.2rem;"></i>
            <span class="brand-text">ISBN YPIK PAM JAYA</span>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="nav-link"><i class="fa-solid fa-border-all"></i>Dashboard</a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link active"><i class="fa-regular fa-file-lines"></i>Pengajuan</a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i>Daftar Naskah</a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i>Draf Naskah</a></li>
        </ul>
        <div class="sidebar-footer"><a href="#" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i>Keluar</a></div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div style="color:var(--text-secondary)">Kontributor / <b>Pradama</b></div>
        </header>

        <form action="{{ route('naskah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid-container">
                
                <div class="card">
                    <h2 style="font-size:1.1rem; margin-bottom:20px; color:var(--primary); font-weight:700;"><i class="fa-solid fa-file-invoice"></i> Informasi Naskah</h2>
                    
                    <div class="form-group">
                        <label>Judul Naskah</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul naskah..." required>
                    </div>

                    <div class="form-group">
                        <label>Sub Judul Naskah (Opsional)</label>
                        <input type="text" name="sub_judul" class="form-control" placeholder="Masukkan sub judul naskah...">
                    </div>

                    <div class="form-group">
                        <label>Sinopsis Naskah</label>
                        <textarea name="sinopsis" class="form-control" placeholder="Tuliskan sinopsis singkat mengenai naskah Anda..." rows="7" style="height:auto; resize:vertical;"></textarea>
                    </div>
                </div>

                <div style="display:flex; flex-direction:column; gap:24px;">
                    
                    <div class="card">
                        <h2 style="font-size:1.1rem; margin-bottom:20px; color:var(--primary); font-weight:700;"><i class="fa-solid fa-image"></i> Unggah Foto Sampul</h2>
                        <div style="border: 2px dashed var(--border-color); border-radius: 12px; padding: 35px 20px; text-align: center; background: var(--bg-input);">
                            <i class="fa-regular fa-images" style="font-size: 2.2rem; color: var(--text-muted); margin-bottom:12px; display:block;"></i>
                            <span style="color: var(--text-secondary); display:block; margin-bottom:8px; font-weight:500;">Pilih File Gambar Sampul</span>
                            <input type="file" name="foto_sampul" accept="image/*" style="font-size:0.85rem; color:var(--text-muted);">
                        </div>
                    </div>

                    <div class="card" style="border-top-color: var(--primary);">
                        <h2 style="font-size:1rem; margin-bottom:12px; color:var(--text-primary); font-weight:600;"><i class="fa-solid fa-paper-plane"></i> Finalisasi</h2>
                        <p style="font-size:0.8rem; color:var(--text-muted); margin-bottom:16px; line-height:1.4;">
                            Pastikan judul dan berkas sampul naskah telah diisi dengan benar sebelum mengirimkan data ke sistem database.
                        </p>
                        <button type="submit" class="btn-submit">Kirim Pengajuan Naskah</button>
                    </div>

                </div>

            </div>
        </form>
    </main>

</body>
</html>