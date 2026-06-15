<?php
session_start();
include "../config/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

mysqli_query($koneksi,"
UPDATE notifikasi
SET status_baca = 1
WHERE id_user = '$id_siswa'
");

$redirect = $_GET['redirect'] ?? 'dashboard_siswa.php';
header("Location: $redirect");
exit;
?>