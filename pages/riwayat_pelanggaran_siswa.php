<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Data Pelanggaran</title>

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

/* TAB */

.tab-card{
    background:#fff;
    border-radius:18px;
    padding:0 20px;
    margin-bottom:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    display:flex;
    align-items:center;
    min-height:65px;
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    padding:22px 12px 18px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.tab:hover{
    color:#15803d;
}

.tab:hover::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:3px;
    background:#86efac;
    border-radius:10px;
}

.tab.active{
    color:#15803d;
}

.tab.active::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:3px;
    background:#16a34a;
    border-radius:10px;
}

.tab-right{
    margin-left:auto;
}

/* CARD */

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:25px;
}

.page-header h1{
    color:#15803d;
    font-size:28px;
    margin-bottom:5px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* FILTER */

.filter-section{
    display:flex;
    gap:15px;
    margin-bottom:25px;
}

.filter-section select{
    width:220px;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
    outline:none;
}

.filter-section select:focus{
    border-color:#16a34a;
}

/* TABLE */

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#dcfce7;
    color:#166534;
    font-weight:600;
}

table th,
table td{
    padding:14px;
    border:1px solid #e5e7eb;
    text-align:center;
}

table tbody tr:hover{
    background:#f9fafb;
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
    transition:.3s;
}

.page-btn:hover{
    background:#f3f4f6;
}

.page-btn.active{
    background:#16a34a;
    border-color:#16a34a;
    color:#fff;
}

/* BOTTOM */

.bottom-action{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
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
    background:#fff;
}

.btn-back:hover{
    background:#15803d;
    color:#fff;
}

.btn-download{
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    padding:12px 18px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-download:hover{
    background:#15803d;
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-section{
        flex-direction:column;
    }

    .filter-section select{
        width:100%;
    }

    .tab-card{
        flex-wrap:wrap;
    }

    .tab-right{
        margin-left:0;
    }

    .bottom-action{
        gap:10px;
    }

}

</style>
</head>
<body>

<div class="container">

    <!-- TAB -->

    <div class="tab-card">

        <a href="data_pelanggaran_siswa.php" class="tab">

            <i class="fas fa-pen-to-square"></i>

            Pencatatan

        </a>

        <a href="riwayat_pelanggaran_siswa.php" class="tab tab-right active">

            <i class="fas fa-clock-rotate-left"></i>

            Riwayat Data Pelanggaran

        </a>

    </div>

    <!-- CONTENT -->

    <div class="card">

        <div class="page-header">

            <h1>Riwayat Data Pelanggaran</h1>

            <p>Riwayat seluruh pelanggaran siswa yang telah dicatat.</p>

        </div>

        <!-- FILTER -->

        <div class="filter-section">

            <select>
                <option>Semua Bulan</option>
                <option>Januari</option>
                <option>Februari</option>
                <option>Maret</option>
                <option>April</option>
            </select>

            <select>
                <option>Semua Kelas</option>
                <option>X RPL 1</option>
                <option>X RPL 2</option>
                <option>XI RPL 1</option>
                <option>XII RPL 1</option>
            </select>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Pelanggaran</th>
                        <th>Poin</th>
                        <th>Catatan Konseling</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>05-07-2025</td>
                        <td>Ahmad Fauzi</td>
                        <td>X RPL 1</td>
                        <td>Terlambat Masuk Sekolah</td>
                        <td>5</td>
                        <td>Telah diberikan pembinaan.</td>
                    </tr>

                    <tr>
                        <td>08-07-2025</td>
                        <td>Siti Nurhaliza</td>
                        <td>XI RPL 1</td>
                        <td>Tidak Memakai Atribut</td>
                        <td>10</td>
                        <td>Diingatkan untuk melengkapi atribut.</td>
                    </tr>

                    <tr>
                        <td>12-07-2025</td>
                        <td>Budi Santoso</td>
                        <td>XII RPL 1</td>
                        <td>Membolos</td>
                        <td>20</td>
                        <td>Pemanggilan orang tua.</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->

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

    <!-- BOTTOM -->

    <div class="bottom-action">

        <a href="dashboard_walikelas.php" class="btn-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <a href="#" class="btn-download">
            <i class="fas fa-download"></i>
            Unduh Data
        </a>

    </div>

</div>

</body>
</html>