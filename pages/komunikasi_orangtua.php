
<?php
include "../config/koneksi.php";

if (isset($_GET['selesai'])) {
    $id = $_GET['selesai'];

    mysqli_query($koneksi, "
        UPDATE pelanggaran_siswa 
        SET status='selesai'
        WHERE id_siswa='$id'
    ");
}

$query = mysqli_query($koneksi, "
SELECT 
    s.id_siswa,
    s.nama_siswa,
    s.kelas,

    ROUND(
        p.total_poin - 
       ROUND(p.total_poin * (COALESCE(r.persen,0) + COALESCE(ro.persen,0)) / 100)
    ) AS total_poin,

    COALESCE(k.status,'proses') AS status

FROM data_siswa s

LEFT JOIN komunikasi_ortu k 
ON k.id_siswa = s.id_siswa

LEFT JOIN (
    SELECT 
        ps.id_siswa,
        SUM(jp.poin) AS total_poin
    FROM pelanggaran_siswa ps
    JOIN jenis_pelanggaran jp 
        ON ps.id_pelanggaran = jp.id_pelanggaran
    GROUP BY ps.id_siswa
) p ON p.id_siswa = s.id_siswa

LEFT JOIN (
    SELECT 
        id_siswa,
        SUM(poin_remisi) AS persen
    FROM pengajuan_remisi
    WHERE status='Disetujui'
    GROUP BY id_siswa
) r ON r.id_siswa = s.id_siswa

LEFT JOIN (
    SELECT 
        id_siswa,
        SUM(persen_remisi) AS persen
    FROM remisi_otomatis
    GROUP BY id_siswa
) ro ON ro.id_siswa = s.id_siswa

HAVING total_poin >= 21

ORDER BY total_poin DESC
") or die(mysqli_error($koneksi));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Komunikasi Orang Tua</title>

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

.tab.active{
    color:#16a34a;
}

.tab.active::after{
    width:100%;
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
}

.btn-search{
    border:none;
    background:#16a34a;
    color:#fff;
    border-radius:10px;
    cursor:pointer;
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
    padding:8px 12px;
    background:#22c55e;
    color:white;
    border:none;
    border-radius:20px;
    display:flex;
    align-items:center;
    gap:6px;
    cursor:pointer;
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
    font-size:14px;
}

.dropdown-content a:hover{
    background:#f3f4f6;
}

.dropdown.active .dropdown-content{
    display:block;
}

/* FORM PROSES */

.form-card{
    display:none;
}

.form-card.active{
    display:block;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-bottom:25px;
}

.info-item{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:16px;
}

.info-item small{
    display:block;
    color:#6b7280;
    margin-bottom:5px;
}

.info-item strong{
    color:#111827;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.form-group input,
.form-group select{
    width:100%;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
}

.form-group input[type=file]{
    padding:10px;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.form-action{
    display:flex;
    justify-content:flex-end;
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
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu,
    .info-grid,
    .form-grid{
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

            <a href="#" class="tab active">
                <i class="fas fa-user-clock"></i>
                Daftar Tindak Lanjut
            </a>

            <a href="riwayat_komunikasi.php" class="tab">
                <i class="fas fa-history"></i>
                Riwayat Komunikasi
            </a>

        </div>

    </div>

    <!-- FILTER -->

    <div class="card">

        <div class="page-header">

            <h1>Komunikasi Orang Tua</h1>

            <p>Daftar siswa yang harus ditindaklanjuti karena telah mencapai batas poin pelanggaran.</p>

        </div>

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

    <!-- DAFTAR TINDAK LANJUT -->

    <div class="card">

        <div class="table-header">

            <div class="table-title">

                <i class="fas fa-users"></i>

                Daftar Tindak Lanjut

            </div>

        </div>

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Total Poin</th>
                        <th>Detail</th>
                    </tr>

                </thead>

               <tbody>
<?php $no = 1; while($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_siswa']; ?></td>
    <td><?= $row['kelas']; ?></td>
    <td><?= $row['total_poin']; ?></td>
    <td>

        <div class="dropdown">

            <button class="btn-detail">

<?php if(trim(strtolower($row['status'])) == 'selesai'){ ?>

    <i class="fas fa-check-circle"></i> Selesai

<?php } else { ?>

    <i class="fas fa-eye"></i>

<?php } ?>

</button>

            <div class="dropdown-content">

                <a href="input_komunikasi_ortu.php?id=<?= $row['id_siswa']; ?>">
                    <i class="fas fa-comments"></i>
                    Proses
                </a>

                <a href="?selesai=<?= $row['id_siswa']; ?>">
    <i class="fas fa-check-circle"></i>
    Selesai
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

    <!-- FORM INI MUNCUL SAAT KLIK PROSES -->

    <div class="card form-card">

        <div class="table-title" style="margin-bottom:20px;">

            <i class="fas fa-comments"></i>

            Input Hasil Komunikasi Orang Tua

        </div>

        <div class="info-grid">

            <div class="info-item">
                <small>Nama Siswa</small>
                <strong>Ahmad Fauzi</strong>
            </div>

            <div class="info-item">
                <small>NISN</small>
                <strong>1234567890</strong>
            </div>

            <div class="info-item">
                <small>Kelas</small>
                <strong>XI RPL 1</strong>
            </div>

            <div class="info-item">
                <small>Total Poin</small>
                <strong>120</strong>
            </div>

        </div>

        <form>

            <div class="form-grid">

                <div class="form-group">

                    <label>Nama Orang Tua / Wali</label>

                    <input type="text">

                </div>

                <div class="form-group">

                    <label>Tanggal Pertemuan</label>

                    <input type="date">

                </div>

                <div class="form-group">

                    <label>Jenis Pertemuan</label>

                    <select>

                        <option>Sekolah</option>
                        <option>Home Visit</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Upload Berita Acara</label>

                    <input type="file">

                </div>

            </div>

            <div class="form-action">

                <button type="submit" class="btn-save">

                    Simpan

                </button>

            </div>

        </form>

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



