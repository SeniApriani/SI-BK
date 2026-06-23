
<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'kepala_sekolah'){
    header("Location: login.php");
    exit;
}

/* =========================================
   BULAN & TAHUN BERJALAN
========================================= */
$bulan = date('m');
$tahun = date('Y');

/* =========================================
   QUERY STATISTIK PELANGGARAN
   Menghitung jumlah pelanggaran per kelas
   pada bulan yang sedang berjalan
========================================= */
$queryStatistik = mysqli_query($koneksi, "
    SELECT
        s.kelas,
        COUNT(*) AS total_pelanggaran
    FROM pelanggaran_siswa p
    JOIN data_siswa s
        ON p.id_siswa = s.id_siswa
   WHERE MONTH(p.tanggal) = '$bulan'
AND YEAR(p.tanggal) = '$tahun'
    GROUP BY s.kelas
");


/* =========================================
   CEK ERROR QUERY
========================================= */
if (!$queryStatistik) {
    die(mysqli_error($koneksi));
}


/* =========================================
   SIMPAN HASIL QUERY KE ARRAY
   Untuk digunakan pada grafik/dashboard
========================================= */
$dataStatistik = [];

while ($row = mysqli_fetch_assoc($queryStatistik)) {
    $dataStatistik[] = $row;
}

/* =========================================
   TOTAL PELANGGARAN BULAN & TAHUN BERJALAN
========================================= */
$queryTotalPelanggaran = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM pelanggaran_siswa
    WHERE MONTH(tanggal) = '$bulan'
    AND YEAR(tanggal) = '$tahun'
");

$totalPelanggaran = mysqli_fetch_assoc($queryTotalPelanggaran);

/* =========================================
   JUMLAH PENGAJUAN REMISI MENUNGGU
   Untuk badge notifikasi Wakasek
========================================= */
$queryRemisi = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM pengajuan_remisi
    WHERE status = 'Menunggu'
");

$totalRemisi = mysqli_fetch_assoc($queryRemisi);
?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Kepala Sekolah</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/1_style.css">

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

            <a href="#"
            class="menu-link">

                <i class="fas fa-triangle-exclamation"></i>

                <span>Data Pelanggaran Siswa</span>

            </a>

            <a href="#"
            class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Monitoring Poin Siswa</span>

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

            <div class="user-dropdown">

                <div class="avatar">

                    <i class="fas fa-user-tie"></i>

                </div>

                <span>Kepala Sekolah</span>

                <i class="fas fa-chevron-down"></i>

            </div>

        </header>

        <!-- WELCOME -->

        <section class="welcome-banner">

    <div class="welcome-left">

        <div class="welcome-banner-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>

        <div class="welcome-banner-text">
            <h1>Selamat Datang!</h1>
            <p>Sistem Informasi Bimbingan Konseling</p>
            <p>Penanganan Pelanggaran Siswa</p>
        </div>

    </div>
</section>

         <!-- DASHBOARD CARD -->

        <section class="dashboard-grid">

            <!-- STATISTIK -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div class="header-icon">

                        <i class="fas fa-chart-column"></i>

                    </div>

                    <h3>Statistik Pelanggaran</h3>

                </div>

             <div class="chart-container">

<?php foreach($dataStatistik as $data): ?>

    <div class="bar-item">
        <span><?= $data['total_pelanggaran']; ?></span>

        <div
            class="bar"
            style="height: <?= $data['total_pelanggaran'] * 20; ?>px;">
        </div>

        <small><?= $data['kelas']; ?></small>
    </div>

<?php endforeach; ?>

</div>
                <div class="chart-footer">

                    Berdasarkan Tingkat Kelas

                </div>

            </div>

            <!-- TOTAL PELANGGARAN -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div class="header-icon">

                        <i class="fas fa-triangle-exclamation"></i>

                    </div>

                    <h3>Jumlah Pelanggaran</h3>

                </div>

                <div class="donut-wrapper">

                    <div class="donut-chart">

                        <div class="donut-content">
<h2><?= $totalPelanggaran['total']; ?></h2>

                            

                        </div>

                    </div>

                </div>

                <div class="date-box">

                    <i class="fas fa-calendar-days"></i>

                    <div>

                        <h4>Selasa, 03 Juni 2026</h4>

                    </div>

                </div>

            </div>

        </section>

        <footer>

            © 2026 SMK PUI Jatinangor. All rights reserved.

        </footer>

    </main>

</div>


<script>

const sidebar = document.getElementById("sidebar");
const sidebarToggle = document.getElementById("sidebarToggle");

sidebarToggle.addEventListener("click", function(){

    sidebar.classList.toggle("collapsed");

});

document.querySelectorAll(".menu-toggle").forEach(menu => {

    menu.addEventListener("click", () => {

        menu.parentElement.classList.toggle("open");

    });

});

</script>

</body>
</html>

