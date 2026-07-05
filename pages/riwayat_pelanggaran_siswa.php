<?php
include __DIR__ . '/../config/koneksi.php';
session_start();


// ambil kelas wali kelas yang login
$kelasLogin = $_SESSION['kelas'];

$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$bulan = $_GET['bulan'] ?? '';
$nama = $_GET['nama'] ?? '';

$where = "WHERE s.kelas='$kelasLogin'";

if ($bulan != '') {
    $where .= " AND MONTH(ps.tanggal) = '$bulan'";
}
if ($nama != '') {
    $where .= " AND s.nama_siswa = '$nama'";
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
       ps.catatan,
       lk.id_laporan
FROM pelanggaran_siswa ps
JOIN data_siswa s ON ps.id_siswa = s.id_siswa
JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
LEFT JOIN laporan_konseling lk
ON ps.id = lk.id_pelanggaran_siswa
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
    border:1px solid #e5e7eb;
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


/* STATUS */
.status-awal,
.status-laporan{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    min-width:125px;
    padding:8px 14px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    font-size:13px;
    white-space:nowrap;
}

.status-awal{
    background:#fee2e2;
    color:#dc2626;
}

.status-laporan{
    background:#dcfce7;
    color:#15803d;
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

.judul-section{
    color:#15803d;
    font-size:18px;
    margin-bottom:15px;
    font-weight:600;
}
</style>
</head>
<body>

<!-- MODAL POP-UP -->
 <div id="modalLaporan" class="modal">
    <div class="modal-content">

        <span class="close-modal">&times;</span>

       <h3>Tindak Lanjut Pelanggaran</h3>

<div id="detailPelanggaran"></div>

<div id="formLaporan">

<div style="margin-top:15px;">
    <label>Tanggal Tindak Lanjut</label>

    <input
        type="date"
        id="tanggal_tindak_lanjut"
        style="
        width:100%;
        padding:10px;
        border:1px solid #d1d5db;
        border-radius:10px;
        margin-top:8px;"
    >
</div>

<div style="margin-top:15px;">
    <label>Catatan Konseling/Tindak Lanjut</label>

    <textarea
        id="catatan_konseling"
        style="
        width:100%;
        min-height:120px;
        padding:10px;
        border:1px solid #d1d5db;
        border-radius:10px;
        margin-top:8px;"
    ></textarea>
</div>

<input type="hidden" id="id_pelanggaran_siswa">

<button id="btnSimpanLaporan"
        class="btn-filter"
        style="margin-top:15px;">
    Simpan
</button>
    </div>
</div>
</div>



<!-- CONTAINER -->
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

          
            <form method="GET" class="filter-wrap" id="filterForm">

    <!-- BULAN -->
    <div class="select-box">
        <i class="fas fa-calendar"></i>
       <select name="bulan" onchange="document.getElementById('filterForm').submit()">
           <option value="" <?= ($bulan=='')?'selected':''; ?>>Semua Bulan</option>
<option value="1" <?= ($bulan=='1')?'selected':''; ?>>Januari</option>
<option value="2" <?= ($bulan=='2')?'selected':''; ?>>Februari</option>
<option value="3" <?= ($bulan=='3')?'selected':''; ?>>Maret</option>
<option value="4" <?= ($bulan=='4')?'selected':''; ?>>April</option>
<option value="5" <?= ($bulan=='5')?'selected':''; ?>>Mei</option>
<option value="6" <?= ($bulan=='6')?'selected':''; ?>>Juni</option>
<option value="7" <?= ($bulan=='7')?'selected':''; ?>>Juli</option>
<option value="8" <?= ($bulan=='8')?'selected':''; ?>>Agustus</option>
<option value="9" <?= ($bulan=='9')?'selected':''; ?>>September</option>
<option value="10" <?= ($bulan=='10')?'selected':''; ?>>Oktober</option>
<option value="11" <?= ($bulan=='11')?'selected':''; ?>>November</option>
<option value="12" <?= ($bulan=='12')?'selected':''; ?>>Desember</option>
        </select>
    </div>

    <!-- NAMA -->
    <div class="select-box">
    <i class="fas fa-user"></i>
    <select name="nama" onchange="document.getElementById('filterForm').submit()">
        <option value="">Semua Siswa</option>

<?php
$q = mysqli_query($koneksi,"SELECT nama_siswa FROM data_siswa
WHERE kelas='$kelasLogin'
ORDER BY nama_siswa ASC");

while($s=mysqli_fetch_assoc($q)){ ?>
    <option value="<?= $s['nama_siswa']; ?>"
        <?= ($nama==$s['nama_siswa'])?'selected':''; ?>>
        <?= $s['nama_siswa']; ?>
    </option>
<?php } ?>

        
    </select>
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
            <th>Detail Pelanggaran</th>
            <th>Status</th>
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
         <td>

<?php if(empty($r['id_laporan'])){ ?>

    <a href="#"
   class="laporan-awal status-awal"
   data-id="<?= $r['id']; ?>">

   <i class="fas fa-triangle-exclamation"></i>
   Laporan Awal

</a>

<?php } else { ?>

    <a href="#"
   class="lihat-laporan status-laporan"
   data-id="<?= $r['id']; ?>">

   <i class="fas fa-file-lines"></i>
   Lihat Laporan

</a>

<?php } ?>

</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

        <!-- PAGINATION -->

      <div class="pagination">

<?php if($page > 1){ ?>
<a class="page-btn" href="?page=<?= $page-1 ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>">‹</a>
<?php } ?>

<?php
$start = max(1, $page - 2);
$end = min($total_pages, $page + 2);

for ($i = $start; $i <= $end; $i++) { ?>
    <a href="?page=<?= $i ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>"
       class="page-btn <?= ($i == $page) ? 'active' : '' ?>">
        <?= $i ?>
    </a>
<?php } ?>

<?php if($page < $total_pages){ ?>
<a class="page-btn" href="?page=<?= $page+1 ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>">›</a>
<?php } ?>
</div>

    <!-- BOTTOM -->

    <div class="bottom-action">

        <a href="dashboard_walikelas.php" class="btn-back">
            <i class="fas fa-chevron-left"></i>
        </a>

    </div>

</div>


<!-- POP-UP MODAL -->

<script>

const modal = document.getElementById('modalLaporan');

document.addEventListener('click', function(e){

    // LAPORAN AWAL
    if(e.target.classList.contains('laporan-awal')){

        e.preventDefault();

        let id = e.target.dataset.id;
        document.getElementById('formLaporan').style.display = 'block';

        document.getElementById('tanggal_tindak_lanjut').style.display = 'block';
        document.getElementById('catatan_konseling').style.display = 'block';
        document.getElementById('btnSimpanLaporan').style.display = 'inline-block';

        fetch('get_detail_pelanggaran.php?id=' + id)
        .then(response => response.json())
        .then(data => {

            document.getElementById('id_pelanggaran_siswa').value = data.id;

            document.getElementById('detailPelanggaran').innerHTML = `
                <div class="detail-card">
                    <div class="detail-grid">

                        <div class="detail-label">Tanggal</div>
                        <div class="detail-value">${data.tanggal}</div>

                        <div class="detail-label">Nama Siswa</div>
                        <div class="detail-value">${data.nama_siswa}</div>

                        <div class="detail-label">NISN</div>
                        <div class="detail-value">${data.nisn}</div>

                        <div class="detail-label">Kelas</div>
                        <div class="detail-value">${data.kelas}</div>

                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">${data.kategori}</div>

                        <div class="detail-label">Jenis Pelanggaran</div>
                        <div class="detail-value">${data.jenis_pelanggaran}</div>

                        <div class="detail-label">Bobot Poin</div>
                        <div class="detail-value">${data.poin}</div>

                        <div class="detail-label">Detail Pelanggaran</div>
                        <div class="detail-value">${data.catatan ?? '-'}</div>

                    </div>
                </div>
            `;

            modal.style.display = 'block';

        });

    }

    // LIHAT LAPORAN
    if(e.target.classList.contains('lihat-laporan')){

        e.preventDefault();

        let id = e.target.dataset.id;

        fetch('get_laporan_konseling.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailPelanggaran').innerHTML = `
    <div class="detail-card">
        <div class="detail-grid">

            <div class="detail-label">Nama Siswa</div>
            <div class="detail-value">${data.nama_siswa}</div>

            <div class="detail-label">NISN</div>
            <div class="detail-value">${data.nisn}</div>

            <div class="detail-label">Kelas</div>
            <div class="detail-value">${data.kelas}</div>

            <div class="detail-label">Kategori</div>
            <div class="detail-value">${data.kategori}</div>

            <div class="detail-label">Jenis Pelanggaran</div>
            <div class="detail-value">${data.jenis_pelanggaran}</div>

            <div class="detail-label">Bobot Poin</div>
            <div class="detail-value">${data.poin}</div>

            <div class="detail-label">Detail Pelanggaran</div>
            <div class="detail-value">${data.catatan ?? '-'}</div>

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

           document.getElementById('formLaporan').style.display = 'none';
            modal.style.display = 'block';

        });

    }

});

document.querySelector('.close-modal').onclick = function(){
    modal.style.display = 'none';
}

window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = 'none';
    }
}

document.getElementById('btnSimpanLaporan').addEventListener('click', function(){

    let id = document.getElementById('id_pelanggaran_siswa').value;
    let catatan = document.getElementById('catatan_konseling').value;
    let tanggal = document.getElementById('tanggal_tindak_lanjut').value;

    if(tanggal == ''){
        alert('Tanggal tindak lanjut wajib diisi!');
        return;
    }

    if(catatan.trim() == ''){
        alert('Catatan konseling wajib diisi!');
        return;
    }

    fetch('simpan_laporan_konseling.php', {

        method:'POST',

        headers:{
            'Content-Type':'application/x-www-form-urlencoded'
        },

        body:
        'id_pelanggaran_siswa=' + id +
        '&catatan_konseling=' + encodeURIComponent(catatan) +
        '&tanggal_tindak_lanjut=' + tanggal

    })

    .then(response => response.text())
    .then(result => {

        if(result.trim() == 'success'){

            alert('Laporan berhasil disimpan');
            location.reload();

        }else{

            alert(result);

        }

    });

});

</script>
</body>
</html>