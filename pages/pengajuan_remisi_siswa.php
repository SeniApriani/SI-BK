<?php
include "../config/koneksi.php";
session_start();

if(!isset($_SESSION['id_siswa'])){
    die("Session login siswa tidak ditemukan");
}

$id_siswa = $_SESSION['id_siswa'];
$kelas = $_SESSION['kelas'];


if(isset($_POST['simpan'])){

    $jenis_prestasi = $_POST['jenis_prestasi'];
    $nama_prestasi  = $_POST['nama_prestasi'];
    $poin_remisi    = $_POST['poin_remisi'];

    $bukti = $_FILES['bukti']['name'];
    $tmp   = $_FILES['bukti']['tmp_name'];

    if(!empty($bukti)){
        $folder = "../upload/bukti_remisi/";
        move_uploaded_file($tmp, $folder.$bukti);
    }

    mysqli_query($koneksi,"
        INSERT INTO pengajuan_remisi
        (id_siswa, kelas, jenis_prestasi, nama_prestasi, poin_remisi, status, bukti)
        VALUES
        ('$id_siswa','$kelas','$jenis_prestasi','$nama_prestasi','$poin_remisi','Menunggu','$bukti')
    ");

    $_SESSION['success'] = 'Pengajuan berhasil';
header("Location: riwayat_remisi_siswa.php");
exit;


}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Penilaian Poin Pelanggaran</title>

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
    max-width:1100px;
    margin:auto;
}

/* =========================
   TAB MENU
========================= */

.tab-card{
    background:#fff;
    border-radius:16px;
    overflow:hidden;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.tab-menu{
    display:grid;
    grid-template-columns:repeat(2,1fr);
}

.tab{
    text-decoration:none;
    color:#4b5563;
    font-size:15px;
    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    padding:22px 15px;

    border-right:1px solid #e5e7eb;

    transition:.3s;
}

.tab:last-child{
    border-right:none;
}

.tab i{
    font-size:15px;
}

.tab:hover{
    background:#f0fdf4;
    color:#16a34a;
}

.tab.active{
    background:#16a34a;
    color:#fff;
}

/* RESPONSIVE */

@media(max-width:768px){

    .tab-menu{
        grid-template-columns:1fr;
    }

    .tab{
        border-right:none;
        border-bottom:1px solid #e5e7eb;
    }

    .tab:last-child{
        border-bottom:none;
    }

}

/* =========================
   CARD
========================= */

.card{
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:30px;
}

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:8px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* =========================
   FORM
========================= */

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
}

.required{
    color:#dc2626;
}

.form-group input,
.form-group select{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:13px 15px;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
}

.readonly{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

input[type=file]{
    padding:12px;
}

/* =========================
   BUTTON
========================= */

.form-action{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:30px;
}

.btn-cancel{
    text-decoration:none;
    border:1px solid #16a34a;
    color:#16a34a;
    background:#fff;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.btn-cancel:hover{
    background:#f0fdf4;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 25px;
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

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu{
        overflow-x:auto;
        gap:25px;
    }

    .card{
        padding:20px;
    }

    .form-action{
        flex-direction:column;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
        justify-content:center;
        text-align:center;
    }

}

/* DROPDOWNN */
.dropdown-siswa{
    position: relative;
    width: 100%;
}

.list-siswa{
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    max-height: 180px;
    overflow-y: auto;
    display: none;
    z-index: 9999;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.item-siswa{
    padding:10px 12px;
    cursor:pointer;
}

.item-siswa:hover{
    background:#f3f4f6;
}

</style>

</head>
<body>

<div class="container">

    <!-- TAB MENU -->

    <div class="tab-card">

        <div class="tab-menu">

            <a href="pengajuan_remisi_siswa.php" class="tab active">
                <i class="fas fa-award"></i>
                Pengajuan Remisi
            </a>

            <a href="riwayat_remisi_siswa.php" class="tab">
                <i class="fas fa-history"></i>
                Riwayat Pengajuan Remisi
            </a>
        </div>

    </div>

    <!-- FORM REMISI -->

<div class="card">

<div class="page-header">

    <h1>Input Remisi Prestasi</h1>

    <p>
        Ajukan remisi poin pelanggaran.
    </p>

</div>

<form method="POST" enctype="multipart/form-data">
            
    <div class="form-group">
        

        <label>
            Tingkat Prestasi
            <span class="required">*</span>
        </label>

        <select name="jenis_prestasi" id="jenis_prestasi" required>
            <option value="">-- Pilih Tingkat Prestasi --</option>

            <option value="15">
                Juara I/II/III Tingkat Sekolah 
            </option>

            <option value="25">
                Juara I/II/III Tingkat Kabupaten/Kota 
            </option>

            <option value="50">
                Juara I/II/III Tingkat Provinsi 
            </option>

            <option value="100">
                Juara I/II/III Tingkat Nasional/Internasional 
            </option>

        </select>

    </div>

    <div class="form-group">

    <label>Persentase Remisi</label>

    <input
        type="text"
        name="poin_remisi"
        id="poin_remisi"
        class="readonly"
        readonly
    >

</div>

    <div class="form-group">

        <label>
            Nama Prestasi / Lomba
            <span class="required">*</span>
        </label>

        <input
            type="text"
            name="nama_prestasi"
            placeholder="Masukkan nama prestasi atau lomba"
            required
        >

    </div>

    

    <div class="form-group">

        <label>
            Upload Bukti Prestasi
            <span class="required">*</span>
        </label>

        <input
            type="file"
            name="bukti"
            required
        >

        <small style="color:#6b7280;">
            Tingkat Sekolah: Surat Keterangan Wakasis.
            Tingkat Kabupaten/Kota, Provinsi, Nasional/Internasional:
            Sertifikat, Piagam, atau dokumen sejenis.
        </small>

    </div>

    <div class="form-action">

        <a href="dashboard_siswa.php" class="btn-cancel">
            Batal
        </a>

        <button type="submit" name="simpan" class="btn-save">

            <i class="fas fa-paper-plane"></i>

            Ajukan Remisi

        </button>

    </div>

</form>

</div>

</div>

</div>

<script>

const jenisPrestasi = document.getElementById('jenis_prestasi');
const poinRemisi = document.getElementById('poin_remisi');

jenisPrestasi.addEventListener('change', function(){

    if(this.value == '15'){
        poinRemisi.value = '15';
    }
    else if(this.value == '25'){
        poinRemisi.value = '25';
    }
    else if(this.value == '50'){
        poinRemisi.value = '50';
    }
    else if(this.value == '100'){
        poinRemisi.value = '100';
    }
    else{
        poinRemisi.value = '';
    }

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
if(localStorage.getItem('remisi_berhasil') === '1'){

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Pengajuan remisi berhasil diajukan.',
        confirmButtonColor: '#16a34a'
    });

    localStorage.removeItem('remisi_berhasil');
}
</script>


</body>
</html
