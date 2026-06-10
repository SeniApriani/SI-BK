<?php
include "../config/koneksi.php";

/* =========================
   ACTION SETUJUI / TOLAK
========================= */
if(isset($_GET['action']) && isset($_GET['id'])){

    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == 'setujui'){
        mysqli_query($koneksi,"
        UPDATE pengajuan_remisi
        SET status='Disetujui'
        WHERE id_remisi='$id'
        ");
    }

    if($action == 'tolak'){
        mysqli_query($koneksi,"
        UPDATE pengajuan_remisi
        SET status='Ditolak'
        WHERE id_remisi='$id'
        ");
    }

    echo "<script>window.location='pengajuan_remisi_wakasek.php';</script>";
    exit;
}

/* =========================
   SIMPAN PENGAJUAN (ADA BUKTI)
========================= */
if(isset($_POST['simpan'])){

    $id_siswa = $_POST['id_siswa'];
    $jenis_prestasi = $_POST['jenis_prestasi'];
    $nama_prestasi = $_POST['nama_prestasi'];
    $poin_remisi = $_POST['poin_remisi'];

    // upload bukti
    $bukti = $_FILES['bukti']['name'];
    $tmp   = $_FILES['bukti']['tmp_name'];

    if(!empty($bukti)){
        $folder = "../bukti_remisi/";
        move_uploaded_file($tmp, $folder.$bukti);
    }

    $simpan = mysqli_query($koneksi,"
    INSERT INTO pengajuan_remisi
    (id_siswa, jenis_prestasi, nama_prestasi, poin_remisi, status, bukti)
    VALUES
    ('$id_siswa','$jenis_prestasi','$nama_prestasi','$poin_remisi','Menunggu','$bukti')
    ");

    if($simpan){
        echo "
        <script>
        localStorage.setItem('remisi_berhasil','1');
        window.location='penilaian_poin_pelanggaran.php';
        </script>
        ";
        exit;
    }
}

$remisi = mysqli_query($koneksi,"
SELECT pr.*, ds.nama_siswa
FROM pengajuan_remisi pr
JOIN data_siswa ds
ON pr.id_siswa = ds.id_siswa
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Penilaian Poin Pelanggaran</title>

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
    max-width:1100px;
    margin:auto;
}

/* =========================
   TAB MENU
========================= */

.tab-card{
    background:#fff;
    border-radius:18px;
    padding:0 30px;
    margin-bottom:25px;
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

/* =========================
   CARD
========================= */

.card{
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:30px;
}

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:8px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* =========================
   FORM
========================= */

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
}

.required{
    color:#dc2626;
}

.form-group input,
.form-group select{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:13px 15px;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
}

.readonly{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

input[type=file]{
    padding:12px;
}

/* =========================
   BUTTON
========================= */

.form-action{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:30px;
}

.btn-cancel{
    text-decoration:none;
    border:1px solid #16a34a;
    color:#16a34a;
    background:#fff;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.btn-cancel:hover{
    background:#f0fdf4;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu{
        overflow-x:auto;
        gap:25px;
    }

    .card{
        padding:20px;
    }

    .form-action{
        flex-direction:column;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
        justify-content:center;
        text-align:center;
    }

}

/* DROPDOWNN */
.dropdown-siswa{
    position: relative;
    width: 100%;
}

.list-siswa{
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    max-height: 180px;
    overflow-y: auto;
    display: none;
    z-index: 9999;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.item-siswa{
    padding:10px 12px;
    cursor:pointer;
}

.item-siswa:hover{
    background:#f3f4f6;
}

.table-container{
    overflow-x:auto;
    margin-top:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
}

thead{
    background:#dcfce7; /* hijau muda pastel */
}

th{
    color:#166534; /* hijau tua */
    font-weight:600;
    text-align:center;
}

th, td{
    padding:14px;
    border:1px solid #d1d5db;
}

td{
    color:#374151;
}

tbody tr:hover{
    background:#f9fafb;
}
.btn-setujui{
    background:#16a34a;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
}

.btn-tolak{
    background:#dc2626;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
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

</style>

</head>
<body>

<div class="container">

    <!-- TAB MENU -->

    <div class="tab-card">

        <div class="tab-menu">

            <a href="penilaian_poin_pelanggaran.php" class="tab active">
                <i class="fas fa-award"></i>
                Pengajuan Remisi
            </a>

            <a href="riwayat_remisi_wakasek.php" class="tab">
                <i class="fas fa-history"></i>
                Riwayat Remisi
            </a>

            <a href="rekap_poin.php" class="tab">
                <i class="fas fa-chart-bar"></i>
                Rekap Poin pelanggaran
            </a>

            

        </div>

    </div>

    <!-- FORM REMISI -->

<div class="card">

<div class="page-header">

    <h1>Persetujuan Pengajuan Remisi</h1>
    <p>
Daftar pengajuan remisi yang menunggu persetujuan Wakasek Kesiswaan.
</p>
</div>

<div class="table-container">

    <table width="100%" cellpadding="10">

        <thead>

            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Prestasi</th>
                <th>Remisi</th>
                <th>Bukti</th>
                <th>Detail</th>
            </tr>

        </thead>

        <tbody>

        <?php
        $no = 1;
        while($r = mysqli_fetch_assoc($remisi)){
        ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $r['nama_siswa']; ?></td>

                <td><?= $r['nama_prestasi']; ?></td>

                <td><?= $r['poin_remisi']; ?>%</td>

                <td>
<?php if(!empty($r['bukti'])) { ?>
    <a href="../upload/bukti_remisi/<?= $r['bukti']; ?>" target="_blank">
        Lihat Bukti
    </a>
<?php } else { ?>
    <span style="color:red;">Tidak ada file</span>
<?php } ?>
</td>
              <td style="text-align:center;">

    <?php if($r['status'] == 'Menunggu'){ ?>

    <div style="display:flex; gap:8px; justify-content:center;">

        <a href="?action=setujui&id=<?= $r['id_remisi']; ?>" class="btn-setujui">
            Setujui
        </a>

        <a href="?action=tolak&id=<?= $r['id_remisi']; ?>" class="btn-tolak">
            Tolak
        </a>

    </div>

<?php } else { ?>

    <span style="
    padding:6px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:600;
    color:#fff;
    background:<?= $r['status']=='Disetujui' ? '#16a34a' : '#dc2626'; ?>
">
    <?= $r['status']; ?>
</span>

<?php } ?>

</td>

            </tr>

        <?php } ?>

        </tbody>

    </table>
    <br> <br>

     <!-- BACK -->

    <div class="bottom-action">

        <a href="dashboard_wakasek.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</div>
<script>
const search = document.getElementById('searchSiswa');
const list = document.getElementById('listSiswa');
const items = document.querySelectorAll('.item-siswa');
const hidden = document.getElementById('id_siswa');

// buka list saat klik / focus
search.addEventListener('focus', () => {
    list.style.display = 'block';
});

// filter
search.addEventListener('input', function(){
    let val = this.value.toLowerCase();

    list.style.display = 'block';

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(val) ? 'block' : 'none';
    });
});

// pilih item
items.forEach(item => {
    item.addEventListener('click', function(){
        search.value = this.textContent.trim();
        hidden.value = this.dataset.id;
        list.style.display = 'none';
    });
});

document.addEventListener('click', function(e){
    if(!e.target.closest('.dropdown-siswa')){
        list.style.display = 'none';
    }
});
</script>

<script>

const jenisPrestasi = document.getElementById('jenis_prestasi');
const poinRemisi = document.getElementById('poin_remisi');

jenisPrestasi.addEventListener('change', function(){

    if(this.value == '15'){
        poinRemisi.value = '15';
    }
    else if(this.value == '25'){
        poinRemisi.value = '25';
    }
    else if(this.value == '50'){
        poinRemisi.value = '50';
    }
    else if(this.value == '100'){
        poinRemisi.value = '100';
    }
    else{
        poinRemisi.value = '';
    }

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
if(localStorage.getItem('remisi_berhasil') === '1'){

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Pengajuan remisi berhasil diajukan.',
        confirmButtonColor: '#16a34a'
    });

    localStorage.removeItem('remisi_berhasil');
}
</script>


</body>
</html
