<?php
session_start();
include "../config/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];
$nama = $_SESSION['nama'] ?? 'Siswa';

// TOTAL SALDO POIN
$q = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT
100 +
COALESCE(SUM(poin),0) AS saldo
FROM (

    SELECT -ps.poin AS poin
    FROM pelanggaran_siswa ps
    WHERE ps.id_siswa='$id_siswa'

    UNION ALL

    SELECT pr.potongan_poin
    FROM pengajuan_remisi pr
    WHERE pr.id_siswa='$id_siswa'
    AND pr.status='Disetujui'

    UNION ALL

    SELECT ro.potongan_poin
    FROM remisi_otomatis ro
    WHERE ro.id_siswa='$id_siswa'

) x
"));

$total = $q['saldo'];
if($total > 100){
    $total = 100;
}

/* =========================================
   AKTIVITAS PELANGGARAN BULAN BERJALAN
   Menghitung jumlah pelanggaran siswa
   pada bulan dan tahun saat ini
========================================= */
$bulan = date('m');
$tahun = date('Y');

$aktivitas_bulan_ini = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) AS jml
FROM pelanggaran_siswa
WHERE id_siswa='$id_siswa'
AND MONTH(tanggal)='$bulan'
AND YEAR(tanggal)='$tahun'
"))['jml'];

// NOTIF
$result = mysqli_query($koneksi,"
SELECT COUNT(*) AS jml
FROM notifikasi
WHERE id_user='$id_siswa'
AND status_baca=0
");

if(!$result){
    die(mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);
$notif_count = $data['jml'];


/* =========================================
   CEK PEMANGGILAN SISWA
   Mengambil pemanggilan yang masih
   berstatus Menunggu Pembinaan
========================================= */

$qPemanggilan = mysqli_query($koneksi, "
SELECT
    p.id_pemanggilan,
    p.tanggal_pemanggilan,
    p.keterangan,
    p.status
FROM pemanggilan_siswa p
JOIN pelanggaran_siswa ps
ON p.id_pelanggaran_siswa = ps.id
WHERE ps.id_siswa = '$id_siswa'
AND p.status = 'Menunggu Pembinaan'
ORDER BY p.tanggal_pemanggilan DESC
LIMIT 1
");

$pemanggilan = mysqli_fetch_assoc($qPemanggilan);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/2_style.css">

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <img src="../assets/img/g_logo_pui.png" alt="Logo">

            <div class="logo-text">

                <h3>SMK PUI JATINANGOR</h3>

                <p>Sistem Informasi Bimbingan Konseling</p>

            </div>

            <button id="sidebarToggle" class="sidebar-btn">

                <i class="fas fa-bars"></i>

            </button>

        </div>

        <div class="sidebar-menu">

            <a href="#" class="menu-link current">

                <i class="fas fa-house"></i>

                <span>Dashboard</span>

            </a>

            <a href="riwayat_pelanggaran_siswa.php"
            class="menu-link">

                <i class="fas fa-triangle-exclamation"></i>

                <span>Riwayat Pelanggaran</span>

            </a>

            <a href="riwayat_komunikasi_siswa.php"
            class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Riwayat Pembinaan</span>

            </a>

            <a href="pengajuan_remisi_siswa.php"
            class="menu-link">

                <i class="fas fa-file-circle-check"></i>

                <span>Pengajuan Remisi</span>

            </a>

           

        </div>

        <a href="logout.php" class="menu-link logout-link">

            <i class="fas fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

    </aside>

    <!-- CONTENT -->
    <main class="content">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-title">

                <h2>Dashboard</h2>

            </div>

            <a href="profile_siswa.php" class="user-dropdown" style="text-decoration:none;color:inherit;">
    <div class="avatar">
        <i class="fas fa-user-graduate"></i>
    </div>
    <span><?= $nama; ?></span>
</a>
        </header>

        <!-- WELCOME -->

        <section class="welcome-banner">

            <div class="welcome-left">

                <div class="welcome-banner-icon">

                    <i class="fas fa-user-graduate"></i>

                </div>

                <div class="welcome-banner-text">

                    <h1>Halo, <?= $nama; ?></h1>

                    <p>Selamat Datang di Sistem Informasi Bimbingan Konseling</p>

                    <p>Penanganan Pelanggaran Siswa</p>

                </div>

            </div>


           <div class="remisi-notification">
    <a href="baca_notif.php" class="notif-icon">
        <i class="fas fa-bell"></i>

        <?php if($notif_count > 0){ ?>
            <span class="notif-badge"><?= $notif_count ?></span>
        <?php } ?>
    </a>

    <p>Pelanggaran Hari Ini</p>

</div>

        </section>

        <!-- nontifikasi pemanggilan siswa -->
         <?php if($pemanggilan){ ?>

<div class="pemanggilan-alert">

    <div class="pemanggilan-icon">
        <i class="fas fa-bell"></i>
    </div>

    <div class="pemanggilan-content">

        <h3>Pemanggilan dari Wali Kelas</h3>

        <p>
            <strong>Jadwal :</strong>
            <?= date('d-m-Y', strtotime($pemanggilan['tanggal_pemanggilan'])); ?>
        </p>

        <p>
            <strong>Keterangan :</strong>
            <?= $pemanggilan['keterangan']; ?>
        </p>

    </div>

</div>

<?php } ?>

        <!-- DASHBOARD CARD -->

       <section class="dashboard-grid">

    <!-- TOTAL POIN -->
    <div class="dashboard-card">
        <a href="rekap_poin_siswa.php?id=<?= $id_siswa ?>" style="text-decoration:none;color:inherit;">

        <div class="card-header">

            <div class="header-icon">
                <i class="fas fa-star"></i>
            </div>

            <h3>Saldo Poin Pelanggaran</h3>

        </div>

        <div style="
            display:flex;
            justify-content:center;
            align-items:center;
            height:160px;
            flex-direction:column;
        ">

            <div style="
                font-size:50px;
                font-weight:700;
                color:#dc2626;
            ">
                <?= $total; ?>
            </div>

            <p style="margin-top:10px;color:#6b7280;">
                Lihat Monitoring Poin
            </p>

        </div>

    </div>

    <!-- CARD 2 -->
    <div class="dashboard-card">

        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-triangle-exclamation"></i>
            </div>
          <h3>Pelanggaran Bulan Ini</h3>
        </div>

        <div class="donut-wrapper">
            <div class="donut-chart">
                <div class="donut-content">
                   <h2><?= $aktivitas_bulan_ini; ?></h2>
                </div>
            </div>
        </div>

        <div class="date-box">
            <i class="fas fa-calendar-days"></i>
            <div>
               <h4><?= date('F Y'); ?></h4>
                
            </div>
        </div>

    </div>

</section>

    </main>

</div>

<script>

const sidebar =
document.getElementById("sidebar");

const sidebarToggle =
document.getElementById("sidebarToggle");

sidebarToggle.addEventListener("click",function(){

    sidebar.classList.toggle("collapsed");

});

</script>

</body>
</html>