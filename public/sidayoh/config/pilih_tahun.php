<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SiDAYOH</title>
	<link rel="icon" href="asset/img/logo_pemkot.png" type="image/x-icon"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/images/suroboyo.jpg');">
			<div class="wrap-login100">
				<table border="0" width="110%" style="margin-top: -25px;margin-left: -3px;font-size: 32px;text-shadow: 3px 3px 3px #ababab;">
					<tr>
						<td align="left"><font style="color: white;font-family: Sofia, sans-serif;">SiDAYOH</font></td>
						<td align="right"><img width="110" src="asset/img/logo_pemkot.png"></td>
					</tr>
				</table>
				<form class="login100-form validate-form" action="login.php" method="POST">
					<span class="login100-form-logo">
						<!--<i class="zmdi zmdi-landscape"></i>-->
						<img width="130" src="asset/img/logo_BKPSDM.png"></img>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Sistem Informasi 
						<br>
						Daftar Tamu 
						<br>
						Layanan Online Harian
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<select name="periode_tahun" class="form-control" required>
							<?php
							$query_tahun_periode = $db->prepare("select tahun from sidayoh_periode_tahun");
							$query_tahun_periode->execute();
							while($data_query_tahun_periode = $query_tahun_periode->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option><?=$data_query_tahun_periode['tahun'];?></option>
								<?php
							}
							?>
						</select>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Pilih
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
	
	<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

</body>
</html>