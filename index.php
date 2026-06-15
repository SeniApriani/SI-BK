
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SI-BK | Sistem Informasi Bimbingan Konseling</title>

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
    overflow-x:hidden;
}

html{
    scroll-behavior:smooth;
}

/* NAVBAR */

.navbar{

    position:fixed;

    top:0;
    left:0;

    width:100%;

    z-index:999;

    padding:18px 8%;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:rgba(255,255,255,.95);

    backdrop-filter:blur(15px);

    box-shadow:0 2px 12px rgba(0,0,0,.05);

}

.logo{

    display:flex;
    align-items:center;
    gap:12px;

}

.logo img{

    width:48px;
    height:48px;
    object-fit:contain;

}

.logo span{

    font-size:22px;
    font-weight:700;

    color:#15803d;

}

.btn-login{

    text-decoration:none;

    background:#16a34a;
    color:#fff;

    padding:12px 28px;

    border-radius:12px;

    font-weight:600;

    transition:.3s;

}

.btn-login:hover{

    background:#15803d;

}

/* HERO */

.hero{

    position:relative;

    min-height:88vh;

    display:flex;
    align-items:center;

    overflow:hidden;

    padding:120px 8% 100px;

    background:
    linear-gradient(
    135deg,
    #dcfce7 0%,
    #eefdf4 55%,
    #ffffff 100%
    );

}

.hero-content{

    width:100%;

    display:grid;
    grid-template-columns:1fr 1fr;

    gap:70px;

    align-items:center;

}

.hero-text h1{

    font-size:44px;

    line-height:1.45;

    color:#166534;

    margin-bottom:20px;

}

.hero-text p{

    color:#6b7280;

    line-height:2;

    margin-bottom:30px;

    font-size:16px;

}

.hero-btn{

    display:inline-flex;
    align-items:center;
    gap:10px;

    text-decoration:none;

    background:#16a34a;
    color:#fff;

    padding:15px 32px;

    border-radius:14px;

    font-weight:600;

    transition:.3s;

}

.hero-btn:hover{

    background:#15803d;

    transform:translateY(-3px);

}

/* FOTO AREA */

.hero-image{

    position:relative;

    display:flex;
    justify-content:center;
    align-items:center;

    transform:translateY(20px);

}

/* GLOW BESAR */

.hero-image::before{

    content:'';

    position:absolute;

    width:750px;
    height:750px;

    border-radius:50%;

    background:#86efac;

    filter:blur(170px);

    opacity:.65;

    bottom:-250px;

    z-index:1;

}

/* GLOW KEDUA */

.hero-image::after{

    content:'';

    position:absolute;

    width:450px;
    height:450px;

    border-radius:50%;

    background:#bbf7d0;

    filter:blur(130px);

    opacity:.7;

    bottom:-120px;
    right:-40px;

    z-index:1;

}

.hero-image img{

    width:100%;
    max-width:560px;

    position:relative;

    z-index:2;

    animation:floatPhoto 6s ease-in-out infinite;

    /* FOTO MENYATU */

    border-radius:40px;

    mask-image:
    linear-gradient(
    to bottom,
    black 78%,
    transparent 100%
    );

    -webkit-mask-image:
    linear-gradient(
    to bottom,
    black 78%,
    transparent 100%
    );

}

@keyframes floatPhoto{

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-10px);
    }

    100%{
        transform:translateY(0);
    }

}

/* WAVE */

.wave{

    position:absolute;

    bottom:-2px;
    left:0;

    width:100%;

    line-height:0;

}

.wave svg{

    width:100%;
    height:90px;

    display:block;

}
html
@media(max-width:950px){

    .hero-content{

        grid-template-columns:1fr;

        text-align:center;

        gap:40px;

    }

    .hero-text h1{

        font-size:34px;

    }

    .hero-image{

        transform:none;

    }

    .hero-image img{

        max-width:420px;

    }

}

@media(max-width:600px){

    .hero{

        padding:110px 6% 90px;

    }

    .navbar{

        padding:15px 6%;

    }

    .hero-text h1{

        font-size:30px;

    }

    .hero-image img{

        max-width:320px;

    }

}

</style>
</head>
<body>

<nav class="navbar">

    <div class="logo">

        <img src="assets/img/g_logo_pui.png">

        <span>SI-BK</span>

    </div>

    <a href="pages/login.php" class="btn-login">

        Login

    </a>

</nav>

