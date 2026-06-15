

<?php
include "../config/koneksi.php";
include "remisi_otomatis.php";

/* =========================
   AMBIL LIST SISWA
========================= */
$siswa = mysqli_query($koneksi,"
SELECT DISTINCT id_siswa, nama_siswa
FROM data_siswa
");

/* =========================
   SELECT SISWA
========================= */
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';
$data_siswa = null;
$total_poin = 0;

if($id_siswa != ''){

    $data_siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT *
    FROM data_siswa
    WHERE id_siswa='$id_siswa'
    "));

    // 🔥 PAKAI INI SAJA (TIDAK HITUNG ULANG LAGI)
    $total_poin = $data_siswa['total_poin'];
}

/* =========================
   QUERY RIWAYAT REMISI
   (TETAP DIPAKAI)
========================= */
$remisi = mysqli_query($koneksi,"
SELECT
    ds.nama_siswa,
    pr.tanggal_pengajuan AS tanggal,
    'Prestasi' AS tipe_remisi,
    pr.nama_prestasi AS keterangan,
    CONCAT(pr.poin_remisi,'%') AS remisi,
    pr.bukti
FROM pengajuan_remisi pr
JOIN data_siswa ds ON pr.id_siswa = ds.id_siswa

UNION ALL

SELECT
    ds.nama_siswa,
    ro.tanggal_remisi AS tanggal,
    'Otomatis' AS tipe_remisi,
    ro.keterangan,
    CONCAT(ro.persen_remisi,'%') AS remisi,
    '' AS bukti
FROM remisi_otomatis ro
JOIN data_siswa ds ON ro.id_siswa = ds.id_siswa

ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Remisi</title>

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

/* TAB MENU */

.tab-card{
    background:#fff;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    overflow:hidden;
}

.tab-menu{
    display:grid;
    grid-template-columns:repeat(4,1fr);
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

/* PILIH SISWA */

.form-group{
    margin-top:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.form-group select{
    width:100%;
    max-width:320px;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
}

.form-group select:focus{
    border-color:#16a34a;
}

/* INFO SISWA */

.student-info{
    display:none;
    margin-top:25px;
}

.student-info.active{
    display:block;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}

.info-item{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:18px;
}

.info-item small{
    display:block;
    color:#6b7280;
    margin-bottom:6px;
}

.info-item strong{
    color:#111827;
    font-size:15px;
}

.total-point strong{
    color:#16a34a;
    font-size:18px;
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

.badge-system{
    background:#f3f4f6;
    color:#6b7280;
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
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

```html id="x7d9ql"
/* PAGINATION */

.pagination-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-top:20px;
}

.pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin:0 auto;
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
    font-size:16px;
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

    .info-grid{
        grid-template-columns:1fr;
    }

    .bottom-action{
        justify-content:center;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="tab-card">

        <div class="tab-menu">

            <a href="pengajuan_remisi_wakasek.php" class="tab">
                <i class="fas fa-file-signature"></i>
                Daftar Pengajuan Remisi
            </a>

            <a href="riwayat_remisi_wakasek.php" class="tab active">
                <i class="fas fa-history"></i>
                Riwayat Remisi
            </a>

            <a href="rekap_poin_wakasek.php" class="tab">
                <i class="fas fa-chart-bar"></i>
                Rekap Poin Pelanggaran
            </a>

           
            
        </div>

    </div>

    <!-- PILIH SISWA -->

    <div class="card">

        <div class="page-header">

            <h1>Riwayat Remisi</h1>

            <p>Pilih siswa untuk melihat detail poin dan identitas siswa.</p>

        </div>

        <div class="form-group">

            <label>Pilih Siswa</label>

           <select id="siswaSelect">

    <option value="">-- Pilih Siswa --</option>

    <?php while($s = mysqli_fetch_assoc($siswa)){ ?>

        <option value="<?= $s['id_siswa']; ?>">
            <?= $s['nama_siswa']; ?>
        </option>

    <?php } ?>

</select>
        </div>

        <!-- MUNCUL SETELAH PILIH SISWA -->

        <div class="student-info <?= ($id_siswa != '') ? 'active' : ''; ?>" id="studentInfo">
            <div class="info-grid">

              <div class="info-item">
    <small>Nama Siswa</small>
    <strong>
        <?= ($data_siswa) ? $data_siswa['nama_siswa'] : '-'; ?>
    </strong>
</div>

                <div class="info-item">
    <small>NISN</small>
    <strong>
        <?= ($data_siswa) ? $data_siswa['nisn'] : '-'; ?>
    </strong>
</div>
                <div class="info-item total-point">
    <small>Total Poin Saat Ini</small>
    <strong><?= $total_poin; ?> Poin</strong>
</div>
            </div>

        </div>

    </div>

    <!-- TABEL SELALU MUNCUL -->

    <div class="card">

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Tipe Remisi</th>
                        <th>Keterangan</th>
                        <th>Remisi</th>
                        <th>Bukti</th>
                    </tr>

                </thead>

              <tbody>

<?php

$remisi = mysqli_query($koneksi,"
SELECT
    ds.nama_siswa,
    pr.tanggal_pengajuan AS tanggal,
    'Prestasi' AS tipe_remisi,
    pr.nama_prestasi AS keterangan,
    CONCAT(pr.poin_remisi,'%') AS remisi,
    pr.bukti
FROM pengajuan_remisi pr
JOIN data_siswa ds ON pr.id_siswa = ds.id_siswa

UNION ALL

SELECT
    ds.nama_siswa,
    ro.tanggal_remisi AS tanggal,
    'Otomatis' AS tipe_remisi,
    ro.keterangan,
    CONCAT(ro.persen_remisi,'%') AS remisi,
    '' AS bukti
FROM remisi_otomatis ro
JOIN data_siswa ds ON ro.id_siswa = ds.id_siswa

ORDER BY tanggal DESC
");


$no = 1;

while($r = mysqli_fetch_assoc($remisi)){

?>

<tr>

    <td><?= $no++; ?></td>

    <td><?= $r['nama_siswa']; ?></td>

    <td><?= date('d/m/Y', strtotime($r['tanggal'])); ?></td>
    <td><?= $r['tipe_remisi']; ?></td>

   <td><?= $r['keterangan']; ?></td>

    <td><?= $r['remisi']; ?></td>
    <td>

        <?php if(!empty($r['bukti'])){ ?>

            <a href="../upload/bukti_remisi/<?= $r['bukti']; ?>" class="btn-view" target="_blank">
                Lihat Bukti
            </a>

        <?php } ?>

    </td>

</tr>

<?php } ?>

</tbody>
            </table>

        </div>

    </div>

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

    <div class="bottom-action">

        <a href="dashboard_wakasek.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</div>

<script>

const siswaSelect = document.getElementById('siswaSelect');
const studentInfo = document.getElementById('studentInfo');

siswaSelect.addEventListener('change', function(){

    if(this.value != ''){

        window.location =
        'riwayat_remisi_wakasek.php?id_siswa=' + this.value;

    }

});


</script>

</body>
</html>
remisi wakasek 
