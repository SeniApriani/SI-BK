
<?php
include "../config/koneksi.php";

$data = mysqli_query($koneksi,"
SELECT 
    k.*,
    s.nama_siswa,
    s.kelas
FROM komunikasi_ortu k
JOIN data_siswa s ON k.id_siswa = s.id_siswa
ORDER BY k.id_komunikasi DESC
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

/* TAB */

.tab-card{
    background:#fff;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    overflow:hidden;
}

.tab-menu{
    display:grid;
    grid-template-columns:1fr 1fr;
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    height:72px;
    transition:.3s;
}

.tab:hover{
    color:#16a34a;
}

.tab::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:0;
    height:4px;
    background:#16a34a;
    transition:.3s;
}

.tab:hover::after{
    width:100%;
}

.tab.active{
    color:#16a34a;
}

.tab.active::after{
    width:100%;
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

    <!-- TAB -->

    <div class="tab-card">

        <div class="tab-menu">

            <a href="komunikasi_orangtua.php" class="tab">

                <i class="fas fa-user-clock"></i>

                Daftar Tindak Lanjut

            </a>

            <a href="riwayat_komunikasi.php" class="tab active">

                <i class="fas fa-history"></i>

                Riwayat Komunikasi

            </a>

        </div>

    </div>

    <!-- HEADER -->

    <div class="card">

        <div class="page-header">

            <h1>Riwayat Komunikasi</h1>

            <p>
                Riwayat komunikasi antara pihak sekolah dengan orang tua / wali siswa.
            </p>

        </div>

    </div>

    <!-- FILTER -->

    <div class="card">

        <div class="filter-grid">

            <input
                type="text"
                placeholder="Cari nama siswa..."
            >

            <button class="btn-search">

                <i class="fas fa-search"></i>

            </button>

        </div>

    </div>

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
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nama Orang Tua</th>
                        <th>Tanggal Pertemuan</th>
                        <th>Jenis Pertemuan</th>
                        <th>Hasil Komunikasi</th>
                        <th>Berita Acara</th>
                    </tr>

                </thead>

                <tbody>

<?php $no = 1; while($row = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_siswa']; ?></td>
    <td><?= $row['kelas']; ?></td>
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

</tbody>
            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="pagination-wrapper">

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

    </div>

    <!-- BACK -->

    <div class="bottom-action">

        <a href="komunikasi_orangtua.php" class="btn-back">

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

