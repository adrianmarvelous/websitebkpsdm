<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"

	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<?php
	include('koneksi.php');
	$kode_booking = htmlentities($_GET['kode_booking']);
	$kode_booking_catatan = $kode_booking;
	?>
	<script type="text/javascript">
		swal({
			title: "<?php echo 'Kode Booking Anda '.$kode_booking_catatan;?>",
			icon: "success",
			button: true
		}).then(function() {
			window.location = "index.php";
		});
	</script>
</body>
</html>