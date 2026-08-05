<?php
// ======================================================
// DASHBOARD ORANG TUA
// ======================================================

// ======================================================
// MEMANGGIL SESSION DAN KONEKSI DATABASE
// ======================================================

session_start();
include "../config/koneksi.php";

// ======================================================
// MENGAMBIL DATA LOGIN
// ======================================================

// id_siswa didapat dari tabel users
$id_siswa = $_SESSION['id_siswa'];

$nama = $_SESSION['nama'] ?? 'Orang Tua';

// ======================================================
// MENGAMBIL NAMA SISWA
// ======================================================
// Catatan: saldo poin & jumlah pelanggaran bulan ini SUDAH TIDAK
// diquery/ditampilkan di sini karena data tersebut hanya relevan
// dan sudah ditampilkan di dashboard SISWA. Dashboard orang tua
// cukup menampilkan identitas anak + akses ke halaman rekap.

$siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"

SELECT nama_siswa

FROM data_siswa

WHERE id_siswa='$id_siswa'

"));


$nama_siswa = $siswa['nama_siswa'];

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Orang Tua</title>

<!-- ======================================================
     GOOGLE FONT
====================================================== -->

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- ======================================================
     FONT AWESOME
====================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- ======================================================
     CSS DASHBOARD
     MENGGUNAKAN CSS YANG SAMA DENGAN DASHBOARD SISWA
====================================================== -->

<link
rel="stylesheet"
href="../assets/css/2_style.css">

</head>
<body>

<div class="wrapper">

    <!-- ======================================================
         SIDEBAR
    ======================================================= -->

    <aside class="sidebar" id="sidebar">

        <!-- ======================================================
             HEADER SIDEBAR
        ======================================================= -->

        <div class="sidebar-header">

            <img src="../assets/img/g_logo_pui.png" alt="Logo">

            <div class="logo-text">

                <h3>SMK PUI JATINANGOR</h3>

                <p>Sistem Informasi Bimbingan Konseling</p>

            </div>

            <!-- Tombol buka/tutup sidebar -->

            <button id="sidebarToggle" class="sidebar-btn">

                <i class="fas fa-bars"></i>

            </button>

        </div>

        <!-- ======================================================
             MENU SIDEBAR
        ======================================================= -->

        <div class="sidebar-menu">

            <!-- Dashboard -->

            <a href="#" class="menu-link current">

                <i class="fas fa-house"></i>

                <span>Dashboard</span>

            </a>

            <!-- Riwayat Pelanggaran -->

            <a href="riwayat_pelanggaran_siswa.php"
               class="menu-link">

                <i class="fas fa-triangle-exclamation"></i>

                <span>Riwayat Pelanggaran Anak</span>

            </a>

            <!-- Riwayat Komunikasi -->

            <a href="riwayat_komunikasi_siswa.php"
               class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Riwayat Pembinaan</span>

            </a>

        </div>

        <!-- ======================================================
             LOGOUT
        ======================================================= -->

        <a href="logout.php"
           class="menu-link logout-link">

            <i class="fas fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

    </aside>

    <!-- ======================================================
         CONTENT
    ======================================================= -->

    <main class="content">

        <!-- ======================================================
             TOPBAR
        ======================================================= -->

        <header class="topbar">

            <div class="topbar-title">

                <h2>Dashboard Orang Tua</h2>

            </div>

            <!-- Nama orang tua yang sedang login -->

            <div class="user-dropdown">

                <div class="avatar">

                    <i class="fas fa-user"></i>

                </div>

                <span><?= $nama; ?></span>

            </div>

        </header>

        <!-- ======================================================
             WELCOME BANNER
        ======================================================= -->

        <section class="welcome-banner">

            <div class="welcome-left">

                <div class="welcome-banner-icon">

                    <i class="fas fa-users"></i>

                </div>

                <div class="welcome-banner-text">

                    <h1>Halo, <?= $nama; ?></h1>

                    <p>Selamat Datang di Sistem Informasi Bimbingan Konseling</p>

                    <p>Monitoring Pelanggaran Siswa</p>

                    <br>

                    <p>

                        <strong>Nama Siswa :</strong>

                        <?= $nama_siswa; ?>

                    </p>

                </div>

            </div>

        </section>

        <!-- ======================================================
             DASHBOARD CARD
             Saldo poin & pelanggaran bulan ini SENGAJA TIDAK
             ditampilkan di sini (itu porsi dashboard siswa).
             Orang tua cukup diberi akses cepat ke halaman rekap
             berupa kartu visual (ikon), bukan angka live.
        ======================================================= -->

        <section class="dashboard-grid">

            <!-- ======================================================
                 CARD REKAP
                 KARTU VISUAL MENUJU HALAMAN REKAP / RIWAYAT PELANGGARAN
            ======================================================= -->

            <div class="dashboard-card">

                <a href="riwayat_pelanggaran_siswa.php"
                style="text-decoration:none;color:inherit;">

                <div class="card-header">

                    <div class="header-icon">

                        <i class="fas fa-clipboard-list"></i>

                    </div>

                    <h3>Rekap Pelanggaran Anak</h3>

                </div>

                <div
                style="
                display:flex;
                justify-content:center;
                align-items:center;
                height:160px;
                flex-direction:column;
                ">

                    <div
                    style="
                    font-size:56px;
                    color:#dc2626;
                    ">

                        <i class="fas fa-file-lines"></i>

                    </div>

                    <p style="margin-top:10px;color:#6b7280;">

                        Lihat Rekap &amp; Riwayat Lengkap

                    </p>

                </div>

                </a>

            </div>

            <!-- ======================================================
                 CARD RIWAYAT PEMBINAAN
                 KARTU VISUAL MENUJU HALAMAN RIWAYAT KOMUNIKASI/PEMBINAAN
            ======================================================= -->

            <div class="dashboard-card">

                <a href="riwayat_komunikasi_siswa.php"
                style="text-decoration:none;color:inherit;">

                <div class="card-header">

                    <div class="header-icon">

                        <i class="fas fa-phone"></i>

                    </div>

                    <h3>Riwayat Pembinaan</h3>

                </div>

                <div
                style="
                display:flex;
                justify-content:center;
                align-items:center;
                height:160px;
                flex-direction:column;
                ">

                    <div
                    style="
                    font-size:56px;
                    color:#2563eb;
                    ">

                        <i class="fas fa-comments"></i>

                    </div>

                    <p style="margin-top:10px;color:#6b7280;">

                        Lihat Riwayat Komunikasi &amp; Pembinaan

                    </p>

                </div>

                </a>

            </div>

        </section>

    </main>

</div>

<!-- ======================================================
     JAVASCRIPT
     MEMBUKA DAN MENUTUP SIDEBAR
====================================================== -->

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