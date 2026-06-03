
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Surat Peringatan</title>

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
}

.form-group select{
    width:100%;
    height:45px;
    border:1px solid #d1d5db;
    border-radius:10px;
    padding:0 15px;
    font-family:'Poppins',sans-serif;
}

.info-grid{
    display:none;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-top:15px;
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
    margin-bottom:5px;
}

.form-action{
    display:none;
    justify-content:flex-end;
    margin-top:15px;
}

.btn-generate{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.surat-preview{
    display:none;
}

.surat-box{
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:40px;
    line-height:1.8;
}

@media(max-width:768px){

    body{
        padding:15px;
    }

    .form-grid,
    .info-grid{
        grid-template-columns:1fr;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="card">

        <div class="page-header">

            <h1>Surat Peringatan</h1>

            <p>
                Generate surat peringatan berdasarkan akumulasi poin pelanggaran siswa.
            </p>

        </div>

    </div>

    <div class="card">

        <div class="form-grid">

            <div class="form-group">

                <label>Pilih Siswa</label>

                <select id="pilihSiswa">

                    <option value="">
                        -- Pilih Siswa --
                    </option>

                    <option
                        value="1"
                        data-nama="Ahmad Fauzi"
                        data-nisn="1234567890"
                        data-kelas="XI RPL 1"
                        data-poin="120">
                        Ahmad Fauzi
                    </option>

                    <option
                        value="2"
                        data-nama="Siti Nurhaliza"
                        data-nisn="1234567891"
                        data-kelas="XI RPL 2"
                        data-poin="95">
                        Siti Nurhaliza
                    </option>

                    <option
                        value="3"
                        data-nama="Budi Santoso"
                        data-nisn="1234567892"
                        data-kelas="XII RPL 1"
                        data-poin="150">
                        Budi Santoso
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Jenis Surat Peringatan</label>

                <select id="jenisSP">

                    <option>SP 1</option>
                    <option>SP 2</option>
                    <option>SP 3</option>

                </select>

            </div>

        </div>

        <div class="info-grid" id="infoSiswa">

            <div class="info-item">

                <small>Nama Siswa</small>

                <strong id="namaSiswa">-</strong>

            </div>

            <div class="info-item">

                <small>NISN</small>

                <strong id="nisnSiswa">-</strong>

            </div>

            <div class="info-item">

                <small>Kelas</small>

                <strong id="kelasSiswa">-</strong>

            </div>

            <div class="info-item">

                <small>Total Poin</small>

                <strong id="poinSiswa">-</strong>

            </div>

        </div>

        <div class="form-action" id="generateArea">

            <button type="button" class="btn-generate" id="btnGenerate">

                <i class="fas fa-file-alt"></i>

                Generate Surat

            </button>

        </div>

    </div>


    <!-- PREVIEW SURAT -->

    <div class="card surat-preview" id="previewSurat">

        <div class="page-header">

            <h1 style="font-size:24px;">
                Preview Surat Peringatan
            </h1>

        </div>

        <div class="surat-box">

            <div style="text-align:center;margin-bottom:30px;">

                <h2 id="judulSP">
                    SURAT PERINGATAN I
                </h2>

                <p>
                    Nomor : 421/SP/SMK/2025
                </p>

            </div>

            <p>Kepada Yth.</p>

            <p>Orang Tua / Wali dari :</p>

            <br>

            <table style="border:none;width:auto;">

                <tr>
                    <td style="border:none;padding:4px 15px 4px 0;">Nama</td>
                    <td style="border:none;" id="suratNama">: -</td>
                </tr>

                <tr>
                    <td style="border:none;padding:4px 15px 4px 0;">NISN</td>
                    <td style="border:none;" id="suratNisn">: -</td>
                </tr>

                <tr>
                    <td style="border:none;padding:4px 15px 4px 0;">Kelas</td>
                    <td style="border:none;" id="suratKelas">: -</td>
                </tr>

            </table>

            <br>

            <p style="text-align:justify;">

                Berdasarkan hasil pemantauan kedisiplinan siswa,
                yang bersangkutan telah mencapai akumulasi poin
                pelanggaran sebesar
                <strong id="suratPoin">0 Poin</strong>.

                Oleh karena itu sekolah memberikan surat
                peringatan sebagai bentuk pembinaan dan
                perhatian terhadap perkembangan perilaku siswa.

            </p>

            <br>

            <p style="text-align:justify;">

                Kami mengharapkan kerja sama orang tua/wali
                untuk melakukan pembinaan dan pengawasan
                agar siswa dapat memperbaiki sikap serta
                mematuhi seluruh tata tertib sekolah.

            </p>

            <br><br>

            <div style="text-align:right;">

                <p>Wali Kelas</p>

                <br><br><br>

                <p>
                    <strong>(..........................)</strong>
                </p>

            </div>

        </div>

        <div style="
            display:flex;
            justify-content:flex-end;
            margin-top:20px;
        ">

            <button class="btn-generate">

                <i class="fas fa-download"></i>

                Unduh PDF

            </button>

        </div>

    </div>

    <!-- BACK -->

    <div style="
        display:flex;
        justify-content:flex-end;
        margin-top:15px;
    ">

        <a href="dashboard_walikelas.php"
           style="
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
        ">

            <i class="fas fa-chevron-left"></i>

        </a>

    </div>

</div>

<script>

const pilihSiswa = document.getElementById('pilihSiswa');
const infoSiswa = document.getElementById('infoSiswa');
const generateArea = document.getElementById('generateArea');
const previewSurat = document.getElementById('previewSurat');

pilihSiswa.addEventListener('change', function(){

    if(this.value === ''){

        infoSiswa.style.display = 'none';
        generateArea.style.display = 'none';
        previewSurat.style.display = 'none';

        return;

    }

    const selected =
        this.options[this.selectedIndex];

    document.getElementById('namaSiswa').innerText =
        selected.dataset.nama;

    document.getElementById('nisnSiswa').innerText =
        selected.dataset.nisn;

    document.getElementById('kelasSiswa').innerText =
        selected.dataset.kelas;

    document.getElementById('poinSiswa').innerText =
        selected.dataset.poin + ' Poin';

    infoSiswa.style.display = 'grid';
    generateArea.style.display = 'flex';

});

document.getElementById('btnGenerate')
.addEventListener('click', function(){

    const selected =
        pilihSiswa.options[pilihSiswa.selectedIndex];

    const jenisSP =
        document.getElementById('jenisSP').value;

    document.getElementById('judulSP').innerText =
        'SURAT PERINGATAN ' +
        jenisSP.replace('SP ','');

    document.getElementById('suratNama').innerText =
        ': ' + selected.dataset.nama;

    document.getElementById('suratNisn').innerText =
        ': ' + selected.dataset.nisn;

    document.getElementById('suratKelas').innerText =
        ': ' + selected.dataset.kelas;

    document.getElementById('suratPoin').innerText =
        selected.dataset.poin + ' Poin';

    previewSurat.style.display = 'block';

});

</script>

</body>
</html>
