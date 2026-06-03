<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kepala Sekolah</title>
</head>
<body>

<h2>Dashboard Wali Kelas</h2>

<p>Selamat datang, <b><?php echo $nama; ?></b></p>

<a href="logout.php">Logout</a>

</body>
</html>