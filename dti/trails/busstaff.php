<!DOCTYPE html>
<html>
<head>
	<title>Bus Staff</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi6uMqz7qKCE7rZ6o8Ce-DCpLF1-RzrxA&libraries=places"></script>
	<style type="text/css">
		#map {
			height: 400px;
			width: 100%;
		}
	</style>
</head>
<body>
	<h1>Bus Staff Page</h1>
	<form method="post" action="update_location.php">
		<label for="bus_id">Bus ID:</label>
		<input type="text" id="bus_id" name="bus_id" required><br><br>
		<label for="location">Location:</label>
		<input type="text" id="location" name="location" required><br><br>
		<div id="map"></div>
		<input type="hidden" id="latitude" name="latitude">
		<input type="hidden" id="longitude" name="longitude">
		<input type="hidden" id="geocoded_address" name="geocoded_address">
		<button type="submit">Update Location</button>
	</form>
	<script>
        // // Update the location every 2 minutes
        // setInterval(updateLocation, 120000); // 120000 milliseconds = 2 minutes

		if (navigator.geolocation) {
			navigator.geolocation.getcurrentPosition(function(position) {
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				var latlng = {lat: latitude, lng: longitude};
				var map = new google.maps.Map(document.getElementById('map'), {
					center: latlng,
					zoom: 18
				});
				var marker = new google.maps.Marker({
					position: latlng,
					map: map,
					title: 'Your location'
				});
				google.maps.event.addListener(map, 'click', function(event) {
					marker.setPosition(event.latLng);
					document.getElementById('latitude').value = event.latLng.lat();
					document.getElementById('longitude').value = event.latLng.lng();
					geocodeLatLng(event.latLng);
				});
				document.getElementById('latitude').value = latitude;
				document.getElementById('longitude').value = longitude;
				geocodeLatLng(latlng);
                setInterval(updateLocation, 120000);
			}, function() {
				alert('Error: The Geolocation service failed.');
			});
		} else {
			alert('Error: Your browser doesn\'t support geolocation.');
		}

		function geocodeLatLng(latlng) {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'location': latlng}, function(results, status) {
				if (status === 'OK') {
					if (results[0]) {
						document.getElementById('location').value = results[0].formatted_address;
						document.getElementById('geocoded_address').value = results[0].formatted_address;
					} else {
						alert('No results found');
					}
				} else {
					alert('Geocoder failed due to: ' + status);
				}
			});
		}

		var mysql = require('mysql');

		var con = mysql.createConnection({
		host: "localhost",
		user: "root",
		password: "",
		database: "acebusDB"
		});

		con.connect(function(err) {
		if (err) throw err;
		console.log("Connected!");
		var sql = "INSERT INTO users (user, password) VALUES ('student', 'password')";
		con.query(sql, function (err, result) {
			if (err) throw err;
			console.log("1 record inserted");
		});
		});
	</script>
</body>
</html>