<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <h1>

                Sistem Informasi
                Bimbingan Konseling
                Penanganan Pelanggaran Siswa

            </h1>

            <p>

                Memudahkan wali kelas, guru BK,
                dan pihak sekolah dalam memantau,
                mengelola, serta menindaklanjuti
                pelanggaran siswa secara digital,
                terintegrasi, dan terdokumentasi.

            </p>

            <a href="pages/login.php" class="hero-btn">

                <i class="fas fa-right-to-bracket"></i>

                Login Sistem

            </a>

        </div>

        <div class="hero-image">

            <img src="assets/img/g_foto_smk.jpeg">

        </div>

    </div>

    <div class="wave">

        <svg viewBox="0 0 1440 320">

            <path
            fill="#ffffff"
            d="M0,224L80,202.7C160,181,320,139,480,138.7C640,139,800,181,960,192C1120,203,1280,181,1360,170.7L1440,160L1440,320L0,320Z">
            </path>

        </svg>

    </div>

</section>

<!-- FITUR -->

<section class="features">

    <div class="section-title">

        <h2>Fitur Sistem</h2>

        <p>

            Mendukung pengelolaan pelanggaran siswa secara terintegrasi.

        </p>

    </div>

    <div class="feature-grid">

        <div class="feature-card">

            <i class="fas fa-triangle-exclamation"></i>

            <h3>Poin Pelanggaran</h3>

            <p>

                Pencatatan dan monitoring poin pelanggaran siswa.

            </p>

        </div>

        <div class="feature-card">

            <i class="fas fa-award"></i>

            <h3>Remisi Poin</h3>

            <p>

                Pengelolaan remisi prestasi dan remisi otomatis.

            </p>

        </div>

        <div class="feature-card">

            <i class="fas fa-users"></i>

            <h3>Komunikasi Orang Tua</h3>

            <p>

                Dokumentasi pemanggilan, komunikasi dan home visit.

            </p>

        </div>

        <div class="feature-card">

            <i class="fas fa-file-signature"></i>

            <h3>Surat Peringatan</h3>

            <p>

                Pembuatan surat peringatan secara otomatis.

            </p>

        </div>

    </div>

</section>

<!-- INFORMASI SEKOLAH -->

<section class="school-info">

    <div class="section-title">

        <h2>Informasi Sekolah</h2>

        <p>

            Informasi kontak sekolah.

        </p>

    </div>

    <div class="info-grid">

        <div class="info-card">

            <i class="fas fa-envelope"></i>

            <h3>Email</h3>

            <p>

                info@smkpui.ac.id

            </p>

        </div>

        <div class="info-card">

            <i class="fas fa-phone"></i>

            <h3>Telepon</h3>

            <p>

                (0265) 123456

            </p>

        </div>

        <div class="info-card">

            <i class="fas fa-location-dot"></i>

            <h3>Alamat</h3>

            <p>

                Jatinangor, Kabupaten Sumedang,
                Jawa Barat

            </p>

        </div>

    </div>

</section>

<style>

.features{

    padding:90px 8%;

    background:#ffffff;

}

.section-title{

    text-align:center;

    margin-bottom:50px;

}

.section-title h2{

    color:#166534;

    font-size:34px;

    margin-bottom:10px;

}

.section-title p{

    color:#6b7280;

}

.feature-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:25px;

}

.feature-card{

    background:#fff;

    border-radius:24px;

    padding:30px;

    text-align:center;

    border:1px solid #ecf0f3;

    transition:.3s;

}

.feature-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 15px 30px rgba(22,163,74,.12);

}

.feature-card i{

    font-size:40px;

    color:#16a34a;

    margin-bottom:15px;

}

.feature-card h3{

    color:#166534;

    margin-bottom:10px;

}

.feature-card p{

    color:#6b7280;

    line-height:1.8;

}

.school-info{

    padding:90px 8%;

    background:
    linear-gradient(
    to bottom,
    #ffffff,
    #f0fdf4
    );

}

.info-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:25px;

}

.info-card{

    background:#fff;

    padding:30px;

    border-radius:24px;

    text-align:center;

    box-shadow:
    0 8px 20px rgba(0,0,0,.05);

}

.info-card i{

    font-size:36px;

    color:#16a34a;

    margin-bottom:15px;

}

.info-card h3{

    color:#166534;

    margin-bottom:10px;

}

.info-card p{

    color:#6b7280;

    line-height:1.8;

}

/* FOOTER */

.footer{

    background:#166534;

    color:#fff;

    text-align:center;

    padding:50px 20px;

}

.footer-logo{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:12px;

    margin-bottom:12px;

}

.footer-logo img{

    width:42px;

    height:42px;

}

.footer p{

    margin-bottom:6px;

    opacity:.9;

}

.footer span{

    opacity:.75;

    font-size:14px;

}

</style>

<footer class="footer">

    <div class="footer-logo">

        <img src="assets/img/g_logo_pui.png">

        <h3>SI-BK</h3>

    </div>

    <p>

        Sistem Informasi Bimbingan Konseling

    </p>

    <span>

        © 2026 SMK PUI Jatinangor

    </span>

</footer>

</body>
</html>
```

