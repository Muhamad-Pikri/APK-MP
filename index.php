<?php
$nama = $_GET['nama'] ?? "User";
$waktu = $_GET['waktu'] ?? 60;
$tipe = $_GET['tipe'] ?? "kraepelin";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP Test - Pro Session</title>
    <style>
        /* CSS RESET & VARS */
        :root {
            --primary-color: #10b981;
            --danger-color: #ef4444;
            --glass-border: rgba(255, 255, 255, 0.15);
        }

        body {
            background-color: #0f172a !important; /* Dasar solid */
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            user-select: none;
            touch-action: manipulation;
            color: #f8fafc;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* BACKGROUND GAMBAR (DIKUNCI) */
        body::after {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('j.jpg') no-repeat center center fixed; 
            background-size: cover;
            z-index: -2;
        }

        /* OVERLAY TETAP GELAP */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.85); 
            z-index: -1;
        }

        .top-nav {
            width: 100%;
            max-width: 450px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            box-sizing: border-box;
            z-index: 10;
        }

        .close-btn {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 8px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        .stats-badge {
            background: rgba(15, 23, 42, 0.8);
            padding: 8px 15px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            font-size: 14px;
        }

        #timer {
            font-weight: 800;
            color: #fbbf24;
            font-size: 24px;
        }

        .game-container {
            width: 100%;
            max-width: 400px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .question-card {
            background: rgba(15, 23, 42, 0.92); 
            border: 3px solid var(--primary-color);
            border-radius: 25px;
            padding: 30px;
            text-align: center;
            margin-bottom: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        .number-display { font-size: 90px; font-weight: 900; line-height: 0.9; color: #fff; }
        .operator { height: 6px; background: var(--primary-color); width: 120px; margin: 15px auto; border-radius: 10px; }

        .keypad { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; width: 100%; }

        .btn {
            aspect-ratio: 1 / 0.85;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            font-size: 32px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.1s;
        }

        /* FEEDBACK WARNA PADA TOMBOL */
        .btn.correct-press { background-color: #10b981 !important; border-color: #059669 !important; transform: scale(0.9); }
        .btn.wrong-press { background-color: #ef4444 !important; border-color: #b91c1c !important; transform: scale(0.9); }

        /* MODAL HASIL (SOLID CLEAN) */
        .modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.9);
            z-index: 100;
            backdrop-filter: blur(10px);
            padding: 20px;
        }
        .modal.open { display: flex; }

        .modal-content {
            background: #1e293b; 
            width: 100%;
            max-width: 400px;
            height: 85vh;
            border-radius: 24px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        #review-container {
            flex-grow: 1;
            overflow-y: auto;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            padding: 10px;
            margin: 15px 0;
        }

        .btn-main { 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%); 
            color: white; padding: 18px; border-radius: 16px; 
            font-weight: 700; border: none; cursor: pointer;
            text-transform: uppercase;
        }
        .btn-home { background: #0ea5e9; color: white; padding: 14px; border-radius: 16px; border: none; font-weight: 700; }
        .btn-history { background: rgba(255,255,255,0.1); color: white; padding: 14px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2); font-weight: 700; }

    </style>
</head>
<body>

<div id="namaUser" style="display:none;"><?php echo htmlspecialchars($nama); ?></div>
<div id="tipeLaihan" style="display:none;"><?php echo htmlspecialchars($tipe); ?></div>

<div class="top-nav">
    <div class="close-btn" onclick="keluar()">✖ KELUAR</div>
    <div style="display: flex; gap: 10px;">
        <div class="stats-badge">B: <b id="score" style="color: #10b981;">0</b></div>
        <div class="stats-badge">S: <b id="salah-counter" style="color: #ef4444;">0</b></div>
    </div>
    <div id="timer"><?php echo (int)$waktu; ?></div>
</div>

<div class="game-container">
    <div class="question-card">
        <div class="number-display">
            <div id="angka1">0</div>
            <div class="operator"></div>
            <div id="angka2">0</div>
        </div>
    </div>

    <div class="keypad" id="keypad">
        <?php for($i=1; $i<=9; $i++): ?>
            <div class="btn" onclick="jawab(<?php echo $i; ?>, this)"><?php echo $i; ?></div>
        <?php endfor; ?>
        <div class="btn" style="opacity: 0; pointer-events: none;"></div> 
        <div class="btn" onclick="jawab(0, this)">0</div>
    </div>

    <p id="game-hint" style="text-align: center; margin-top: 20px; opacity: 0.7; font-size: 14px;">
        <?php 
            if($tipe == "kraepelin") echo "Jumlahkan & ketik digit terakhir";
            else if($tipe == "pengurangan") echo "Kurangi angka atas dengan bawah";
            else if($tipe == "perkalian") echo "Kalikan kedua angka";
            else if($tipe == "pembagian") echo "Bagi angka atas dengan bawah";
        ?>
    </p>
</div>

<div id="resultModal" class="modal">
    <div class="modal-content">
        <h2 style="text-align: center; margin-bottom: 20px; font-weight: 800;">HASIL TES</h2>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            <div style="background: rgba(16, 185, 129, 0.1); padding: 15px; border-radius: 18px; text-align: center;">
                <small style="display: block; opacity: 0.6; font-size: 11px;">BENAR</small>
                <b id="resultBenar" style="color: #10b981; font-size: 1.8rem;">0</b>
            </div>
            <div style="background: rgba(239, 68, 68, 0.1); padding: 15px; border-radius: 18px; text-align: center;">
                <small style="display: block; opacity: 0.6; font-size: 11px;">SALAH</small>
                <b id="resultSalah" style="color: #ef4444; font-size: 1.8rem;">0</b>
            </div>
        </div>

        <div style="text-align: center; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 18px;">
            <small style="opacity: 0.5; font-size: 11px;">RATA-RATA PER DETIK</small><br>
            <strong id="resultAverage" style="color: #10b981; font-size: 26px;">0.00</strong>
        </div>

        <div id="review-container"></div>

        <div style="display: flex; flex-direction: column; gap: 10px; margin-top: auto;">
            <button onclick="location.reload()" class="btn-main">Main Lagi</button>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <button onclick="window.location.href='history.php'" class="btn-history">Riwayat</button>
                <button onclick="window.location.href='home.php'" class="btn-home">Home</button>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<script>
    function keluar() {
        if(confirm("Berhenti sekarang? Progress tidak disimpan.")) window.location.href = "home.php";
    }
    
    // Pastikan fungsi jawab lu di script.js pake class 'correct-press' atau 'wrong-press'
</script>

</body>
</html>