<?php
// ======================================================
// MEMANGGIL SESSION DAN KONEKSI DATABASE
// ======================================================
session_start();
include '../config/koneksi.php';

// ======================================================
// MENGAMBIL ROLE DAN KELAS USER YANG LOGIN
// ======================================================
$role  = $_SESSION['role'];
$kelas = $_SESSION['kelas'] ?? '';

// ======================================================
// QUERY DATA ORANG TUA
// ======================================================

// Wali kelas hanya melihat data orang tua
// dari siswa yang berada di kelasnya
if($role == 'wali_kelas'){

    $query = mysqli_query($koneksi,"
    SELECT
        o.*,
        s.nama_siswa,
        s.nisn,
        s.kelas
    FROM data_orang_tua o
    JOIN data_siswa s
    ON o.id_siswa = s.id_siswa
    WHERE s.kelas='$kelas'
    ORDER BY s.nama_siswa ASC
    ");

}else{

    // Wakasek dan Kepsek melihat semua data
    $query = mysqli_query($koneksi,"
    SELECT
        o.*,
        s.nama_siswa,
        s.nisn,
        s.kelas
    FROM data_orang_tua o
    JOIN data_siswa s
    ON o.id_siswa = s.id_siswa
    ORDER BY s.kelas ASC, s.nama_siswa ASC
    ");

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Orang Tua</title>

<!-- FONT POPPINS -->
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
    max-width:1200px;
    margin:auto;
}

/* ======================================================
   CARD
====================================================== */

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* ======================================================
   HEADER
====================================================== */

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* ======================================================
   HEADER TABEL
====================================================== */

.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.table-title{
    display:flex;
    align-items:center;
    gap:10px;
    color:#15803d;
    font-weight:600;
    font-size:18px;
}

/* ======================================================
   TOMBOL TAMBAH
====================================================== */

.btn-add{
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    padding:10px 16px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:500;
    transition:.3s;
}

.btn-add:hover{
    background:#15803d;
}

/* ======================================================
   TABEL
====================================================== */

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    border:1px solid #e5e7eb;
}

table th{
    background:#dcfce7;
    color:#166534;
    font-weight:600;
}

table th,
table td{
    border:1px solid #e5e7eb;
    padding:14px;
    text-align:center;
}

table tbody tr:hover{
    background:#f9fafb;
}

/* ======================================================
   DROPDOWN DETAIL
====================================================== */

.dropdown{
    position:relative;
    display:inline-block;
}

.btn-detail{
    width:38px;
    height:38px;
    border:none;
    border-radius:8px;
    background:#16a34a;
    color:#fff;
    cursor:pointer;
    transition:.3s;
}

.btn-detail:hover{
    background:#15803d;
}

.dropdown-content{
    display:none;
    position:absolute;
    right:0;
    top:45px;
    min-width:150px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
    z-index:100;
    overflow:hidden;
}

.dropdown-content a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 15px;
    text-decoration:none;
    color:#374151;
    font-size:14px;
    transition:.2s;
}

.dropdown-content a:hover{
    background:#f3f4f6;
}

.dropdown.active .dropdown-content{
    display:block;
}

/* ======================================================
   TOMBOL KEMBALI
====================================================== */

.bottom-action{
    display:flex;
    justify-content:flex-end;
    margin-top:15px;
}

.btn-back{
    width:45px;
    height:45px;
    background:#fff;
    color:#15803d;
    border:1px solid #15803d;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.3s;
    font-size:16px;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

/* ======================================================
   RESPONSIVE
====================================================== */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .table-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .btn-add{
        width:100%;
        justify-content:center;
    }

    .bottom-action{
        justify-content:center;
    }

}

</style>

</head>
<body>

