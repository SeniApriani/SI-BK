<?php
// ======================================================
// KONEKSI DATABASE & SESSION
// ======================================================
include __DIR__ . '/../config/koneksi.php';
session_start();

// ======================================================
// AMBIL KELAS WALI KELAS YANG LOGIN
// ======================================================
$kelasLogin = $_SESSION['kelas'];

// ======================================================
// PAGINATION
// ======================================================
$limit  = 10;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page   = ($page < 1) ? 1 : $page;
$offset = ($page - 1) * $limit;

// ======================================================
// FILTER
// ======================================================
$bulan = $_GET['bulan'] ?? '';
$nama  = $_GET['nama'] ?? '';

// ======================================================
// WHERE
// ======================================================
$where = "WHERE s.kelas='$kelasLogin'";

if($bulan != ""){
    $where .= " AND MONTH(p.tanggal_pemanggilan)='$bulan'";
}

if($nama != ""){
    $where .= " AND s.nama_siswa='$nama'";
}

// ======================================================
// DATA PEMANGGILAN SISWA
// ======================================================
$data = mysqli_query($koneksi,"
SELECT
    p.id_pemanggilan,
    p.tanggal_pemanggilan,
    p.keterangan,
    p.status,

    s.id_siswa,
    s.nama_siswa,
    s.nisn,
    s.kelas

FROM pemanggilan_siswa p

JOIN pelanggaran_siswa ps
ON p.id_pelanggaran_siswa = ps.id

JOIN data_siswa s
ON ps.id_siswa = s.id_siswa

$where

ORDER BY p.tanggal_pemanggilan DESC

LIMIT $limit OFFSET $offset
");

// ======================================================
// HITUNG PAGINATION
// ======================================================
$totalQuery = mysqli_query($koneksi,"
SELECT COUNT(*) total

FROM pemanggilan_siswa p

JOIN pelanggaran_siswa ps
ON p.id_pelanggaran_siswa = ps.id

JOIN data_siswa s
ON ps.id_siswa = s.id_siswa

$where
");

$total       = mysqli_fetch_assoc($totalQuery);
$total_pages = ceil($total['total'] / $limit);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pemanggilan Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
max-width:1200px;
margin:auto;
}

.card{
background:#fff;
padding:25px;
border-radius:18px;
box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
margin-bottom:25px;
}

.page-header h1{
font-size:28px;
color:#15803d;
margin-bottom:6px;
}

.page-header p{
color:#6b7280;
}

.filter-wrap{
display:flex;
gap:15px;
flex-wrap:wrap;
margin-bottom:25px;
align-items:center;
}

.select-box{
position:relative;
}

.select-box i{
position:absolute;
left:12px;
top:12px;
color:#16a34a;
}

.select-box select{
padding:10px 12px 10px 35px;
min-width:190px;
border:1px solid #d1d5db;
border-radius:10px;
outline:none;
font-family:Poppins;
background:white;
}

.select-box select:focus{
border-color:#16a34a;
box-shadow:0 0 0 3px rgba(22,163,74,.15);
}

.table-responsive{
overflow-x:auto;
border-radius:12px;
border:1px solid #e5e7eb;
}

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#dcfce7;
color:#166534;
padding:14px;
font-weight:600;
}

table td{
padding:14px;
text-align:center;
border-top:1px solid #e5e7eb;
}

tbody tr:hover{
background:#f9fafb;
}

.status-menunggu{
display:inline-block;
padding:7px 13px;
background:#fef3c7;
color:#92400e;
border-radius:8px;
font-size:13px;
font-weight:600;
}

.status-selesai{
display:inline-block;
padding:7px 13px;
background:#dcfce7;
color:#166534;
border-radius:8px;
font-size:13px;
font-weight:600;
}

.btn-input,
.btn-lihat{
display:inline-block;
padding:8px 14px;
border-radius:8px;
text-decoration:none;
font-size:13px;
font-weight:600;
color:#fff;
}

.btn-input{
background:#16a34a;
}

.btn-input:hover{
background:#15803d;
}

.btn-lihat{
background:#2563eb;
}

.btn-lihat:hover{
background:#1d4ed8;
}

.pagination{
display:flex;
justify-content:center;
gap:8px;
margin-top:25px;
}

.page-btn{
padding:8px 13px;
border-radius:8px;
border:1px solid #d1d5db;
text-decoration:none;
color:#374151;
background:#fff;
}

.page-btn.active{
background:#16a34a;
color:#fff;
border-color:#16a34a;
}

.btn-back{
width:45px;
height:45px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
border:1px solid #16a34a;
color:#16a34a;
text-decoration:none;
margin-top:20px;
}

.btn-back:hover{
background:#16a34a;
color:#fff;
}

/* ===========================
   MODAL PEMANGGILAN SISWA
=========================== */

.modal{
    display:none;
    position:fixed;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.45);
    z-index:9999;
    overflow-y:auto;
}

