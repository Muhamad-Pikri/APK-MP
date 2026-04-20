<?php
include 'koneksi.php';

// Fitur Baru: Hapus Terpilih (Checkbox)
if (isset($_POST['id_hapus'])) {
    $ids = $_POST['id_hapus'];
    // Mengubah array ID menjadi string yang dipisahkan koma (contoh: 1,2,3)
    $all_id = implode(",", array_map('intval', $ids));
    
    $query = "DELETE FROM hasil WHERE id IN ($all_id)";
    if (mysqli_query($conn, $query)) {
        header("Location: history.php?pesan=terpilih_terhapus");
        exit();
    } else {
        echo "Gagal menghapus data terpilih: " . mysqli_error($conn);
    }
}

// Fitur Hapus Semua (GET)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'semua') {
    $query = "DELETE FROM hasil";
    if (mysqli_query($conn, $query)) {
        header("Location: history.php?pesan=semua_terhapus");
        exit();
    }
}

// Fitur Hapus Satuan (GET)
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM hasil WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: history.php?pesan=hapus_berhasil");
        exit();
    }
}

mysqli_close($conn);
?>