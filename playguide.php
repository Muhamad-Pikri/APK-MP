<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP - Cara Bermain</title>
    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #34d399;
            --bg-overlay: linear-gradient(135deg, rgba(2, 6, 23, 0.85), rgba(15, 23, 42, 0.85));
            --glass-bg: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text: #f8fafc;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg-overlay), url('j.jpg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text);
            font-family: 'Segoe UI', Roboto, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden; /* Mencegah scroll body luar */
        }

        .container {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            padding: 40px 30px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            max-height: 85vh; /* Sedikit lebih tinggi biar lega */
            overflow-y: auto;
            position: relative;
        }

        /* Scrollbar Mewah */
        .card::-webkit-scrollbar { width: 4px; }
        .card::-webkit-scrollbar-track { background: transparent; }
        .card::-webkit-scrollbar-thumb { 
            background: linear-gradient(transparent, var(--primary-color), transparent); 
            border-radius: 10px; 
        }

        h1 {
            margin: 0;
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(to right, #34d399, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            margin: -5px 0 35px;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 6px;
            opacity: 0.9;
        }

        .guide-section {
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.03);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 1rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 10px var(--primary-color);
        }

        p {
            line-height: 1.6;
            font-size: 0.9rem;
            margin: 0 0 12px;
            color: #cbd5e1;
        }

        .example-box {
            background: #0f172a;
            padding: 12px 15px;
            border-radius: 12px;
            font-size: 0.8rem;
            color: #34d399;
            font-family: 'Courier New', monospace;
            display: flex;
            justify-content: space-between;
        }

        .btn-home {
            display: block;
            margin-top: 30px; /* Jarak dari konten atas */
            padding: 18px;
            background: var(--primary-color);
            color: #064e3b;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>MP</h1>
            <div class="subtitle">Cara Bermain</div>
            
            <div class="guide-section">
                <h2>Mode Kreaplin</h2>
                <p>Cukup input <b>angka satuan</b> (digit terakhir) dari hasil penjumlahan dua angka.</p>
                <div class="example-box">
                    <span>8 + 9 = 17</span>
                    <b>Input: 7</b>
                </div>
            </div>

            <div class="guide-section">
                <h2>Mode Perkalian</h2>
                <p>Input hasil perkalian secara lengkap. Gunakan kecepatan tangan untuk hasil 2 digit.</p>
                <div class="example-box">
                    <span>8 x 9 = 72</span>
                    <b>Input: 72</b>
                </div>
            </div>

            <div class="guide-section">
                <h2>Mode Pengurangan</h2>
                <p>Kurangi angka pertama dengan angka kedua. Input hasil pengurangannya secara lengkap.</p>
                <div class="example-box">
                    <span>15 - 7 = 8</span>
                    <b>Input: 8</b>
                </div>
            </div>

            <div class="guide-section">
                <h2>Mode Pembagian</h2>
                <p>Bagi angka pertama dengan angka kedua secara presisi. Input hasil baginya saja.</p>
                <div class="example-box">
                    <span>100 : 4 = 25</span>
                    <b>Input: 25</b>
                </div>
            </div>

            <a href="home.php" class="btn-home">kembali ke Home</a>
        </div>
    </div>
</body>
</html>