<!-- Stores into database the lat and long and the geo coded address -->

<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acebusDB";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get bus ID from form data
$bus_id = $_POST["bus_id"];

// Get user's location and geocode it using Google Maps API
$lat = $_POST["latitude"];
$lng = $_POST["longitude"];
$location = $lat . ',' . $lng;
$google_api_key = "AIzaSyAi6uMqz7qKCE7rZ6o8Ce-DCpLF1-RzrxA";
$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$location&key=$google_api_key";
$response = file_get_contents($url);
$json = json_decode($response, true);
if ($json['status'] == 'OK') {
    $address = $json['results'][0]['formatted_address'];
} else {
    $address = '';
}

// Insert location data into database
$sql = "INSERT INTO bus_locations (bus_id, latitude, longitude, address) VALUES ('$bus_id', '$lat', '$lng', '$address')";
if ($conn->query($sql) === TRUE) {
    echo "Location updated successfully";
} else {
    echo "Error updating location: " . $conn->error;
}

// Close database connection
$conn->close();

// Wait for 2 minutes before sending the next location update
sleep(120);

// Redirect to the same page to send the next location update
header("Location: update_location.php");
exit;
?>