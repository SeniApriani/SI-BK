

<?php
session_start();
include "../config/koneksi.php";

$role = $_SESSION['role'];
$kelasLogin = $_SESSION['kelas'];

// PREDIKAT PHP
function predikat($poin){

    if($poin <= 25){
        return "A (Sangat Baik)";
    }
    elseif($poin <= 50){
        return "B (Baik)";
    }
    elseif($poin <= 75){
        return "C (Cukup)";
    }
    elseif($poin <= 100){
        return "D (Kurang)";
    }
    else{
        return "E (Sangat Kurang)";
    }

}
$kelas = $_GET['kelas'] ?? '';

// QUERY REKAP REALTIME


$where = "";

if($role == "wali_kelas"){

    $where = "WHERE ds.kelas='$kelasLogin'";

}else{

    if($kelas != ""){
        $where = "WHERE ds.kelas='$kelas'";
    }

}

$rekap = mysqli_query($koneksi,"
SELECT
    ds.id_siswa,
    ds.nisn,
    ds.nama_siswa,
    ds.kelas,
    COALESCE(rp.total_poin,0) AS total_poin,
    rp.updated_at
FROM data_siswa ds
LEFT JOIN rekap_poin rp
ON rp.id_siswa=ds.id_siswa
$where
ORDER BY ds.nama_siswa ASC
");

$no=1;
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

/* =========================
   TAB MENU
========================= */

.tab-card{
    background:#fff;
    border-radius:16px;
    overflow:hidden;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.tab-menu{
    display:grid;
    grid-template-columns:repeat(3,1fr);
}

.tab{
    text-decoration:none;
    color:#4b5563;
    font-size:15px;
    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    padding:22px 15px;

    border-right:1px solid #e5e7eb;

    transition:.3s;
}

.tab:last-child{
    border-right:none;
}

.tab i{
    font-size:15px;
}

.tab:hover{
    background:#f0fdf4;
    color:#16a34a;
}

.tab.active{
    background:#16a34a;
    color:#fff;
}

/* RESPONSIVE */

@media(max-width:768px){

    .tab-menu{
        grid-template-columns:1fr;
    }

    .tab{
        border-right:none;
        border-bottom:1px solid #e5e7eb;
    }

    .tab:last-child{
        border-bottom:none;
    }

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
    background:#dcfce7;;
    color:#16a34a;
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

<a href="penilaian_poin_pelanggaran.php" class="tab">
<i class="fas fa-file-signature"></i> Pengajuan Remisi
</a>

<a href="riwayat_remisi_walikelas.php" class="tab">
<i class="fas fa-history"></i> Riwayat Remisi Siswa
</a>

<a href="rekap_poin_walikelas.php" class="tab active">
<i class="fas fa-chart-bar"></i> Rekap Poin Pelanggaran
</a>

</div>
</div>

<div class="card">

<div class="page-header">
<h1>Rekap Poin Pelanggaran Siswa</h1>
</div>

<div class="filter-box">

</select>

<?php if($role=='wakasek'){ ?>

<form method="GET">

<select name="kelas" onchange="this.form.submit()">

    <option value="">Semua Kelas</option>

    <option value="X TKJ" <?= ($kelas=='X TKJ')?'selected':''; ?>>X TKJ</option>

    <option value="XI TKJ" <?= ($kelas=='XI TKJ')?'selected':''; ?>>XI TKJ</option>

    <option value="XII TKJ" <?= ($kelas=='XII TKJ')?'selected':''; ?>>XII TKJ</option>

</select>

</form>

<?php } ?>
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
<th>Poin Akhir</th>
</tr>
</thead>

<tbody>

<?php $no = 1; while($s = mysqli_fetch_assoc($rekap)) { ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $s['nisn']; ?></td>

    <td>
        <a class="nama-siswa" href="detail_rekap_poin.php?id=<?= $s['id_siswa']; ?>">
            <?= $s['nama_siswa']; ?>
        </a>
    </td>

    <td><?= $s['kelas']; ?></td>

    <td>
        <span class="badge-poin">
            <?= $s['total_poin']; ?> Poin
        </span>
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

<div class="table-footer">

<?php if($role=='wakasek'){ ?>
<a href="dashboard_wakasek.php" class="btn-back">
<?php } else { ?>
<a href="dashboard_walikelas.php" class="btn-back">
<?php } ?>

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

<a href="cetak_rekap_poin.php?kelas=<?= $kelas; ?>" class="btn-download">
    <i class="fas fa-download"></i>
    Unduh
</a>

</div>

</div>

</div>

</body>
</html>
