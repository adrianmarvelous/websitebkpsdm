<?php
ini_set('display_errors', 1);
error_reporting(~0);
include "koneksi.php";
if (htmlentities(isset($_GET['nip']))) {
	$nip = htmlentities($_GET['nip']);
} else {
	header("location:absensi.php");
}

$query_get_data_konfirmasi = $db->prepare('SELECT * FROM daftar_hadir_pengarahan_walikota JOIN daftar_master_pengarahan_walikota ON daftar_hadir_pengarahan_walikota.nip = daftar_master_pengarahan_walikota.nip WHERE daftar_hadir_pengarahan_walikota.nip = :nip');
$query_get_data_konfirmasi->bindParam(':nip', $nip);
$query_get_data_konfirmasi->execute();
$data_query_get_data_konfirmasi = $query_get_data_konfirmasi->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Informasi</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<style>
	/* Custom CSS for adjusting card height */
	.card {
		height: 100%;
	}

	/* Custom CSS for adjusting card image */
	.card-img-top {
		height: 200px;
		object-fit: cover;
	}

	.info-item {
		margin-bottom: 10px;
	}

	.info-item strong {
		margin-right: 10px;
		font-weight: bold;
	}

	.info-item span {
		color: #555;
	}

	.logo {
		max-width: 50%;
		height: auto; /* Maintain aspect ratio */
		padding-bottom: 20px; /* Space between the logo and the rest of the content */
	}

</style>
</head>
<body>

	<div class="container mt-5">
		<!-- Main Content Section -->
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
					<br>
					<table>
						<tr>
							<td align="left"><img src="logo_pemkot.png" style="max-width: 100px; height: auto;"> <!-- <img src="logo_bkpsdm.png" style="max-width: 60px; height: auto;"> --></td>
							<!-- <td align="right"><img src="logo_bkpsdm.png" style="max-width: 70px; height: auto; padding-right: 5px;"></td> -->
						</tr>
					</table>
					<!-- Center the QR code horizontally -->
					<div class="text-center">
						<img class="card-img-top" src="qr_code/<?=$nip?>.png" alt="QR Code" style="max-width: 200px;">
					</div>
					<div class="card-body">
						<h2 class="card-title text-center"><b>DAFTAR HADIR</b></h2>
						<h5 class="card-subtitle text-center">(PENGARAHAN WALIKOTA)</h5>
						<br>
						<div class="card-text">
							<div class="info-item">
								<strong>NIP:</strong> <?=$data_query_get_data_konfirmasi['nip']?>
							</div>
							<div class="info-item">
								<strong>Nama:</strong> <?=$data_query_get_data_konfirmasi['nama']?>
							</div>
							<div class="info-item">
								<strong>Jabatan:</strong> <?=$data_query_get_data_konfirmasi['jabatan']?>
							</div>
							<div class="info-item">
								<strong>Instansi:</strong> <?=$data_query_get_data_konfirmasi['instansi']?>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<form method="post" action="index.php">
							<button type="submit" class="btn btn-danger btn-block" name="logout">Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
