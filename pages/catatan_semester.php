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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
background:#dcfce7;
    color:#15803d;
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

.btn-icon{
    width:38px;
    height:38px;
    border:none;
    border-radius:10px;
    background:#dcfce7;
    color:#15803d;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    transition:.3s;
}

.btn-icon:hover{
    background:#bbf7d0;
}

/* card semester */
.title-card{
    background:#dcfce7;
    color:#15803d;
    padding:14px 18px;
    border-radius:12px;
    font-weight:600;
    margin-bottom:20px;
   display:inline-flex;
    align-items:center;
    gap:10px;
    font-size:16px;
}

/* filter kelas */
.filter-box{
    position:relative;
    display:inline-block;
    margin-bottom:20px;
}

.filter-box i{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    color:#16a34a;
}

.filter-box select{
    min-width:230px;
    padding:12px 15px 12px 42px;
    border:1px solid #d1d5db;
    border-radius:12px;
    background:#fff;
    font-family:'Poppins',sans-serif;
}


/* placeholder */
.placeholder-text{
    color:#bdbdbd;
    font-style:normal;
}
</style>
</head>
<body>

<div class="card">

<div class="title-card">
    <i class="fas fa-book-open"></i>
    Catatan Semester Wali Kelas
</div>

<br>


<form method="GET">

<div class="filter-box">
<i class="fas fa-users"></i>
<select
name="kelas"
onchange="this.form.submit()">

<option value="">Semua Kelas</option>

<option value="X TKJ" <?= ($kelas=='X TKJ')?'selected':''; ?>>
X TKJ
</option>

<option value="XI TKJ" <?= ($kelas=='XI TKJ')?'selected':''; ?>>
XI TKJ
</option>

<option value="XII TKJ" <?= ($kelas=='XII TKJ')?'selected':''; ?>>
XII TKJ
</option>

</select>

</div>

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

echo "<span class='placeholder-text'>Masukkan catatan wali kelas di sini...</span>";

}
?>

</td>

<td>

<button
type="button"
class="btn-icon editBtn"

data-id="<?= $r['id_siswa']; ?>"
data-nama="<?= htmlspecialchars($r['nama_siswa']); ?>"
data-kelas="<?= htmlspecialchars($r['kelas']); ?>"
data-poin="<?= $r['total_poin']; ?>"
data-catatan="<?= htmlspecialchars($r['catatan_walikelas']); ?>">

<i class="fas fa-pen"></i>

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