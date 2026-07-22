<?php
// ======================================================
// KONEKSI DAN SESSION
// ======================================================
session_start();
include "../config/koneksi.php";

// Hanya wali kelas
if($_SESSION['role'] != 'wali_kelas'){
    die("Akses ditolak.");
}

$id = $_GET['id'] ?? '';

if($id == ''){
    die("ID tidak ditemukan.");
}

// ======================================================
// AMBIL DATA ORANG TUA
// ======================================================

$query = mysqli_query($koneksi,"
SELECT
o.*,
s.nama_siswa,
s.nisn,
s.kelas
FROM data_orang_tua o
JOIN data_siswa s
ON o.id_siswa=s.id_siswa
WHERE o.id_orangtua='$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan.");
}

// ======================================================
// UPDATE DATA
// ======================================================
if(isset($_POST['simpan'])){

    $nama_orangtua = mysqli_real_escape_string($koneksi,$_POST['nama_orangtua']);
    $hubungan      = mysqli_real_escape_string($koneksi,$_POST['hubungan']);
    $no_hp         = mysqli_real_escape_string($koneksi,$_POST['no_hp']);
    $alamat        = mysqli_real_escape_string($koneksi,$_POST['alamat']);

    mysqli_query($koneksi,"
    UPDATE data_orang_tua
SET
nama_orangtua='$nama_orangtua',
no_hp='$no_hp',
alamat='$alamat',
hubungan='$hubungan'
WHERE id_orangtua='$id';
    ");

    echo "
    <script>
        alert('Data berhasil diperbarui.');
        window.location='data_orang_tua.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Data Orang Tua</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:#f5f7fb;
padding:30px;
}

.card{
max-width:700px;
margin:auto;
background:#fff;
padding:30px;
border-radius:18px;
box-shadow:0 4px 15px rgba(0,0,0,.05);
}

h2{
color:#15803d;
margin-bottom:25px;
}

.form-group{
margin-bottom:18px;
}

label{
display:block;
margin-bottom:8px;
font-weight:500;
}

input,
select,
textarea{
width:100%;
padding:12px;
border:1px solid #d1d5db;
border-radius:10px;
font-family:Poppins;
}

textarea{
height:100px;
resize:none;
}

.btn{
margin-top:15px;
display:flex;
gap:10px;
}

.btn button{
padding:12px 18px;
border:none;
border-radius:10px;
cursor:pointer;
font-family:Poppins;
}

.simpan{
background:#16a34a;
color:white;
}

.kembali{
background:#e5e7eb;
color:#374151;
text-decoration:none;
padding:12px 18px;
border-radius:10px;
}

.info{
background:#f9fafb;
padding:12px;
border-radius:10px;
margin-bottom:20px;
}

</style>

</head>
<body>

<div class="card">

<h2>Edit Data Orang Tua</h2>

<div class="info">
<b>Nama Siswa :</b> <?= $data['nama_siswa']; ?><br>
<b>NISN :</b> <?= $data['nisn']; ?><br>
<b>Kelas :</b> <?= $data['kelas']; ?>
</div>

<form method="POST">

<div class="form-group">
<label>Nama Orang Tua</label>
<input
type="text"
name="nama_orangtua"
value="<?= $data['nama_orangtua']; ?>"
required>
</div>

<div class="form-group">
<label>Hubungan</label>

<select name="hubungan" required>

<option value="Ayah" <?= ($data['hubungan']=="Ayah")?'selected':''; ?>>Ayah</option>

<option value="Ibu" <?= ($data['hubungan']=="Ibu")?'selected':''; ?>>Ibu</option>

<option value="Wali" <?= ($data['hubungan']=="Wali")?'selected':''; ?>>Wali</option>

</select>

</div>

<div class="form-group">
<label>No HP</label>
<input
type="text"
name="no_hp"
value="<?= $data['no_hp']; ?>"
required>
</div>

<div class="form-group">
<label>Alamat</label>

<textarea
name="alamat"
required><?= $data['alamat']; ?></textarea>

</div>

<div class="btn">

<button
type="submit"
name="simpan"
class="simpan">
Simpan Perubahan
</button>

<a href="data_orang_tua.php" class="kembali">
Batal
</a>

</div>

</form>

</div>

</body>
</html>