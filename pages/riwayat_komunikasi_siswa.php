<?php
include "../config/koneksi.php";
session_start();
$id_siswa = $_SESSION['id_siswa'] ?? 0;
$nama = $_SESSION['nama'];
$role = $_SESSION['role'];
include "../config/koneksi.php";

$id_siswa = $_SESSION['id_siswa'] ?? 0;

// ======================================================
// PAGINATION
// ======================================================

$limit = 20;
$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// total data (untuk menentukan jumlah halaman)
$totalRow = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) AS jml
FROM komunikasi_ortu k
WHERE k.id_siswa = '$id_siswa'
"));

$total_data  = $totalRow['jml'];
$total_pages = max(1, (int) ceil($total_data / $limit));

// kalau page yang diminta melebihi total halaman, kembalikan ke halaman terakhir
if ($page > $total_pages) $page = $total_pages;
$offset = ($page - 1) * $limit;

$data = mysqli_query($koneksi,"
SELECT 
    k.*,
    s.nama_siswa,
    s.kelas
FROM komunikasi_ortu k
JOIN data_siswa s ON k.id_siswa = s.id_siswa
WHERE k.id_siswa = '$id_siswa'
ORDER BY k.id_komunikasi DESC
LIMIT $limit OFFSET $offset
");
?>



<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Komunikasi</title>

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
    grid-template-columns:1fr 60px;
    gap:12px;
}

.filter-grid input{
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
}

.filter-grid input:focus{
    border-color:#16a34a;
}

.btn-search{
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

/* TABLE */

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
    font-size:18px;
    font-weight:600;
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

.btn-view{
    text-decoration:none;
    background:#eff6ff;
    color:#2563eb;
    padding:8px 12px;
    border-radius:8px;
    font-size:13px;
    font-weight:500;
    transition:.3s;
}

.btn-view:hover{
    background:#dbeafe;
}


/* PAGINATION */

.pagination-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    margin-top:20px;
}

.pagination{
    display:flex;
    gap:8px;
}

.page-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:10px;
    background:#fff;
    border:1px solid #d1d5db;
    cursor:pointer;
    transition:.3s;
    text-decoration:none;
    color:#374151;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Poppins',sans-serif;
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

.page-btn.disabled{
    opacity:.4;
    pointer-events:none;
}

/* BACK */

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
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu{
        grid-template-columns:1fr;
    }

    .bottom-action{
        justify-content:center;
    }

}

/* hasil komunikasi */

.hasil-komunikasi{
    text-align:left;
    max-width:300px;
    white-space:normal;
}

.btn-view-hasil{
    border:none;
    background:#dcfce7;
    color:#166534;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    font-weight:600;
}

.btn-view-hasil:hover{
    background:#bbf7d0;
}

.modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
    z-index:9999;
}

.modal-content{
    background:#fff;
    width:90%;
    max-width:700px;
    padding:25px;
    border-radius:15px;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
}

.close-modal{
    float:right;
    font-size:28px;
    cursor:pointer;
    font-weight:bold;
}

#isiHasil{
    line-height:1.8;
    white-space:pre-wrap;
    max-height:400px;
    overflow-y:auto;
    padding-right:10px;
}

</style>
</head>
<body>
<!-- MODAL HASIL KOMUNIKASI -->
<div id="modalHasil" class="modal">

    <div class="modal-content">

        <span class="close-modal">&times;</span>

        <h3>Hasil Komunikasi Orang Tua</h3>

        <br>

        <div id="isiHasil"></div>

    </div>

</div>
<!-- container -->

<div class="container">

  
    <!-- HEADER -->

    <div class="card">

        <div class="page-header">

            <h1>Riwayat Pembinaan</h1>

            <p>
                Riwayat komunikasi antara pihak sekolah dengan orang tua / wali siswa.
            </p>

        </div>

    </div>

    <!-- FILTER -->

    
    <!-- TABLE -->

    <div class="card">

        <div class="table-header">

            <div class="table-title">

                <i class="fas fa-comments"></i>

                Data Riwayat Komunikasi

            </div>

        </div>

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Orang Tua</th>
                        <th>Tanggal Pertemuan</th>
                        <th>Jenis Pertemuan</th>
                        <th>Hasil Komunikasi</th>
                        <th>Berita Acara</th>
                    </tr>

                </thead>

                <tbody>

<?php $no = $offset + 1; while($row = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_ortu']; ?></td>
    <td><?= $row['tanggal']; ?></td>
    <td><?= $row['jenis_pertemuan']; ?></td>
    <td>

<button
type="button"
class="btn-view-hasil"
data-hasil="<?= htmlspecialchars($row['hasil_komunikasi']); ?>">

Lihat Hasil Komunikasi

</button>

</td>

    <td>
        <a href="../upload/<?= $row['file_ba']; ?>" target="_blank" class="btn-view">
            Lihat Berita Acara
        </a>
    </td>
</tr>

        

<?php } ?>

<?php if ($total_data == 0) { ?>
<tr>
    <td colspan="6">Belum ada data riwayat komunikasi.</td>
</tr>
<?php } ?>

</tbody>
            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <!-- Aktif otomatis: 20 data pertama tampil di halaman 1,
         data ke-21 dan seterusnya otomatis masuk ke halaman 2, dst. -->

    <div class="pagination-wrapper">

        <div class="pagination">

            <a href="?page=<?= max(1,$page-1); ?>"
               class="page-btn <?= $page<=1 ? 'disabled':''; ?>">

                <i class="fas fa-chevron-left"></i>

            </a>

<?php for ($i = 1; $i <= $total_pages; $i++) { ?>

            <a href="?page=<?= $i; ?>"
               class="page-btn <?= $i==$page ? 'active':''; ?>">
                <?= $i; ?>
            </a>

<?php } ?>

            <a href="?page=<?= min($total_pages,$page+1); ?>"
               class="page-btn <?= $page>=$total_pages ? 'disabled':''; ?>">

                <i class="fas fa-chevron-right"></i>

            </a>

        </div>

    </div>

    <!-- BACK -->

    <div class="bottom-action">

        <?php

if($role=='siswa'){

    $back = "dashboard_siswa.php";

}else{

    $back = "dashboard_ortu.php";

}

?>

<a href="<?= $back; ?>" class="btn-back">

    <i class="fas fa-chevron-left"></i>

</a>

    </div>

</div>
<!-- pop-up modal -->
 <script>

const modal =
document.getElementById('modalHasil');

const isi =
document.getElementById('isiHasil');

document
.querySelectorAll('.btn-view-hasil')
.forEach(function(btn){

    btn.onclick = function(){

        isi.innerHTML =
        this.dataset.hasil;

        modal.style.display='block';

    }

});

document
.querySelector('.close-modal')
.onclick = function(){

    modal.style.display='none';

}

window.onclick = function(e){

    if(e.target == modal){

        modal.style.display='none';

    }

}

</script>
</body>
</html>