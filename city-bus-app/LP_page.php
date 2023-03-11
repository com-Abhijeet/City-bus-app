<?php
// Initialize database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acebusDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $strt_point = $destination = $latitude = $longitude = $location = "";
// // Retrieve user's location and destination from POST request
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// $strt_point = $_POST['strt_location'];
// $destination = $_POST['destination'];
// $latitude = $_POST['latitude'];
// $longitude = $_POST['longitude'];
// $location = $_POST['geocoded_address'];
// $Bus_id = "";
// }

// // Retrieve bus information from the database
// $sql = "SELECT * FROM bus_schedule WHERE end_point = '$destination'";
// $result = $conn->query($sql);

// // Create HTML output for the bus cards
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         echo "<div class='bus-card'>
//             <h3>Bus Name &rarr;" . $row['bus_no'] .' ----'.' Bus Id &rarr;'. $row['Bus_id']. "</h3>
//             <p><strong>From:</strong> " . $row['start_point'] . "</p>
//             <p><strong>To:</strong> " . $row['end_point'] . "</p>
//             <p><strong>Departure Time:</strong> " . $row['departure_time'] . "</p>
//             <button onclick='showDetails(this)'>Show Details</button>
// 			<button id='payment-btn-" . $Bus_id . "' class='payment-btn' data-bus-id='" . $Bus_id . "'>Make Payment</button	

//            <div class='bus-details'>
//                 <p><strong>Driver Name:</strong> " . $row['staff_name'] . "</p>
               
//             </div>
//         </div>";
		
//     }
// } else {
//     echo "<p>No buses available for this route.</p>";
// }

// Close database connection
// $conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Landing Page</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpADpK3ACC_2nD6PUSflatI67EQiIZXc&libraries=places"></script>
	<link rel="stylesheet" href="LP_page.css">
	<link rel="stylesheet" href="/dti/styles.css">
	<script src="/dti/script.js" defer></script>
	
