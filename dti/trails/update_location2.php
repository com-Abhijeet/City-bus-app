<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bus_id = $_POST["bus_id"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];
  $address = $_POST["address"];

  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "acebusDB";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert data into table
  $sql = "INSERT INTO bus_locations (bus_id, latitude, longitude, address) VALUES ('$bus_id', '$latitude', '$longitude', '$address')";

  if ($conn->query($sql) === TRUE) {
    echo "Location updated successfully";
  } else {
    echo "Error updating location: " . $conn->error;
  }

  $conn->close();
}
?>
