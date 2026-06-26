<?php
include "../config/koneksi.php";
session_start();

// role
$role = $_SESSION['role'];
$kelasLogin = $_SESSION['kelas'];

$where = "";

if($role == 'wali_kelas'){
    $where = "WHERE ds.kelas='$kelasLogin'";
}

/* FILTER */
$nama  = $_GET['nama'] ?? '';
$kelas = $_GET['kelas'] ?? '';

$role = $_SESSION['role'];
$kelasLogin = $_SESSION['kelas'];

$where = "WHERE 1=1";

if($role == 'wali_kelas'){
    $where .= " AND ds.kelas='$kelasLogin'";
}

if($nama != ''){
    $where .= " AND ds.nama_siswa LIKE '%$nama%'";
}

if($kelas != ''){
    $where .= " AND ds.kelas LIKE '%$kelas%'";
}

/* QUERY RIWAYAT REMISI SEMUA SISWA */

$query = mysqli_query($koneksi,"
SELECT
    pr.id_siswa,
    ds.nama_siswa,
    ds.kelas,
    pr.tanggal_pengajuan,
    pr.nama_prestasi,
    pr.poin_remisi,
    pr.status,
    pr.bukti
FROM pengajuan_remisi pr
JOIN data_siswa ds
ON pr.id_siswa = ds.id_siswa
$where
ORDER BY pr.tanggal_pengajuan DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Remisi Wali Kelas</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    font-family:Poppins;
    background:#f5f7fb;
    padding:25px;
}

/* CONTAINER */
.container{
    max-width:1100px;
    margin:auto;
}

/* CARD */
.card{
    background:#fff;
    padding:25px;
    border-radius:18px;
    margin-bottom:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* TITLE */
h1{
    color:#15803d;
}

/* FILTER */
.filter{
    display:flex;
    gap:10px;
    margin-top:15px;
}

input{
    padding:10px;
    border:1px solid #ddd;
    border-radius:10px;
}

/* BUTTON */
button{
    padding:10px 15px;
    background:#16a34a;
    color:#fff;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#dcfce7;
    color:#166534;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* STATUS */
.status{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
}

.menunggu{background:#fef9c3;color:#92400e;}
.disetujui{background:#dcfce7;color:#166534;}
.ditolak{background:#fee2e2;color:#991b1b;}

/* LINK */
a{
    text-decoration:none;
    color:#2563eb;
    background:#eff6ff;
    padding:6px 10px;
    border-radius:8px;
}

/* =========================
   TAB MENU (WAJIB TAMBAH)
========================= */

.tab-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.tab-menu{
    display:flex;
    width:100%;
}

.tab{
    flex:1;
    text-align:center;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;

    padding:18px 10px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    border-right:1px solid #e5e7eb;
    transition:.25s;
}

.tab:last-child{
    border-right:none;
}

.tab:hover{
    background:#f0fdf4;
    color:#16a34a;
}

.tab.active{
    background:#16a34a;
    color:#fff;
}
</style>
</head>
<body>

<div class="container">
    <!-- TAB MENU -->
<div class="tab-card">
    <div class="tab-menu">

        <a href="penilaian_poin_pelanggaran.php" class="tab">
            <i class="fas fa-file-signature"></i>
            Pengajuan Remisi
        </a>

        <a href="riwayat_remisi_walikelas.php" class="tab active">
            <i class="fas fa-history"></i>
            Riwayat Remisi Siswa
        </a>

        <a href="rekap_poin_walikelas.php" class="tab">
            <i class="fas fa-chart-bar"></i>
            Rekap Poin Pelanggaran 
        </a>

    </div>
</div>

<!-- HEADER -->
<div class="card">

    <h1>Riwayat Remisi Siswa</h1>
    <p>Semua pengajuan remisi siswa</p>

    <!-- FILTER -->
    <form method="GET" class="filter">

        <input type="text" name="nama" placeholder="Cari nama siswa">

        <input type="text" name="kelas" placeholder="Kelas">

        <button>Cari</button>

    </form>

</div>

<!-- TABLE -->
<div class="card">

<table>

<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Tanggal</th>
    <th>Prestasi</th>
    <th>Remisi</th>
    <th>Bukti</th>
    <th>Status</th>
</tr>

<?php $no=1; while($r=mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['nama_siswa']; ?></td>
    <td><?= $r['kelas']; ?></td>
    <td><?= $r['tanggal_pengajuan']; ?></td>
    <td><?= $r['nama_prestasi']; ?></td>
    <td><?= $r['poin_remisi']; ?>%</td>

    <td>
        <?php if($r['bukti']){ ?>
            <a href="../upload/bukti_remisi/<?= $r['bukti']; ?>" target="_blank">
                Lihat
            </a>
        <?php } ?>
    </td>

    <td>
        <span class="status <?= strtolower($r['status']); ?>">
            <?= $r['status']; ?>
        </span>
    </td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>