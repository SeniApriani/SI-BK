<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Pelanggaran Siswa</title>

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
    max-width:900px;
    margin:auto;
}

/* TAB */

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
    padding:30px;
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

/* FORM */

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
}

.required{
    color:#dc2626;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:12px 15px;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color:#16a34a;
}

.form-group textarea{
    resize:none;
    min-height:120px;
}

.readonly{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

/* BUTTON */

.form-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:30px;
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

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-card{
        flex-wrap:wrap;
        gap:8px;
    }

    .tab-right{
        margin-left:0;
    }

    .card{
        padding:20px;
    }

}

</style>

</head>
<body>

<div class="container">

    <!-- TAB MENU -->

    <div class="tab-card">

        <a href="data_pelanggaran_siswa.php" class="tab active">

            <i class="fas fa-pen-to-square"></i>

            Pencatatan

        </a>

        <a href="riwayat_pelanggaran_siswa.php" class="tab tab-right">

            <i class="fas fa-clock-rotate-left"></i>

            Riwayat Data Pelanggaran

        </a>

    </div>

    <!-- FORM PENCATATAN -->

    <div class="card">

        <div class="page-header">

            <h1>Pencatatan Pelanggaran</h1>

            <p>Input data pelanggaran siswa ke dalam sistem.</p>

        </div>

        <form method="POST">

            <div class="form-group">

                <label>
                    Nama Siswa
                    <span class="required">*</span>
                </label>

                <select required>

                    <option value="">-- Pilih Siswa --</option>
                    <option>Ahmad Fauzi</option>
                    <option>Siti Nurhaliza</option>
                    <option>Budi Santoso</option>

                </select>

            </div>

            <div class="form-group">

                <label>
                    Kategori Pelanggaran
                    <span class="required">*</span>
                </label>

                <select required>

                    <option value="">-- Pilih Kategori --</option>
                    <option>Kedisiplinan</option>
                    <option>Kerapihan</option>
                    <option>Etika</option>
                    <option>Akademik</option>

                </select>

            </div>

            <div class="form-group">

                <label>
                    Jenis Pelanggaran
                    <span class="required">*</span>
                </label>

                <select required>

                    <option value="">-- Pilih Jenis Pelanggaran --</option>
                    <option>Terlambat Masuk Sekolah</option>
                    <option>Tidak Memakai Atribut Lengkap</option>
                    <option>Membolos</option>

                </select>

            </div>

            <div class="form-group">

                <label>Bobot Poin</label>

                <input
                    type="text"
                    class="readonly"
                    value="Otomatis sesuai jenis pelanggaran"
                    readonly
                >

            </div>

            <div class="form-group">

                <label>Catatan Konseling</label>

                <textarea placeholder="Masukkan catatan konseling jika diperlukan..."></textarea>

            </div>

            <div class="form-action">

                <a href="dashboard_walikelas.php" class="btn-back">

                    <i class="fas fa-chevron-left"></i>

                </a>

                <button type="submit" class="btn-save">

                    <i class="fas fa-save"></i>

                    Simpan Data

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>