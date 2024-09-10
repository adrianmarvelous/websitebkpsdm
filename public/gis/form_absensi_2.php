<!DOCTYPE html>
<html>
<head>
	<title>Get GPS Coordinates</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Responsive Form Input</title>
	<style type="text/css">
		/* Reset some default styles */
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		/* Apply a basic style to the body */
		body {
			font-family: Arial, sans-serif;
			background-color: #f0f0f0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		/* Style the container */
		.container {
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
			padding: 20px;
			width: 100%;
			max-width: 400px;
		}

		/* Style the form input groups */
		.input-group {
			margin-bottom: 15px;
		}

		.input-group label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		.input-group input[type="text"],
		.input-group input[type="email"],
		.input-group textarea {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
		}

		.input-group input[type="submit"] {
			background-color: #007BFF;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
		}

		/* Responsive styles */
		@media screen and (max-width: 600px) {
			.container {
				max-width: 100%;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Absen Dengan Lokasi</h2>
		<br>
		<p id="coordinates"></p>

		<form action="proses_absensi_2.php" method="POST">
			<!-- <div class="input-group">
				<label for="latitude">Latitude:</label> -->
				<input type="hidden" name="latitude" id="latitudeInput">
			<!-- </div>

			<div class="input-group">
				<label for="longitude">Longitude:</label> -->
				<input type="hidden" name="longitude" id="longitudeInput">
			<!-- </div> -->

			<div class="input-group" align="center">
				<input type="submit" value="Mulai Absen">
			</div>
		</form>

		<script>
			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else {
					document.getElementById("coordinates").innerHTML = "Geolocation is not supported by this browser.";
				}
			}

			function showPosition(position) {
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				//document.getElementById("coordinates").innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;

            // Set the input fields with the coordinates
            document.getElementById("latitudeInput").value = latitude;
            document.getElementById("longitudeInput").value = longitude;

            // Submit the form
            document.getElementById("coordinatesForm").submit();
        }

        function showError(error) {
        	switch(error.code) {
        		case error.PERMISSION_DENIED:
        		document.getElementById("coordinates").innerHTML = "User denied the request for Geolocation.";
        		break;
        		case error.POSITION_UNAVAILABLE:
        		document.getElementById("coordinates").innerHTML = "Location information is unavailable.";
        		break;
        		case error.TIMEOUT:
        		document.getElementById("coordinates").innerHTML = "The request to get user location timed out.";
        		break;
        		case error.UNKNOWN_ERROR:
        		document.getElementById("coordinates").innerHTML = "An unknown error occurred.";
        		break;
        	}
        }

        // Call the getLocation() function to get the coordinates
        getLocation();
    </script>
</div>
</body>
</html>