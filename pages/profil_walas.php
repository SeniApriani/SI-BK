<?php
session_start();
include '../config/koneksi.php';

/* =========================================
   AMBIL DATA GURU (WALI KELAS) YANG LOGIN
   Pakai session 'nama' & 'kelas', sama seperti
   yang dipakai di dashboard_walikelas.php
========================================= */
$nama  = $_SESSION['nama']  ?? null;
$kelas = $_SESSION['kelas'] ?? null;

if(!$nama || !$kelas){
    // Session tidak lengkap -> paksa login ulang
    header("Location: ../login.php");
    exit;
}

$nama_escaped  = mysqli_real_escape_string($koneksi, $nama);
$kelas_escaped = mysqli_real_escape_string($koneksi, $kelas);

$q = mysqli_query($koneksi,"
    SELECT * FROM data_guru
    WHERE nama_guru='$nama_escaped' AND kelas_wali='$kelas_escaped'
");

if(!$q){
    die(mysqli_error($koneksi));
}

$guru = mysqli_fetch_assoc($q);

if(!$guru){
    // Data guru tidak ditemukan di tabel data_guru
    header("Location: dashboard_walikelas.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profil Wali Kelas</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    color:#374151;
    padding:30px;
}

.container{
    max-width:700px;
    margin:auto;
}

.card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:25px;
    text-align:center;
}

.profile-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#16a34a;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:36px;
    margin:0 auto 15px;
}

.page-header h1{
    color:#15803d;
    font-size:24px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

.info-group{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    border-bottom:1px solid #f0f0f0;
}

.info-group:last-of-type{
    border-bottom:none;
}

.info-label{
    font-size:13px;
    color:#9ca3af;
}

.info-value{
    font-size:15px;
    font-weight:500;
    color:#374151;
}

.badge-role{
    display:inline-block;
    background:#dcfce7;
    color:#15803d;
    font-size:12px;
    font-weight:600;
    padding:4px 12px;
    border-radius:20px;
}

.form-action{
    display:flex;
    justify-content:space-between;
    margin-top:25px;
}

.btn-back{
    width:45px;
    height:45px;
    border-radius:50%;
    border:1px solid #15803d;
    color:#15803d;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.3s;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.btn-edit{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 24px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    transition:.3s;
}

.btn-edit:hover{
    background:#15803d;
}

@media(max-width:768px){
    body{
        padding:15px;
    }
    .form-action{
        gap:10px;
    }
}

</style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="page-header">

            <div class="profile-avatar">
                <i class="fas fa-user-tie"></i>
            </div>

            <h1><?= htmlspecialchars($guru['nama_guru']); ?></h1>
            <p>Wali Kelas <?= htmlspecialchars($guru['kelas_wali']); ?></p>

        </div>

        <div class="info-group">
            <span class="info-label">NIP</span>
            <span class="info-value"><?= htmlspecialchars($guru['nip']); ?></span>
        </div>

        <div class="info-group">
            <span class="info-label">Username</span>
            <span class="info-value"><?= htmlspecialchars($guru['username']); ?></span>
        </div>

        <div class="info-group">
            <span class="info-label">Kelas Wali</span>
            <span class="info-value"><?= htmlspecialchars($guru['kelas_wali']); ?></span>
        </div>

        <div class="info-group">
            <span class="info-label">Role</span>
            <span class="badge-role">Wali Kelas</span>
        </div>

        <div class="form-action">

            <a href="dashboard_walikelas.php" class="btn-back">
                <i class="fas fa-chevron-left"></i>
            </a>

           
        </div>

    </div>

</div>

</body>
</html>