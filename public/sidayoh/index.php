<?php
include("koneksi.php");
include "assets/phpqrcode/qrlib.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SiDAYOH</title>
	<link rel="icon" href="asset/img/logo_pemkot.png" type="image/x-icon"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	</style>
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
				<form class="login100-form validate-form" action="proses_input_daftar_tamu.php" method="POST">
					<input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
					<span class="login100-form-logo">
						<img width="130" src="asset/img/logo_BKPSDM.png"></img>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Sistem Informasi 
						<br>
						Daftar Tamu 
						<br>
						Layanan Online Harian
					</span>

					<a href="" data-toggle="modal" data-target="#modalQRCode" style="color: white;"><i class="fa fa-qrcode" aria-hidden="true"></i> Qr Code</a>
					<br><br>
					<div class="wrap-input100 validate-input" data-validate = "Enter nama">
						<input class="form-control" type="text" name="nama" placeholder="Nama">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter opd">
						<?php
						$query_get_opd = $db->prepare("select * from sidayoh_master_opd");
						$query_get_opd->execute();
						?>
						<select name="instansi" id="id_instansi" class="form-control">
							<option selected="selected" disabled="disabled" value="">Pilih Instansi/Umum</option>
							<?php
							while($data_query_get_opd = $query_get_opd->fetch(PDO::FETCH_ASSOC)){
								?>
								<option value="<?php echo $data_query_get_opd['id_instansi']; ?>"><?php echo $data_query_get_opd['instansi']?></option>
								<?php
							}
							?>
						</select>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter alamat">
						<input class="form-control" name="alamat" id="alamat" placeholder="Alamat">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter no_telp">
						<input class="form-control" type="number" name="no_telp" placeholder="No Telp/HP">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter tanggal">
						<label style="color: white;">Tanggal</label>
						<input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="tanggal" align="center" placeholder="Tanggal">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter waktu">
						<label style="color: white;">Jam</label>
						<input class="form-control" type="time" value="<?php echo date("h:i"); ?>" name="waktu" align="center" placeholder="Waktu">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter id layanan">
						<?php
						$query_get_layanan = $db->prepare("select * from sidayoh_layanan order by id_layanan DESC");
						$query_get_layanan->execute();
						?>
						<select name="id_layanan" id="id_layanan" class="form-control">
							<option selected="selected" disabled="disabled" value="">- Pilih Layanan -</option>
							<?php
							while($data_query_get_layanan = $query_get_layanan->fetch(PDO::FETCH_ASSOC)){
								?>
								<option value="<?php echo $data_query_get_layanan['id_layanan']; ?>"><?php echo $data_query_get_layanan['layanan']?></option>
								<?php
							}
							?>
						</select>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter layanan">
						<input class="form-control" type="text" id="layanan" name="layanan" placeholder="Layanan">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter bidang">
						<?php
						$query_get_bidang = $db->prepare("select * from sidayoh_bidang");
						$query_get_bidang->execute();
						?>
						<select name="bidang_tujuan" id="id_instansi" class="form-control">
							<option selected="selected" disabled="disabled" value="">Pilih Bidang Yang Dituju</option>
							<?php
							while($data_query_get_bidang = $query_get_bidang->fetch(PDO::FETCH_ASSOC)){
								?>
								<option value="<?php echo $data_query_get_bidang['id_bidang']; ?>"><?php echo $data_query_get_bidang['nama_bidang']?></option>
								<?php
							}
							?>
						</select>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Enter tujuan">
						<input class="form-control" type="text" id="tujuan" name="tujuan" placeholder="Tujuan">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter permasalahan">
						<input class="form-control" type="text" type="text" name="permasalahan" placeholder="Permasalahan">
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="Login" type="submit">
							Kirim
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalQRCode" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Scan Qr Code</h4>
			</div>
			<div class="modal-body" align="center">
				<p>
					<?php
					$tempdir = "assets/images/"; //Nama folder tempat menyimpan file qrcode
					if (!file_exists($tempdir)) //Buat folder bername temp
					mkdir($tempdir);
					$codeContents = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					QRcode::png($codeContents, $tempdir.'007_4.png', QR_ECLEVEL_L, 11);
					echo '<img src="'.$tempdir.'007_4.png" align=center/>';
					?>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
	$(function() {
		$("#id_instansi").change(function(){
			var id_instansi = $("#id_instansi").val();

			$.ajax({
				url: 'proses_get_data_alamat.php',
				type: 'POST',
				dataType: 'json',
				data: {
					'id_instansi': id_instansi
				},
				success: function (opd) {
                        //$("#alamat").val(opd['alamat']);

                        if (opd['alamat'] == "kosong"){
                            //document.getElementById("alamat").style.visibility = "visible";
                            //document.getElementById("alamat_kosong").style.visibility = "visible";
                            document.getElementById('alamat').readOnly = false;
                            document.getElementById('alamat').value = '';
                            //$("#alamat").val(opd['alamat']);
                        }

                        if (opd['alamat'] != "kosong"){
                          //else{
                            //document.getElementById("alamat").style.visibility = "visible";
                            document.getElementById('alamat').readOnly = true;


                            //document.getElementById("alamat_kosong").style.visibility = "hidden";
                            $("#alamat").val(opd['alamat']);
                        }



                        /*$("#alamat").val(siswa['alamat']);
                        var $jenis_kelamin = $('input:radio[name=jenis_kelamin]');

                        if(siswa['jenis_kelamin'] == 'laki-laki'){
                            $jenis_kelamin.filter('[value=laki-laki]').prop('checked', true);
                        }
                        else{
                            $jenis_kelamin.filter('[value=perempuan]').prop('checked', true);
                        }*/
                    }
                });
		});

    /*$("form").submit(function(){
      alert("Keep learning");
  });*/
});
	$(function() {
		$("#id_layanan").change(function(){
			var id_layanan = $("#id_layanan").val();

			$.ajax({
				url: 'proses_get_data_layanan.php',
				type: 'POST',
				dataType: 'json',
				data: {
					'id_layanan': id_layanan
				},
				success: function (layanan1) {

					if (layanan1['layanan'] == "LAINNYA"){
						document.getElementById('layanan').readOnly = false;
						document.getElementById('layanan').value = '';
					}

					if (layanan1['layanan'] != "LAINNYA"){
						document.getElementById('layanan').readOnly = true;
						$("#layanan").val(layanan1['layanan']);
					}
				}
			});
		});
	});
</script>

</body>
</html>