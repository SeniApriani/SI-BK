<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi,"
SELECT
    ps.*,
    ds.nama_siswa,
    ds.nisn,
    ds.kelas,
    jp.kategori,
    jp.jenis_pelanggaran
FROM pelanggaran_siswa ps
JOIN data_siswa ds ON ps.id_siswa = ds.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id='$id'
");

$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Tindak Lanjut</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    padding:30px;
}

.container{
    max-width:900px;
    margin:auto;
}

.card{
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

h2{
    color:#15803d;
    margin-bottom:25px;
}

.item{
    margin-bottom:15px;
}

.label{
    font-weight:600;
    color:#15803d;
}

.value{
    margin-top:5px;
    color:#374151;
}

.box{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:15px;
    border-radius:10px;
    margin-top:5px;
}

.btn-back{
    display:inline-block;
    margin-top:25px;
    padding:10px 18px;
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    border-radius:10px;
}

.btn-back:hover{
    background:#15803d;
}

</style>

</head>
<body>

<div class="container">

<div class="card">

<h2>Detail Tindak Lanjut Pelanggaran</h2>

<div class="item">
<div class="label">Nama Siswa</div>
<div class="value"><?= $d['nama_siswa']; ?></div>
</div>

<div class="item">
<div class="label">NISN</div>
<div class="value"><?= $d['nisn']; ?></div>
</div>

<div class="item">
<div class="label">Kelas</div>
<div class="value"><?= $d['kelas']; ?></div>
</div>

<div class="item">
<div class="label">Kategori</div>
<div class="value"><?= $d['kategori']; ?></div>
</div>

<div class="item">
<div class="label">Jenis Pelanggaran</div>
<div class="value"><?= $d['jenis_pelanggaran']; ?></div>
</div>

<div class="item">
<div class="label">Poin</div>
<div class="value"><?= $d['poin']; ?> Poin</div>
</div>

<div class="item">
<div class="label">Detail Pelanggaran</div>
<div class="box">
<?= $d['catatan']; ?>
</div>
</div>

<div class="item">
<div class="label">Tanggal Tindak Lanjut</div>
<div class="value">
<?= date('d-m-Y', strtotime($d['tanggal_tindak_lanjut'])); ?>
</div>
</div>

<div class="item">
<div class="label">Catatan Tindak Lanjut</div>
<div class="box">
<?= $d['catatan_tindak_lanjut']; ?>
</div>
</div>

<div class="item">
<div class="label">Status</div>
<div class="value">
<?= $d['status']; ?>
</div>
</div>

<a href="riwayat_pelanggaran_siswa.php" class="btn-back">
Kembali
</a>

</div>

</div>

</body>
</html>