let a, b;
let score = 0;
let jumlahSalah = 0; 
let totalJawaban = 0;
let gameOver = false;
let timerInterval;
let jawabAkumulasi = ""; 
let digitDiperlukan = 1; 

// --- FITUR GACOR: COMBO & HISTORY ---
let historyJawaban = []; 
let comboCount = 0;
let maxCombo = 0;

const timerElement = document.getElementById("timer");
const scoreElement = document.getElementById("score");
const salahElement = document.getElementById("salah-counter"); 
const namaElement = document.getElementById("namaUser");
const tipeElement = document.getElementById("tipeLaihan");
const keypadElement = document.getElementById("keypad");
const resultModal = document.getElementById("resultModal");

let waktu = timerElement ? parseInt(timerElement.innerText, 10) || 60 : 60;
const totalWaktu = waktu;
let nama = namaElement ? namaElement.innerText.trim() : "User";
let tipe = tipeElement ? tipeElement.innerText.trim() : "kraepelin";

// --- FUNGSI GENERATE ---
function generate() {
    const angka1 = document.getElementById("angka1");
    const angka2 = document.getElementById("angka2");

    if (tipe === "pembagian") {
        let pembagi = Math.floor(Math.random() * 9) + 2; 
        let hasilBenar = Math.floor(Math.random() * 10) + 1; 
        a = pembagi * hasilBenar; 
        b = pembagi;
        digitDiperlukan = hasilBenar.toString().length;
        window.targetAnswer = hasilBenar;
    } 
    else if (tipe === "perkalian") {
        a = Math.floor(Math.random() * 10);
        b = Math.floor(Math.random() * 10);
        let hasil = a * b;
        digitDiperlukan = hasil.toString().length;
        window.targetAnswer = hasil;
    } 
    else if (tipe === "pengurangan") {
        a = Math.floor(Math.random() * 15) + 5; 
        b = Math.floor(Math.random() * (a + 1)); 
        let hasil = a - b;
        digitDiperlukan = hasil.toString().length;
        window.targetAnswer = hasil;
    }
    else { 
        a = Math.floor(Math.random() * 10);
        b = Math.floor(Math.random() * 10);
        digitDiperlukan = 1;
        window.targetAnswer = (a + b) % 10;
    }

    if (angka1) angka1.innerText = a;
    if (angka2) angka2.innerText = b;
}

// --- FUNGSI JAWAB ---
function jawab(x, el) {
    if (gameOver) return;

    let simbol = (tipe === "pembagian") ? "/" : (tipe === "perkalian") ? "x" : (tipe === "pengurangan") ? "-" : "+";
    let soalTeks = `${a} ${simbol} ${b}`;
    let jawabanBener = window.targetAnswer;

    if (tipe !== "kraepelin") {
        jawabAkumulasi += x;
        // Kasih warna netral saat ngetik digit awal (opsional)
        el.classList.add("correct-press"); 

        if (jawabAkumulasi.length === digitDiperlukan) {
            totalJawaban++;
            let userAns = parseInt(jawabAkumulasi);
            let isCorrect = (userAns === jawabanBener);
            
            prosesJawaban(isCorrect, soalTeks, userAns, jawabanBener);

            // Jika salah satu digit salah, ganti warna tombol terakhir jadi merah
            if(!isCorrect) {
                el.classList.remove("correct-press");
                el.classList.add("wrong-press");
            }

            setTimeout(() => {
                el.classList.remove("correct-press", "wrong-press");
                jawabAkumulasi = "";
                updateUI();
                generate();
            }, 150);
        } else {
            // Belum selesai digitnya, lepas class bentar biar bisa diklik lagi
            setTimeout(() => el.classList.remove("correct-press"), 100);
        }
    } 
    else {
        // Mode Kraepelin (Langsung Cek)
        totalJawaban++;
        let isCorrect = (x === jawabanBener);
        
        el.classList.add(isCorrect ? "correct-press" : "wrong-press");
        prosesJawaban(isCorrect, soalTeks, x, jawabanBener);

        setTimeout(() => {
            el.classList.remove("correct-press", "wrong-press");
            updateUI();
            generate();
        }, 150);
    }
}

