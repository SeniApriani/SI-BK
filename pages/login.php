
<?php
session_start();
include "../config/koneksi.php";

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users
        WHERE username='$username'
        AND password='$password'"
        
    );
    

    $cek = mysqli_num_rows($query);

    if($cek > 0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        $_SESSION['id_user'] = $data['id_user'];
$_SESSION['id_siswa'] = $data['id_siswa'];
$_SESSION['kelas'] = $data['kelas'];

        if($data['role'] == 'wali_kelas'){

            header("Location: dashboard_walikelas.php");
            exit;

        }

        elseif($data['role'] == 'wakasek'){

            header("Location: dashboard_wakasek.php");
            exit;

        }

        elseif($data['role'] == 'kepala_sekolah'){

            header("Location: dashboard_kepsek.php");
            exit;

        }

        elseif($data['role'] == 'siswa'){

    header("Location: dashboard_siswa.php");
    exit;

}

    }else{

        $error = "Username atau Password salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login SI-BK</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>


```css
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:'Poppins',sans-serif;

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #ecfdf5,
        #dcfce7
    );

    position:relative;

    overflow-y:auto;

    padding:20px;

}

body::before{

    content:'';

    position:absolute;

    width:450px;
    height:450px;

    background:
    rgba(22,163,74,.10);

    border-radius:50%;

    top:-180px;
    left:-180px;

    filter:blur(40px);

}

body::after{

    content:'';

    position:absolute;

    width:450px;
    height:450px;

    background:
    rgba(22,163,74,.08);

    border-radius:50%;

    right:-180px;
    bottom:-180px;

    filter:blur(40px);

}

.login-card{

    width:100%;
    max-width:470px;

    background:#fff;

    border-radius:28px;

    padding:45px;

    border-top:6px solid #16a34a;

    box-shadow:
    0 20px 60px rgba(0,0,0,.08);

    position:relative;

    z-index:10;

}

.logo-area{

    text-align:center;

    margin-bottom:25px;

}

.logo-area img{

    width:95px;
    height:95px;

    object-fit:contain;

    margin-bottom:10px;

}

.logo-area h1{

    color:#166534;

    font-size:40px;

    margin-bottom:8px;

}

.logo-area p{

    color:#6b7280;

    line-height:1.8;

    font-size:14px;

}

.divider{

    width:80px;
    height:4px;

    background:#16a34a;

    border-radius:20px;

    margin:0 auto 25px;

}

.alert-error{

    background:#fef2f2;

    color:#dc2626;

    border:1px solid #fecaca;

    padding:12px;

    border-radius:12px;

    margin-bottom:20px;

    font-size:14px;

}

.form-group{

    margin-bottom:20px;

}

.form-group label{

    display:block;

    margin-bottom:8px;

    color:#374151;

    font-weight:600;

    font-size:14px;

}

.input-box{

    position:relative;

}

.input-box i:first-child{

    position:absolute;

    left:15px;
    top:50%;

    transform:translateY(-50%);

    color:#9ca3af;

}

.input-box input{
    max-width:370px;

    width:100%;

    height:55px;

    border:1px solid #d1d5db;

    border-radius:14px;

    padding-left:45px;
    padding-right:45px;

    outline:none;

    font-family:'Poppins',sans-serif;

    transition:.3s;

}

.input-box input:focus{

    border-color:#16a34a;

    box-shadow:
    0 0 0 4px rgba(22,163,74,.10);

}

.toggle-password{

    position:absolute;

    right:55px;
    top:50%;

    transform:translateY(-50%);

    cursor:pointer;

    color:#9ca3af;

}

/* BUTTON LOGIN */

.button-area{

    display:flex;

    justify-content:center;

    margin-top:30px;

}

.btn-submit{

    width:220px;

    height:55px;

    border:none;

    border-radius:14px;

    background:#16a34a;

    color:#fff;

    font-family:'Poppins',sans-serif;

    font-size:15px;

    font-weight:600;

    cursor:pointer;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:10px;

    transition:.3s;

    box-shadow:
    0 10px 20px rgba(22,163,74,.20);

}

.btn-submit:hover{

    background:#15803d;

    transform:translateY(-2px);

}

/* BACK BUTTON */

.back-home{

    display:flex;

    justify-content:flex-end;

    margin-top:25px;

}

.btn-back{

    width:45px;
    height:45px;

    border-radius:50%;

    border:1px solid #16a34a;

    color:#16a34a;

    text-decoration:none;

    display:flex;

    align-items:center;

    justify-content:center;

    transition:.3s;

}

.btn-back:hover{

    background:#16a34a;

    color:#fff;

}

@media(max-width:576px){

    .login-card{

        padding:35px 25px;

    }

    .logo-area h1{

        font-size:34px;

    }

}


</style>

</head>
<body>

<div class="login-card">

    <div class="logo-area">

        <img src="../assets/img/g_logo_pui.png">

        <h1>SI-BK</h1>

        <p>
            Sistem Informasi Bimbingan Konseling
            <br>
            Penanganan Pelanggaran Siswa
        </p>

    </div>

    <div class="divider"></div>

    <?php if($error != ""){ ?>

        <div class="alert-error">

            <?php echo $error; ?>

        </div>

    <?php } ?>

    <form method="POST">

        <div class="form-group">

            <label>Username</label>

            <div class="input-box">

                <i class="fas fa-user"></i>

                <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required>

            </div>

        </div>

        <div class="form-group">

            <label>Password</label>

            <div class="input-box">

                <i class="fas fa-lock"></i>

                <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan Password"
                required>

                <span
                class="toggle-password"
                onclick="togglePassword()">

                    <i
                    id="eyeIcon"
                    class="fas fa-eye"></i>

                </span>

            </div>

        </div>

        <div class="button-area">

            <button
            type="submit"
            name="login"
            class="btn-submit">

                <i class="fas fa-right-to-bracket"></i>

                Login Sistem

            </button>

        </div>

    </form>

    <div class="back-home">

        <a
        href="../index.php"
        class="btn-back">

            <i class="fas fa-arrow-left"></i>

        </a>

    </div>

</div>

<script>

function togglePassword(){

    let password =
    document.getElementById("password");

    let eye =
    document.getElementById("eyeIcon");

    if(password.type === "password"){

        password.type = "text";

        eye.classList.remove("fa-eye");

        eye.classList.add("fa-eye-slash");

    }

    else{

        password.type = "password";

        eye.classList.remove("fa-eye-slash");

        eye.classList.add("fa-eye");

    }

}

</script>

</body>
</html>
