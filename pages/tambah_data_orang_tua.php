<?php
// ======================================================
// MEMANGGIL SESSION DAN KONEKSI DATABASE
// ======================================================
session_start();
include '../config/koneksi.php';

// ======================================================
// MENGAMBIL KELAS WALI KELAS YANG LOGIN
// ======================================================
$kelas = $_SESSION['kelas'];

// ======================================================
// MENAMPILKAN SISWA SESUAI KELAS WALI KELAS
// ======================================================
$query_siswa = mysqli_query($koneksi,"
SELECT *
FROM data_siswa
WHERE kelas='$kelas'
ORDER BY nama_siswa ASC
");

// ======================================================
// PROSES SIMPAN DATA
// ======================================================
if(isset($_POST['simpan'])){

    // Mengambil data dari form
    $id_siswa      = $_POST['id_siswa'];
$nama_orangtua = $_POST['nama_orangtua'];
$no_hp         = $_POST['no_hp'];
$alamat        = $_POST['alamat'];
$hubungan      = $_POST['hubungan'];

    // Mengambil data siswa
    $ambil = mysqli_query($koneksi,"
    SELECT *
    FROM data_siswa
    WHERE id_siswa='$id_siswa'
    ");

    $siswa = mysqli_fetch_assoc($ambil);

    // Username dan Password Login Orang Tua
    $username = "ortu".$siswa['nisn'];
    $password = $siswa['nisn'];

    // ======================================================
    // SIMPAN KE DATA ORANG TUA
    // ======================================================

    

    mysqli_query($koneksi,"
    INSERT INTO data_orang_tua
(
id_siswa,
nama_orangtua,
no_hp,
alamat,
hubungan
)
VALUES
(
'$id_siswa',
'$nama_orangtua',
'$no_hp',
'$alamat',
'$hubungan'
)
    ");

    // ======================================================
    // MEMBUAT AKUN LOGIN ORANG TUA
    // ======================================================

   mysqli_query($koneksi,"
INSERT INTO users
(
    nama,
    username,
    password,
    role,
    id_siswa,
    kelas
)
VALUES
(
    '$nama_orangtua',
    '$username',
    '$password',
    'orang_tua',
    '$id_siswa',
    '".$siswa['kelas']."'
)
");

    // ======================================================
    // KEMBALI KE HALAMAN DATA ORANG TUA
    // ======================================================

    header("Location: data_orang_tua.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Data Orang Tua</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* ======================================================
   RESET CSS
====================================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* ======================================================
   BODY
====================================================== */

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    color:#374151;
    padding:30px;
}

/* ======================================================
   CONTAINER
====================================================== */

.container{
    max-width:700px;
    margin:auto;
}

/* ======================================================
   CARD
====================================================== */

.card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* ======================================================
   HEADER
====================================================== */

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

/* ======================================================
   FORM
====================================================== */

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
.form-group select,
.form-group textarea{

    width:100%;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:12px 15px;
    outline:none;
    font-family:'Poppins',sans-serif;
    transition:.3s;

}
.form-group textarea{

    min-height:110px;
    resize:vertical;

}

.form-group input:focus,
.form-group select:focus
.form-group textarea:focus{

    border-color:#16a34a;
    box-shadow:0 0 0 3px rgba(22,163,74,.10);

}

/* ======================================================
   BUTTON
====================================================== */

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
    background:#fff;
    color:#15803d;
    display:flex;
    justify-content:center;
    align-items:center;
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

/* ======================================================
   RESPONSIVE
====================================================== */

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

    <!-- ======================================================
         CARD UTAMA
    ======================================================= -->

    <div class="card">

        <!-- ======================================================
             JUDUL HALAMAN
        ======================================================= -->

        <div class="page-header">

            <h1>Tambah Data Orang Tua</h1>

            <p>Masukkan data orang tua siswa ke dalam sistem.</p>

        </div>

        <!-- ======================================================
             FORM TAMBAH DATA ORANG TUA
        ======================================================= -->

        <form method="POST">

            <!-- ======================================================
                 PILIH SISWA
                 HANYA MENAMPILKAN SISWA SESUAI KELAS WALI KELAS
            ======================================================= -->

            <div class="form-group">

                <label>Nama Siswa</label>

                <select name="id_siswa" required>

                    <option value="">-- Pilih Siswa --</option>

                    <?php while($siswa = mysqli_fetch_assoc($query_siswa)){ ?>

                    <option value="<?= $siswa['id_siswa']; ?>">

                        <?= $siswa['nama_siswa']; ?>
                        (<?= $siswa['nisn']; ?>)

                    </option>

                    <?php } ?>

                </select>

            </div>

            <!-- ======================================================
                 NAMA ORANG TUA
            ======================================================= -->

            <div class="form-group">

                <label>Nama Orang Tua</label>

                <input
                    type="text"
                    name="nama_orangtua"
                    placeholder="Masukkan nama orang tua"
                    required
                >

            </div>

            <!-- ======================================================
                 HUBUNGAN DENGAN SISWA
            ======================================================= -->

            <div class="form-group">

                <label>Hubungan</label>

                <select name="hubungan" required>

                    <option value="">-- Pilih Hubungan --</option>

                    <option value="Ayah">Ayah</option>

                    <option value="Ibu">Ibu</option>

                    <option value="Wali">Wali</option>

                </select>

            </div>
<div class="form-group">
<label>No HP</label>
<input type="text" name="no_hp" required>
</div>

<div class="form-group">
<label>Alamat</label>
<textarea name="alamat" required></textarea>
</div>
          
            <!-- ======================================================
                 TOMBOL AKSI
            ======================================================= -->

            <div class="form-action">

                <!-- Tombol Kembali -->

                <a href="data_orang_tua.php" class="btn-back">

                    <i class="fas fa-chevron-left"></i>

                </a>

                <!-- Tombol Simpan -->

                <button
                    type="submit"
                    name="simpan"
                    class="btn-save"
                >

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>
<!-- ======================================================
     PENUTUP HALAMAN
====================================================== -->

</body>
</html>