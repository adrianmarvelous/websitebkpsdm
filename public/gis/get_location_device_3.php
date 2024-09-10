<script type="text/javascript">
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById("coordinates").innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
    // Handle successful geolocation here
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

</script>