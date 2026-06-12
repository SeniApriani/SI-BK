

<?php
include "../config/koneksi.php";

$kelas = $_GET['kelas'] ?? '';

if($kelas != ''){

    $rekap = mysqli_query($koneksi,"
    SELECT
        id_siswa,
        nisn,
        nama_siswa,
        kelas
    FROM data_siswa
    WHERE kelas='$kelas'
    ORDER BY nama_siswa ASC
    ");

}else{

    $rekap = mysqli_query($koneksi,"
    SELECT
        id_siswa,
        nisn,
        nama_siswa,
        kelas
    FROM data_siswa
    ORDER BY nama_siswa ASC
    ");

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rekap Poin Siswa</title>

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
    color:#374151;
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.tab-card{
    background:#fff;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    overflow:hidden;
}

.tab-menu{
    display:grid;
    grid-template-columns:repeat(4,1fr);
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    height:72px;
    transition:.3s;
}

.tab:hover{
    color:#16a34a;
}

.tab::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:0;
    height:4px;
    background:#16a34a;
    transition:.3s;
}

.tab:hover::after{
    width:100%;
}

.tab.active{
    color:#16a34a;
}

.tab.active::after{
    width:100%;
}

.card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:25px;
}

.page-header h1{
    color:#15803d;
    font-size:28px;
}

.filter-box{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:15px;
    margin-bottom:25px;
}

.filter-box select{
    width:100%;
    padding:12px 15px;
    border:1px solid #d1d5db;
    border-radius:10px;
    outline:none;
    font-family:'Poppins',sans-serif;
}

.filter-box select:focus{
    border-color:#16a34a;
}

.table-container{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

table thead{
    background:#16a34a;
    color:#fff;
}

table th{
    padding:14px;
    text-align:center;
    font-size:14px;
}

table td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid #e5e7eb;
    font-size:14px;
}

table tbody tr:hover{
    background:#f0fdf4;
}

.badge-poin{
    background:#dcfce7;
    color:#15803d;
    padding:6px 12px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}

.table-footer{
    margin-top:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
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
    transition:.3s;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.pagination{
    display:flex;
    align-items:center;
    gap:10px;
}

.page{
    min-width:40px;
    height:40px;
    padding:0 14px;
    border-radius:12px;
    background:#fff;
    border:1px solid #e5e7eb;
    color:#6b7280;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:500;
    transition:.3s;
}

.page:hover{
    background:#dcfce7;
    border-color:#16a34a;
    color:#16a34a;
}

.page.active{
    background:#16a34a;
    border-color:#16a34a;
    color:#fff;
    box-shadow:0 4px 12px rgba(22,163,74,.25);
}

<style>

.page{
    width:38px;
    height:38px;
    border-radius:10px;
    border:1px solid #d1d5db;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    color:#374151;
    transition:.3s;
}

.page:hover,
.page.active{
    background:#16a34a;
    border-color:#16a34a;
    color:#fff;
}

.btn-download{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 22px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-download:hover{
    background:#15803d;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu{
        grid-template-columns:1fr;
    }

    .filter-box{
        grid-template-columns:1fr;
    }

    .card{
        padding:20px;
    }

    .table-footer{
        flex-direction:column;
        gap:15px;
    }

}

/* Nama Siswa */
.nama-siswa{
    text-decoration:none;
    color:#374151;
    font-weight:500;
    transition:.3s;
}

.nama-siswa:hover{
    color:#16a34a;
}

</style>
</head>
<body>

<div class="container">

<div class="tab-card">
<div class="tab-menu">

<a href="pengajuan_remisi_wakasek.php" class="tab">
<i class="fas fa-file-signature"></i> Daftar Pengajuan Remisi
</a>

<a href="riwayat_remisi.php" class="tab">
<i class="fas fa-history"></i> Riwayat Remisi
</a>

<a href="rekap_poin_wakasek.php" class="tab active">
<i class="fas fa-chart-bar"></i> Rekap Poin Pelanggaran
</a>

</div>
</div>

<div class="card">

<div class="page-header">
<h1>Rekap Poin Pelanggaran Siswa</h1>
</div>

<div class="filter-box">

<select>
<option>Semester</option>
<option>Ganjil</option>
<option>Genap</option>
</select>

<select>
<option>Tahun Ajaran</option>
<option>2024/2025</option>
<option>2025/2026</option>
</select>

<form method="GET">
    <select name="kelas" onchange="this.form.submit()">

        <option value="">Semua Kelas</option>

        <option value="X TKJ"
        <?= ($kelas=='X TKJ') ? 'selected' : ''; ?>>
        X TKJ
        </option>

        <option value="XI TKJ"
        <?= ($kelas=='XI TKJ') ? 'selected' : ''; ?>>
        XI TKJ
        </option>

        <option value="XII TKJ"
        <?= ($kelas=='XII TKJ') ? 'selected' : ''; ?>>
        XII TKJ
        </option>

    </select>
</form>
</div>

<div class="table-container">

<table>

<thead>
<tr>
<th>No</th>
<th>NISN</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Total Poin Pelanggaran</th>
<th>Total Remisi</th>
<th>Poin Akhir</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;
while($s = mysqli_fetch_assoc($rekap)){
?>

<tr>
    

    <td><?= $no++; ?></td>
    <td><?= $s['nisn']; ?></td>
   <td>
   <a class="nama-siswa" href="detail_rekap_poin.php?id=<?= $s['id_siswa']; ?>">
    <?= $s['nama_siswa']; ?>
</a>
</td>
    <td><?= $s['kelas']; ?></td>

    <?php
$pelanggaran = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(jp.poin) AS total
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='".$s['id_siswa']."'
"));

$total_pelanggaran = $pelanggaran['total'] ?? 0;
?>

<td><?= $total_pelanggaran; ?></td>
    <?php

$remisi = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(poin_remisi) AS total_remisi
FROM pengajuan_remisi
WHERE id_siswa='".$s['id_siswa']."'
AND status='Disetujui'
"));

$remisi_otomatis = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(persen_remisi) AS total_otomatis
FROM remisi_otomatis
WHERE id_siswa='".$s['id_siswa']."'
"));

$total_remisi =
($remisi['total_remisi'] ?? 0)
+
($remisi_otomatis['total_otomatis'] ?? 0);

?>

<td><?= $total_remisi; ?>%</td>
    <?php

$nilai_remisi = round(($total_pelanggaran * $total_remisi) / 100);

$poin_akhir = max(
    0,
    round($total_pelanggaran - $nilai_remisi)
);

?>

<td>
    <span class="badge-poin">
        <?= $poin_akhir; ?> Poin
    </span>
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

<div class="table-footer">

<a href="dashboard_wakasek.php" class="btn-back">
<i class="fas fa-chevron-left"></i>
</a>

<div class="pagination">

    <a href="#" class="page">
        <i class="fas fa-chevron-left"></i>
    </a>

    <a href="#" class="page active">1</a>
    <a href="#" class="page">2</a>
    <a href="#" class="page">3</a>

    <a href="#" class="page">
        <i class="fas fa-chevron-right"></i>
    </a>

</div>

<button class="btn-download">
<i class="fas fa-download"></i>
Unduh
</button>

</div>

</div>

</div>

</body>
</html>

