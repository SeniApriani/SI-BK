<?php
include "../config/koneksi.php";

/* AMBIL ID SISWA */
$id = $_GET['id'] ?? '';

/* AMBIL DATA SISWA */
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT
    s.id_siswa,
    s.nisn,
    s.nama_siswa,
    s.kelas,
    COALESCE(r.total_poin,0) AS total_poin
FROM data_siswa s
LEFT JOIN rekap_poin r
ON s.id_siswa = r.id_siswa
WHERE s.id_siswa='$id'
"));

/* CEK DATA PELANGGARAN BERULANG */
$berulang = mysqli_query($koneksi,"
SELECT
    jp.jenis_pelanggaran AS nama_pelanggaran,
    jp.kategori,
    COUNT(*) AS jumlah
FROM pelanggaran_siswa p
JOIN jenis_pelanggaran jp
ON p.id_pelanggaran = jp.id_pelanggaran
WHERE p.id_siswa='$id'
GROUP BY jp.jenis_pelanggaran, jp.kategori
HAVING COUNT(*) >= 2
ORDER BY jumlah DESC
") or die(mysqli_error($koneksi));



/* RIWAYAT PELANGGARAN DETAIL */
$riwayat = mysqli_query($koneksi,"
SELECT
    ps.tanggal,
    jp.jenis_pelanggaran,
    jp.kategori,
    jp.poin
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$id'
ORDER BY ps.tanggal DESC
") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Riwayat Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:#f5f7fb;
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.card{
    background:#fff;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0 3px 10px rgba(0,0,0,.08);
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
}

.info-item{
    background:#f9fafb;
    padding:15px;
    border-radius:10px;
    border:1px solid #e5e7eb;
}

.info-item small{
    color:#6b7280;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th{
    background:#dcfce7;
    padding:10px;
    border:1px solid #e5e7eb;
}

td{
    padding:10px;
    border:1px solid #e5e7eb;
    text-align:center;
}

.badge-warning{
    color:#dc2626;
    font-weight:bold;
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

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="container">

    <!-- INFO SISWA -->
    <div class="card">
        <h2>Detail Riwayat Pelanggaran Siswa</h2>

        <div class="info-grid">

            <div class="info-item">
                <small>Nama</small><br>
                <strong><?= $siswa['nama_siswa']; ?></strong>
            </div>

            <div class="info-item">
                <small>NISN</small><br>
                <strong><?= $siswa['nisn']; ?></strong>
            </div>

            <div class="info-item">
                <small>Kelas</small><br>
                <strong><?= $siswa['kelas']; ?></strong>
            </div>

            <div class="info-item">
                <small>Total Poin</small><br>
                <strong><?= $siswa['total_poin']; ?> Poin</strong>
            </div>

        </div>
    </div>

    <!-- PELANGGARAN BERULANG -->
    <div class="card">

        <h3>Pelanggaran Berulang</h3>

        <table>
            <tr>
                <th>Jenis Pelanggaran</th>
                <th>Jumlah</th>
            </tr>
            

            <?php while($b = mysqli_fetch_assoc($berulang)) { ?>

<tr>
    <td>
        <?= $b['nama_pelanggaran']; ?>
        <br>
        <small style="color:gray;">
            (<?= $b['kategori']; ?>)
        </small>
    </td>

    <td>
        <?php if($b['jumlah'] >= 3){ ?>
            <span class="badge-warning"><?= $b['jumlah']; ?>x (Sering)</span>
        <?php } else { ?>
            <?= $b['jumlah']; ?>x
        <?php } ?>
    </td>
</tr>

<?php } ?>

        </table>
    </div>

  <!-- RIWAYAT DETAIL -->
<div class="card">

    <h3>Riwayat Pelanggaran</h3>

    <table>
        <tr>
            <th>Tanggal</th>
            <th>Pelanggaran</th>
            <th>Kategori</th>
            <th>Poin</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($riwayat)) { ?>

        <tr>
            <td><?= $r['tanggal']; ?></td>
            <td><?= $r['jenis_pelanggaran']; ?></td>
            <td><?= $r['kategori']; ?></td>
            <td><?= $r['poin']; ?></td>
        </tr>

        <?php } ?>

    </table>

</div>
<div class="bottom-action">

        <a href="komunikasi_orangtua.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</body>
</html>