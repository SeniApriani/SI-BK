<?php
include "../config/koneksi.php";

// ambil id pelanggaran siswa
$id = $_GET['id'] ?? '';

// validasi
if ($id == '') {
    echo "ID tidak ditemukan";
    exit;
}

// ambil data pelanggaran siswa
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT id_siswa, poin
FROM pelanggaran_siswa
WHERE id = '$id'
"));

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

$id_siswa = $data['id_siswa'];
$poin = $data['poin'] ?? 0;

// update rekap poin (kurangi)
mysqli_query($koneksi, "
UPDATE rekap_poin
SET total_poin = total_poin - $poin
WHERE id_siswa = '$id_siswa'
");

// hapus data pelanggaran
mysqli_query($koneksi, "
DELETE FROM pelanggaran_siswa
WHERE id = '$id'
");

// redirect
echo "<script>
alert('Data pelanggaran berhasil dihapus');
window.location.href='riwayat_pelanggaran_siswa.php';
</script>";
?>