<?php
include __DIR__ . '/../config/koneksi.php';

$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$bulan = $_GET['bulan'] ?? '';
$kelas = $_GET['kelas'] ?? '';

$where = "WHERE 1=1";

if ($bulan != '') {
    $where .= " AND MONTH(ps.tanggal) = '$bulan'";
}

if ($kelas != '') {
    $where .= " AND s.kelas = '$kelas'";
}

/* ===================== DATA ===================== */
$data = mysqli_query($koneksi, "
SELECT ps.id,
       ps.tanggal,
       s.nama_siswa,
       s.nisn,
       s.kelas,
       jp.kategori,
       jp.jenis_pelanggaran,
       jp.poin,
       ps.catatan
FROM pelanggaran_siswa ps
JOIN data_siswa s ON ps.id_siswa = s.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
$where
ORDER BY ps.tanggal DESC
LIMIT $limit OFFSET $offset
");

/* ===================== TOTAL PAGINATION ===================== */
$totalQuery = mysqli_query($koneksi, "
SELECT COUNT(*) as total
FROM pelanggaran_siswa ps
JOIN data_siswa s ON ps.id_siswa = s.id_siswa
$where
");

$total = mysqli_fetch_assoc($totalQuery);
$total_pages = ceil($total['total'] / $limit);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Data Pelanggaran</title>

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
    padding:0 20px;
    margin-bottom:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    display:flex;
    align-items:center;
    min-height:65px;
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    padding:22px 12px 18px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.tab:hover{
    color:#15803d;
}

.tab:hover::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:3px;
    background:#86efac;
    border-radius:10px;
}

.tab.active{
    color:#15803d;
}

.tab.active::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:3px;
    background:#16a34a;
    border-radius:10px;
}

.tab-right{
    margin-left:auto;
}

/* CARD */

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

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

/* FILTER */

.filter-section{
    display:flex;
    gap:15px;
    margin-bottom:25px;
}

.filter-section select{
    width:220px;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
}

.filter-section select:focus{
    border-color:#16a34a;
}

/* TABLE */

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#dcfce7;
    color:#166534;
    font-weight:600;
}

table th,
table td{
    padding:14px;
    border:1px solid #e5e7eb;
    text-align:center;
}

table tbody tr:hover{
    background:#f9fafb;
}

/* PAGINATION */

.pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin-top:20px;
}

.page-btn{
    padding:8px 12px;
    border-radius:8px;
    border:1px solid #d1d5db;
    background:#fff;
    cursor:pointer;
    transition:.3s;
    text-decoration:none;
    color:#374151;
    display:inline-block;
    min-width:36px;
    text-align:center;
}

.page-btn:hover{
    background:#f3f4f6;
}

.page-btn.active{
    background:#16a34a;
    border-color:#16a34a;
    color:#fff;
}

/* BOTTOM */

