<?php
include("koneksi.php");

if (htmlentities(isset($_POST['Login']) && htmlentities(isset($_POST['tahun'])))){
    // Secret Key ini kita ambil dari halaman Google reCaptcha
    // Sesuai pada catatan saya di STEP 1 nomor 6
    //$secret_key = "6LcyqVQkAAAAACFIHiPFJXWjQ_tYcJbMOCbO9XCs";

    // Disini kita akan melakukan komunkasi dengan google recpatcha
    // dengan mengirimkan scret key dan hasil dari response recaptcha nya
    //$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
    //$response = json_decode($verify);

//if($response->success){ // Jika proses validasi captcha berhasil
    $login = $db->prepare('SELECT * FROM users WHERE username = :username');
    $login->execute(array(
      ':username' => htmlentities($_POST['username'])));
    $row = $login->fetch(PDO::FETCH_ASSOC);

    if(htmlentities(!empty($row['username']))){
        if (password_verify($_POST['password'], $row['password'])) {
            if (session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }
            echo htmlentities($_POST['tahun']);
            $_SESSION['login_user'] = htmlentities($row['username']);
            $_SESSION['id_bidang'] = htmlentities($row['id_bidang']);
            $_SESSION['nama'] = htmlentities($row['nama']);
            $_SESSION['role'] = htmlentities($row['role']);
            $_SESSION['tahun'] = htmlentities($_POST['tahun']);

            if ($_SESSION['role'] == 'Admin'){
                header("Location: view/users/admin/index.php");
            }
            if ($_SESSION['role'] == 'Super Admin'){
                header("Location: view/users/admin/index.php");
            }
        }
        else{
            echo "<script>alert('Username atau Password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
//}

//else{ // Jika captcha tidak valid
 //   echo "<script>alert('Captcha Tidak Valid')</script>";
    /*echo "<h2>Captcha Tidak Valid</h2>";
    echo "Ohh sorry, you're not human (Anda bukan manusia)<hr>";
    echo "Silahkan klik kotak I'm not robot (reCaptcha) untuk verifikasi";*/
//}
}

if (htmlentities(!isset($_POST['periode_tahun']))) {
    include "pilih_tahun.php";
}

if (htmlentities(isset($_POST['periode_tahun']))){
    echo $tahun = $_POST['periode_tahun'];
    ?>
    <!--<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link rel="icon" href="asset/img/logo_pemkot.png">
        <title>Login</title>
        <link rel="stylesheet" href="asset/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="asset/assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="asset/assets/css/-Login-form-Page-BS4-.css">
        <link rel="stylesheet" href="asset/assets/css/styles.css">-->
        <!-- Load Librari Google reCaptcha nya -->
        <!--<script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
    <div class="alert alert-warning" role="alert">
        <?php //echo $_SESSION['error']; ?>
    </div>
    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <img src="asset/img/logo_pemkot.png" style="width: 100px; margin-left: -25px;">
                    <h1 class="text-info font-weight-light mb-6"><i class="fa fa-list-ol"></i>&nbsp;Si</h1>
                    <h4 class="text-info font-weight-light mb-6"></i><b>Sistem Informasi Raport Online</b></h4>-->
                    <form action="" method="POST">
                        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
                        <div class="form-group">
                            <label class="text-secondary">Username</label>
                            <input class="form-control" type="text" name="username" required>
                        </div>
                        <div class="form-group">
                            <label class="text-secondary">Password</label><input class="form-control" type="password" name="password" required>
                        </div>
                        <!--<div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LcyqVQkAAAAABAHVj0WDxbeRUj-9NwSDpLRvCRp"></div>
                        </div>-->
                        <button class="btn btn-info mt-2" name="Login" type="submit">Log In</button>
                    </form>
                    <!--<p class="mt-3 mb-0"></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image:url(&quot;asset/assets/img/trans-suroboyo.png&quot;);background-size:cover;background-position:center center;">
                <p class="ml-auto small text-dark mb-2">
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>-->

    <?php
}
?>