.modal-content{
    background:#fff;
    width:700px;
    max-width:95%;
    margin:30px auto;
    padding:25px;
    border-radius:15px;
    max-height:90vh;
    overflow-y:auto;
}

.close-modal{
    float:right;
    font-size:28px;
    cursor:pointer;
    color:#dc2626;
}

.detail-table{
    width:100%;
    border-collapse:collapse;
}

.detail-table td{
    padding:10px;
    border-bottom:1px solid #eee;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<div class="page-header">

<h1>Pemanggilan Siswa</h1>

<p>
Daftar siswa yang dijadwalkan mengikuti proses pembinaan.
</p>

</div>

<form
method="GET"
id="filterForm"
class="filter-wrap">

<div class="select-box">

<i class="fas fa-calendar"></i>

<select
name="bulan"
onchange="filterForm.submit()">

<option value="">Semua Bulan</option>

<?php

$bulanNama=[
1=>"Januari",
2=>"Februari",
3=>"Maret",
4=>"April",
5=>"Mei",
6=>"Juni",
7=>"Juli",
8=>"Agustus",
9=>"September",
10=>"Oktober",
11=>"November",
12=>"Desember"
];

foreach($bulanNama as $key=>$val){

?>

<option
value="<?= $key;?>"
<?=($bulan==$key)?'selected':'';?>>

<?= $val;?>

</option>

<?php } ?>

</select>

</div>

<div class="select-box">

<i class="fas fa-user"></i>

<select
name="nama"
onchange="filterForm.submit()">

<option value="">Semua Siswa</option>

<?php

$q=mysqli_query($koneksi,"
SELECT nama_siswa
FROM data_siswa
WHERE kelas='$kelasLogin'
ORDER BY nama_siswa
");

while($s=mysqli_fetch_assoc($q)){

?>

<option
value="<?= $s['nama_siswa'];?>"
<?=($nama==$s['nama_siswa'])?'selected':'';?>>

<?= $s['nama_siswa'];?>

</option>

<?php } ?>

</select>

</div>

</form>

<!-- ======================================================
     TABEL PEMANGGILAN SISWA
====================================================== -->

<div class="table-responsive">

<table>

<thead>

<tr>

<th>Tanggal</th>
<th>Nama Siswa</th>
<th>NISN</th>
<th>Kelas</th>
<th>Keterangan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php if(mysqli_num_rows($data)>0){ ?>

<?php while($r=mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= date('d/m/Y',strtotime($r['tanggal_pemanggilan'])) ?>
</td>

<td>
<?= $r['nama_siswa']; ?>
</td>

<td>
<?= $r['nisn']; ?>
</td>

<td>
<?= $r['kelas']; ?>
</td>

<td>
<?= $r['keterangan']; ?>
</td>

<td>

<?php if($r['status']=="Menunggu Pembinaan"){ ?>

<span class="status-menunggu">

<?= $r['status']; ?>

</span>

<?php }else{ ?>

<span class="status-selesai">

<?= $r['status']; ?>

</span>

<?php } ?>

</td>

<td>

<?php if($r['status']=="Menunggu Pembinaan"){ ?>

<a
href="#"
class="btn-input lihat-detail"
data-id="<?= $r['id_pemanggilan']; ?>">

<i class="fas fa-comments"></i>

Input Hasil

</a>

<?php }else{ ?>

<a
href="#"
class="btn-lihat lihat-detail"
data-id="<?= $r['id_pemanggilan']; ?>">

<i class="fas fa-eye"></i>

Lihat Hasil

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php }else{ ?>

<tr>

<td colspan="7">

Belum ada data pemanggilan siswa.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<!-- ======================================================
     PAGINATION
====================================================== -->

<div class="pagination">

<?php if($page>1){ ?>

<a
class="page-btn"
href="?page=<?= $page-1 ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>">

<i class="fas fa-chevron-left"></i>

</a>

<?php } ?>


<?php

$start=max(1,$page-2);
$end=min($total_pages,$page+2);

for($i=$start;$i<=$end;$i++){

?>

<a

href="?page=<?= $i ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>"

class="page-btn <?=($i==$page)?'active':'';?>">

<?= $i; ?>

</a>

<?php } ?>


<?php if($page<$total_pages){ ?>

<a
class="page-btn"
href="?page=<?= $page+1 ?>&bulan=<?= $bulan ?>&nama=<?= urlencode($nama) ?>">

<i class="fas fa-chevron-right"></i>

</a>

<?php } ?>

</div>


<!-- ======================================================
     TOMBOL KEMBALI
====================================================== -->

<a
href="dashboard_walikelas.php"
class="btn-back">

<i class="fas fa-chevron-left"></i>

</a>

</div>

</div>
<!-- ======================================================
     MODAL DETAIL / INPUT HASIL KONSELING
====================================================== -->

<div id="modalDetail" class="modal">

    <div class="modal-content">

        <span class="close-modal">&times;</span>

        <h2 style="color:#15803d;margin-bottom:20px;">
            Detail Pemanggilan Siswa
        </h2>

        <div id="detailPemanggilan"></div>

        <hr style="margin:20px 0;">

        <div id="formKonseling">

            <label><b>Tanggal Konseling</b></label>

            <input
                type="date"
                id="tanggal_pembinaan"
                style="
                width:100%;
                margin-top:8px;
                margin-bottom:18px;
                padding:10px;
                border:1px solid #d1d5db;
                border-radius:10px;">

            <label><b>Hasil Konseling</b></label>

            <textarea
                id="hasil_pembinaan"
                placeholder="Masukkan hasil konseling..."
                style="
                width:100%;
                min-height:150px;
                margin-top:8px;
                padding:10px;
                border:1px solid #d1d5db;
                border-radius:10px;"></textarea>

            <input
                type="hidden"
                id="id_pemanggilan">

            <button
                id="btnSimpanPembinaan"
                class="btn-input"
                style="margin-top:20px;border:none;cursor:pointer;">

                <i class="fas fa-save"></i>

                Simpan Hasil Konseling

            </button>

        </div>

    </div>

</div>

<style>

.modal{

display:none;
position:fixed;
left:0;
top:0;
width:100%;
height:100%;
background:rgba(0,0,0,.45);
z-index:999;

}

.modal-content{

background:#fff;
width:700px;
max-width:95%;
margin:50px auto;
padding:25px;
border-radius:15px;
animation:muncul .3s;

}

@keyframes muncul{

from{
transform:translateY(-20px);
opacity:0;
}

to{
transform:translateY(0);
opacity:1;
}

}

.close-modal{

float:right;
font-size:28px;
cursor:pointer;
color:#dc2626;

}

.detail-table{

width:100%;
border-collapse:collapse;

}

.detail-table td{

padding:10px;
border-bottom:1px solid #eee;
text-align:left;

}

</style>

<script>

const modal=document.getElementById("modalDetail");

document.addEventListener("click",function(e){

const btn=e.target.closest(".lihat-detail");

if(!btn) return;

e.preventDefault();

let id=btn.dataset.id;

fetch("get_detail_pemanggilan.php?id="+id)

.then(res=>res.json())

.then(data=>{

document.getElementById("id_pemanggilan").value=data.id_pemanggilan;

document.getElementById("detailPemanggilan").innerHTML=`

<table class="detail-table">

<tr>
<td width="35%"><b>Nama Siswa</b></td>
<td>${data.nama_siswa}</td>
</tr>

<tr>
<td><b>NISN</b></td>
<td>${data.nisn}</td>
</tr>

<tr>
<td><b>Kelas</b></td>
<td>${data.kelas}</td>
</tr>

<tr>
<td><b>Tanggal Pemanggilan</b></td>
<td>${data.tanggal_pemanggilan}</td>
</tr>

<tr>
<td><b>Keterangan</b></td>
<td>${data.keterangan}</td>
</tr>

<tr>
<td><b>Status</b></td>
<td>${data.status}</td>
</tr>

</table>

`;

if(data.status=="Sudah Dibina"){

document.getElementById("tanggal_pembinaan").value=data.tanggal_pembinaan;

document.getElementById("hasil_pembinaan").value=data.hasil_pembinaan;

document.getElementById("tanggal_pembinaan").disabled=true;

document.getElementById("hasil_pembinaan").disabled=true;

document.getElementById("btnSimpanPembinaan").style.display="none";

}else{

document.getElementById("tanggal_pembinaan").disabled=false;

document.getElementById("hasil_pembinaan").disabled=false;

document.getElementById("tanggal_pembinaan").value="";

document.getElementById("hasil_pembinaan").value="";

document.getElementById("btnSimpanPembinaan").style.display="inline-block";

}

modal.style.display="block";

});

});

document.querySelector(".close-modal").onclick=function(){

modal.style.display="none";

}

window.onclick=function(e){

if(e.target==modal){

modal.style.display="none";

}

}

document.getElementById("btnSimpanPembinaan").onclick=function(){

let id=document.getElementById("id_pemanggilan").value;

let tanggal=document.getElementById("tanggal_pembinaan").value;

let hasil=document.getElementById("hasil_pembinaan").value;

if(tanggal==""){

alert("Tanggal konseling harus diisi.");

return;

}

if(hasil.trim()==""){

alert("Hasil konseling harus diisi.");

return;

}

fetch("simpan_hasil_konseling.php",{

method:"POST",

headers:{

"Content-Type":"application/x-www-form-urlencoded"

},

body:

"id_pemanggilan="+id+

"&tanggal_pembinaan="+encodeURIComponent(tanggal)+

"&hasil_pembinaan="+encodeURIComponent(hasil)

})

.then(res=>res.text())

.then(result=>{

if(result.trim()=="success"){

alert("Hasil konseling berhasil disimpan.");

location.reload();

}else{

alert(result);

}

});

}

</script>

</body>

</html>