<?php
include __DIR__ . '/../config/koneksi.php';
session_start();

// pastikan hanya wali kelas yang login yang boleh akses
if (!isset($_SESSION['kelas'])) {
    http_response_code(403);
    echo 'Akses ditolak. Silakan login terlebih dahulu.';
    exit;
}

// pastikan request via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Metode tidak diizinkan.';
    exit;
}

$id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'] ?? '';
$catatan_konseling     = trim($_POST['catatan_konseling'] ?? '');
$tanggal_tindak_lanjut = $_POST['tanggal_tindak_lanjut'] ?? '';

// validasi input dasar
if ($id_pelanggaran_siswa === '' || $catatan_konseling === '' || $tanggal_tindak_lanjut === '') {
    echo 'Data tidak lengkap. Pastikan tanggal dan keterangan sudah diisi.';
    exit;
}

if (!ctype_digit((string)$id_pelanggaran_siswa)) {
    echo 'ID pelanggaran tidak valid.';
    exit;
}

// cek apakah pelanggaran ini benar milik siswa di kelas wali kelas yang login
// (mencegah wali kelas mengirim laporan untuk siswa kelas lain)
$cekStmt = mysqli_prepare($koneksi, "
    SELECT ps.id
    FROM pelanggaran_siswa ps
    JOIN data_siswa s ON ps.id_siswa = s.id_siswa
    WHERE ps.id = ? AND s.kelas = ?
");
mysqli_stmt_bind_param($cekStmt, 'is', $id_pelanggaran_siswa, $_SESSION['kelas']);
mysqli_stmt_execute($cekStmt);
mysqli_stmt_store_result($cekStmt);

if (mysqli_stmt_num_rows($cekStmt) === 0) {
    echo 'Data pelanggaran tidak ditemukan atau bukan wewenang Anda.';
    exit;
}
mysqli_stmt_close($cekStmt);

// cek supaya tidak dobel laporan untuk pelanggaran yang sama
$cekLaporan = mysqli_prepare($koneksi, "
    SELECT id_laporan FROM laporan_konseling WHERE id_pelanggaran_siswa = ?
");
mysqli_stmt_bind_param($cekLaporan, 'i', $id_pelanggaran_siswa);
mysqli_stmt_execute($cekLaporan);
mysqli_stmt_store_result($cekLaporan);

if (mysqli_stmt_num_rows($cekLaporan) > 0) {
    echo 'Pemanggilan untuk pelanggaran ini sudah pernah dikirim sebelumnya.';
    exit;
}
mysqli_stmt_close($cekLaporan);

// ======================================================
// SIMPAN KE TABEL LAPORAN KONSELING
// ======================================================
$stmt = mysqli_prepare($koneksi, "
INSERT INTO laporan_konseling
(
    id_pelanggaran_siswa,
    catatan_konseling,
    tanggal_tindak_lanjut,
    status
)
VALUES
(
    ?, ?, ?, 'menunggu_pembinaan'
)
");

mysqli_stmt_bind_param(
    $stmt,
    'iss',
    $id_pelanggaran_siswa,
    $catatan_konseling,
    $tanggal_tindak_lanjut
);

// ======================================================
// JIKA BERHASIL SIMPAN LAPORAN,
// MAKA OTOMATIS MASUK KE TABEL PEMANGGILAN_SISWA
// ======================================================

if(mysqli_stmt_execute($stmt)){

    // simpan juga ke tabel pemanggilan_siswa
    $stmt2 = mysqli_prepare($koneksi,"
    INSERT INTO pemanggilan_siswa
    (
        id_pelanggaran_siswa,
        tanggal_pemanggilan,
        keterangan,
        status
    )
    VALUES
    (
        ?, ?, ?, 'Menunggu Pembinaan'
    )
    ");

    mysqli_stmt_bind_param(
        $stmt2,
        'iss',
        $id_pelanggaran_siswa,
        $tanggal_tindak_lanjut,
        $catatan_konseling
    );

    if(mysqli_stmt_execute($stmt2)){
        echo "success";
    }else{
        echo "Gagal menyimpan ke tabel pemanggilan_siswa : ".mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt2);

}else{

    echo "Gagal menyimpan laporan konseling : ".mysqli_error($koneksi);

}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);