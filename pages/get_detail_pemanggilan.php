<?php
include __DIR__ . '/../config/koneksi.php';

header('Content-Type: application/json');

// ===============================
// Ambil ID Pemanggilan
// ===============================
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id <= 0){
    echo json_encode([
        "status" => "error",
        "pesan"  => "ID tidak valid."
    ]);
    exit;
}

// ===============================
// Ambil Detail Pemanggilan
// ===============================
$query = mysqli_query($koneksi, "
    SELECT
    p.id_pemanggilan,
    p.tanggal_pemanggilan,
    p.keterangan,
    p.status,
    p.tanggal_pembinaan,
    p.hasil_pembinaan,

    s.nama_siswa,
    s.nisn,
    s.kelas,

    jp.kategori,
    jp.jenis_pelanggaran,
    jp.poin

FROM pemanggilan_siswa p

JOIN pelanggaran_siswa ps
ON p.id_pelanggaran_siswa = ps.id

JOIN data_siswa s
ON ps.id_siswa = s.id_siswa

JOIN jenis_pelanggaran jp
ON ps.id_pelanggaran = jp.id_pelanggaran

WHERE p.id_pemanggilan='$id'
LIMIT 1
");

if(mysqli_num_rows($query) == 0){

    echo json_encode([
        "status" => "error",
        "pesan"  => "Data tidak ditemukan."
    ]);

    exit;
}

$data = mysqli_fetch_assoc($query);

// ===============================
// Format Tanggal
// ===============================
if(!empty($data['tanggal_tindak_lanjut'])){
    $data['tanggal_tindak_lanjut'] =
    date('d-m-Y', strtotime($data['tanggal_tindak_lanjut']));
}

if(!empty($data['tanggal_konseling'])){
    $data['tanggal_konseling'] =
    date('Y-m-d', strtotime($data['tanggal_konseling']));
}

// ===============================
// Kirim JSON
// ===============================
echo json_encode($data);