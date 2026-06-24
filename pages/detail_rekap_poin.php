

<?php

include "../config/koneksi.php";

/* =========================
   KONEKSI DATABASE
========================= */

$id_siswa = $_GET['id'];

$riwayat = mysqli_query($koneksi, "

/* =========================
   PELANGGARAN
========================= */
SELECT
    ps.tanggal,
    ds.nama_siswa,
    ds.kelas,
    'Pelanggaran' AS aktivitas,
    jp.jenis_pelanggaran AS keterangan,
    CONCAT('-', ps.poin) AS poin
FROM pelanggaran_siswa ps
JOIN data_siswa ds ON ps.id_siswa = ds.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$id_siswa'
UNION ALL

/* =========================
   REMISI PRESTASI
========================= */
SELECT
    pr.tanggal_pengajuan AS tanggal,
    ds.nama_siswa,
    ds.kelas,
    'Remisi Prestasi' AS aktivitas,
    pr.nama_prestasi AS keterangan,
    CONCAT('+', pr.potongan_poin) AS poin
FROM pengajuan_remisi pr
JOIN data_siswa ds ON pr.id_siswa = ds.id_siswa
WHERE pr.status='Disetujui'
AND pr.id_siswa='$id_siswa'

UNION ALL

/* =========================
   REMISI OTOMATIS
========================= */
SELECT
    ro.tanggal_remisi AS tanggal,
    ds.nama_siswa,
    ds.kelas,
    'Remisi Otomatis' AS aktivitas,
    ro.keterangan,
   CONCAT('+', ro.potongan_poin) AS poin
FROM remisi_otomatis ro
JOIN data_siswa ds ON ro.id_siswa = ds.id_siswa
WHERE ro.id_siswa='$id_siswa'

ORDER BY tanggal ASC

");

// DATA SISWA
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT *
FROM data_siswa
WHERE id_siswa='$id_siswa'
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Rekap Poin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
}

.container{
    max-width:1400px;
    margin:auto;
}

.card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.header{
    margin-bottom:25px;
}

.header h1{
    color:#15803d;
    font-size:30px;
}

.header p{
    color:#6b7280;
    margin-top:5px;
}

.info-siswa{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    margin-bottom:25px;
}

.box{
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    border-radius:14px;
    padding:18px;
}

.box span{
    display:block;
    font-size:13px;
    color:#6b7280;
}

.box strong{
    color:#166534;
    font-size:16px;
}

.table-container{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#16a34a;
    color:#fff;
}

th{
    padding:14px;
    text-align:center;
}

td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid #e5e7eb;
}

tbody tr:hover{
    background:#f0fdf4;
}

.badge-pelanggaran{
    background:#fee2e2;
    color:#b91c1c;
    padding:6px 12px;
    border-radius:8px;
    font-weight:600;
}

.badge-remisi{
    background:#dcfce7;
    color:#166534;
    padding:6px 12px;
    border-radius:8px;
    font-weight:600;
}

.badge-otomatis{
    background:#dbeafe;
    color:#1d4ed8;
    padding:6px 12px;
    border-radius:8px;
    font-weight:600;
}

.keterangan{
    margin-top:25px;
    background:#f9fafb;
    border-radius:15px;
    padding:20px;
    border:1px solid #e5e7eb;
}

.keterangan h3{
    color:#166534;
    margin-bottom:15px;
}

.legend{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:10px;
}

.total-box{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
}

.total{
    background:#fff;
    border:2px solid #16a34a;
    border-radius:15px;
    padding:20px 30px;
    text-align:center;
}

.total h3{
    color:#166534;
}

.total h1{
    color:#16a34a;
    font-size:40px;
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
    margin-top:20px;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

/* total saldo poin */
.total-box{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
}

.total{
    background:#fff;
    border:2px solid #16a34a;
    border-radius:15px;
    padding:20px 30px;
    text-align:center;
}

.total h3{
    color:#166534;
    font-size:16px;
}

.total h1{
    color:#16a34a;
    font-size:40px;
}

</style>
</head>
<body>

<div class="container">

<div class="card">

<div class="header">
    <h1>Riwayat Saldo Poin Pelanggaran Siswa</h1>
    <p>Monitoring aktivitas poin pelanggaran dan remisi siswa</p>
</div>

<div class="info-siswa">

    <div class="box">
        <span>Nama Siswa</span>
        <strong><?= $siswa['nama_siswa']; ?></strong>
    </div>

    <div class="box">
        <span>NISN</span>
        <strong><?= $siswa['nisn']; ?></strong>
    </div>

    <div class="box">
        <span>Kelas</span>
        <strong><?= $siswa['kelas']; ?></strong>
    </div>

</div>

<div class="table-container">

<table>

<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Aktivitas</th>
<th>Keterangan</th>
<th>Perubahan Poin</th>
<th>Saldo Poin</th>
</tr>
</thead>

<tbody>

<?php

$no = 1;

/* MODAL AWAL */
$total_berjalan = 100;

?>

<!-- TAMPIL 1 KALI SAJA -->
<tr>
    <td><?= $no++; ?></td>
    <td>-</td>
    <td><?= $siswa['nama_siswa']; ?></td>
    <td><?= $siswa['kelas']; ?></td>
    <td>Modal Awal</td>
    <td>Poin awal siswa</td>
    <td>+100</td>
    <td><b>100</b></td>
</tr>

<?php

while($r = mysqli_fetch_assoc($riwayat)){

    $nilai = (int)$r['poin'];

    $total_berjalan += $nilai;

    if($total_berjalan > 100){
        $total_berjalan = 100;
    }

?>
<tr>

    <td><?= $no++; ?></td>

     <td><?= date('d/m/Y', strtotime($r['tanggal'])); ?></td>
    <td><?= $r['nama_siswa']; ?></td>

    <td><?= $r['kelas']; ?></td>

    <td><?= $r['aktivitas']; ?></td>

    <td><?= $r['keterangan']; ?></td>

    <td><?= $r['poin']; ?></td>

    <td><b><?= $total_berjalan; ?></b></td>

</tr>

<?php } ?>
</tbody>

</table>

<div class="total-box">

    <div class="total">
        <h3>Saldo Poin Akhir</h3>
        <h1><?= $total_berjalan; ?></h1>
    </div>

</div>


<a href="rekap_poin_wakasek.php" class="btn-back">
<i class="fas fa-chevron-left"></i>
</a>

</div>

</div>

</body>
</html>