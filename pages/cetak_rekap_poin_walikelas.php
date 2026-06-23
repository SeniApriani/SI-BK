<?php
include "../config/koneksi.php";

// BULAN

$bulan = [
    1=>'Januari',
    2=>'Februari',
    3=>'Maret',
    4=>'April',
    5=>'Mei',
    6=>'Juni',
    7=>'Juli',
    8=>'Agustus',
    9=>'September',
    10=>'Oktober',
    11=>'November',
    12=>'Desember'
];

$tanggal_indonesia =
date('d').' '.
$bulan[date('n')].' '.
date('Y');


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

@page{
    size:A4 portrait;
    margin:15mm;
}

body{
    font-family:"Times New Roman", serif;
    background:#e5e5e5;
    margin:0;
    padding:20px;
}

.laporan{
    width:210mm;
    min-height:297mm;
    background:#fff;
    margin:auto;
    padding:15mm;
    box-sizing:border-box;
    box-shadow:0 0 10px rgba(0,0,0,.15);
}

.kop{
    width:100%;
    display:block;
    margin-bottom:20px;
}

.judul{
    text-align:center;
    margin-bottom:25px;
}

.judul h3{
    margin:0;
    font-size:20px;
}

.info{
    margin-bottom:25px;
    line-height:1.8;
    font-size:15px;
}

.kelas-section{
    margin-bottom:40px;
}

.kelas-section h3{
    margin-bottom:12px;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

th{
    background:#d9ead3;
}

th,td{
    border:1px solid #000;
    padding:8px;
    text-align:center;
}

td:nth-child(3),
td:nth-child(7){
    text-align:left;
}

.ttd{
    width:280px;
    margin-top:60px;
    margin-left:auto;
    text-align:center;
    line-height:1.8;
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
        padding:0;
        box-shadow:none;
    }

    .ttd{
        page-break-inside:avoid;
    }

}

</style>
</head>
<body>
    <div class="laporan">

<!-- KOP SURAT -->

<img src="../assets/img/kop_surat.jpeg" class="kop">



<div class="judul">
    <h3>REKAP POIN PELANGGARAN SISWA</h3>
</div>

<?php

$bulan = date('n');

if($bulan >= 7){
    $semester = "Ganjil";
    $tahun_ajaran = date('Y')."/".(date('Y')+1);
}else{
    $semester = "Genap";
    $tahun_ajaran = (date('Y')-1)."/".date('Y');
}

?>

<div class="info">

    <strong>Periode</strong>
    : Semester <?= $semester; ?> Tahun Ajaran <?= $tahun_ajaran; ?>

</div>

<?php foreach($groupKelas as $namaKelas => $rows){ ?>

<div class="kelas-section">

    <h3 style="margin-bottom:10px;">
        KELAS <?= $namaKelas; ?>
    </h3>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Total Poin</th>
                <th>Predikat</th>
                <th>Kategori</th>
                <th>Catatan Wali Kelas</th>
            </tr>
        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach($rows as $r){ ?>

        <?php
        $predikat = getPredikat($r['total_poin']);
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $r['nisn']; ?></td>
            <td style="text-align:left;">
                <?= $r['nama_siswa']; ?>
            </td>
            <td><?= $r['total_poin']; ?></td>
            <td><?= $predikat[0]; ?></td>
            <td><?= $predikat[1]; ?></td>
            <td><?= $r['catatan_walikelas'] ?: '-'; ?></td>
        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php } ?>
<div class="ttd">

   Jatinangor, <?= $tanggal_indonesia; ?>

    <br>

    Wali Kelas

    <br><br><br>

    <b>(................................)</b>

</div>

<script>
window.print();
</script>
</div>
</body>
</html>