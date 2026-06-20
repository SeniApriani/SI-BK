<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi,"
SELECT
    ps.id,
    ps.tanggal,
    s.nama_siswa,
    s.nisn,
    s.kelas,
    jp.kategori,
    jp.jenis_pelanggaran,
    jp.poin,
    ps.catatan,
    lk.catatan_konseling,
    lk.tanggal_tindak_lanjut,
    lk.tanggal_konseling
FROM pelanggaran_siswa ps
JOIN data_siswa s ON ps.id_siswa = s.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
JOIN laporan_konseling lk
ON ps.id = lk.id_pelanggaran_siswa
WHERE ps.id='$id'
");

echo json_encode(mysqli_fetch_assoc($data));