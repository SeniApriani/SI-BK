<?php
session_start();
include "../config/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

// tandai semua notifikasi pelanggaran milik siswa ini sebagai sudah dibaca
mysqli_query($koneksi, "
UPDATE notifikasi
SET status_baca = 1
WHERE id_user = '$id_siswa'
AND status_baca = 0
");

header("Location: riwayat_pelanggaran_siswa.php");
exit;