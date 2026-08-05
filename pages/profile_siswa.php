<?php
session_start();
include "../config/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

$q = mysqli_query($koneksi, "
SELECT
    nisn,
    nama_siswa,
    kelas
FROM data_siswa
WHERE id_siswa='$id_siswa'
");

if(!$q){
    die(mysqli_error($koneksi));
}

$siswa = mysqli_fetch_assoc($q);
$nama  = $siswa['nama_siswa'] ?? 'Siswa';
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profil Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/2_style.css">

<style>

.profile-card{
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    max-width:520px;
}

.profile-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#dcfce7;
    color:#16a34a;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    margin:0 auto 20px;
}

.profile-name{
    text-align:center;
    font-size:20px;
    font-weight:700;
    color:#111827;
    margin-bottom:5px;
}

.profile-role{
    text-align:center;
    color:#6b7280;
    font-size:14px;
    margin-bottom:30px;
}

.profile-info{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-bottom:14px;
    border-bottom:1px solid #e5e7eb;
}

.info-row:last-child{
    border-bottom:none;
    padding-bottom:0;
}

.info-label{
    display:flex;
    align-items:center;
    gap:10px;
    color:#6b7280;
    font-size:14px;
}

.info-label i{
    color:#16a34a;
    width:18px;
}

.info-value{
    font-weight:600;
    color:#111827;
    font-size:14px;
}

</style>
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

            <a href="dashboard_siswa.php" class="menu-link">

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

                <h2>Profil Siswa</h2>

            </div>

            <div class="user-dropdown">

                <div class="avatar">

                    <i class="fas fa-user-graduate"></i>

                </div>

                <span><?= $nama; ?></span>

            </div>

        </header>

        <!-- PROFILE CARD -->

        <div class="profile-card">

            <div class="profile-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>

            <div class="profile-name"><?= $siswa['nama_siswa']; ?></div>
            <div class="profile-role">Siswa</div>

            <div class="profile-info">

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-id-card"></i>
                        NISN
                    </div>
                    <div class="info-value"><?= $siswa['nisn']; ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-user"></i>
                        Nama Siswa
                    </div>
                    <div class="info-value"><?= $siswa['nama_siswa']; ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-chalkboard"></i>
                        Kelas
                    </div>
                    <div class="info-value"><?= $siswa['kelas']; ?></div>
                </div>

            </div>

        </div>

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
