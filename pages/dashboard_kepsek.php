
<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'kepala_sekolah'){
    header("Location: login.php");
    exit;
}
/* =========================================
   FILTER SEMESTER & TAHUN
========================================= */
$semester = $_GET['semester'] ?? 'Genap';
$tahun    = $_GET['tahun'] ?? date('Y');

/* =========================================
   MENENTUKAN RENTANG BULAN
========================================= */
if($semester == 'Ganjil'){
    $bulan_awal  = 7;
    $bulan_akhir = 12;
}else{
    $bulan_awal  = 1;
    $bulan_akhir = 6;
}

/* =========================================
   QUERY STATISTIK PELANGGARAN
   Menghitung jumlah pelanggaran setiap kelas
   berdasarkan semester & tahun
========================================= */
$queryStatistik = mysqli_query($koneksi, "
    SELECT
        s.kelas,
        COUNT(*) AS total_pelanggaran
    FROM pelanggaran_siswa p
    JOIN data_siswa s
        ON p.id_siswa = s.id_siswa
    WHERE MONTH(p.tanggal) BETWEEN '$bulan_awal' AND '$bulan_akhir'
      AND YEAR(p.tanggal) = '$tahun'
    GROUP BY s.kelas
    ORDER BY s.kelas
");

/* =========================================
   CEK ERROR QUERY
========================================= */
if (!$queryStatistik) {
    die(mysqli_error($koneksi));
}

/* =========================================
   SIMPAN HASIL QUERY KE ARRAY
========================================= */
$dataStatistik = [];

while ($row = mysqli_fetch_assoc($queryStatistik)) {
    $dataStatistik[] = $row;
}

/* =========================================
   TOTAL PELANGGARAN
   Berdasarkan semester & tahun
========================================= */
$queryTotalPelanggaran = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM pelanggaran_siswa
    WHERE MONTH(tanggal) BETWEEN '$bulan_awal' AND '$bulan_akhir'
      AND YEAR(tanggal) = '$tahun'
");

$totalPelanggaran = mysqli_fetch_assoc($queryTotalPelanggaran);

/* =========================================
   JUMLAH PENGAJUAN REMISI MENUNGGU
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

            <a href="riwayat_pelanggaran_siswa.php"
            class="menu-link">

                <i class="fas fa-triangle-exclamation"></i>

                <span>Riwayat Pelanggaran Siswa</span>

            </a>

            <a href="rekap_poin_kepsek.php"
            class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Penilaian Pelanggaran</span>

            </a>

             <a href="riwayat_tindak_lanjut_kepsek.php"
            class="menu-link">

                <i class="fas fa-phone"></i>

                <span>Riwayat Pembinaan Siswa</span>

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

    <!-- FILTER -->

    <form method="GET" class="filter-dashboard">

        <select name="semester" onchange="this.form.submit()">
            <option value="Ganjil" <?= $semester=='Ganjil'?'selected':''; ?>>
                Semester Ganjil
            </option>

            <option value="Genap" <?= $semester=='Genap'?'selected':''; ?>>
                Semester Genap
            </option>
        </select>

        <select name="tahun" onchange="this.form.submit()">

            <?php
            for($t=date('Y'); $t>=2024; $t--){
            ?>

            <option value="<?= $t; ?>" <?= $tahun==$t?'selected':''; ?>>
                <?= $t; ?>
            </option>

            <?php } ?>

        </select>

    </form>

    <?php
    $warna = [
        "#16a34a",
        "#4ade80",
        "#84cc16",
        "#fbbf24",
        "#fb923c",
        "#ef4444",
        "#3b82f6",
        "#8b5cf6",
        "#ec4899",
        "#14b8a6",
        "#f97316",
        "#0ea5e9"
    ];

    $maxData = 1;

    foreach($dataStatistik as $d){
        if($d['total_pelanggaran'] > $maxData){
            $maxData = $d['total_pelanggaran'];
        }
    }

    $i = 0;
    ?>

    <div class="chart-container">

        <?php foreach($dataStatistik as $data): ?>

        <?php
        $tinggi = max(5, ($data['total_pelanggaran'] / $maxData) * 180);
        ?>

        <div class="bar-item">

            <span><?= $data['total_pelanggaran']; ?></span>

            <div
                class="bar"
                style="
                    height:<?= $tinggi; ?>px;
                    background:<?= $warna[$i++ % count($warna)]; ?>;
                ">
            </div>

            <small><?= $data['kelas']; ?></small>

        </div>

        <?php endforeach; ?>

    </div>

    <div class="chart-footer">
        Statistik Pelanggaran Seluruh Kelas
        Semester <?= $semester; ?>
        Tahun <?= $tahun; ?>
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
