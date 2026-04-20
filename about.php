<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP - Tentang Aplikasi</title>
    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #34d399;
            /* Gradient overlay yang sama dengan Home/Playguide */
            --bg-overlay: linear-gradient(135deg, rgba(2, 6, 23, 0.9), rgba(15, 23, 42, 0.9));
            --glass-bg: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text: #f8fafc;
            --muted: #94a3b8;
        }

        body {
            margin: 0;
            min-height: 100vh;
            /* Pakai background p.jpg seperti request lu */
            background: var(--bg-overlay), url('j.jpg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text);
            font-family: 'Segoe UI', Roboto, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden; /* Biar rapi */
        }

        .container {
            width: 100%;
            max-width: 480px;
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
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(to right, #34d399, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            margin: -5px 0 35px;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 6px;
            opacity: 0.9;
        }

        .content-section {
            text-align: left;
            background: rgba(255, 255, 255, 0.03);
            padding: 25px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 30px;
        }

        p {
            line-height: 1.7;
            font-size: 0.95rem;
            margin: 0 0 15px;
            color: #cbd5e1;
        }

        h2 {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-top: 20px;
            margin-bottom: 15px;
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

        ul {
            padding-left: 5px;
            list-style: none;
            margin: 0;
        }

        li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #e2e8f0;
        }

        li::before {
            content: '▹';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        .btn-home {
            display: block;
            padding: 18px;
            background: var(--primary-color);
            color: #064e3b;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-home:hover {
            background: var(--primary-hover);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>MP</h1>
            <div class="subtitle">Tentang Aplikasi</div>
            
            <div class="content-section">
                <p><b>MP</b> adalah platform latihan matematika adaptif yang dirancang untuk mengasah refleks kognitif dan akurasi hitung di bawah tekanan waktu.</p>
                
                <h2>Fitur Utama</h2>
                <ul>
                    <li>Multi-Mode: Penjumlahan, Pengurangan, Perkalian, dan Pembagian.</li>
                    <li>Durasi Fleksibel: Sesi latihan 30s, 60s, 120s, hingga 180s.</li>
                    <li>Smart History: Pelacakan progres skor dan statistik kesalahan.</li>
                    <li>Optimasi Mobile: Tampilan responsif untuk kenyamanan di smartphone.</li>
                </ul>
            </div>

            <a href="home.php" class="btn-home">Kembali ke Home</a>
        </div>
    </div>
</body>
</html>