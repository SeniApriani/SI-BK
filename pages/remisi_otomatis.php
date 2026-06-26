<?php
include "../config/koneksi.php";

/* ==================================================
   REMISI OTOMATIS 6%
================================================== */

$siswa = mysqli_query($koneksi,"
SELECT DISTINCT id_siswa
FROM pelanggaran_siswa
");

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

    // Selisih hari dari pelanggaran terakhir
    $selisih = floor(
        (strtotime(date('Y-m-d')) - strtotime($last['last_date']))
        / 86400
    );

    if($selisih < 30){
        continue;
    }

    // Tanggal remisi = 30 hari setelah pelanggaran terakhir
    $tanggal_remisi = date('Y-m-d', strtotime($last['last_date'].' +30 days'));

    // Cek apakah remisi untuk tanggal tersebut sudah pernah dibuat
    $cek = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT *
    FROM remisi_otomatis
    WHERE id_siswa='$id_siswa'
    AND tanggal_remisi='$tanggal_remisi'
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
        continue;
    }

    $total_poin = (int)$data_poin['total_poin'];

    /* ==========================================
       HITUNG SALDO
    ========================================== */

    $saldo = 100 - $total_poin;

    if($saldo >= 100){
        continue;
    }

    /* ==========================================
       REMISI 6%
    ========================================== */

    $potongan = round($saldo * 0.06);

    if($potongan < 1){
        $potongan = 1;
    }

    $saldo_baru = $saldo + $potongan;

    if($saldo_baru > 100){
        $saldo_baru = 100;
    }

    $total_baru = 100 - $saldo_baru;

    /* ==========================================
       SIMPAN REMISI
    ========================================== */

    $simpan = mysqli_query($koneksi,"
    INSERT INTO remisi_otomatis
    (id_siswa,persen_remisi,potongan_poin,tanggal_remisi,keterangan)
    VALUES
    ('$id_siswa','6','$potongan','$tanggal_remisi','Tidak melakukan pelanggaran 30 hari')
    ");

    if(!$simpan){
        die(mysqli_error($koneksi));
    }

    mysqli_query($koneksi,"
    UPDATE rekap_poin
    SET total_poin='$total_baru'
    WHERE id_siswa='$id_siswa'
    ");

}
?>