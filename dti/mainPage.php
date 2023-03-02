<?php
    session_start();
    require_once("connect.php");
    require_once("config.php");

    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if location and destination are not empty
        if(empty($_POST["location"]) || empty($_POST["destination"])) {
            $error = "Please enter both location and destination.";
        } else {
            $location = mysqli_real_escape_string($conn,$_POST["location"]);
            $destination = mysqli_real_escape_string($conn,$_POST["destination"]);

            // Check if the entered location and destination are within the bus path
            $query = "SELECT * FROM bus_schedule";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                if(strpos($row["bus_path"], $location) !== false && strpos($row["bus_path"], $destination) !== false) {
                    // If location and destination are within the bus path, show the bus details
                    $_SESSION["bus_id"] = $row["bus_id"];
                    header("location: bus_details.php");
                    exit();
                }
            }

            // If location and destination are not within the bus path, show an error message
            $error = "Sorry, we couldn't find a bus route that covers the entered location and destination.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="background_styles.css">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="landingPage.css">

        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
        <script src="script.js" defer></script>
        <title>AceBUS</title>
      </head>
    <body>
      
        <!-- responsive navbar html -->
        <nav class="navbar">
          <div class="brand-title">AceBUS</div>
          <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </a>
          <div class="navbar-links">
            <ul>
            <?php if(isset($_SESSION["username"])) { ?>
              <li><a href="#">Welcome <?php echo $_SESSION["username"]; ?></a></li>
              <li><a href="#">Home</a></li>
              <li><a href="#">support</a></li>
              
              <li><a href="logout.php">Logout</a></li>
              <?php } else { ?>
              <li><a href="login.php">login</a></li>
              <?php } ?>
            </ul>
          </div>
        </nav>

        <!-- landing page -->
        <div class="container">
            <h1>Where do you want to go today?</h1>
            <hr>
            <form method="POST">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter your location" required>
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" placeholder="Enter your destination" required>
                <button type="submit">Find Bus</button>
                <p class="error-message"><?php echo $error; ?></p>
            </form>
        </div>
    </body>
</html>
