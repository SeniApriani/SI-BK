<?php
include __DIR__ . '/../config/koneksi.php';

$siswa = mysqli_query($koneksi, "SELECT * FROM data_siswa");
$kategori = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM jenis_pelanggaran");
$jenisData = mysqli_query($koneksi, "SELECT * FROM jenis_pelanggaran");

if(isset($_POST['simpan'])){

    $id_siswa = $_POST['id_siswa'];
    $id_pelanggaran = $_POST['id_pelanggaran'];
    $tanggal = date('Y-m-d');
    $catatan = $_POST['catatan'];

    // 1. ambil poin dulu
    $data_pelanggaran = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT poin
        FROM jenis_pelanggaran
        WHERE id_pelanggaran='$id_pelanggaran'
    "));

    $poin = $data_pelanggaran['poin'];

    // 2. simpan pelanggaran
    mysqli_query($koneksi, "
        INSERT INTO pelanggaran_siswa
        (id_siswa, id_pelanggaran, tanggal, catatan, poin)
        VALUES
        ('$id_siswa', '$id_pelanggaran', '$tanggal', '$catatan', '$poin')
    ");

    $id_siswa = $_POST['id_siswa'];

// ambil nama pelanggaran (kalau ada)
$nama_pelanggaran = $_POST['nama_pelanggaran'];

mysqli_query($koneksi,"
INSERT INTO notifikasi
(
    id_user,
    role,
    judul,
    pesan,
    tipe,
    link
)
VALUES
(
    '$id_siswa',
    'siswa',
    'Pelanggaran Baru',
    'Kamu mendapatkan pelanggaran: $nama_pelanggaran',
    'pelanggaran',
    'riwayat_pelanggaran.php'
)
");

    // 3. update rekap poin
    $cek = mysqli_query($koneksi,"SELECT * FROM rekap_poin WHERE id_siswa='$id_siswa'");

if(mysqli_num_rows($cek) > 0){
    mysqli_query($koneksi,"
        UPDATE rekap_poin 
        SET total_poin = total_poin + $poin
        WHERE id_siswa='$id_siswa'
    ");
} else {
    mysqli_query($koneksi,"
        INSERT INTO rekap_poin (id_siswa, total_poin)
        VALUES ('$id_siswa', $poin)
    ");
}

    header("Location: riwayat_pelanggaran_siswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Pelanggaran Siswa</title>

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
    max-width:900px;
    margin:auto;
}

/* TAB */

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
    padding:30px;
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

/* FORM */

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
}

.required{
    color:#dc2626;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:12px 15px;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color:#16a34a;
}

.form-group textarea{
    resize:none;
    min-height:120px;
}

.readonly{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

/* BUTTON */

.form-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:30px;
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
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 24px;
    border-radius:10px;
    cursor:pointer;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-card{
        flex-wrap:wrap;
        gap:8px;
    }

    .tab-right{
        margin-left:0;
    }

    .card{
        padding:20px;
    }

}


/* Cari Siswa */
.dropdown-siswa{
    position: relative;
    width: 100%;
}

#searchSiswa{
    width: 100%;
    box-sizing: border-box;
}

.list-siswa{
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    width: 100%;
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
    text-align: left;
    width: 100%;
    box-sizing: border-box;
    display: block; /* ini penting biar gak “geser kanan” */
}

.item-siswa:hover{
    background:#f3f4f6;
}

</style>

</head>
<body>

<div class="container">

    <!-- TAB MENU -->

    <div class="tab-card">

        <a href="data_pelanggaran_siswa.php" class="tab active">

            <i class="fas fa-pen-to-square"></i>

            Pencatatan

        </a>

        <a href="riwayat_pelanggaran_siswa.php" class="tab tab-right">

            <i class="fas fa-clock-rotate-left"></i>

            Riwayat Data Pelanggaran

        </a>

    </div>

    <!-- FORM PENCATATAN -->

    <div class="card">

        <div class="page-header">

            <h1>Pencatatan Pelanggaran</h1>

            <p>Input data pelanggaran siswa ke dalam sistem.</p>

        </div>

        <form method="POST">

            <div class="form-group">

                <label>
                    Nama Siswa
                    <span class="required">*</span>
                </label>
                
   

    <div class="dropdown-siswa" style="position:relative;">
    <input type="text" id="searchSiswa" placeholder="Cari siswa...">

    <div id="listSiswa" class="list-siswa">

    <?php while($s = mysqli_fetch_assoc($siswa)) { ?>
    <div class="item-siswa" data-id="<?= $s['id_siswa']; ?>">
        <?= $s['nama_siswa']; ?> - <?= $s['kelas']; ?> (<?= $s['nisn']; ?>)
    </div>
<?php } ?>
    </div>

    <input type="hidden" name="id_siswa" id="id_siswa">
</div>

            </div>

            <div class="form-group">

                <label>
                    Kategori Pelanggaran
                    <span class="required">*</span>
                </label>

              <select name="kategori" id="kategori">
    <option value="">-- Pilih Kategori --</option>

    <?php while($k = mysqli_fetch_assoc($kategori)) { ?>
        <option value="<?= $k['kategori']; ?>">
            <?= $k['kategori']; ?>
        </option>
    <?php } ?>

</select>

            </div>

            <div class="form-group">

                <label>
                    Jenis Pelanggaran
                    <span class="required">*</span>
                </label>

                <select name="id_pelanggaran" id="jenis">
    <option value="">-- Pilih Jenis Pelanggaran --</option>
</select>
            </div>

            <div class="form-group">

                <label>Bobot Poin</label>

                <input type="text" id="poin" name="poin" class="readonly" readonly>
            </div>

            <div class="form-group">

                <label>Catatan</label>

                
                <textarea name="catatan" placeholder="Masukkan catatan konseling jika diperlukan..."></textarea>

            </div>

            <div class="form-action">

                <a href="dashboard_walikelas.php" class="btn-back">

                    <i class="fas fa-chevron-left"></i>

                </a>

                
                    <button type="submit" name="simpan" class="btn-save">

                    <i class="fas fa-save"></i>

                    Simpan Data

                </button>

            </div>

        </form>

    </div>

</div>

<script>

const dataJenis = <?= json_encode(mysqli_fetch_all($jenisData, MYSQLI_ASSOC)); ?>;

document.getElementById('kategori').addEventListener('change', function(){

    let kategori = this.value;
    let jenis = document.getElementById('jenis');

    jenis.innerHTML = '<option value="">-- Pilih Jenis Pelanggaran --</option>';

    dataJenis.forEach(item => {
        if(item.kategori === kategori){
            let opt = document.createElement('option');
            opt.value = item.id_pelanggaran;
            opt.textContent = item.jenis_pelanggaran;
            jenis.appendChild(opt);
        }
    });

});

document.getElementById('jenis').addEventListener('change', function(){

    let id = this.value;
    let poinField = document.getElementById('poin');

    let data = dataJenis.find(x => x.id_pelanggaran == id);

    if(data){
        poinField.value = data.poin;
    }else{
        poinField.value = '';
    }

});

</script>


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

// klik luar
document.addEventListener('click', function(e){
    if(!e.target.closest('.dropdown-siswa')){
        list.style.display = 'none';
    }
});
</script>
</body>
</html>