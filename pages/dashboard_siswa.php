<?php
session_start();
include "../config/koneksi.php";

$nama = $_SESSION['nama'] ?? 'Siswa';
$total = 0;
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

            <a href="riwayat_pelanggaran.php"
            class="menu-link">

                <i class="fas fa-triangle-exclamation"></i>

                <span>Riwayat Pelanggaran</span>

            </a>

            <a href="riwayat_komunikasi_siswa.php"
            class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Komunikasi Orang Tua</span>

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

            <div class="user-dropdown">

                <div class="avatar">

                    <i class="fas fa-user-graduate"></i>

                </div>

                <span><?= $nama; ?></span>

            </div>

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

                <div class="notif-icon">

                    <i class="fas fa-bell"></i>

                    <span class="notif-badge">1</span>

                </div>

                <p>Pelanggaran Hari Ini</p>

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

    <div class="bar-item">
        <span>2</span>
        <div class="bar bar-jan"></div>
        <small>Jan</small>
    </div>

    <div class="bar-item">
        <span>4</span>
        <div class="bar bar-feb"></div>
        <small>Feb</small>
    </div>

    <div class="bar-item">
        <span>6</span>
        <div class="bar bar-mar"></div>
        <small>Mar</small>
    </div>

</div>

<div class="chart-footer">
    Statistik Pelanggaran Per-bulan
</div>

            </div>

            <!-- Aktivitas PELANGGARAN -->

            <div class="dashboard-card">

    <div class="card-header">

        <div class="header-icon">
            <i class="fas fa-triangle-exclamation"></i>
        </div>

        <h3>Aktivitas Pelanggaran</h3>

    </div>

    <div class="donut-wrapper">

        <div class="donut-chart">

            <div class="donut-content">
                <h2><?= $total; ?></h2>
            </div>

        </div>

    </div>

    

    <div class="date-box">

        <i class="fas fa-calendar-days"></i>

        <div>
            <h4><?= date('d F Y'); ?></h4>
            <span>Tanggal Berjalan</span>
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