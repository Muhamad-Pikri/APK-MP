<?php
include 'koneksi.php';

// Query mengambil data untuk riwayat
$query = "SELECT id, benar, salah, skor, rata, durasi, tanggal FROM hasil ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Hasil - MP Session</title>
    <style>
        :root {
            --primary-color: #10b981;
            --danger-color: #ef4444;
            --accent-blue: #0ea5e9;
            --glass-bg: rgba(15, 23, 42, 0.8);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: #0f172a !important;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            color: #f8fafc;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* BACKGROUND FIXED (Sama seperti Home/Game) */
        body::after {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('j.jpg') no-repeat center center fixed; 
            background-size: cover;
            z-index: -2;
        }

        /* OVERLAY GELAP */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.85); 
            z-index: -1;
        }

        .page { width: 100%; max-width: 1000px; z-index: 1; }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: var(--glass-bg);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
        }

        h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px; }

        .btn-group { display: flex; gap: 10px; }

        a, button { 
            text-decoration: none; 
            padding: 10px 20px; 
            border-radius: 12px; 
            font-size: 14px; 
            font-weight: 700; 
            transition: all 0.2s ease; 
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-home { background: var(--accent-blue); color: white; }
        .btn-home:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4); }

        .btn-clear { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .btn-clear:hover { background: var(--danger-color); color: white; transform: translateY(-2px); }

        /* TABLE CARD CUSTOM */
        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 10px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .table-container { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        
        th { 
            text-align: left; 
            color: var(--primary-color); 
            padding: 20px 15px; 
            font-size: 12px; 
            text-transform: uppercase; 
            letter-spacing: 1.5px;
            background: rgba(255,255,255,0.03);
        }

        td { padding: 18px 15px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: rgba(255,255,255,0.03); }

        .skor-badge {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-color);
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 800;
        }

        .btn-delete { 
            background: rgba(239, 68, 68, 0.1);
            color: #f87171; 
            width: 35px; height: 35px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
        }
        .btn-delete:hover { background: var(--danger-color); color: white; }

        .empty { text-align: center; padding: 100px 20px; opacity: 0.5; }
        
        input[type="checkbox"] {
            accent-color: var(--primary-color);
            width: 18px; height: 18px;
            cursor: pointer;
        }

        /* Responsive Scrollbar */
        .card::-webkit-scrollbar { height: 8px; }
        .card::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
    
    <script>
        function toggleAll(source) {
            checkboxes = document.getElementsByName('id_hapus[]');
            for(var i=0, n=checkboxes.length; i<n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>RIWAYAT HASIL</h1>
            <div class="btn-group">
                <a href="home.php" class="btn-home">🏠 Home</a>
                
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <button type="submit" form="formHapus" class="btn-clear" onclick="return confirm('Hapus data terpilih?')">🗑 Terpilih</button>
                    <a href="hapus.php?aksi=semua" class="btn-clear" onclick="return confirm('Hapus semua riwayat permanen?')">🔥 Semua</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <div class="table-container">
                    <form id="formHapus" action="hapus.php" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center;"><input type="checkbox" onClick="toggleAll(this)"></th>
                                    <th>Benar</th>
                                    <th>Salah</th>
                                    <th>Skor</th>
                                    <th>Rata-rata</th>
                                    <th>Durasi</th>
                                    <th>Tanggal</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td style="text-align: center;"><input type="checkbox" name="id_hapus[]" value="<?php echo $row['id']; ?>"></td>
                                        <td style="color: var(--primary-color); font-weight: 700;"><?php echo htmlspecialchars($row['benar']); ?></td>
                                        <td style="color: var(--danger-color); font-weight: 700;"><?php echo htmlspecialchars($row['salah']); ?></td>
                                        <td><span class="skor-badge"><?php echo htmlspecialchars($row['skor']); ?></span></td>
                                        <td><b><?php echo htmlspecialchars(number_format((float)$row['rata'], 2)); ?></b> <small style="opacity: 0.5;">/s</small></td>
                                        <td><?php echo htmlspecialchars($row['durasi']); ?>s</td>
                                        <td style="font-size: 12px; opacity: 0.6;"><?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?></td>
                                        <td style="display: flex; justify-content: center;">
                                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus data ini?')">✖</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            <?php else: ?>
                <div class="empty">
                    <div style="font-size: 50px; margin-bottom: 10px;">📊</div>
                    <p>Belum ada riwayat permainan.<br>Mainkan satu ronde untuk melihat statistikmu!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>