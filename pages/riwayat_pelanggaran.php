<?php
session_start();
include "../config/koneksi.php";
$nisn = $_SESSION['id_siswa'];
$nama = $_SESSION['nama'] ?? 'Siswa';

/* =========================
PAGINATION SETUP
========================= */
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

/* TOTAL DATA */
$totalData = mysqli_num_rows(mysqli_query($koneksi,"
SELECT * FROM pelanggaran_siswa
WHERE id_siswa='$nisn'
"));

$totalPage = ceil($totalData / $limit);

/* DATA RIWAYAT */

$query = mysqli_query($koneksi,"
SELECT ps.tanggal, jp.jenis_pelanggaran, jp.poin, ps.catatan
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$nisn'
ORDER BY ps.tanggal DESC
LIMIT $start, $limit
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Pelanggaran</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    padding:20px;
    color:#374151;
}

.container{
    max-width:1000px;
    margin:auto;
}

/* HEADER */
.header{
    background:#fff;
    padding:18px;
    border-radius:14px;
    margin-bottom:15px;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
}

.header h2{
    color:#15803d;
}

.header p{
    font-size:13px;
    color:#6b7280;
}

/* CARD */
.card{
    background:#fff;
    padding:18px;
    border-radius:14px;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    font-size:14px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f9fafb;
}

.badge{
    background:#16a34a;
    color:#fff;
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
}

/* EMPTY */
.empty{
    padding:20px;
    text-align:center;
    color:#6b7280;
}

/* PAGINATION */
.pagination{
    display:flex;
    justify-content:center;
    gap:8px;
    margin-top:15px;
}

.pagination a{
    width:38px;
    height:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    border:1px solid #d1d5db;
    border-radius:8px;
    text-decoration:none;
    color:#374151;
    background:#fff;
}

.pagination a.active{
    background:#16a34a;
    color:#fff;
    border-color:#16a34a;
}

/* BACK BUTTON */
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
    background:#fff;
    transition:.3s;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}


</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2>Riwayat Pelanggaran</h2>
        <p>Semua data pelanggaran siswa yang tercatat.</p>
    </div>

    <!-- CARD -->
    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

            <?php if(mysqli_num_rows($query) > 0){ ?>

                <?php while($row = mysqli_fetch_assoc($query)){ ?>
                <tr>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['jenis_pelanggaran']; ?></td>
                    <td><span class="badge"><?= $row['poin']; ?></span></td>
                    <td><?= $row['catatan'] ?? '-' ?></td>
                </tr>
                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="4" class="empty">Belum ada pelanggaran</td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="pagination">

            <?php for($i=1; $i <= $totalPage; $i++){ ?>
                <a href="?page=<?= $i; ?>" class="<?= ($i==$page)?'active':''; ?>">
                    <?= $i; ?>
                </a>
            <?php } ?>

        </div>
 <div class="bottom-action">

        <a href="dashboard_siswa.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

    </div>

</div>

</body>
</html>