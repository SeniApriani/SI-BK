<?php
include __DIR__ . '/../config/koneksi.php';
session_start();

$role = $_SESSION['role'] ?? '';

// hanya wali kelas yang boleh mengedit data pelanggaran
if ($role !== 'wali_kelas') {
    header("Location: riwayat_pelanggaran_siswa.php");
    exit;
}

$kelasLogin = $_SESSION['kelas'];

$id = $_GET['id'] ?? ($_POST['id'] ?? '');

if (!ctype_digit((string)$id)) {
    die("ID pelanggaran tidak valid.");
}

/* ===================== SIMPAN PERUBAHAN ===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tanggal = $_POST['tanggal'] ?? '';
    $id_pelanggaran = $_POST['id_pelanggaran'] ?? '';
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan'] ?? '');

    if ($tanggal === '' || $id_pelanggaran === '') {
        $error = "Tanggal dan jenis pelanggaran wajib diisi!";
    } else {

        // pastikan data yang diedit memang milik siswa di kelas wali kelas ini
        $cek = mysqli_prepare($koneksi, "
            SELECT ps.id
            FROM pelanggaran_siswa ps
            JOIN data_siswa s ON ps.id_siswa = s.id_siswa
            WHERE ps.id = ? AND s.kelas = ?
        ");
        mysqli_stmt_bind_param($cek, 'is', $id, $kelasLogin);
        mysqli_stmt_execute($cek);
        mysqli_stmt_store_result($cek);

        if (mysqli_stmt_num_rows($cek) === 0) {
            die("Data tidak ditemukan atau bukan wewenang Anda.");
        }
        mysqli_stmt_close($cek);

        $update = mysqli_prepare($koneksi, "
            UPDATE pelanggaran_siswa
            SET tanggal = ?, id_pelanggaran = ?, catatan = ?
            WHERE id = ?
        ");
        mysqli_stmt_bind_param($update, 'siss', $tanggal, $id_pelanggaran, $catatan, $id);

        if (mysqli_stmt_execute($update)) {
            header("Location: riwayat_pelanggaran_siswa.php");
            exit;
        } else {
            $error = "Gagal menyimpan perubahan: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($update);
    }
}

/* ===================== AMBIL DATA UNTUK DITAMPILKAN DI FORM ===================== */
$stmt = mysqli_prepare($koneksi, "
    SELECT
        ps.id,
        ps.tanggal,
        ps.id_pelanggaran,
        ps.catatan,
        s.nama_siswa,
        s.nisn,
        s.kelas,
        jp.kategori AS current_kategori,
        jp.poin AS current_poin
    FROM pelanggaran_siswa ps
    JOIN data_siswa s ON ps.id_siswa = s.id_siswa
    JOIN jenis_pelanggaran jp ON ps.id_pelanggaran = jp.id_pelanggaran
    WHERE ps.id = ? AND s.kelas = ?
");
mysqli_stmt_bind_param($stmt, 'is', $id, $kelasLogin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan atau bukan wewenang Anda.");
}

// daftar kategori (untuk dropdown pertama)
$kategoriQuery = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM jenis_pelanggaran ORDER BY kategori ASC");
$kategoriList = [];
while ($k = mysqli_fetch_assoc($kategoriQuery)) {
    $kategoriList[] = $k['kategori'];
}

// semua jenis pelanggaran (dipakai JS untuk filter kaskade kategori -> jenis)
$jenisAllQuery = mysqli_query($koneksi, "SELECT id_pelanggaran, kategori, jenis_pelanggaran, poin FROM jenis_pelanggaran ORDER BY jenis_pelanggaran ASC");
$jenisAll = [];
while ($j = mysqli_fetch_assoc($jenisAllQuery)) {
    $jenisAll[] = $j;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Data Pelanggaran</title>

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
    max-width:800px;
    margin:auto;
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
    font-size:28px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* IDENTITAS SISWA */

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
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
    margin-bottom:6px;
}

.info-item strong{
    color:#111827;
    font-size:15px;
}

/* FORM */

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    font-size:14px;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:12px 15px;
    outline:none;
    font-family:'Poppins',sans-serif;
}

.form-group textarea{
    min-height:100px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color:#16a34a;
}

.alert-error{
    background:#fef2f2;
    color:#dc2626;
    border:1px solid #fecaca;
    padding:12px;
    border-radius:12px;
    margin-bottom:20px;
    font-size:14px;
}