</head>
<body onload="getLocation()">
<nav class="navbar">
        <div class="brand-title">AceBUS</div>
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
        <div class="navbar-links">
          <ul>
            <li><a href="landingPage.php">Home</a></li>
            <li><a href="#">support</a></li>
            <li><a href="login.php">login</a></li>
          </ul>
        </div>
      </nav>
	<h1>Search for your local bus</h1><hr>
	<!-- <p>Please allow us to access your location in order to provide you with accurate information.</p> -->
	<!-- <button onclick="getLocation()">Get My Location</button> -->
	<p id="location-status"></p>
	<form method="post" action=" ">
    <!-- <label for="destination"></label> -->
		<!-- <input type="text" id="destination" name="destination" required><br><br> -->
		<tr><td>
		<label for="strt_location">Enter the location:</label></td>
		<td><input type="text" id="strt_location" name="strt_location" required><br><br></td></tr>

		<label for="destination">Enter Destination:   </label>
		<input type="text" id="destination" name="destination" required><br><br>
		<button type="submit">search nearby</button>
		<div id="map"></div>
		<input type="hidden" id="latitude" name="latitude">
		<input type="hidden" id="longitude" name="longitude">
		<input type="hidden" id="geocoded_address" name="geocoded_address">
		<!-- <button type="submit">Search</button> -->
		<hr>
		<div class = 'avail'> <h2>Available Buses</h2><div><hr>
		<?php
		$strt_point = $destination = $latitude = $longitude = $location = "";
		// Retrieve user's location and destination from POST request
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$strt_point = $_POST['strt_location'];
		$destination = $_POST['destination'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$location = $_POST['geocoded_address'];
		$Bus_id = "";
		}
		
		// Retrieve bus information from the database
		$sql = "SELECT * FROM bus_schedule WHERE end_point = '$destination'";
		$result = $conn->query($sql);
		
		// Create HTML output for the bus cards
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<div class='bus-card'>
					
					<h3>Bus Name &rarr;" . $row['bus_no'] .'<br> Bus Id &rarr;'. $row['Bus_id']. "</h3>
					<p><strong>From:</strong> " . $row['start_point'] . "</p>
					<p><strong>To:</strong> " . $row['end_point'] . "</p>
					<p><strong>Departure Time:</strong> " . $row['departure_time'] . "</p>
					<button onclick='showDetails(this)'>Show Details</button>
					<button id='payment-btn-" . $Bus_id . "' class='payment-btn' data-bus-id='" . $Bus_id . "'>Make Payment</button>
				</div>";
				
			}
		} else {
			echo "<p>No buses available for this route.</p>";
		}
		$conn->close();
		?>
		
	</form>
	<div id="bus-results"></div>
	<script>
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition, showError);
				// document.getElementById('location-status').innerHTML = 'Please wait while we fetch your location...';
			} else {
				// document.getElementById('location-status').innerHTML = 'Geolocation is not supported by your browser.';
			}
		}

		function showPosition(position) {
			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;
			var latlng = {lat: latitude, lng: longitude};
			var map = new google.maps.Map(document.getElementById('map'), {
				center: latlng,
				zoom: 15,
				disableDefaultUI :true,
				mapId:"cd486193df0c0628"
				
			});
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				title: 'Your location'
			});
			document.getElementById('latitude').value = latitude;
			document.getElementById('longitude').value = longitude;
			geocodeLatLng(latlng);
			// document.getElementById('location-status').innerHTML = 'Your location has been successfully retrieved.';
			checkBusLocations(latitude, longitude, document.getElementById('destination').value);
		}


		function showError(error) {
			switch(error.code) {
				case error.PERMISSION_DENIED:
					document.getElementById('location-status').innerHTML = 'You have denied the request for Geolocation.';
					break;
				case error.POSITION_UNAVAILABLE:
					document.getElementById('location-status').innerHTML = 'Location information is unavailable.';
					break
        case error.TIMEOUT:
        document.getElementById('location-status').innerHTML = 'The request to get your location has timed out.';
    break;
case error.UNKNOWN_ERROR:
document.getElementById('location-status').innerHTML = 'An unknown error occurred.';
break;
}
}

	function geocodeLatLng(latlng) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
				if (results[0]) {
					document.getElementById('geocoded_address').value = results[0].formatted_address;
				} else {
					console.log('No results found');
				}
			} else {
				console.log('Geocoder failed due to: ' + status);
			}
		});
	}

	function checkBusLocations(latitude, longitude, destination) {
		$.ajax({
			url: 'get_bus_locations.php',
			type: 'post',
			data: {
				'latitude': latitude,
				'longitude': longitude,
				'destination': destination
			},
			success: function(response) {
				var buses = JSON.parse(response);
				if (buses.length > 0) {
					var busResults = document.getElementById('bus-results');
					busResults.innerHTML = '';
					for (var i = 0; i < buses.length; i++) {
						var bus = buses[i];
						var busCard = document.createElement('div');
						busCard.classList.add('bus-card');
						var busTitle = document.createElement('h3');
						busTitle.innerHTML = bus['bus_name'];
						busCard.appendChild(busTitle);
						var busDetails = document.createElement('div');
						busDetails.classList.add('bus-details');
						var busLocation = document.createElement('p');
						busLocation.innerHTML = 'Location: ' + bus['location'];
						busDetails.appendChild(busLocation);
						var busDestination = document.createElement('p');
						busDestination.innerHTML = 'Destination: ' + bus['destination'];
						busDetails.appendChild(busDestination);
						var busTime = document.createElement('p');
						busTime.innerHTML = 'Departure Time: ' + bus['departure_time'];
						busDetails.appendChild(busTime);
						// var busSeats = document.createElement('p');
						// busSeats.innerHTML = 'Seats Available: ' + bus['seats_available'];
						// busDetails.appendChild(busSeats);
						var bookButton = document.createElement('button');
						bookButton.innerHTML = 'Book Now';
						busDetails.appendChild(bookButton);
						busCard.appendChild(busDetails);
						busResults.appendChild(busCard);
						$(busCard).click(function() {
							$(this).find('.bus-details').slideToggle();
						});
					}
				} else {
					document.getElementById('bus-results').innerHTML = 'No buses found.';
				}
			}
		});
	}
	$('.payment-btn').click(function() {
	// Get the bus ID from the data attribute
	var busId = $(this).data('bus-id');
	// Make an AJAX call to fetch the bus location
	$.ajax({
		url: 'get_bus_location.php',
		type: 'POST',
		data: {bus_id: busId},
		success: function(response) {
			// Parse the response JSON to get the bus location
			var busLocation = JSON.parse(response);

			// Create a new marker for the bus and add it to the map
			var busMarker = new google.maps.Marker({
				position: {lat: parseFloat(busLocation.latitude), lng: parseFloat(busLocation.longitude)},
				map: map,
				title: 'Bus ' + busLocation.bus_id,
				icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
			});

			// Add the bus marker to the array
			busMarkers.push(busMarker);
		}
	});
});

</script>
</body>
</html>