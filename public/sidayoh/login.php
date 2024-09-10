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
  $login = $db->prepare('SELECT * FROM sidayoh_users WHERE username = :username');
  $login->execute(array(
    ':username' => htmlentities($_POST['username'])));
  $row = $login->fetch(PDO::FETCH_ASSOC);

  if(htmlentities(!empty($row['username']))){
    if (password_verify($_POST['password'], $row['password'])) {
      if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
      }
      htmlentities($_POST['tahun']);
      $_SESSION['login_user'] = htmlentities($row['username']);
      $_SESSION['id_bidang'] = htmlentities($row['id_bidang']);
      $_SESSION['nama'] = htmlentities($row['nama_user']);
      $_SESSION['role'] = htmlentities($row['role']);
      $_SESSION['tahun'] = htmlentities($_POST['tahun']);

      if ($_SESSION['login_user'] == 'admin'){
        header("Location: view/users/admin/index.php");
      }
      if ($_SESSION['login_user'] == '196905101997022001'){
        header("Location: view/users/super_admin/index.php");
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
    $tahun = $_POST['periode_tahun'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
     <title>SiDAYO</title>
     <link rel="icon" href="asset/img/logo_pemkot.png" type="image/x-icon"/>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
     <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
     <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
     <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
     <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
     <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
     <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
     <link rel="stylesheet" type="text/css" href="assets/css/util.css">
     <link rel="stylesheet" type="text/css" href="assets/css/main.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

     <style type="text/css">
     .limiter {
      width: 100%;
      margin: 0 auto;
      background-color: #000000;
    }

    .container-login100 {
      width: 100%;
      min-height: 100vh;
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: top;
      padding: 10px;
      background-image: url("assets/images/suroboyo.jpg");
      background-color: #ebebeb;
    }

  /*.wrap-login100 {
    width: 570px;
    background: #fff;
    border-radius: 10px;
    position: relative;
    height: max-content;
    }*/
  </style>
</head>
<body>

 <div class="limiter">
  <div class="container-login100" style="background-image: url('assets/images/suroboyo.jpg');bg-image {opacity: 0.7}">
   <div class="wrap-login100">
    <table border="0" width="110%" style="margin-top: -25px;margin-left: -3px;font-size: 32px;text-shadow: 3px 3px 3px #ababab;">
      <tr>
        <td align="left"><font style="color: white;font-family: Sofia, sans-serif;">SiDAYOH</font></td>
        <td align="right"><img width="110" src="asset/img/logo_pemkot.png"></td>
      </tr>
    </table>
    <form class="login100-form validate-form" action="" method="POST">
      <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
      <span class="login100-form-logo">
        <!--<i class="zmdi zmdi-landscape"></i>-->
        <img width="130" src="asset/img/logo_BKPSDM.png"></img>
      </span>

      <span class="login100-form-title p-b-34 p-t-27">
        Log in
      </span>

      <div class="wrap-input100 validate-input" data-validate = "Enter username">
        <input class="input100" type="text" name="username" placeholder="Username">
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
      </div>

      <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="password" name="password" placeholder="Password">
        <span class="focus-input100" data-placeholder="&#xf191;"></span>
      </div>

                  <!--<div class="contact100-form-checkbox">
                      <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                      <label class="label-checkbox100" for="ckb1">
                         Remember me
                     </label>
                   </div>-->

                   <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name="Login" type="submit">
                     Login
                   </button>
                 </div>

					<!--<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>-->
				</form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>
  <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="assets/vendor/animsition/js/animsition.min.js"></script>
  <script src="assets/vendor/bootstrap/js/popper.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/select2/select2.min.js"></script>
  <script src="assets/vendor/daterangepicker/moment.min.js"></script>
  <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="assets/vendor/countdowntime/countdowntime.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>
<?php
}
?>