.form-action{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:10px;
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

.btn-cancel{
    text-decoration:none;
    background:#f3f4f6;
    color:#374151;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-cancel:hover{
    background:#e5e7eb;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .info-grid{
        grid-template-columns:1fr;
    }

    .form-action{
        flex-direction:column-reverse;
    }

    .btn-save,
    .btn-cancel{
        justify-content:center;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="card">

        <div class="page-header">
            <h1>Edit Data Pelanggaran</h1>
            <p>Ubah data pelanggaran siswa yang sudah dicatat.</p>
        </div>

    </div>

    <!-- IDENTITAS SISWA (read-only) -->
    <div class="card">

        <div class="info-grid">

            <div class="info-item">
                <small>Nama Siswa</small>
                <strong><?= htmlspecialchars($row['nama_siswa']); ?></strong>
            </div>

            <div class="info-item">
                <small>NISN</small>
                <strong><?= htmlspecialchars($row['nisn']); ?></strong>
            </div>

            <div class="info-item">
                <small>Kelas</small>
                <strong><?= htmlspecialchars($row['kelas']); ?></strong>
            </div>

        </div>

    </div>

    <!-- FORM EDIT -->
    <div class="card">

        <?php if (!empty($error)) { ?>
        <div class="alert-error"><?= htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="POST">

            <input type="hidden" name="id" value="<?= (int)$row['id']; ?>">

            <div class="form-group">
                <label>Tanggal Pelanggaran</label>
                <input
                    type="date"
                    name="tanggal"
                    value="<?= htmlspecialchars($row['tanggal']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Kategori Pelanggaran</label>
                <select id="kategori_pelanggaran" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategoriList as $kat) { ?>
                    <option
                        value="<?= htmlspecialchars($kat); ?>"
                        <?= ($kat === $row['current_kategori']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($kat); ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Pelanggaran</label>
                <select name="id_pelanggaran" id="jenis_pelanggaran" required>
                    <option value="">-- Pilih Jenis Pelanggaran --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Bobot Poin</label>
                <input type="text" id="bobot_poin" value="<?= (int)$row['current_poin']; ?>" readonly style="background:#f3f4f6;">
            </div>

            <div class="form-group">
                <label>Detail Pelanggaran</label>
                <textarea
                    name="catatan"
                    placeholder="Tuliskan detail kejadian pelanggaran"
                ><?= htmlspecialchars($row['catatan']); ?></textarea>
            </div>

            <div class="form-action">

                <a href="riwayat_pelanggaran_siswa.php" class="btn-cancel">
                    <i class="fas fa-xmark"></i>
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<script>
// data seluruh jenis pelanggaran, dipakai untuk filter kaskade kategori -> jenis
const jenisData = <?= json_encode($jenisAll); ?>;

const idJenisAwal = <?= (int)$row['id_pelanggaran']; ?>;

const selectKategori = document.getElementById('kategori_pelanggaran');
const selectJenis = document.getElementById('jenis_pelanggaran');
const inputPoin = document.getElementById('bobot_poin');

function renderJenisOptions(kategoriTerpilih, idJenisTerpilih){

    selectJenis.innerHTML = '<option value="">-- Pilih Jenis Pelanggaran --</option>';

    jenisData
        .filter(function(j){ return j.kategori === kategoriTerpilih; })
        .forEach(function(j){

            let opt = document.createElement('option');
            opt.value = j.id_pelanggaran;
            opt.textContent = j.jenis_pelanggaran + ' (' + j.poin + ' poin)';
            opt.dataset.poin = j.poin;

            if (parseInt(j.id_pelanggaran) === parseInt(idJenisTerpilih)) {
                opt.selected = true;
            }

            selectJenis.appendChild(opt);
        });
}

// render awal sesuai data yang sedang diedit
if (selectKategori.value !== '') {
    renderJenisOptions(selectKategori.value, idJenisAwal);
}

// waktu kategori diganti manual, reset jenis (tidak ada yang otomatis kepilih)
selectKategori.addEventListener('change', function(){
    renderJenisOptions(this.value, null);
    inputPoin.value = '';
});

// waktu jenis dipilih, bobot poin otomatis mengikuti
selectJenis.addEventListener('change', function(){
    let opt = this.options[this.selectedIndex];
    inputPoin.value = opt && opt.dataset.poin ? opt.dataset.poin : '';
});
</script>

</body>
</html>