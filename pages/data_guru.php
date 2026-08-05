<?php
include "../config/koneksi.php";

$data = mysqli_query($koneksi,"
SELECT * FROM data_guru
ORDER BY id_guru DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Guru</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

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
}

.btn-add:hover{
    background:#15803d;
}

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
    overflow:hidden;
    z-index:100;
}

.dropdown-content a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 15px;
    text-decoration:none;
    color:#374151;
}

.dropdown-content a:hover{
    background:#f3f4f6;
}

.dropdown.active .dropdown-content{
    display:block;
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
}

.page-btn.active{
    background:#16a34a;
    color:#fff;
    border-color:#16a34a;
}

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
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

</style>
</head>

<body>

<div class="container">

<div class="card page-header">

    <h1>Data Guru</h1>

    <p>Kelola data guru yang terdaftar dalam sistem.</p>

</div>

<div class="card">

    <div class="table-header">

        <div class="table-title">

            <i class="fas fa-chalkboard-teacher"></i>

            Daftar Guru

        </div>

        <a href="tambah_guru.php" class="btn-add">

            <i class="fas fa-user-plus"></i>

            Tambah Guru

        </a>

    </div>

    <div class="table-responsive">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>NIP</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Kelas Wali</th>
                    <th>Detail</th>
                </tr>

            </thead>

            <tbody>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($data)){
?>

<tr>

    <td><?= $no++; ?></td>
    <td><?= $row['nama_guru']; ?></td>
    <td><?= $row['nip']; ?></td>
    <td><?= $row['username']; ?></td>
    <td><?= $row['role']; ?></td>
    <td><?= $row['kelas_wali']; ?></td>

    <td>

        <div class="dropdown">

            <button class="btn-detail">
                <i class="fas fa-eye"></i>
            </button>

            <div class="dropdown-content">

              <a href="edit_guru.php?id=<?= $row['id_guru']; ?>">
    <i class="fas fa-pen"></i>
    Edit
</a>

<a href="hapus_guru.php?id=<?= $row['id_guru']; ?>"
   onclick="return confirm('Yakin hapus data guru ini?');">
    <i class="fas fa-trash"></i>
    Hapus
</a>

            </div>

        </div>

    </td>

</tr>

<?php } ?>

</tbody>
        </table>

    </div>

</div>

<div class="pagination">

    <button class="page-btn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <button class="page-btn active">1</button>

    <button class="page-btn">2</button>

    <button class="page-btn">
        <i class="fas fa-chevron-right"></i>
    </button>

</div>

<div class="bottom-action">

    <a href="dashboard_wakasek.php" class="btn-back">

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