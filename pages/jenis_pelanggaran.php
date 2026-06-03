<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Jenis Pelanggaran</title>

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
    color:#374151;
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
}

/* CARD */

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

/* HEADER */

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* FILTER */

.filter-grid{
    display:grid;
    grid-template-columns:2fr 1fr 60px;
    gap:12px;
}

.filter-grid input,
.filter-grid select{
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    outline:none;
    font-family:'Poppins',sans-serif;
}

.filter-grid input:focus,
.filter-grid select:focus{
    border-color:#16a34a;
}

.btn-search{
    border:none;
    background:#16a34a;
    color:#fff;
    border-radius:10px;
    cursor:pointer;
    transition:.3s;
}

.btn-search:hover{
    background:#15803d;
}

/* TABLE */

.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.table-title{
    display:flex;
    align-items:center;
    gap:10px;
    color:#15803d;
    font-size:18px;
    font-weight:600;
}

.btn-add{
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    padding:10px 16px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-add:hover{
    background:#15803d;
}

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    border:1px solid #e5e7eb;
}

table th{
    background:#dcfce7;
    color:#166534;
    font-weight:600;
}

table th,
table td{
    border:1px solid #e5e7eb;
    padding:14px;
    text-align:center;
}

table tbody tr:hover{
    background:#f9fafb;
}

/* DETAIL */

.dropdown{
    position:relative;
    display:inline-block;
}

.btn-detail{
    width:38px;
    height:38px;
    border:none;
    border-radius:8px;
    background:#16a34a;
    color:#fff;
    cursor:pointer;
}

.dropdown-content{
    display:none;
    position:absolute;
    right:0;
    top:45px;
    min-width:140px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
    overflow:hidden;
    z-index:99;
}

.dropdown-content a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 15px;
    text-decoration:none;
    color:#374151;
}

.dropdown-content a:hover{
    background:#f3f4f6;
}

.dropdown-content .delete{
    color:#dc2626;
}

.dropdown.active .dropdown-content{
    display:block;
}

/* PAGINATION */

.pagination{
    display:flex;
    justify-content:center;
    gap:8px;
    margin-top:20px;
}

.page-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:10px;
    background:#fff;
    border:1px solid #d1d5db;
    cursor:pointer;
}

.page-btn.active{
    background:#16a34a;
    color:#fff;
    border-color:#16a34a;
}

/* BACK */

.bottom-action{
    display:flex;
    justify-content:flex-end;
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
    background:#fff;
    transition:.3s;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-grid{
        grid-template-columns:1fr;
    }

    .table-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

}

</style>
</head>
<body>

<div class="container">

    <!-- JUDUL -->

    <div class="card page-header">

        <h1>Data Jenis Pelanggaran</h1>

        <p>Kelola kategori pelanggaran, jenis pelanggaran, dan bobot poin siswa.</p>

    </div>

    <!-- FILTER -->

    <div class="card">

        <div class="filter-grid">

            <input type="text" placeholder="Cari jenis pelanggaran...">

            <select>
                <option>Semua Kategori</option>
                <option>Kedisiplinan</option>
                <option>Kerapihan</option>
                <option>Etika</option>
                <option>Akademik</option>
            </select>

            <button class="btn-search">
                <i class="fas fa-search"></i>
            </button>

        </div>

    </div>

    <!-- TABEL -->

    <div class="card">

        <div class="table-header">

            <div class="table-title">

                <i class="fas fa-triangle-exclamation"></i>

                Daftar Jenis Pelanggaran

            </div>

            <a href="tambah_jenis_pelanggaran.php" class="btn-add">
                <i class="fas fa-folder-plus"></i>

                Tambah Data

            </a>

        </div>

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Kategori Pelanggaran</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Bobot Poin</th>
                        <th>Detail</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>
                        <td>Kedisiplinan</td>
                        <td>Terlambat Masuk Sekolah</td>
                        <td>5</td>

                        <td>

                            <div class="dropdown">

                                <button class="btn-detail">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <div class="dropdown-content">

                                    <a href="edit_jenis_pelanggaran.html">

                                        <i class="fas fa-pen"></i>

                                        Edit

                                    </a>

                                    <a href="hapus_jenis_pelanggaran.php" class="delete">

                                        <i class="fas fa-trash"></i>

                                        Hapus

                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>Kerapihan</td>
                        <td>Tidak Memakai Atribut Lengkap</td>
                        <td>10</td>

                        <td>

                            <div class="dropdown">

                                <button class="btn-detail">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <div class="dropdown-content">

                                    <a href="edit_jenis_pelanggaran.php">

                                        <i class="fas fa-pen"></i>

                                        Edit

                                    </a>

                                    <a href="hapus_jenis_pelanggaran.php" class="delete">

                                        <i class="fas fa-trash"></i>

                                        Hapus

                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="pagination">

            <button class="page-btn">
                <i class="fas fa-chevron-left"></i>
            </button>

            <button class="page-btn active">1</button>

            <button class="page-btn">2</button>

            <button class="page-btn">3</button>

            <button class="page-btn">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>

    </div>

    <div class="bottom-action">

        <a href="dashboard_walikelas.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</div>

<script>

document.querySelectorAll('.btn-detail').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        document.querySelectorAll('.dropdown').forEach(item => {

            if(item !== this.parentElement){
                item.classList.remove('active');
            }

        });

        this.parentElement.classList.toggle('active');

    });

});

document.addEventListener('click', function(e){

    if(!e.target.closest('.dropdown')){

        document.querySelectorAll('.dropdown').forEach(item => {

            item.classList.remove('active');

        });

    }

});

</script>

</body>
</html>