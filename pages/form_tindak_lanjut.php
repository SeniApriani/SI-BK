<?php
include "../config/koneksi.php";
session_start();

$id = $_GET['id'];

if(isset($_POST['simpan'])){
    if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

    $catatan_tindak_lanjut = mysqli_real_escape_string(
        $koneksi,
        $_POST['catatan_tindak_lanjut']
    );

    $tanggal_tindak_lanjut = $_POST['tanggal_tindak_lanjut'];

    $update = mysqli_query($koneksi,"
    UPDATE pelanggaran_siswa
    SET
        catatan_tindak_lanjut='$catatan_tindak_lanjut',
        tanggal_tindak_lanjut='$tanggal_tindak_lanjut',
        status='Selesai Ditindaklanjuti'
    WHERE id='$id'
");

if(!$update){
    die(mysqli_error($koneksi));
}


    $_SESSION['success']="Tindak lanjut berhasil disimpan";

    header("Location: riwayat_pelanggaran_siswa.php");
    exit;
}

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT
    ps.*,
    ds.nama_siswa,
    ds.nisn,
    ds.kelas,
    jp.kategori,
    jp.jenis_pelanggaran
FROM pelanggaran_siswa ps
JOIN data_siswa ds ON ps.id_siswa = ds.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id='$id'
"));
?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

* *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f4f7f6;
    padding:30px;
    color:#374151;
}

.container{
    max-width:900px;
    margin:auto;
}

.card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.page-title{
    margin-bottom:25px;
}

.page-title h2{
    color:#15803d;
    font-size:28px;
    margin-bottom:5px;
}

.page-title p{
    color:#6b7280;
    font-size:14px;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:15px;
    margin-bottom:25px;
}

.info{
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    border-radius:14px;
    padding:15px;
}

.info b{
    color:#166534;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#166534;
}

.form-group input,
.form-group textarea{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:12px 14px;
    font-family:'Poppins',sans-serif;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group textarea:focus{
    border-color:#16a34a;
    box-shadow:0 0 0 4px rgba(22,163,74,.10);
}

.form-group textarea{
    min-height:140px;
    resize:vertical;
}

.btn{
    width:100%;
    border:none;
    background:#16a34a;
    color:white;
    padding:14px;
    border-radius:12px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#15803d;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .card{
        padding:20px;
    }

    .page-title h2{
        font-size:22px;
    }

} 

</style>


<div class="info-grid">

    <div class="info">
        <b>Nama :</b><br>
        <?= $data['nama_siswa']; ?>
    </div>

    <div class="info">
        <b>NISN :</b><br>
        <?= $data['nisn']; ?>
    </div>

    <div class="info">
        <b>Kelas :</b><br>
        <?= $data['kelas']; ?>
    </div>

    <div class="info">
        <b>Kategori :</b><br>
        <?= $data['kategori']; ?>
    </div>
   
    <div class="info">
        <b>Poin :</b><br>
        <?= $data['poin']; ?>
    </div>

    <div class="info">
        <b>Tanggal Pelanggaran :</b><br>
        <?= date('d-m-Y', strtotime($data['tanggal'])); ?>
    </div>

     <div class="info">
    <b>Jenis Pelanggaran :</b><br>
    <?= $data['jenis_pelanggaran']; ?>
</div>


</div>

<form method="POST">

<div class="form-group">
    <label>Tanggal Tindak Lanjut</label>
    <input type="date" name="tanggal_tindak_lanjut" required>
</div>

<div class="form-group">
    <label>Catatan Konseling</label>
    <textarea
        name="catatan_tindak_lanjut"
        placeholder="Tuliskan hasil konseling, arahan yang diberikan, komitmen siswa, dan tindak lanjut berikutnya..."
        required></textarea>
       
</div>

<button type="submit" name="simpan" class="btn">
    Simpan Tindak Lanjut
</button>
 </form>

</div>

</div>

