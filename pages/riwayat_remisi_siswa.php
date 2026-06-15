<?php
include "../config/koneksi.php";
session_start();

/* AMBIL SISWA LOGIN */
$id_siswa = $_SESSION['id_siswa'];

if(!isset($id_siswa)){
    die("Session siswa tidak ditemukan");
}

/* DATA SISWA */
$data_siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'
"));

/* TOTAL POIN */
$poin = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COALESCE(SUM(jp.poin),0) AS total_poin
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp 
ON ps.id_pelanggaran = jp.id_pelanggaran
WHERE ps.id_siswa='$id_siswa'
"));

$total_poin = $poin['total_poin'];

/* RIWAYAT REMISI */
$remisi = mysqli_query($koneksi,"
SELECT
    pr.tanggal_pengajuan,
    pr.nama_prestasi,
    pr.poin_remisi,
    pr.status,
    pr.bukti
FROM pengajuan_remisi pr
WHERE pr.id_siswa='$id_siswa'
ORDER BY pr.tanggal_pengajuan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Remisi Saya</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

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
body{
    font-family:Poppins;
    background:#f5f7fb;
    padding:25px;
}

.container{
    max-width:1000px;
    margin:auto;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:18px;
    margin-bottom:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* INFO */
.info{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}

.box{
    background:#f0fdf4;
    padding:15px;
    border-radius:12px;
    border:1px solid #bbf7d0;
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
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* STATUS */
.status{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.menunggu{background:#fef9c3;color:#92400e;}
.setuju{background:#dcfce7;color:#166534;}
.tolak{background:#fee2e2;color:#991b1b;}

.btn{
    padding:6px 10px;
    background:#e0f2fe;
    color:#0369a1;
    border-radius:8px;
    text-decoration:none;
}

h1{
    color:#15803d;
}


/* =========================
   TAB MENU
========================= */

.tab-card{
    background:#fff;
    border-radius:18px;
    max-width:960px;
    margin:0 auto 20px auto;
    padding:10px 20px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.tab-menu{
    display:flex;
    align-items:center;
    gap:45px;
    min-height:72px;
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
    height:72px;
    transition:.3s;
}

.tab i{
    font-size:15px;
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
    border-radius:20px;
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


</style>
</head>
<body>
     <!-- TAB MENU -->

    <div class="tab-card">

        <div class="tab-menu">
            <?php $page = basename($_SERVER['PHP_SELF']); ?>

            <a href="pengajuan_remisi_siswa.php" 
   class="tab <?= $page == 'pengajuan_remisi_siswa.php' ? 'active' : '' ?>">
    <i class="fas fa-award"></i>
    Pengajuan Remisi
</a>

<a href="riwayat_remisi_siswa.php" 
   class="tab <?= $page == 'riwayat_remisi_siswa.php' ? 'active' : '' ?>">
    <i class="fas fa-history"></i>
    Riwayat Pengajuan Remisi
</a>
        </div>

    </div>

<div class="container">

<div class="card">

    <h1>Riwayat Remisi Saya</h1>

    <div class="info">

        <div class="box">
            <small>Nama</small><br>
            <b><?= $data_siswa['nama_siswa']; ?></b>
        </div>

        <div class="box">
            <small>NISN</small><br>
            <b><?= $data_siswa['nisn']; ?></b>
        </div>
        <div class="box">
            <small>Kelas</small><br>
            <b><?= $data_siswa['kelas']; ?></b>
        </div>
    </div>
</div>

<div class="card">

<h3 style="color:#15803d;">Riwayat Pengajuan Remisi</h3>

<table>

<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Prestasi</th>
    <th>Remisi</th>
    <th>Bukti</th>
    <th>Status</th>
    
</tr>

<?php $no=1; while($r=mysqli_fetch_assoc($remisi)){ ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['tanggal_pengajuan']; ?></td>
    <td><?= $r['nama_prestasi']; ?></td>
    <td><?= $r['poin_remisi']; ?>%</td>

    <td>
        <?php if($r['bukti']){ ?>
            <a class="btn" target="_blank"
            href="../upload/bukti_remisi/<?= $r['bukti']; ?>">
            Lihat
            </a>
        <?php } ?>
    </td>

    <td>
        <?php if($r['status']=='Disetujui'){ ?>
            <span class="status setuju">Disetujui</span>
        <?php } elseif($r['status']=='Ditolak'){ ?>
            <span class="status tolak">Ditolak</span>
        <?php } else { ?>
            <span class="status menunggu">Menunggu</span>
        <?php } ?>
    </td>

</tr>
<?php } ?>

</table>

</div>
<div class="bottom-action">
    <a href="dashboard_siswa.php" class="btn-back">
        <i class="fas fa-chevron-left"></i>
    </a>
    </div>

</div>


<?php if(isset($_SESSION['success'])) { ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $_SESSION['success']; ?>',
    confirmButtonColor: '#16a34a'
});
</script>
<?php unset($_SESSION['success']); } ?>

</body>
</html>