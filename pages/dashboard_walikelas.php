
<?php
session_start();
include '../config/koneksi.php';

$nama  = $_SESSION['nama'];
$kelas = $_SESSION['kelas']; // kelas wali kelas yang login

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
   Menampilkan jumlah pelanggaran
   setiap bulan pada semester yang dipilih
========================================= */
$queryStatistik = mysqli_query($koneksi,"
SELECT
    MONTH(p.tanggal) AS bulan,
    COUNT(*) AS total_pelanggaran
FROM pelanggaran_siswa p
JOIN data_siswa s
ON p.id_siswa = s.id_siswa
WHERE MONTH(p.tanggal) BETWEEN '$bulan_awal' AND '$bulan_akhir'
AND YEAR(p.tanggal)='$tahun'
AND s.kelas='$kelas'
GROUP BY MONTH(p.tanggal)
ORDER BY MONTH(p.tanggal)
");

if(!$queryStatistik){
    die(mysqli_error($koneksi));
}

/* =========================================
   MENYIAPKAN DATA GRAFIK
   Agar semua bulan tetap tampil
========================================= */
$dataStatistik = [];

for($i=$bulan_awal;$i<=$bulan_akhir;$i++){
    $dataStatistik[$i]=0;
}

while($row=mysqli_fetch_assoc($queryStatistik)){
    $dataStatistik[$row['bulan']]=$row['total_pelanggaran'];
}

/* =========================================
   NAMA BULAN
========================================= */
$namaBulan=[
1=>"Jan",
2=>"Feb",
3=>"Mar",
4=>"Apr",
5=>"Mei",
6=>"Jun",
7=>"Jul",
8=>"Ags",
9=>"Sep",
10=>"Okt",
11=>"Nov",
12=>"Des"
];

/* =========================================
   TOTAL PELANGGARAN
   Berdasarkan semester & tahun
========================================= */
$queryTotalPelanggaran=mysqli_query($koneksi,"
SELECT COUNT(*) AS total
FROM pelanggaran_siswa p
JOIN data_siswa s
ON p.id_siswa=s.id_siswa
WHERE MONTH(p.tanggal) BETWEEN '$bulan_awal' AND '$bulan_akhir'
AND YEAR(p.tanggal)='$tahun'
AND s.kelas='$kelas'
");

$totalPelanggaran=mysqli_fetch_assoc($queryTotalPelanggaran);

/* =========================================
   JUMLAH PENGAJUAN REMISI
========================================= */
$queryRemisi=mysqli_query($koneksi,"
SELECT COUNT(*) AS total
FROM pengajuan_remisi
WHERE status='Menunggu'
");

$totalRemisi=mysqli_fetch_assoc($queryRemisi);
?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Wali Kelas</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/3_style.css">

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

            <!-- DATA MASTER -->
            <div class="menu-group">

                <button class="menu-toggle">

                    <div>

                        <i class="fas fa-database"></i>

                        <span>Data Master</span>

                    </div>

                    <i class="fas fa-chevron-down arrow"></i>

                </button>

                <div class="submenu">

                    <a href="data_siswa.php">

                        <i class="fas fa-user-graduate"></i>

                        Data Siswa

                    </a>

                    <a href="data_orang_tua.php">

                        <i class="fas fa-user-graduate"></i>

                        Data Orang Tua

                    </a>

                    <!-- <a href="jenis_pelanggaran.php">

                        <i class="fas fa-list"></i>

                        Data Jenis Pelanggaran

                    </a> -->

                </div>

            </div>

            <!-- PELANGGARAN -->
            <div class="menu-group">

                <button class="menu-toggle">

                    <div>

                        <i class="fas fa-triangle-exclamation"></i>

                        <span>Pelanggaran Siswa</span>

                    </div>

                    <i class="fas fa-chevron-down arrow"></i>

                </button>

                <div class="submenu">

                    <a href="data_pelanggaran_siswa.php">

                        <i class="fas fa-file-circle-exclamation"></i>

                        Data Pelanggaran Siswa

                    </a>

                    <a href="penilaian_poin_pelanggaran.php">

                        <i class="fas fa-star"></i>

                        Penilaian Pelanggaran

                    </a>

                    
                    <a href="catatan_semester.php">

                        <i class="fas fa-star"></i>

                       Catatan Semester

                    </a>

                </div>

            </div>

            <!-- TINDAK LANJUT -->
            <div class="menu-group">

                <button class="menu-toggle">

                    <div>

                        <i class="fas fa-comments"></i>

                        <span>Tindak Lanjut</span>

                    </div>

                    <i class="fas fa-chevron-down arrow"></i>

                </button>
<div class="submenu">
    <a href="komunikasi_orangtua.php">
        <i class="fas fa-phone"></i>
        Komunikasi Orang Tua
    </a>
    <a href="pemanggilan_siswa.php">
        <i class="fas fa-phone"></i>
        Riwayat Pemanggilan Siswa
    </a>
</div>
            </div>

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

                <h3>Dashboard Wali Kelas</h3>
            </div>
            <a href="profil_walas.php" class="user-dropdown" style="text-decoration:none; color:inherit;">
                <div class="avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span><?= $nama; ?> </span>
                <i class="fas fa-chevron-down"></i>
            </a>
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

        <!-- =========================================
DASHBOARD
========================================= -->

<section class="dashboard-grid">

    <div class="dashboard-card">

        <div class="card-header">

            <div class="header-icon">
                <i class="fas fa-chart-column"></i>
            </div>

            <h3>Statistik Pelanggaran Siswa</h3>

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

        <!-- GRAFIK -->

        <div class="chart-container">

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

$maxData = max($dataStatistik);
$minData = min($dataStatistik);

if($maxData == $minData){
    $maxData = $minData + 1;
}

$i = 0;

foreach($dataStatistik as $bulan => $total):

    $tinggi = 40 + (($total - $minData) / ($maxData - $minData)) * 140;
?>

<div class="bar-item">

    <span><?= $total; ?></span>

    <div class="bar"
         style="
            height:<?= $tinggi ?>px;
            background:<?= $warna[$i++] ?>;
         ">
    </div>

    <small><?= $namaBulan[$bulan]; ?></small>

</div>

<?php endforeach; ?>
        </div>

        <div class="chart-footer">
            Statistik Pelanggaran Kelas <?= $kelas; ?>
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