.bottom-action{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.btn-back{
    width:45px;
    height:45px;
    border-radius:50%;
    border:1px solid #15803d;
    color:#15803d;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.3s;
    background:#fff;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.btn-download{
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    padding:12px 18px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-download:hover{
    background:#15803d;
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-section{
        flex-direction:column;
    }

    .filter-section select{
        width:100%;
    }

    .tab-card{
        flex-wrap:wrap;
    }

    .tab-right{
        margin-left:0;
    }

    .bottom-action{
        gap:10px;
    }

}

/* FILTER */
.filter-wrap{
    display:flex;
    gap:12px;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
}

.select-box{
    position:relative;
    display:flex;
    align-items:center;
}

.select-box i{
    position:absolute;
    left:12px;
    color:#16a34a;
    font-size:14px;
}

.select-box select{
    padding:10px 12px 10px 35px;
    border:1px solid #d1d5db;
    border-radius:10px;
    font-family:'Poppins',sans-serif;
    outline:none;
    background:#fff;
    min-width:180px;
    cursor:pointer;
}

.select-box select:focus{
    border-color:#16a34a;
    box-shadow:0 0 0 3px rgba(22,163,74,.1);
}

.btn-filter{
    display:flex;
    align-items:center;
    gap:6px;
    padding:10px 14px;
    border:none;
    border-radius:10px;
    background:#16a34a;
    color:#fff;
    cursor:pointer;
    font-weight:500;
    transition:.3s;
}

.btn-filter:hover{
    background:#15803d;
}

</style>
</head>
<body>

<div class="container">

    <!-- TAB -->

    <div class="tab-card">

        <a href="data_pelanggaran_siswa.php" class="tab">

            <i class="fas fa-pen-to-square"></i>

            Pencatatan

        </a>

        <a href="riwayat_pelanggaran_siswa.php" class="tab tab-right active">

            <i class="fas fa-clock-rotate-left"></i>

            Riwayat Data Pelanggaran

        </a>

    </div>

    <!-- CONTENT -->

    <div class="card">

        <div class="page-header">

            <h1>Riwayat Data Pelanggaran</h1>

            <p>Riwayat seluruh pelanggaran siswa yang telah dicatat.</p>

        </div>

        <!-- FILTER -->

        <div class="filter-section">

          <form method="GET" class="filter-wrap">

    <!-- BULAN -->
    <div class="select-box">
        <i class="fas fa-calendar"></i>
        <select name="bulan">
            <option value="">Semua Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>

    <!-- KELAS -->
    <div class="select-box">
        <i class="fas fa-users"></i>
        <select name="kelas">
            <option value="">Semua Kelas</option>
            <option value="X TKJ">X TKJ</option>
            <option value="XI TKJ">XI TKJ</option>
            <option value="XII TKJ">XII TKJ</option>
        </select>
    </div>

    <button type="submit" class="btn-filter">
        <i class="fas fa-search"></i>
        Cari
    </button>

</form>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Jenis Pelanggaran</th>
            <th>Bobot Poin</th>
            <th>Catatan</th>
        </tr>
    </thead>

    <tbody>
        <?php while($r = mysqli_fetch_assoc($data)) { ?>
        <tr>
           <td><?= date('d/m/Y', strtotime($r['tanggal'])); ?></td>
          <td><?= $r['nama_siswa']; ?></td>
<td><?= $r['nisn']; ?></td>
<td><?= $r['kelas']; ?></td>
<td><?= $r['kategori']; ?></td>
            <td><a href="hapus_pelanggaran.php?id=<?= $r['id']; ?>"
       onclick="return confirm('Data ini akan dihapus dan total poin akan berkurang. Lanjutkan?');"
       style="color:#374151;; font-weight:500; text-decoration:none;">
        <?= $r['jenis_pelanggaran']; ?>
    </a>
</td>
            <td><?= $r['poin']; ?></td>
            <td><?= $r['catatan']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>



        <!-- PAGINATION -->

      <div class="pagination">

<?php if($page > 1){ ?>
    <a class="page-btn" href="?page=<?= $page-1 ?>&bulan=<?= $bulan ?>&kelas=<?= $kelas ?>">‹</a>
<?php } ?>

<?php
$start = max(1, $page - 2);
$end = min($total_pages, $page + 2);

for ($i = $start; $i <= $end; $i++) { ?>
    <a href="?page=<?= $i ?>&bulan=<?= $bulan ?>&kelas=<?= $kelas ?>"
       class="page-btn <?= ($i == $page) ? 'active' : '' ?>">
        <?= $i ?>
    </a>
<?php } ?>

<?php if($page < $total_pages){ ?>
    <a class="page-btn" href="?page=<?= $page+1 ?>&bulan=<?= $bulan ?>&kelas=<?= $kelas ?>">›</a>
<?php } ?>

</div>

    <!-- BOTTOM -->

    <div class="bottom-action">

        <a href="dashboard_walikelas.php" class="btn-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <!-- <a href="#" class="btn-download">
            <i class="fas fa-download"></i>
            Unduh Data
        </a> -->

    </div>

</div>

</body>
</html>