<div class="container">

    <!-- ======================================================
         JUDUL HALAMAN
    ======================================================= -->

    <div class="card page-header">

        <h1>Data Orang Tua</h1>

        <p>Kelola data orang tua siswa yang terdaftar dalam sistem.</p>

    </div>

    <!-- ======================================================
         DAFTAR DATA ORANG TUA
    ======================================================= -->

    <div class="card">

        <!-- HEADER TABEL -->
        <div class="table-header">

            <!-- JUDUL TABEL -->
            <div class="table-title">

                <i class="fas fa-user-friends"></i>

                Daftar Orang Tua

            </div>

            <!-- ======================================================
                 TOMBOL TAMBAH
                 HANYA DITAMPILKAN UNTUK WALI KELAS
            ======================================================= -->

            <?php if($role == 'wali_kelas'){ ?>

            <a href="tambah_data_orang_tua.php" class="btn-add">

                <i class="fas fa-user-plus"></i>

                Tambah Orang Tua

            </a>

            <?php } ?>

        </div>

        <!-- ======================================================
             TABEL DATA ORANG TUA
        ======================================================= -->

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
<th>Nama Siswa</th>
<th>NISN</th>
<th>Kelas</th>
<th>Nama Orang Tua</th>
<th>No HP</th>
<th>Alamat</th>
<th>Hubungan</th>
                        <!-- Detail hanya untuk wali kelas -->

                        <?php if($role == 'wali_kelas'){ ?>

                        <th>Detail</th>

                        <?php } ?>

                    </tr>

                </thead>

                <tbody>

                <?php

                $no = 1;

                while($row = mysqli_fetch_assoc($query)){

                ?>

                <tr>

                    <!-- NOMOR -->
                     

                    <td><?= $no++; ?></td>

                    <td><?= $row['nama_siswa']; ?></td>
<td><?= $row['nisn']; ?></td>
<td><?= $row['kelas']; ?></td>
<td><?= $row['nama_orangtua']; ?></td>
<td><?= $row['no_hp']; ?></td>
<td><?= $row['alamat']; ?></td>
<td><?= $row['hubungan']; ?></td>
                    <!-- ======================================================
                         MENU DETAIL
                         HANYA UNTUK WALI KELAS
                    ======================================================= -->

                    <?php if($role == 'wali_kelas'){ ?>

                    <td>

                        <div class="dropdown">

                            <button class="btn-detail">

                                <i class="fas fa-eye"></i>

                            </button>

                            <div class="dropdown-content">

                                <a href="edit_data_ortu.php?id=<?= $row['id_orangtua']; ?>">

                                    <i class="fas fa-pen"></i>

                                    Edit

                                </a>

                           <a href="hapus_data_ortu.php?id=<?= $row['id_orangtua']; ?>"
onclick="return confirm('Yakin ingin menghapus data orang tua beserta akun login orang tua?');">

                                    <i class="fas fa-trash"></i>

                                    Hapus

                                </a>

                            </div>

                        </div>

                    </td>

                    <?php } ?>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    

    <!-- ======================================================
         TOMBOL KEMBALI
         MENYESUAIKAN ROLE YANG LOGIN
    ======================================================= -->

    <div class="bottom-action">

    <?php

    if($role == 'wali_kelas'){

        $back = "dashboard_walikelas.php";

    }elseif($role == 'wakasek'){

        $back = "dashboard_wakasek.php";

    }elseif($role == 'kepsek'){

        $back = "dashboard_kepsek.php";

    }

    ?>

    <a href="<?= $back; ?>" class="btn-back">

        <i class="fas fa-chevron-left"></i>

    </a>

    </div>

</div>
<!-- ======================================================
     JAVASCRIPT DROPDOWN DETAIL
====================================================== -->

<script>

// ======================================================
// SAAT TOMBOL DETAIL DIKLIK
// ======================================================

document.querySelectorAll('.btn-detail').forEach(button => {

    button.addEventListener('click', function(e){

        // Mencegah tombol berpindah halaman
        e.preventDefault();

        // Menutup dropdown lain yang sedang terbuka
        document.querySelectorAll('.dropdown').forEach(item => {

            if(item !== this.parentElement){

                item.classList.remove('active');

            }

        });

        // Membuka / menutup dropdown yang dipilih
        this.parentElement.classList.toggle('active');

    });

});

// ======================================================
// MENUTUP DROPDOWN JIKA KLIK DI LUAR AREA DROPDOWN
// ======================================================

document.addEventListener('click', function(e){

    if(!e.target.closest('.dropdown')){

        document.querySelectorAll('.dropdown').forEach(item => {

            item.classList.remove('active');

        });

    }

});

</script>

</body>
</html>