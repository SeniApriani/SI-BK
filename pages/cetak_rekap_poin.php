<?php
include "../config/koneksi.php";

// PREDIKAT
function getPredikat($poin) {
    if ($poin <= 25) return ['A','Sangat Baik'];
    elseif ($poin <= 50) return ['B','Baik'];
    elseif ($poin <= 75) return ['C','Cukup'];
    elseif ($poin <= 100) return ['D','Kurang'];
    else return ['E','Sangat Kurang'];
}

$kelas = $_GET['kelas'] ?? '';

// QUERY
$sql = "
SELECT 
    ds.id_siswa,
    ds.nisn,
    ds.nama_siswa,
    ds.kelas,
    COALESCE(rp.total_poin,0) AS total_poin,
    cs.catatan_walikelas
FROM data_siswa ds
LEFT JOIN rekap_poin rp ON ds.id_siswa = rp.id_siswa
LEFT JOIN catatan_semester cs 
    ON ds.id_siswa = cs.id_siswa
    AND cs.semester='Ganjil'
    AND cs.tahun_ajaran='2025/2026'
WHERE 1=1
";

if($kelas != ''){
    $sql .= " AND ds.kelas='$kelas' ";
}

$sql .= " ORDER BY ds.kelas, ds.nama_siswa";

$rekap = mysqli_query($koneksi, $sql);

// ambil data dulu
$data = [];
while($r = mysqli_fetch_assoc($rekap)){
    $data[] = $r;
}

// grouping kelas
$groupKelas = [];
foreach($data as $d){
    $groupKelas[$d['kelas']][] = $d;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cetak Rekap Poin</title>

<style>

body{
    font-family:Arial, sans-serif;
    margin:25px;
    color:#000;
}

.kop{
    width:100%;
    margin-bottom:5px;
}

.garis1{
    border:2px solid #000;
    margin:0;
}

.garis2{
    border:1px solid #000;
    margin-top:2px;
}

.judul{
    text-align:center;
    margin-top:20px;
    margin-bottom:20px;
}

.judul h2{
    margin:0;
}

.info{
    margin-bottom:20px;
    line-height:28px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#d9ead3;
}

th,td{
    border:1px solid #000;
    padding:8px;
    text-align:center;
}

.ttd{
    width:300px;
    float:right;
    text-align:center;
    margin-top:50px;
}

@media print{

    @page{
        size:A4 portrait;
        margin:15mm;
    }

}

body{
    font-family: "Times New Roman", serif;
    background:#f5f5f5;
    margin:0;
    padding:20px;
}

.laporan{
    width:210mm;
    min-height:297mm;
    background:#fff;
    margin:auto;
    padding:15mm;
    box-shadow:0 0 10px rgba(0,0,0,.15);
}

.kop{
    width:100%;
    height:auto;
}

.judul{
    text-align:center;
    font-size:20px;
    font-weight:bold;
    margin:20px 0;
}

.info{
    font-size:14px;
    line-height:1.8;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

th,td{
    border:1px solid #000;
    padding:7px;
}

th{
    background:#d9ead3;
}

.ttd{
    width:250px;
    margin-left:auto;
    margin-top:40px;
    text-align:center;
    font-size:14px;
}

@media print{

    body{
        background:#fff;
        padding:0;
    }

    .laporan{
        width:100%;
        min-height:auto;
        margin:0;
        box-shadow:none;
        padding:0;
    }

}

</style>
</head>
<body>
    <div class="laporan">

<!-- KOP SURAT -->

<img src="../assets/img/kop_surat.jpeg" class="kop">

<hr class="garis1">
<hr class="garis2">

<div class="judul">
    <h2>REKAP POIN PELANGGARAN SISWA</h2>
</div>

<div class="info">

    <strong>Periode Berjalan</strong>
    : Tahun <?= date('Y'); ?>

    <br>

    <strong>Kelas</strong>
    : <?= ($kelas != '') ? $kelas : 'Semua Kelas'; ?>

    <br>

    <strong>Tanggal Cetak</strong>
    : <?= date('d F Y'); ?>

</div>

<table>
<tr>
    <th>No</th>
    <th>NISN</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Total Poin</th>
    <th>Predikat</th>
    <th>Kategori</th>
    <th>Catatan Wali Kelas</th>
</tr>

<?php $no = 1; ?>

<?php foreach($groupKelas as $namaKelas => $rows){ ?>

<tr>
    <td colspan="8" style="background:#eee;font-weight:bold;text-align:left;">
        KELAS <?= $namaKelas; ?>
    </td>
</tr>

<?php foreach($rows as $r){ 
    $predikat = getPredikat($r['total_poin']);
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['nisn']; ?></td>
    <td style="text-align:left;"><?= $r['nama_siswa']; ?></td>
    <td><?= $r['kelas']; ?></td>
    <td><?= $r['total_poin']; ?></td>
    <td><?= $predikat[0]; ?></td>
    <td><?= $predikat[1]; ?></td>
    <td><?= $r['catatan_walikelas'] ?? '-'; ?></td>
</tr>

<?php } ?>

<?php } ?>

</table>

<div class="ttd">

    Jatinangor,
    <?= date('d F Y'); ?>

    <br><br>

    Wakasek Kesiswaan

    <br><br><br><br><br>

    <b>
    ______________________
    </b>

</div>

<script>
window.print();
</script>
</div>
</body>
</html>