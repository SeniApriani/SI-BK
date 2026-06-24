<?php
include "../config/koneksi.php";

/* ==================================================
   REMISI OTOMATIS 6%
================================================== */

$siswa = mysqli_query($koneksi,"
SELECT DISTINCT id_siswa
FROM pelanggaran_siswa
");

// echo "Remisi otomatis berjalan <br>";
while($row = mysqli_fetch_assoc($siswa)){

    $id_siswa = $row['id_siswa'];

    $last = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT MAX(tanggal) AS last_date
    FROM pelanggaran_siswa
    WHERE id_siswa='$id_siswa'
    "));

    if(empty($last['last_date'])){
        continue;
    }

    $selisih = floor(
        (strtotime(date('Y-m-d')) - strtotime($last['last_date']))
        / 86400
    );

    if($selisih < 30){
        continue;
    }

    $cek = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT *
    FROM remisi_otomatis
    WHERE id_siswa='$id_siswa'
    AND MONTH(tanggal_remisi)=MONTH(CURDATE())
    AND YEAR(tanggal_remisi)=YEAR(CURDATE())
    "));

    if($cek > 0){
        continue;
    }

    $data_poin = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT total_poin
    FROM rekap_poin
    WHERE id_siswa='$id_siswa'
    LIMIT 1
    "));

    if(!$data_poin){
        echo "Rekap poin tidak ditemukan untuk siswa ".$id_siswa."<br>";
        continue;
    }

    $total_poin = (int)$data_poin['total_poin'];

/* ==========================================
   HITUNG SALDO POIN POSITIF SISWA
   Modal awal = 100
========================================== */
$saldo = 100 - $total_poin;

/* ==========================================
   JIKA SALDO SUDAH 100
   TIDAK PERLU REMISI LAGI
========================================== */
if($saldo >= 100){
    continue;
}

/* ==========================================
   REMISI OTOMATIS 6%
   DIHITUNG DARI SALDO POSITIF
========================================== */
$potongan = round($saldo * 0.06);

if($potongan < 1){
    $potongan = 1;
}

/* ==========================================
   TAMBAHKAN REMISI KE SALDO
========================================== */
$saldo_baru = $saldo + $potongan;

/* ==========================================
   BATASI MAKSIMAL 100
========================================== */
if($saldo_baru > 100){
    $saldo_baru = 100;
}

/* ==========================================
   KONVERSI KEMBALI KE TOTAL PELANGGARAN
========================================== */
$total_baru = 100 - $saldo_baru;

    echo "Lolos remisi siswa: ".$id_siswa."<br>";
   
    $simpan = mysqli_query($koneksi,"
    INSERT INTO remisi_otomatis
(id_siswa, persen_remisi, potongan_poin, tanggal_remisi, keterangan)
VALUES
('$id_siswa','6','$potongan',CURDATE(),'Tidak melakukan pelanggaran 30 hari')
    ");

    if(!$simpan){
        die("ERROR INSERT : ".mysqli_error($koneksi));
    }

    mysqli_query($koneksi,"
    UPDATE rekap_poin
    SET total_poin='$total_baru'
    WHERE id_siswa='$id_siswa'
    ");

    echo "Berhasil simpan remisi siswa ".$id_siswa."<br>";
}
?>