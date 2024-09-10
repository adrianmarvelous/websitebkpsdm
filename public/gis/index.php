<!DOCTYPE html>
<html>
<head>
    <title>Get GPS Coordinates</title>
</head>
<body>
    <h1>Get GPS Coordinates</h1>
    
    <p id="coordinates"></p>

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
            document.getElementById("coordinates").innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
        }

        // Call the getLocation() function to get the coordinates
        getLocation();
    </script>
</body>
</html>