// LOGIC PROSES (COMBO & FEEDBACK)
function prosesJawaban(isCorrect, soal, jwb, asli) {
    let status = isCorrect ? "Benar" : "Salah";
    historyJawaban.push({ soal: soal, jwb: jwb, asli: asli, status: status });

    if (isCorrect) {
        score++;
        comboCount++;
        if (comboCount > maxCombo) maxCombo = comboCount;
        if (comboCount >= 2) triggerCombo(comboCount);
    } else {
        jumlahSalah++;
        comboCount = 0; 
        if (navigator.vibrate) navigator.vibrate(50);
    }
}

function triggerCombo(val) {
    const container = document.getElementById('combo-layer');
    if (container) {
        container.innerHTML = `<div class="combo-text">${val}x COMBO!</div>`;
        setTimeout(() => { container.innerHTML = ''; }, 500);
    }
}

function updateUI() {
    if (scoreElement) scoreElement.innerText = score;
    if (salahElement) salahElement.innerText = jumlahSalah;
}

function startTimer() {
    timerInterval = setInterval(() => {
        waktu--;
        if (timerElement) {
            timerElement.innerText = waktu;
            if (waktu <= 5) timerElement.style.color = "#ef4444";
        }
        if (waktu <= 0) {
            clearInterval(timerInterval);
            selesai();
        }
    }, 1000);
}

function selesai() {
    gameOver = true;
    if (keypadElement) {
        keypadElement.style.opacity = "0.3";
        keypadElement.style.pointerEvents = "none";
    }

    const nilaiRata = totalWaktu > 0 ? (score / totalWaktu).toFixed(2) : "0.00";

    // Simpan ke DB
    const dataKirim = new URLSearchParams();
    dataKirim.append('nama', nama);
    dataKirim.append('benar', score);
    dataKirim.append('salah', jumlahSalah);
    dataKirim.append('skor', score);
    dataKirim.append('rata', nilaiRata);
    dataKirim.append('durasi', totalWaktu);

    fetch("simpan.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: dataKirim.toString()
    }).catch(err => console.log("Gagal simpan"));

    showResult(score, jumlahSalah, nilaiRata);
}

function showResult(scoreValue, salahValue, rataValue) {
    if (document.getElementById("resultBenar")) document.getElementById("resultBenar").innerText = scoreValue;
    if (document.getElementById("resultSalah")) document.getElementById("resultSalah").innerText = salahValue;
    if (document.getElementById("resultAverage")) document.getElementById("resultAverage").innerText = rataValue;

    const reviewContainer = document.getElementById("review-container");
    if (reviewContainer) {
        // Header detail tetap ada, tapi list di bawahnya tanpa nomor
        reviewContainer.innerHTML = `<p style="text-align:center; opacity:0.5; font-size:11px; margin-bottom:10px;">DETAIL PERFORMA (COMBO MAX: ${maxCombo})</p>`;
        
        historyJawaban.forEach((item) => {
            const isCorrect = item.status === "Benar";
            const badgeColor = isCorrect ? "#10b981" : "#ef4444";

            reviewContainer.innerHTML += `
                <div class="review-item" style="display:flex; justify-content:space-between; padding:8px; border-bottom:1px solid rgba(255,255,255,0.05); font-size:13px;">
                    <span>${item.soal} = <b>${item.jwb}</b></span>
                    <span style="color:${badgeColor}; font-weight:bold; font-size:11px;">
                        ${item.status.toUpperCase()}
                    </span>
                </div>
            `;
        });
    }

    if (resultModal) resultModal.classList.add("open");
}

// Inisialisasi awal
generate();
startTimer();