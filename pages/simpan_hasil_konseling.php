<?php
// ======================================================
// KONEKSI DATABASE
// ======================================================
include __DIR__ . '/../config/koneksi.php';

// ======================================================
// HANYA MENERIMA REQUEST POST
// ======================================================
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit("Akses ditolak.");
}

// ======================================================
// AMBIL DATA DARI FORM
// (nama variabel disesuaikan dengan yang dikirim JavaScript)
// ======================================================
$id_pemanggilan      = $_POST['id_pemanggilan'] ?? '';
$tanggal_pembinaan   = $_POST['tanggal_pembinaan'] ?? '';
$hasil_pembinaan     = trim($_POST['hasil_pembinaan'] ?? '');

// ======================================================
// VALIDASI
// ======================================================
if (
    empty($id_pemanggilan) ||
    empty($tanggal_pembinaan) ||
    empty($hasil_pembinaan)
) {
    exit("Semua data wajib diisi.");
}

// ======================================================
// CEK DATA PEMANGGILAN ADA ATAU TIDAK
// ======================================================
$cek = mysqli_query($koneksi,"
SELECT id_pemanggilan
FROM pemanggilan_siswa
WHERE id_pemanggilan='$id_pemanggilan'
");

if(mysqli_num_rows($cek)==0){
    exit("Data pemanggilan tidak ditemukan.");
}

// ======================================================
// UPDATE HASIL KONSELING
// Sekaligus ubah status menjadi Sudah Dibina
// ======================================================
$query = mysqli_query($koneksi,"
UPDATE pemanggilan_siswa
SET
    tanggal_pembinaan = '$tanggal_pembinaan',
    hasil_pembinaan   = '$hasil_pembinaan',
    status            = 'Sudah Dibina'
WHERE id_pemanggilan = '$id_pemanggilan'
");

// ======================================================
// RESPONSE KE AJAX
// ======================================================
if($query){

    echo "success";

}else{

    echo "Gagal menyimpan data : ".mysqli_error($koneksi);

}

// ======================================================
// TUTUP KONEKSI
// ======================================================
mysqli_close($koneksi);
?>