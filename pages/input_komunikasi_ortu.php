<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Input Komunikasi Orang Tua</title>

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

.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
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

/* IDENTITAS SISWA */

.info-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
}

.info-item{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:18px;
}

.info-item small{
    display:block;
    color:#6b7280;
    margin-bottom:6px;
}

.info-item strong{
    color:#111827;
    font-size:15px;
}

/* FORM */

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    font-size:14px;
}

.form-group input,
.form-group select{
    width:100%;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    outline:none;
    font-family:'Poppins',sans-serif;
}

.form-group input[type=file]{
    padding:10px;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#16a34a;
}

.required{
    color:#dc2626;
}

.form-action{
    display:flex;
    justify-content:flex-end;
    margin-top:10px;
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

```html id="mx8r2q"

/* BACK BUTTON */

.bottom-action{
    display:flex;
    justify-content:flex-end;
    margin-top:15px;
}

.btn-back{
    width:45px;
    height:45px;
    background:#fff;
    color:#15803d;
    border:1px solid #15803d;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.3s;
    font-size:16px;
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

    .info-grid{
        grid-template-columns:1fr;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .bottom-action{
        justify-content:center;
    }

}

</style>
</head>
<body>

<div class="container">

    <!-- HEADER -->

    <div class="card">

        <div class="page-header">

            <h1>Input Komunikasi Orang Tua</h1>

            <p>
                Input hasil komunikasi antara pihak sekolah dengan orang tua siswa.
            </p>

        </div>

    </div>

    <!-- IDENTITAS SISWA -->

    <div class="card">

        <div class="info-grid">

            <div class="info-item">

                <small>Nama Siswa</small>

                <strong>Ahmad Fauzi</strong>

            </div>

            <div class="info-item">

                <small>NISN</small>

                <strong>1234567890</strong>

            </div>

            <div class="info-item">

                <small>Kelas</small>

                <strong>XI RPL 1</strong>

            </div>

            <div class="info-item">

                <small>Total Poin</small>

                <strong>120 Poin</strong>

            </div>

        </div>

    </div>

    <!-- FORM -->

    <div class="card">

        <form method="POST" enctype="multipart/form-data">

            <div class="form-grid">

                <div class="form-group">

                    <label>

                        Nama Orang Tua / Wali
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        placeholder="Masukkan nama orang tua / wali"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>

                        Tanggal Pertemuan
                        <span class="required">*</span>

                    </label>

                    <input
                        type="date"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>

                        Jenis Pertemuan
                        <span class="required">*</span>

                    </label>

                    <select required>

                        <option value="">
                            -- Pilih Jenis Pertemuan --
                        </option>

                        <option>
                            Sekolah
                        </option>

                        <option>
                            Home Visit
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>

                        Upload Berita Acara
                        <span class="required">*</span>

                    </label>

                    <input
                        type="file"
                        required
                    >

                </div>

            </div>

            <div class="form-action">

                <button type="submit" class="btn-save">

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

    <!-- BACK -->

    <div class="bottom-action">

        <a href="komunikasi_orangtua.php" class="btn-back">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</div>

</body>
</html>
```
