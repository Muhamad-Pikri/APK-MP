<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP</title>
   <style>
    :root {
        --primary-color: #10b981;
        --primary-hover: #059669;
        --bg-overlay: linear-gradient(rgba(2, 6, 23, 0.7), rgba(15, 23, 42, 0.7)); 
        --glass-bg: rgba(255, 255, 255, 0.03);
        --glass-border: rgba(255, 255, 255, 0.15);
    }

    body {
        background: var(--bg-overlay), 
                    url('j.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        color: #f8fafc;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

   .container {
        width: 100%;
        max-width: 370px;
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .subtitle {
        margin-top: -8px;
        margin-bottom: 50px;
        font-size: 0.95rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 5px;
        color: #ffffff;
        text-shadow: 
            2px 2px 0px #000, 
            -1px -1px 0px #000, 
            0px 4px 10px rgba(0,0,0,0.9);
        opacity: 1;
    }

    h1 {
        font-size: 3.6rem;
        font-weight: 800;
        letter-spacing: -2px;
        margin-bottom: 5px;
        background: linear-gradient(to right, #34d399, #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 4px 15px rgba(0,0,0,0.8));
    }

    .card {
        width: 100%;
        background: var(--glass-bg);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        padding: 40px 30px;
        border-radius: 30px;
        border: 1px solid var(--glass-border);
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.7);
    }

    .form-group {
        text-align: left;
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        margin-left: 5px;
        color: #10b981;
        letter-spacing: 1px;
    }

    input, select {
        width: 100%;
        padding: 14px 16px;
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid var(--glass-border);
        border-radius: 14px;
        font-size: 15px;
        font-weight: 500;
        color: #ffffff;
        box-sizing: border-box;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    select option {
        background-color: #0f172a;
        color: #ffffff;
    }

    input:focus, select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
    }

    button {
        width: 100%;
        padding: 16px;
        background: var(--primary-color);
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 800;
        color: #064e3b;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    button:hover {
        background: var(--primary-hover);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.4);
    }

    .history-button {
        display: block;
        margin: 15px 0 0;
        padding: 16px;
        background: rgba(16, 185, 129, 0.1);
        color: #34d399;
        text-decoration: none;
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        text-align: center;
    }

    .history-button:hover {
        background: rgba(16, 185, 129, 0.2);
        border-color: #10b981;
        transform: translateY(-2px);
    }

    .action-row {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .toggle-button {
        flex: 1;
        padding: 12px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #cbd5e1;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        text-decoration: none;
        text-align: center;
        transition: all 0.2s ease;
    }

    .toggle-button:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        transform: translateY(-1px);
    }

    footer {
        margin-top: 50px;
        margin-bottom: 20px;
        padding: 8px 20px;
        background: rgba(15, 23, 42, 0.6); 
        backdrop-filter: blur(5px);
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: inline-block;
        font-size: 13px;
        color: #f8fafc;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .creator-name {
        font-weight: 800;
        color: #10b981;
        text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
    }
</style>
</head>
<body>

<div class="container">
    <header>
        <h1>MP</h1>
        <p class="subtitle">MATH PRO</p>
    </header>

    <div class="card">
        <form action="index.php" method="GET">
            
            <div class="form-group">
                <label>DURASI TES</label>
                <select name="waktu">
                    <option value="30"selected>30 Detik (Kilat)</option> 
                    <option value="60">60 Detik (Singkat)</option>
                    <option value="120">120 Detik (Standar)</option>
                    <option value="180">180 Detik (Intensif)</option>
                </select>
            </div>

            <div class="form-group">
                <label>JENIS LATIHAN</label>
                <select name="tipe" id="tipeLatihanSelect">
                    <option value="kraepelin">Kreaplin </option>
                    <option value="pengurangan">Pengurangan </option> 
                    <option value="perkalian">Perkalian</option>
                    <option value="pembagian">Pembagian</option>
                </select>
            </div>

            <button type="submit">Mulai</button>
        </form>

        <a href="history.php" class="history-button">Lihat Riwayat Hasil</a>

        <div class="action-row">
            <a href="playguide.php" class="toggle-button">Cara Bermain</a>
            <a href="about.php" class="toggle-button">Tentang Aplikasi</a>
        </div>

    </div>

    <footer>
        Dibuat oleh <span class="creator-name">MUHAMAD PIKRI</span>
    </footer>
</div>

</body>
</html>