<?php
session_start();
include '../config/koneksi.php';

$kelas_wali = $_SESSION['kelas'];

if(isset($_POST['simpan'])){

    $nama_siswa = $_POST['nama_siswa'];
    $nisn = $_POST['nisn'];
    $kelas = $kelas_wali;

    // 1. simpan ke data_siswa
    mysqli_query($koneksi, "INSERT INTO data_siswa(nama_siswa, nisn, kelas)
    VALUES('$nama_siswa','$nisn','$kelas')");

    // 2. ambil id siswa terakhir
    $id_siswa = mysqli_insert_id($koneksi);

    // 3. simpan ke users (login siswa)
    mysqli_query($koneksi, "INSERT INTO users(nama, username, password, role, id_siswa)
    VALUES('$nama_siswa','$nisn','$nisn','siswa','$id_siswa')");

    header("Location: data_siswa.php");
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

            <h1>Tambah Data Siswa</h1>

            <p>Masukkan data siswa baru ke dalam sistem.</p>

        </div>

        <form method="POST">

            <div class="form-group">

                <label>Nama Siswa</label>
                <input
    type="text"
    name="nama_siswa"
    placeholder="Masukkan nama siswa"
    required
>

                

            </div>

            <div class="form-group">

                <label>NISN</label>

               
<input
    type="text"
    name="nisn"
    placeholder="Masukkan NISN"
    required
>
            </div>

            <div class="form-group">

<label>Kelas</label>

<input 
type="text"
value="<?= $_SESSION['kelas']; ?>"
readonly
>

</div>

            <div class="form-action">

                <a href="data_siswa.php" class="btn-back">

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