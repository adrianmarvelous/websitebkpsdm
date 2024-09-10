<?php
include "koneksi.php";

if (isset($_POST['image'])) {
	$img = $_POST['image'];
	$folderPath = "upload/";

	$image_parts = explode(";base64,", $img);
	$image_type_aux = explode("image/", $image_parts[0]);
	$image_type = $image_type_aux[1];

	$image_base64 = base64_decode($image_parts[1]);
	$fileName = uniqid() . '.png';

	$file = $folderPath . $fileName;
	file_put_contents($file, $image_base64);
	// print_r($fileName);
	// echo "<br><br><";
	//echo "File Berhasil DiUpload";
	?>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<style type="text/css">
		html, body {
			height: 100%;
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.center {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="center">
		<p>
			<?php
			// echo $_POST['locationLatitude'];
			// echo "<br>"
			?>
			<br><br>
			Foto Berhasil Upload
			<br>
			Terima Kasih
		</p>
	</div>
</body>
</html>
<?php
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Capture Foto</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<!-- Your Bootstrap form goes here -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
		<style type="text/css">
		#results { padding:20px; border:1px solid; background:#ccc; }

		.webcam-container {
			display: flex;
			justify-content: center; /* Center horizontally */
			align-items: center; /* Center vertically */
			max-width: 100%; /* Ensure the container doesn't exceed its parent's width */
			height: 0;
			padding-top: 75%; /* 4:3 aspect ratio, adjust as needed */
		}

		.image-preview img {
			max-width: 100%;
			height: auto;
		}
	</style>
</head>
<body style="text-align: center;vertical-align: center;">
	<?php
	$query_master_loc = $db->prepare("select * from attendance_daftar_alamat");
	$query_master_loc->execute();
	$data_query_master_loc = $query_master_loc->fetch(PDO::FETCH_ASSOC);

	function isLocationOutsideRadius($latitude1, $longitude1, $latitude2, $longitude2, $radiusInKilometers) {
    // Radius of the Earth in kilometers
		$earthRadius = 6371;

    // Convert latitude and longitude from degrees to radians
		$lat1 = deg2rad($latitude1);
		$lon1 = deg2rad($longitude1);
		$lat2 = deg2rad($latitude2);
		$lon2 = deg2rad($longitude2);

    // Haversine formula
		$dLat = $lat2 - $lat1;
		$dLon = $lon2 - $lon1;
		$a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$distance = $earthRadius * $c;

    // Check if the distance is greater than the specified radius
		return $distance > $radiusInKilometers;
	}

// Example usage:
// $referenceLatitude = 51.5074; // Reference latitude
// $referenceLongitude = -0.1278; // Reference longitude
// $locationLatitude = 52.5200; // Location latitude to check
// $locationLongitude = 13.4050; // Location longitude to check
// $radiusInKilometers = 100; // Radius in kilometers

// $referenceLatitude = -7.2577509; // Reference latitude
// $referenceLongitude = 112.7473633; // Reference longitude
// $locationLatitude = -7.1663616; // Location latitude to check
// $locationLongitude = 112.64; // Location longitude to check
// $radiusInKilometers = 20; // Radius in kilometers

$referenceLatitude = $data_query_master_loc['latitude']; // Reference latitude
$referenceLongitude = $data_query_master_loc['longitude']; // Reference longitude
//$locationLatitude = $_POST['latitude']; // Location latitude to check
//$locationLongitude = $_POST['longitude']; // Location longitude to check

$locationLatitude = -7.338653214079732; // Location latitude to check
$locationLongitude = 112.64108919966621; // Location longitude to check
$radiusInKilometers = 2; // Radius in kilometers


$isOutsideRadius = isLocationOutsideRadius($referenceLatitude, $referenceLongitude, $locationLatitude, $locationLongitude, $radiusInKilometers);

if ($isOutsideRadius) {
	echo "Lokasi Diluar Jangkauan Radius";
} else {
	echo "Lokasi di dalam Jangkauan Radius, silahkan untuk mengambil foto";
	echo "<br>";
	?>

	
	<body>
		<div class="container">
			<form action="" method="post">
				<div class="form-group" align="center">
					<div id="my_camera" class="camera-container" ></div>
					<input type=button value="Take Snapshot" onClick="take_snapshot()">
					<input type="hidden" name="image" class="image-tag">
					<input type="hidden" name="locationLatitude" value="<?=$locationLatitude?>">
					<input type="hidden" name="locationLongitude" value="<?=$locationLongitude?>">
				</div>

				<div class="form-group">
					<div id="results" class="image-preview">Your captured image will appear here...</div>
				</div>

				<div class="form-group">
					<br/>
					<button class="btn btn-success">Submit</button>
				</div>
			</form>



		</div>

		<!-- Configure a few settings and attach camera -->
		<script language="JavaScript">
			Webcam.set({
				width: 490,
				height: 390,
				image_format: 'jpeg',
				jpeg_quality: 90
			});

			Webcam.attach( '#my_camera' );

			function take_snapshot() {
				Webcam.snap( function(data_uri) {
					$(".image-tag").val(data_uri);
					document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
				} );
			}
		</script>
		<?php
	}
	?>
</body>
</html>
<?php
}
?>