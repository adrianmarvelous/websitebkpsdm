<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		var successHandler = function(position) { 
			alert(position.coords.latitude); 
			alert(position.coords.longitude); 
		}; 

		var errorHandler = function (errorObj) { 
			alert(errorObj.code + ": " + errorObj.message); 

			alert("something wrong take this lat " + 26.0546106 ); 
			alert("something wrong take this lng " +-98.3939791); 

		}; 

		navigator.geolocation.getCurrentPosition( 
			successHandler, errorHandler, 
			{enableHighAccuracy: true, maximumAge: 10000});
		navigator.geolocation.getCurrentPosition(success, error, options);

	</script>
</body>
</html>