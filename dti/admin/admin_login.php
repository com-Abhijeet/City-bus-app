<?php
session_start();
require_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check username and password
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows == 1) {
    $_SESSION["loggedin"] = true;
    header("Location: add_bus_schedule.php");
	echo"Welcome";
    exit;
  } else {
    $error = "Invalid username or password";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="/dti/styles.css">
  <link rel="stylesheet" href="/dti/login.css">
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
        
              <li><a href="#">admin_dashboard</a></li>
              <li><a href="#">bus_schedule</a></li>
              <li><a href="#">bus_routes</a></li>
            </ul>
          </div>
        </nav>
  <h2>Admin Login</h2>
  <?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <form action="admin_login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login" class="button">
  </form>

</body>
</html>
