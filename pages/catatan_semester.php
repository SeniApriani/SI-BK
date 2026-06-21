<?php
session_start();
include "../config/koneksi.php";
$kelas = $_GET['kelas'] ?? '';

$kelas_login = $_SESSION['kelas'];

$semester = "Ganjil";
$tahun_ajaran = "2025/2026";

/* SIMPAN */
if(isset($_POST['simpan'])){

    $id_siswa = $_POST['id_siswa'];
    $catatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['catatan']
    );

    $cek = mysqli_query($koneksi,"
    SELECT *
    FROM catatan_semester
    WHERE id_siswa='$id_siswa'
    AND semester='$semester'
    AND tahun_ajaran='$tahun_ajaran'
    ");

    if(mysqli_num_rows($cek)>0){

        mysqli_query($koneksi,"
        UPDATE catatan_semester
        SET catatan_walikelas='$catatan'
        WHERE id_siswa='$id_siswa'
        AND semester='$semester'
        AND tahun_ajaran='$tahun_ajaran'
        ");

    }else{

        mysqli_query($koneksi,"
        INSERT INTO catatan_semester
        (
            id_siswa,
            semester,
            tahun_ajaran,
            catatan_walikelas
        )
        VALUES
        (
            '$id_siswa',
            '$semester',
            '$tahun_ajaran',
            '$catatan'
        )
        ");

    }

    echo "<script>
    alert('Catatan berhasil disimpan');
    location='catatan_semester.php';
    </script>";
}


$where = "WHERE 1=1";

if($kelas != ''){
    $where .= " AND ds.kelas='$kelas'";
}

$data = mysqli_query($koneksi,"
SELECT
    ds.id_siswa,
    ds.nisn,
    ds.nama_siswa,
    ds.kelas,
    COALESCE(rp.total_poin,0) as total_poin,
    cs.catatan_walikelas
FROM data_siswa ds

LEFT JOIN rekap_poin rp
ON ds.id_siswa = rp.id_siswa

LEFT JOIN catatan_semester cs
ON ds.id_siswa = cs.id_siswa
AND cs.semester='$semester'
AND cs.tahun_ajaran='$tahun_ajaran'

$where
ORDER BY ds.kelas, ds.nama_siswa
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Catatan Semester</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:Poppins,sans-serif;
background:#f5f7fb;
padding:20px;
}

.card{
background:#fff;
padding:25px;
border-radius:15px;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#16a34a;
color:#fff;
}

th,td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

.badge{
background:#dcfce7;
color:#15803d;
padding:5px 10px;
border-radius:8px;
font-weight:600;
}

.btn{
background:#16a34a;
color:#fff;
border:none;
padding:10px 16px;
border-radius:8px;
cursor:pointer;
}

.btn:hover{
background:#15803d;
}

.modal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.5);
z-index:9999;
}

.modal-content{
background:#fff;
width:90%;
max-width:650px;
padding:25px;
border-radius:15px;
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
}

.close{
float:right;
font-size:28px;
cursor:pointer;
font-weight:bold;
}

#catatan{
width:100%;
min-height:180px;
padding:10px;
border:1px solid #ddd;
border-radius:10px;
font-family:Poppins;
}

.preview{
text-align:left;
max-width:300px;
}

</style>
</head>
<body>

<div class="card">

<h2>Catatan Semester Wali Kelas</h2>

<br>

<br>

<form method="GET">

<select
name="kelas"
onchange="this.form.submit()"
style="
padding:10px;
border:1px solid #ddd;
border-radius:8px;
margin-bottom:20px;
">

<option value="">Semua Kelas</option>

<option value="X TKJ"
<?= ($kelas=='X TKJ')?'selected':''; ?>>
X TKJ
</option>

<option value="XI TKJ"
<?= ($kelas=='XI TKJ')?'selected':''; ?>>
XI TKJ
</option>

<option value="XII TKJ"
<?= ($kelas=='XII TKJ')?'selected':''; ?>>
XII TKJ
</option>

</select>

</form>

<table>

<tr>
<th>NISN</th>
<th>Nama</th>
<th>Kelas</th>
<th>Poin</th>
<th>Catatan</th>
<th>Aksi</th>
</tr>

<?php while($r = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $r['nisn']; ?></td>

<td><?= $r['nama_siswa']; ?></td>

<td><?= $r['kelas']; ?></td>

<td>
<span class="badge">
<?= $r['total_poin']; ?>
</span>
</td>

<td class="preview">

<?php
if(!empty($r['catatan_walikelas'])){

echo substr(
$r['catatan_walikelas'],
0,
50
);

if(strlen($r['catatan_walikelas']) > 50){
echo "...";
}

}else{

echo "<i>Belum ada catatan</i>";

}
?>

</td>

<td>

<button
type="button"
class="btn editBtn"

data-id="<?= $r['id_siswa']; ?>"

data-nama="<?= htmlspecialchars($r['nama_siswa']); ?>"

data-kelas="<?= htmlspecialchars($r['kelas']); ?>"

data-poin="<?= $r['total_poin']; ?>"

data-catatan="<?= htmlspecialchars($r['catatan_walikelas']); ?>"
>

Edit

</button>

</td>

</tr>

<?php } ?>

</table>

</div>


<!-- MODAL -->

<div id="modal" class="modal">

<div class="modal-content">

<span class="close">&times;</span>

<h3>Catatan Semester Wali Kelas</h3>

<br>

<form method="POST">

<input
type="hidden"
name="id_siswa"
id="id_siswa">

<p>
<b>Nama :</b>
<span id="nama"></span>
</p>

<br>

<p>
<b>Kelas :</b>
<span id="kelas"></span>
</p>

<br>

<p>
<b>Total Poin :</b>
<span id="poin"></span>
</p>

<br>

<textarea
name="catatan"
id="catatan"
required>
</textarea>

<br><br>

<button
type="submit"
name="simpan"
class="btn">
Simpan Catatan
</button>

</form>

</div>

</div>


<script>

const modal =
document.getElementById('modal');

const closeBtn =
document.querySelector('.close');

document
.querySelectorAll('.editBtn')
.forEach(function(btn){

btn.onclick = function(){

document
.getElementById('id_siswa')
.value =
this.dataset.id;

document
.getElementById('nama')
.innerHTML =
this.dataset.nama;

document
.getElementById('kelas')
.innerHTML =
this.dataset.kelas;

document
.getElementById('poin')
.innerHTML =
this.dataset.poin;

document
.getElementById('catatan')
.value =
this.dataset.catatan;

modal.style.display='block';

}

});

closeBtn.onclick = function(){

modal.style.display='none';

}

window.onclick = function(e){

if(e.target == modal){

modal.style.display='none';

}

}

</script>

</body>
</html>