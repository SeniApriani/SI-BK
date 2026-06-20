<?php
include "../config/koneksi.php";

$id_pelanggaran = $_POST['id_pelanggaran_siswa'];
$tanggal_tindak_lanjut = $_POST['tanggal_tindak_lanjut'];
$catatan = $_POST['catatan_konseling'];

mysqli_query($koneksi,"
INSERT INTO laporan_konseling
(
    id_pelanggaran_siswa,
    catatan_konseling,
    tanggal_tindak_lanjut
)
VALUES
(
    '$id_pelanggaran',
    '$catatan',
    '$tanggal_tindak_lanjut'
)
");

echo "success";