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
// MENGAMBIL TOTAL SALDO POIN ANAK
// ======================================================

$q = mysqli_fetch_assoc(mysqli_query($koneksi,"

SELECT
100 +
COALESCE(SUM(poin),0) AS saldo

FROM(

    /* TOTAL POIN PELANGGARAN */

    SELECT -ps.poin AS poin

    FROM pelanggaran_siswa ps

    WHERE ps.id_siswa='$id_siswa'

    UNION ALL

    /* REMISI PRESTASI */

    SELECT pr.potongan_poin

    FROM pengajuan_remisi pr

    WHERE pr.id_siswa='$id_siswa'
    AND pr.status='Disetujui'

    UNION ALL

    /* REMISI OTOMATIS */

    SELECT ro.potongan_poin

    FROM remisi_otomatis ro

    WHERE ro.id_siswa='$id_siswa'

)x

"));

$total = $q['saldo'];

// ======================================================
// JUMLAH PELANGGARAN BULAN INI
// ======================================================

$bulan = date('m');
$tahun = date('Y');

$aktivitas_bulan_ini = mysqli_fetch_assoc(mysqli_query($koneksi,"

SELECT COUNT(*) AS jml

FROM pelanggaran_siswa

WHERE id_siswa='$id_siswa'

AND MONTH(tanggal)='$bulan'

AND YEAR(tanggal)='$tahun'

"))['jml'];

// ======================================================
// MENGAMBIL NAMA SISWA
// ======================================================

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
        ======================================================= -->

        <section class="dashboard-grid">

            <!-- ======================================================
                 CARD 1
                 MENAMPILKAN SALDO POIN PELANGGARAN SISWA
            ======================================================= -->

            <div class="dashboard-card">

                <a href="rekap_poin_siswa.php?id=<?= $id_siswa; ?>"
                style="text-decoration:none;color:inherit;">

                <div class="card-header">

                    <div class="header-icon">

                        <i class="fas fa-star"></i>

                    </div>

                    <h3>Saldo Poin Pelanggaran</h3>

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

                </a>

            </div>

            <!-- ======================================================
                 CARD 2
                 MENAMPILKAN JUMLAH PELANGGARAN BULAN INI
            ======================================================= -->

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