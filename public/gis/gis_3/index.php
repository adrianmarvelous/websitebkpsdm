<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<button id="find-me">Show my location</button><br />
	<p id="status"></p>
	<a id="map-link" target="_blank"></a>

	<script type="text/javascript">
		const options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0,
		};

		function success(pos) {
			const crd = pos.coords;

			console.log("Your current position is:");
			console.log(`Latitude : ${crd.latitude}`);
			console.log(`Longitude: ${crd.longitude}`);
			console.log(`More or less ${crd.accuracy} meters.`);
		}

		function error(err) {
			console.warn(`ERROR(${err.code}): ${err.message}`);
		}

		navigator.geolocation.getCurrentPosition(success, error, options);
	</script>
</body>
</html>