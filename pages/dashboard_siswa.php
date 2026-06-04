<?php
session_start();
include "../config/koneksi.php";

$nisn = $_SESSION['id_siswa'] ?? '';
$nama = $_SESSION['nama'] ?? 'Siswa';

// data pelanggaran
$data = mysqli_query($koneksi,"
    SELECT * FROM pelanggaran_siswa 
    WHERE id_siswa='$nisn'
");

// total pelanggaran
$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Siswa</title>

<link rel="stylesheet" href="../assets/css/1_style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="sidebar-header">
        <img src="../assets/logo.png">
        <div class="logo-text">
            <h3>SI-BK</h3>
            <p>Siswa</p>
        </div>
    </div>

    <div class="sidebar-menu">

        <a class="menu-link current" href="#">
            <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>

        <a class="menu-link" href="#">
            <i class="fas fa-list"></i> <span>Riwayat Pelanggaran</span>
        </a>

        <a class="menu-link" href="#">
            <i class="fas fa-comments"></i> <span>Komunikasi Orang Tua</span>
        </a>

        <a class="menu-link" href="#">
            <i class="fas fa-file"></i> <span>Pengajuan Remisi</span>
        </a>

        <a class="menu-link" href="logout.php">
            <i class="fas fa-right-from-bracket"></i> <span>Logout</span>
        </a>

    </div>

</div>

<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-title">
            <h2>Dashboard Siswa</h2>
        </div>

        <div class="user-dropdown">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <span><?= $nama; ?></span>
        </div>
    </div>

    <!-- WELCOME -->
    <div class="welcome-banner">

        <div class="welcome-left">
            <div class="welcome-banner-icon">
                <i class="fas fa-user-graduate"></i>
            </div>

            <div class="welcome-banner-text">
                <h1>Halo, <?= $nama; ?></h1>
                <p>Selamat datang di dashboard siswa SI-BK</p>
            </div>
        </div>

    </div>

    <!-- GRID -->
    <div class="dashboard-grid">

        <!-- STAT -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="header-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3>Total Pelanggaran</h3>
            </div>

            <h1 style="font-size:40px;color:#16a34a;">
                <?= $total; ?>
            </h1>

        </div>

        <!-- MINI CHART -->
        <div class="dashboard-card">

            <div class="card-header">
                <div class="header-icon">
                    <i class="fas fa-chart-column"></i>
                </div>
                <h3>Aktivitas Pelanggaran</h3>
            </div>

            <div class="chart-footer">
                Grafik berdasarkan data pelanggaran siswa
            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="dashboard-card" style="margin-top:18px;">

        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-table"></i>
            </div>
            <h3>Riwayat Pelanggaran</h3>
        </div>

        <table class="table">
            <tr>
                <th>No</th>
                <th>Pelanggaran</th>
                <th>Tanggal</th>
                <th>Poin</th>
            </tr>

            <?php $no=1; while($row=mysqli_fetch_assoc($data)){ ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['jenis_pelanggaran']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['poin']; ?></td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</div>

</body>
</html>