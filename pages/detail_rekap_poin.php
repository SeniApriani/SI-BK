<?php
include "../config/koneksi.php";

$id_siswa = $_GET['id'] ?? '';

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT *
FROM data_siswa
WHERE id_siswa='$id_siswa'
"));

if(!$data){
    die("Data siswa tidak ditemukan");
}


$pel = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(jp.poin) AS total
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$id_siswa'
"));

$total_pelanggaran = $pel['total'] ?? 0;

$prestasi = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(poin_remisi) AS total
FROM pengajuan_remisi
WHERE id_siswa='$id_siswa'
AND status='Disetujui'
"));

$otomatis = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(persen_remisi) AS total
FROM remisi_otomatis
WHERE id_siswa='$id_siswa'
"));

$total_remisi =
($prestasi['total'] ?? 0)
+
($otomatis['total'] ?? 0);

$nilai_remisi = round(($total_pelanggaran * $total_remisi)/100);

$poin_akhir = max(
    0,
    $total_pelanggaran - $nilai_remisi
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Rekap Poin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    padding:30px;
    color:#374151;
}

.container{
    max-width:1200px;
    margin:auto;
}

.card{
    background:#fff;
    border-radius:20px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header h1{
    color:#15803d;
    margin-bottom:8px;
}

.page-header p{
    color:#6b7280;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}

.info-box{
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    border-radius:15px;
    padding:18px;
}

.info-box small{
    display:block;
    color:#6b7280;
    margin-bottom:5px;
}

.info-box strong{
    color:#166534;
}

.summary-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}

.summary-box{
    background:#dcfce7;
    border-radius:15px;
    padding:20px;
    text-align:center;
}

.summary-box h3{
    color:#166534;
    font-size:14px;
    margin-bottom:8px;
}

.summary-box span{
    font-size:24px;
    font-weight:700;
    color:#15803d;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#16a34a;
    color:#fff;
}

th,td{
    padding:14px;
    border-bottom:1px solid #e5e7eb;
    text-align:center;
}

tbody tr:hover{
    background:#f0fdf4;
}

.btn-back{
    width:45px;
    height:45px;
    border-radius:50%;
    border:1px solid #15803d;
    color:#15803d;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

@media(max-width:768px){

    .info-grid,
    .summary-grid{
        grid-template-columns:1fr;
    }

}

</style>
</head>
<body>

<div class="container">

<div class="card page-header">
    <h1>Detail Rekap Poin Siswa</h1>
    <p>Informasi poin pelanggaran dan remisi siswa.</p>
</div>

<!-- DATA SISWA -->

<div class="card">

<h2 style="color:#15803d;margin-bottom:20px;">
Data Siswa
</h2>

<div class="info-grid">

<div class="info-box">
<small>Nama Siswa</small>
<strong><?= $data['nama_siswa']; ?></strong>
</div>

<div class="info-box">
<small>NISN</small>
<strong><?= $data['nisn']; ?></strong>
</div>

<div class="info-box">
<small>Kelas</small>
<strong><?= $data['kelas']; ?></strong>
</div>

</div>

</div>

<!-- RINGKASAN -->

<div class="card">

<h2 style="color:#15803d;margin-bottom:20px;">
Ringkasan Poin
</h2>

<div class="summary-grid">

<div class="summary-box">
<h3>Total Poin Pelanggaran</h3>
<span><?= $total_pelanggaran; ?></span>
</div>

<div class="summary-box">
<h3>Total Remisi</h3>
<span><?= $total_remisi; ?>%</span>
</div>

<div class="summary-box">
<h3>Poin Akhir</h3>
<span><?= $poin_akhir; ?></span>
</div>

</div>

</div>

<!-- RIWAYAT PELANGGARAN -->

<div class="card">

<h2 style="color:#15803d;margin-bottom:20px;">
Riwayat Pelanggaran
</h2>

<table>

<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Jenis Pelanggaran</th>
<th>Poin</th>
</tr>
</thead>

<tbody>

<?php

$pelanggaran = mysqli_query($koneksi,"
SELECT
    ps.tanggal,
    jp.jenis_pelanggaran,
    jp.poin
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$id_siswa'
ORDER BY ps.tanggal DESC
");

$no = 1;

while($p = mysqli_fetch_assoc($pelanggaran)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d/m/Y', strtotime($p['tanggal'])); ?></td>
    <td><?= $p['jenis_pelanggaran']; ?></td>
    <td><?= $p['poin']; ?></td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- RIWAYAT REMISI -->

<div class="card">

<h2 style="color:#15803d;margin-bottom:20px;">
Riwayat Remisi
</h2>

<table>

<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Jenis Remisi</th>
<th>Remisi</th>
</tr>
</thead>

<tbody>

<?php

$no = 1;

$riwayat_remisi = mysqli_query($koneksi,"
SELECT
    tanggal_pengajuan AS tanggal,
    nama_prestasi AS jenis_remisi,
    CONCAT(poin_remisi,'%') AS nilai_remisi
FROM pengajuan_remisi
WHERE id_siswa='$id_siswa'
AND status='Disetujui'

UNION ALL

SELECT
    tanggal_remisi AS tanggal,
    keterangan AS jenis_remisi,
    CONCAT(persen_remisi,'%') AS nilai_remisi
FROM remisi_otomatis
WHERE id_siswa='$id_siswa'

ORDER BY tanggal DESC
");

while($r = mysqli_fetch_assoc($riwayat_remisi)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d/m/Y', strtotime($r['tanggal'])); ?></td>
    <td><?= $r['jenis_remisi']; ?></td>
    <td><?= $r['nilai_remisi']; ?></td>
</tr>

<?php } ?>
</tbody>

</table>

</div>

<a href="rekap_poin_wakasek.php" class="btn-back">
←
</a>

</div>

</body>
</html>