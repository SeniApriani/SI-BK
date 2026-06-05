<?php

include __DIR__ . '/../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM jenis_pelanggaran WHERE id_pelanggaran='$id'");
$row = mysqli_fetch_assoc($data);

$kategori = $row['kategori'];
$jenis_pelanggaran = $row['jenis_pelanggaran'];
$bobot_poin = $row['poin'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Jenis Pelanggaran</title>

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
    padding:30px;
    color:#374151;
}

.container{
    max-width:800px;
    margin:auto;
}

.card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:25px;
}

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
}

.form-group input,
.form-group select{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:12px 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
}

.form-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:25px;
}

.btn-back{
    width:45px;
    height:45px;
    border-radius:50%;
    border:1px solid #15803d;
    color:#15803d;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.3s;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 24px;
    border-radius:10px;
    cursor:pointer;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

}

</style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="page-header">

            <h1>Edit Jenis Pelanggaran</h1>

            <p>Perbarui data jenis pelanggaran yang sudah terdaftar.</p>

        </div>

        <form method="POST">

            <div class="form-group">

                <label>Kategori Pelanggaran</label>

                <select name="kategori" required>

                    <option value="Kedisiplinan" <?= ($kategori=="Kedisiplinan") ? "selected" : ""; ?>>
                        Kedisiplinan
                    </option>

                    <option value="Kerapihan" <?= ($kategori=="Kerapihan") ? "selected" : ""; ?>>
                        Kerapihan
                    </option>

                    <option value="Etika" <?= ($kategori=="Etika") ? "selected" : ""; ?>>
                        Etika
                    </option>

                    <option value="Akademik" <?= ($kategori=="Akademik") ? "selected" : ""; ?>>
                        Akademik
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Jenis Pelanggaran</label>

                <input
                    type="text"
                    name="jenis_pelanggaran"
                    value="<?= $jenis_pelanggaran; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Bobot Poin</label>

                <input
                    type="number"
                    name="bobot_poin"
                    value="<?= $bobot_poin; ?>"
                    required
                >

            </div>

            <div class="form-action">

                <a href="jenis_pelanggaran.php" class="btn-back">

                    <i class="fas fa-chevron-left"></i>

                </a>

                <button type="submit" name="update" class="btn-save">

                    <i class="fas fa-pen-to-square"></i>

                    Update Data

                </button>

            </div>

        </form>

    </div>

</div>

<?php

if(isset($_POST['update'])){

    $kategori = $_POST['kategori'];
    $jenis = $_POST['jenis_pelanggaran'];
    $poin = $_POST['bobot_poin'];

    mysqli_query($koneksi, "UPDATE jenis_pelanggaran SET 
        kategori='$kategori',
        jenis_pelanggaran='$jenis',
        poin='$poin'
        WHERE id_pelanggaran='$id'
    ");

    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='jenis_pelanggaran.php';
    </script>
    ";
}

?>
</body>
</html>