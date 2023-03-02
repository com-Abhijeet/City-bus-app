<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acebusDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $bus_id = $_POST["bus_id"];
//   // $location = $_POST["location"];
//   $latitude = $_POST["latitude"];
//   $longitude = $_POST["longitude"];
//   $geocoded_address = $_POST["geocoded_address"];

//   $stmt = $conn->prepare("SELECT * FROM bus_locations WHERE bus_id = ?");
//   $stmt->bind_param("s", $bus_id);
//   $stmt->execute();
//   $result = $stmt->get_result();
//   $stmt->close();

//   if ($result->num_rows > 0) {
//       $stmt = $conn->prepare("UPDATE bus_locations SET latitude = ?, longitude = ?, address = ? WHERE bus_id = ?");
//       $stmt->bind_param("ssss", $latitude, $longitude, $geocoded_address, $bus_id);
//       if ($stmt->execute()) {
//           echo "Location updated successfully";
//       } else {
//           echo "Error updating location: " . $stmt->error;
//       }
//       $stmt->close();
//   } else {
//       $stmt = $conn->prepare("INSERT INTO bus_locations (bus_id, latitude, longitude, address) VALUES (?, ?, ?, ?)");
//       $stmt->bind_param("ssss", $bus_id, $latitude, $longitude, $geocoded_address);
//       if ($stmt->execute()) {
//           echo "Location added successfully";
//       } else {
//           echo "Error adding location: " . $stmt->error;
//       }
//       $stmt->close();
//   }
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $bus_id = $_POST["bus_id"];
//   $location = $_POST["location"];
//   $latitude = $_POST["latitude"];
//   $longitude = $_POST["longitude"];
//   $geocoded_address = $_POST["geocoded_address"];

//   // Check if bus ID exists in the database
//   $sql = "SELECT * FROM bus_locations WHERE Bus_id='$bus_id'";
//   $checkID = $sql;
//   $result = $conn->query($sql);
//   echo ($result);
//   echo $sql;

//   if ($checkID = $sql) {
//       // Bus ID exists, update the record
//       $sql = "REPLACE INTO bus_locations (bus_id, latitude, longitude, address) VALUES ('$bus_id',  '$latitude', '$longitude', '$geocoded_address')";
//   } else {
//       // Bus ID does not exist, insert a new record
//       $sql = "INSERT INTO bus_locations (bus_id,  latitude, longitude, address) VALUES ('$bus_id', '$latitude', '$longitude', '$geocoded_address')";
//   }

//   if ($conn->query($sql) === TRUE) {
//       echo "Location updated successfully";
//   } else {
//       echo "Error updating location: " . $conn->error;
//   }
// }

// Get the form data
$bus_id = $_POST["bus_id"];
$lat = $_POST["latitude"];
$lng = $_POST["longitude"];
$address = $_POST["geocoded_address"];

// Prepare the query
$stmt = $conn->prepare("INSERT INTO bus_locations (bus_id, latitude, longitude, address) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE latitude=?, longitude=?, address=?");

// Bind the parameters
$stmt->bind_param("sddssss", $bus_id, $lat, $lng, $address, $lat, $lng, $address);

// Execute the query
if ($stmt->execute()) {
    echo "Location saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>
