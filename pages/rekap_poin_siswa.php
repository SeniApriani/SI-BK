<?php
session_start();
include "../config/koneksi.php";

$id_siswa = $_GET['id'];

// ==========================
// QUERY GABUNGAN RIWAYAT
// ==========================
$riwayat = mysqli_query($koneksi,"
SELECT * FROM (

    /* ================= PELANGGARAN ================= */
    SELECT 
        ps.tanggal AS tanggal,
        ds.nama_siswa,
        ds.kelas,
        'Pelanggaran' AS aktivitas,
        jp.jenis_pelanggaran AS keterangan,
        -ps.poin AS poin
    FROM pelanggaran_siswa ps
    JOIN data_siswa ds ON ps.id_siswa = ds.id_siswa
    JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
    WHERE ps.id_siswa='$id_siswa'

    UNION ALL

    /* ================= REMISI PRESTASI ================= */
    SELECT 
        pr.tanggal_pengajuan AS tanggal,
        ds.nama_siswa,
        ds.kelas,
        'Remisi Prestasi' AS aktivitas,
        pr.nama_prestasi AS keterangan,
        pr.potongan_poin AS poin
    FROM pengajuan_remisi pr
    JOIN data_siswa ds ON pr.id_siswa = ds.id_siswa
    WHERE pr.status='Disetujui'
    AND pr.id_siswa='$id_siswa'

    UNION ALL

    /* ================= REMISI OTOMATIS ================= */
    SELECT 
        ro.tanggal_remisi AS tanggal,
        ds.nama_siswa,
        ds.kelas,
        'Remisi Otomatis' AS aktivitas,
        ro.keterangan AS keterangan,
        ro.potongan_poin AS poin
    FROM remisi_otomatis ro
    JOIN data_siswa ds ON ro.id_siswa = ds.id_siswa
    WHERE ro.id_siswa='$id_siswa'

) AS semua
ORDER BY tanggal ASC
");

// DATA SISWA
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'
"));

$total = 100;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Saldo Poin Pelanggaran Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    font-family:Poppins;
    background:#f5f7fb;
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
    background:#fff;
    padding:25px;
    border-radius:15px;
}

h2{
    color:#16a34a;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th{
    background:#16a34a;
    color:#fff;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f0fdf4;
}



.btn-back{
    display:inline-block;
    margin-top:15px;
    padding:10px 15px;
    background:#16a34a;
    color:#fff;
    border-radius:8px;
    text-decoration:none;
}

/* identitas siswa */


.info-card{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    margin-top:15px;
    margin-bottom:20px;
}

.info-item{
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    padding:15px;
    border-radius:12px;
    text-align:center;
}

.info-item span{
    display:block;
    font-size:12px;
    color:#6b7280;
    margin-bottom:5px;
}

.info-item b{
    color:#166534;
    font-size:16px;
}


/* total saldo */
.total-box{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
}

.total{
    background:#fff;
    border:2px solid #16a34a;
    border-radius:15px;
    padding:10px 15px;
    text-align:center;
}

.total h3{
    color:#166534;
    font-size:16px;
}

.total h1{
    color:#16a34a;
    font-size:20px;
}
</style>

</head>
<body>

<div class="container">

<h2>Riwayat Saldo Poin Pelanggaran</h2>

<div class="info-card">

    <div class="info-item">
        <span>Nama Siswa</span>
        <b><?= $siswa['nama_siswa']; ?></b>
    </div>

    <div class="info-item">
        <span>NISN</span>
        <b><?= $siswa['nisn']; ?></b>
    </div>

    <div class="info-item">
        <span>Kelas</span>
        <b><?= $siswa['kelas']; ?></b>
    </div>

</div>
<table>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Aktivitas</th>
<th>Keterangan</th>
<th>Perubahan Poin</th>
<th>Saldo Poin</th>
</tr>

<?php
$no = 1;
?>

<tr>
    <td><?= $no++; ?></td>
    <td>-</td>
    <td>Modal Awal</td>
    <td>Poin awal siswa(Poin Positif)</td>
    <td>+100</td>
    <td>100</td>
</tr>


<?php 
$no = 1;
while($r = mysqli_fetch_assoc($riwayat)) { 

$total += $r['poin'];
if($total > 100){
    $total = 100;
}
?>

<tr>
<td><?= $no++; ?></td>
<td><?= date('d/m/Y', strtotime($r['tanggal'])); ?></td>
<td><?= $r['aktivitas']; ?></td>
<td><?= $r['keterangan']; ?></td>
<td>
<?php
if($r['poin'] > 0){
    echo "+".$r['poin'];
}else{
    echo $r['poin'];
}
?>
</td>
<td><?= $total; ?></td>
</tr>

<?php } ?>

</table>
<div class="total-box">

    <div class="total">
        <h3>Saldo Poin Akhir</h3>
        <h1><?= $total; ?></h1>
    </div>

</div>

<a href="dashboard_siswa.php" class="btn-back">
<i class="fas fa-arrow-left"></i> Kembali
</a>

</div>

</body>
</html>