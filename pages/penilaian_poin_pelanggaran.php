```html
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Penilaian Poin Pelanggaran</title>

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
    max-width:1100px;
    margin:auto;
}

/* =========================
   TAB MENU
========================= */

.tab-card{
    background:#fff;
    border-radius:18px;
    padding:0 30px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.tab-menu{
    display:flex;
    align-items:center;
    gap:45px;
    min-height:72px;
}

.tab{
    position:relative;
    text-decoration:none;
    color:#6b7280;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
    height:72px;
    transition:.3s;
}

.tab i{
    font-size:15px;
}

.tab:hover{
    color:#16a34a;
}

.tab::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:0;
    height:4px;
    background:#16a34a;
    border-radius:20px;
    transition:.3s;
}

.tab:hover::after{
    width:100%;
}

.tab.active{
    color:#16a34a;
}

.tab.active::after{
    width:100%;
}

/* =========================
   CARD
========================= */

.card{
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.page-header{
    margin-bottom:30px;
}

.page-header h1{
    color:#15803d;
    font-size:30px;
    margin-bottom:8px;
}

.page-header p{
    color:#6b7280;
    font-size:14px;
}

/* =========================
   FORM
========================= */

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
}

.required{
    color:#dc2626;
}

.form-group input,
.form-group select{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:13px 15px;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
}

.readonly{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

input[type=file]{
    padding:12px;
}

/* =========================
   BUTTON
========================= */

.form-action{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:30px;
}

.btn-cancel{
    text-decoration:none;
    border:1px solid #16a34a;
    color:#16a34a;
    background:#fff;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.btn-cancel:hover{
    background:#f0fdf4;
}

.btn-save{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .tab-menu{
        overflow-x:auto;
        gap:25px;
    }

    .card{
        padding:20px;
    }

    .form-action{
        flex-direction:column;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
        justify-content:center;
        text-align:center;
    }

}

</style>

</head>
<body>

<div class="container">

    <!-- TAB MENU -->

    <div class="tab-card">

        <div class="tab-menu">

            <a href="penilaian_poin_pelanggaran.php" class="tab active">
                <i class="fas fa-award"></i>
                Remisi Poin
            </a>

            <a href="rekap_poin.php" class="tab">
                <i class="fas fa-chart-bar"></i>
                Rekap Poin
            </a>

            <a href="pengajuan_remisi.php" class="tab">
                <i class="fas fa-file-signature"></i>
                Pengajuan Remisi
            </a>

            <a href="riwayat_remisi.php" class="tab">
                <i class="fas fa-history"></i>
                Riwayat Remisi
            </a>

        </div>

    </div>

    <!-- FORM REMISI -->

    <div class="card">

        <div class="page-header">

            <h1>Input Remisi Prestasi</h1>

            <p>
                Tambahkan remisi poin berdasarkan prestasi yang diperoleh siswa.
            </p>

        </div>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">

                <label>
                    Pilih Siswa
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
                    Jenis Prestasi
                    <span class="required">*</span>
                </label>

                <select required>
                    <option value="">-- Pilih Jenis Prestasi --</option>
                    <option>Akademik</option>
                    <option>Non Akademik</option>
                    <option>Kejuaraan Sekolah</option>
                    <option>Kejuaraan Kabupaten</option>
                    <option>Kejuaraan Provinsi</option>
                    <option>Kejuaraan Nasional</option>
                </select>

            </div>

            <div class="form-group">

                <label>
                    Nama Prestasi / Lomba
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    placeholder="Masukkan nama prestasi atau lomba"
                    required
                >

            </div>

            <div class="form-group">

                <label>Poin Remisi</label>

                <input
                    type="text"
                    class="readonly"
                    value="Otomatis sesuai jenis prestasi"
                    readonly
                >

            </div>

            <div class="form-group">

                <label>
                    Upload Bukti Sertifikat
                    <span class="required">*</span>
                </label>

                <input
                    type="file"
                    required
                >

            </div>

            <div class="form-action">

                <a href="dashboard_walikelas.php" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
```
