<?php
// ======================================================
// HAPUS DATA ORANG TUA
// ======================================================

session_start();
include "../config/koneksi.php";

// ======================================================
// HANYA WALI KELAS YANG BOLEH MENGHAPUS
// ======================================================

if($_SESSION['role'] != 'wali_kelas'){
    die("Akses ditolak.");
}

// ======================================================
// AMBIL ID
// ======================================================

$id = $_GET['id'] ?? '';

if($id == ''){
    die("ID tidak ditemukan.");
}

// ======================================================
// AMBIL DATA ORANG TUA
// ======================================================

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT *
FROM data_orang_tua
WHERE id_orangtua='$id'
"));

if(!$data){
    die("Data tidak ditemukan.");
}

// ======================================================
// HAPUS AKUN LOGIN ORANG TUA
// ======================================================

mysqli_query($koneksi,"
DELETE FROM users
WHERE role='orang_tua'
AND id_siswa='".$data['id_siswa']."'
");

// ======================================================
// HAPUS DATA ORANG TUA
// ======================================================

mysqli_query($koneksi,"
DELETE FROM data_orang_tua
WHERE id_orangtua='$id'
");

// ======================================================
// KEMBALI KE HALAMAN DATA ORANG TUA
// ======================================================

header("Location: data_orang_tua.php");
exit;
?>