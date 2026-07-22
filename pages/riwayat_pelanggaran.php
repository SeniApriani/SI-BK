<?php
session_start();

// notif


include "../config/koneksi.php";
// ======================================================
// MENGAMBIL DATA LOGIN
// ======================================================

$id_siswa = $_SESSION['id_siswa'];

$nama = $_SESSION['nama'];

$role = $_SESSION['role'];
/* =========================
PAGINATION SETUP
========================= */
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

/* TOTAL DATA */
$totalData = mysqli_num_rows(mysqli_query($koneksi,"
SELECT * FROM pelanggaran_siswa
WHERE id_siswa='$id_siswa'
"));

$totalPage = ceil($totalData / $limit);

/* DATA RIWAYAT */

$query = mysqli_query($koneksi,"
SELECT
    ps.id,
    ps.tanggal,
    jp.kategori,
    jp.jenis_pelanggaran,
    jp.poin,
    ps.catatan,
    lk.id_laporan
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran
LEFT JOIN laporan_konseling lk
ON ps.id = lk.id_pelanggaran_siswa
WHERE ps.id_siswa='$id_siswa'
ORDER BY ps.tanggal DESC
LIMIT $start,$limit
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

/* MODAL */
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
    margin:50px auto;
    padding:25px;
    border-radius:15px;
    max-height:85vh;
    overflow-y:auto;
    scrollbar-width:thin;
}

.close-modal{
    float:right;
    font-size:28px;
    cursor:pointer;
    font-weight:bold;
}

.detail-card{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}

.detail-grid{
    display:grid;
    grid-template-columns:180px 1fr;
    gap:10px;
}

.detail-label{
    font-weight:600;
    color:#374151;
}

.detail-value{
    color:#6b7280;
}


</style>
</head>

<body>


<!-- POP-UP MODAL -->
 <div id="modalLaporan" class="modal">
    <div class="modal-content">

        <span class="close-modal">&times;</span>

        <h3>Tindak Lanjut Pelanggaran</h3>

        <div id="detailLaporan"></div>

    </div>
</div>

<!-- POP-UP CONTAINER -->

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
<th>Kategori</th>
<th>Jenis Pelanggaran</th>
<th>Bobot Poin</th>
<th>Detail Pelanggaran</th>
<th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php if(mysqli_num_rows($query) > 0){ ?>

                <?php while($row = mysqli_fetch_assoc($query)){ ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>

<td><?= $row['kategori']; ?></td>

<td><?= $row['jenis_pelanggaran']; ?></td>

<td>
    <span class="badge">
        <?= $row['poin']; ?>
    </span>
</td>

<td><?= $row['catatan'] ?: '-'; ?></td>

<td>

<?php if(empty($row['id_laporan'])){ ?>

    <span style="
    background:#fee2e2;
    color:#dc2626;
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;">
        Laporan Awal
    </span>

<?php } else { ?>

    <a href="#"
       class="lihat-laporan"
       data-id="<?= $row['id']; ?>"
       style="
       background:#dcfce7;
       color:#15803d;
       padding:6px 10px;
       border-radius:8px;
       text-decoration:none;
       font-size:12px;
       font-weight:600;">
        Lihat Laporan
    </a>

<?php } ?>

</td>
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

</div>

<!-- MODAL -->
 <script>

const modal = document.getElementById('modalLaporan');

document.addEventListener('click', function(e){

    if(e.target.classList.contains('lihat-laporan')){

        e.preventDefault();

        let id = e.target.dataset.id;

        fetch('get_laporan_konseling.php?id=' + id)
        .then(response => response.json())
        .then(data => {

            document.getElementById('detailLaporan').innerHTML = `
                <div class="detail-card">
                    <div class="detail-grid">

                        <div class="detail-label">Tanggal Pelanggaran</div>
                        <div class="detail-value">${data.tanggal}</div>

                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">${data.kategori}</div>

                        <div class="detail-label">Jenis Pelanggaran</div>
                        <div class="detail-value">${data.jenis_pelanggaran}</div>

                        <div class="detail-label">Bobot Poin</div>
                        <div class="detail-value">${data.poin}</div>

                        <div class="detail-label">Detail Pelanggaran</div>
                        <div class="detail-value">${data.catatan ? data.catatan : '-'}</div>
                      

                    </div>
                </div>

                <div class="detail-card">
                    <div class="detail-grid">

                        <div class="detail-label">Tanggal Tindak Lanjut</div>
                        <div class="detail-value">${data.tanggal_tindak_lanjut}</div>

                        <div class="detail-label">Catatan Konseling</div>
                        <div class="detail-value">${data.catatan_konseling}</div>

                    </div>
                </div>
            `;

           modal.style.display='flex';

        });

    }

});

document.querySelector('.close-modal').onclick = function(){
    modal.style.display='none';
}

window.onclick = function(event){
    if(event.target==modal){
        modal.style.display='none';
    }
}

</script>

</body>
</html>