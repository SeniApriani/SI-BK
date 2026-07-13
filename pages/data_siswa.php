<?php
session_start();
include '../config/koneksi.php';

// mengambil kelas wali kelas yang sedang login

$role = $_SESSION['role'];
$kelas = $_SESSION['kelas'] ?? '';


// hanya menampilkan siswa sesuai kelas wali kelas dan wakasek 
if($role == 'wakasek'){

    // wakasek lihat semua kelas
    $query = mysqli_query($koneksi,"
    SELECT *
    FROM data_siswa
    ORDER BY nama_siswa ASC
    ");

}else{

    // wali kelas hanya kelasnya
    $query = mysqli_query($koneksi,"
    SELECT *
    FROM data_siswa
    WHERE kelas='$kelas'
    ORDER BY nama_siswa ASC
    ");

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Siswa</title>

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
    max-width:1200px;
    margin:auto;
}

/* CARD */

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* HEADER */

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* FILTER */

.filter-grid{
    display:grid;
    grid-template-columns:2fr 180px 60px;
    gap:12px;
    align-items:center;
}

.filter-grid input,
.filter-grid select{
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    outline:none;
    font-family:'Poppins',sans-serif;
}

.filter-grid input:focus,
.filter-grid select:focus{
    border-color:#16a34a;
}

.btn-search{
    height:45px;
    border:none;
    background:#16a34a;
    color:#fff;
    border-radius:10px;
    cursor:pointer;
    transition:.3s;
}

.btn-search:hover{
    background:#15803d;
}

/* TABLE HEADER */

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

/* TABLE */

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

/* DETAIL MENU */

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
    min-width:140px;
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

.dropdown-content .delete{
    color:#dc2626;
}

.dropdown.active .dropdown-content{
    display:block;
}

/* BACK BUTTON */

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

.pagination{
    display:flex;
    justify-content:center;
    gap:8px;
    margin-top:20px;
}

.page-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:10px;
    background:#fff;
    border:1px solid #d1d5db;
    cursor:pointer;
    font-weight:500;
    transition:.3s;
}

.page-btn:hover{
    background:#16a34a;
    color:#fff;
    border-color:#16a34a;
}

.page-btn.active{
    background:#16a34a;
    color:#fff;
    border-color:#16a34a;
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-grid{
        grid-template-columns:1fr;
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

    <!-- JUDUL -->

    <div class="card page-header">

        <h1>Data Siswa</h1>

        <p>Kelola data siswa yang terdaftar dalam sistem.</p>

    </div>

   

    <!-- DAFTAR SISWA -->

    <div class="card">

        <div class="table-header">

            <div class="table-title">

                <i class="fas fa-users"></i>

                Daftar Siswa

            </div>

          <?php if($_SESSION['role'] == 'wali_kelas'){ ?>

<a href="tambah_data_siswa.php" class="btn-add">

    <i class="fas fa-user-plus"></i>

    Tambah Siswa

</a>

<?php } ?>

        </div>

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                       <?php if($_SESSION['role']=='wali_kelas'){ ?>
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

    <td><?= $no++; ?></td>
    <td><?= $row['nama_siswa']; ?></td>
    <td><?= $row['nisn']; ?></td>
    <td><?= $row['kelas']; ?></td>

  <?php if($_SESSION['role']=='wali_kelas'){ ?>

<td>

    <div class="dropdown">

        <button class="btn-detail">
            <i class="fas fa-eye"></i>
        </button>

        <div class="dropdown-content">

            <a href="edit_data_siswa.php?id=<?= $row['id_siswa']; ?>">
                <i class="fas fa-pen"></i>
                Edit
            </a>

            <a href="hapus_data_siswa.php?id=<?= $row['id_siswa']; ?>">
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

    <!-- PAGINATION -->
     <div class="pagination">

    <button class="page-btn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <button class="page-btn active">1</button>

    <button class="page-btn">2</button>

    <button class="page-btn">3</button>

    <button class="page-btn">
        <i class="fas fa-chevron-right"></i>
    </button>

</div>

    <!-- BACK -->

    <div class="bottom-action">

        <?php

if($_SESSION['role']=='wali_kelas'){
    $back = "dashboard_walikelas.php";
}
elseif($_SESSION['role']=='wakasek'){
    $back = "dashboard_wakasek.php";
}
elseif($_SESSION['role']=='kepsek'){
    $back = "dashboard_kepsek.php";
}

?>

<a href="<?= $back; ?>" class="btn-back">

    <i class="fas fa-chevron-left"></i>

</a>

    </div>

</div>

<script>

document.querySelectorAll('.btn-detail').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        document.querySelectorAll('.dropdown').forEach(item => {

            if(item !== this.parentElement){
                item.classList.remove('active');
            }

        });

        this.parentElement.classList.toggle('active');

    });

});

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