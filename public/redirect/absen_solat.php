<?php
    echo $jam = date("H:i");

    $duhur = 'https://forms.gle/qCzMYHpLiUy1Er2x9';
    $ashar = 'https://forms.gle/L3M69VHde8CgizBC7';

    if ($jam >= "14:10") {
        // echo "duhur";
        header("Location: $ashar");
    } elseif ($jam > "10:30") {
        // echo "ashar";
        header("Location: $duhur");
    }
    // if (isset($_GET['lat']) && isset($_GET['lon'])) {
    //     $latitude = $_GET['lat'];
    //     $longitude = $_GET['lon'];
    //     echo "Your Latitude: " . $latitude . "<br>";
    //     echo "Your Longitude: " . $longitude;
    // } else {
    //     echo "Location data not found.";
    // }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var url = "process_location.php?lat=" + latitude + "&lon=" + longitude;

            // Redirect to the PHP script to process the location data
            window.location.href = url;
        }
    </script>
</head>
<body>
<button onclick="getLocation()">Get My Location</button>
</body>
</html> -->