<?php
include "../config/koneksi.php";

$id = $_GET['id'] ?? '';

if($id === ''){
    header("Location: data_guru.php");
    exit;
}

// ambil username dulu, dibutuhkan untuk hapus dari tabel users
$q = mysqli_query($koneksi,"
    SELECT username FROM data_guru WHERE id_guru='$id'
");

if(!$q){
    die(mysqli_error($koneksi));
}

$guru = mysqli_fetch_assoc($q);

if($guru){

    mysqli_query($koneksi,"
        DELETE FROM data_guru WHERE id_guru='$id'
    ");

    mysqli_query($koneksi,"
        DELETE FROM users WHERE username='" . $guru['username'] . "'
    ");

}

header("Location: data_guru.php");
exit;
