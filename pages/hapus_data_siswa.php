<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hapus Data Siswa</title>

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
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.modal{
    background:#fff;
    width:400px;
    border-radius:20px;
    padding:30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.12);
}

.modal-icon{
    width:80px;
    height:80px;
    margin:auto;
    border-radius:50%;
    background:#fef2f2;
    color:#dc2626;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    margin-bottom:20px;
}

.modal h2{
    color:#111827;
    margin-bottom:10px;
}

.modal p{
    color:#6b7280;
    font-size:14px;
    line-height:1.6;
}

.student-name{
    color:#dc2626;
    font-weight:600;
}

.modal-action{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:12px;
    margin-top:25px;
}

.btn-cancel,
.btn-delete{
    width:120px;
    height:42px;
    border:none;
    border-radius:10px;
    font-size:14px;
    font-weight:500;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    cursor:pointer;
    transition:.3s;
}

.btn-cancel{
    background:#e5e7eb;
    color:#374151;
}

.btn-cancel:hover{
    background:#d1d5db;
}

.btn-delete{
    background:#dc2626;
    color:#fff;
    gap:6px;
}

.btn-delete:hover{
    background:#b91c1c;
}

.form-delete{
    margin:0;
}

</style>

</head>
<body>

<?php

/* nanti ambil dari database */
$nama_siswa = "Ahmad Fauzi";

?>

<div class="modal">

    <div class="modal-icon">
        <i class="fas fa-trash"></i>
    </div>

    <h2>Hapus Data Siswa</h2>

    <p>
        Apakah Anda yakin ingin menghapus data siswa
        <br><br>

        <span class="student-name">
            <?= $nama_siswa; ?>
        </span>

        ?
    </p>

    <div class="modal-action">

        <a href="data_siswa.php" class="btn-cancel">
            Batal
        </a>

        <form method="POST" class="form-delete">

            <button type="submit" name="hapus" class="btn-delete">

                <i class="fas fa-trash"></i>
                Hapus

            </button>

        </form>

    </div>

</div>

<?php

if(isset($_POST['hapus'])){

    // QUERY DELETE DATABASE DI SINI

    echo "
    <script>
        alert('Data siswa berhasil dihapus');
        window.location='data_siswa.php';
    </script>
    ";

}

?>

</body>
</html>