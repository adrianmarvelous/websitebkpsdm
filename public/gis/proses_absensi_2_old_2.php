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
	print_r($fileName);
	echo "<br>";
	echo "File Berhasil DiUpload";
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Capture Foto</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
		<style type="text/css">
			#results { padding:20px; border:1px solid; background:#ccc; }
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
	<!-- <video id="camera-preview" autoplay></video>
	<center><button id="start-camera">Start Camera</button></center>
	<br>
	<form id="video-form" action="" method="POST">
		<input type="hidden" id="video-data" name="video-data">
		<button type="submit" name="capture" value="capture">Capture Foto</button>
	</form>

	<script>
		const startCameraButton = document.getElementById('start-camera');
		const cameraPreview = document.getElementById('camera-preview');
		const videoForm = document.getElementById('video-form');
		const videoDataInput = document.getElementById('video-data');

		startCameraButton.addEventListener('click', async () => {
			try {
				const stream = await navigator.mediaDevices.getUserMedia({ video: true });
				cameraPreview.srcObject = stream;
			} catch (error) {
				console.error('Error accessing camera:', error);
			}
		});

    // When the form is submitted, capture the video stream and attach it to the form data
    videoForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent the default form submission behavior

        // Check if a video stream is available
        if (cameraPreview.srcObject) {
        	const mediaRecorder = new MediaRecorder(cameraPreview.srcObject);
        	const chunks = [];

        	mediaRecorder.ondataavailable = (event) => {
        		if (event.data.size > 0) {
        			chunks.push(event.data);
        		}
        	};

        	mediaRecorder.onstop = () => {
        		const blob = new Blob(chunks, { type: 'video/webm' });
        		const videoUrl = URL.createObjectURL(blob);
        		videoDataInput.value = videoUrl;
                videoForm.submit(); // Submit the form with the captured video data
            };

            mediaRecorder.start();

            setTimeout(() => {
            	mediaRecorder.stop();
            	cameraPreview.srcObject.getTracks().forEach((track) => track.stop());
            }, 5000); // Capture video for 5 seconds (adjust as needed)
        }
    });
</script> -->


<div class="container">
	<h1 class="text-center">Capture</h1>

	<form method="POST" action="">
		<div class="row">
			<div class="col-md-6">
				<div id="my_camera"></div>
				<br/>
				<input type=button value="Take Snapshot" onClick="take_snapshot()">
				<input type="hidden" name="image" class="image-tag">
			</div>
			<div class="col-md-6">
				<div id="results">Your captured image will appear here...</div>
			</div>
			<div class="col-md-12 text-center">
				<br/>
				<button class="btn btn-success">Submit</button>
			</div>
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