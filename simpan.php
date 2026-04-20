<?php
include 'koneksi.php';

$nama = isset($_POST['nama']) ? trim($_POST['nama']) : 'Anonymous';
$benar = isset($_POST['benar']) ? (int)$_POST['benar'] : 0;
$salah = isset($_POST['salah']) ? (int)$_POST['salah'] : 0;
$skor = isset($_POST['skor']) ? (int)$_POST['skor'] : 0;
$rata = isset($_POST['rata']) ? (float)$_POST['rata'] : 0.0;
$durasi = isset($_POST['durasi']) ? (int)$_POST['durasi'] : 0;

$stmt = mysqli_prepare($conn, "INSERT INTO hasil (nama, benar, salah, skor, rata, durasi) VALUES (?, ?, ?, ?, ?, ?)");

if ($stmt) {
    // PERBAIKAN: s (string), i (int), i (int), i (int), d (float/rata), i (int/durasi)
    // Jadi urutannya: siiidi
    mysqli_stmt_bind_param($stmt, 'siiidi', $nama, $benar, $salah, $skor, $rata, $durasi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "Berhasil simpan: " . $rata;
}
?>