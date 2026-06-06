<?php
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama_guru = $_POST['nama_guru'];
    $nip = $_POST['nip'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $kelas_wali = $_POST['kelas_wali'];

    mysqli_query($koneksi,"
        INSERT INTO data_guru
        (nama_guru,nip,username,password,role,kelas_wali)
        VALUES
        ('$nama_guru','$nip','$username','$password','$role','$kelas_wali')
    ");

    mysqli_query($koneksi,"
INSERT INTO users
(nama,username,password,role,kelas)
VALUES
('$nama_guru','$username','$password','$role','$kelas_wali')
");
    header("Location: data_guru.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Data Siswa</title>

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

/* CARD */

.card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* HEADER */

.page-header{
    margin-bottom:25px;
}

.page-header h1{
    color:#15803d;
    font-size:28px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* FORM */

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
}

.form-group input,
.form-group select{
    width:100%;
    height:48px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
    box-shadow:0 0 0 3px rgba(22,163,74,.1);
}

/* BUTTON */

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

.btn-save{
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
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

/* RESPONSIVE */

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

            <h1>Tambah Data Guru</h1>

            <p>Masukkan data guru baru ke dalam sistem.</p>

        </div>

        <form method="POST">

    <div class="form-group">

        <label>Nama Guru</label>

        <input
        type="text"
        name="nama_guru"
        placeholder="Masukkan nama guru"
        required>

    </div>

    <div class="form-group">

        <label>NIP</label>

        <input
        type="text"
        name="nip"
        placeholder="Masukkan NIP"
        required>

    </div>

    <div class="form-group">

        <label>Username</label>

        <input
        type="text"
        name="username"
        placeholder="Masukkan username"
        required>

    </div>

    <div class="form-group">

        <label>Password</label>

        <input
        type="text"
        name="password"
        placeholder="Masukkan password"
        required>

    </div>

    <div class="form-group">

        <label>Role</label>

        <select name="role" required>

            <option value="">Pilih Role</option>
            <option value="wali_kelas">Wali Kelas</option>
            <option value="wakasek">Wakasek Kesiswaan</option>
            <option value="kepala_sekolah">Kepala Sekolah</option>

        </select>

    </div>

    <div class="form-group">

        <label>Kelas Wali</label>

        <input
        type="text"
        name="kelas_wali"
        placeholder="Contoh: X TKJ"
        required>

    </div>

    <div class="form-action">

        <a href="data_guru.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

        <button type="submit" name="simpan" class="btn-save">

            <i class="fas fa-save"></i>

            Simpan

        </button>

    </div>

</form>

    </div>

</div>

</body>
</html>