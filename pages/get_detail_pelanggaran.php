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
    ps.catatan
FROM pelanggaran_siswa ps
JOIN data_siswa s ON ps.id_siswa = s.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id='$id'
");

$row = mysqli_fetch_assoc($data);

echo json_encode($row);