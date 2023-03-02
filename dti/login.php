<?php
    // session_start();
    
  session_start();
  require_once('connect.php');

    // // Connect to the database
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "acebusDB";

    // $conn = new mysqli($servername, $username, $password, $dbname);

    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // SQL query to validate user credentials
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Set session variables
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            header("Location: mainPage.php");
            exit();
        } else {
            echo "<script>alert('Invalid login credentials. Please try again.');</script>";
        }
        
    }

    $conn->close();

// session_start();
// require_once('connect.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $username = $_POST['username'];
//   $password = $_POST['password'];

//   $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
//   $stmt->bind_param('s', $username);
//   $stmt->execute();
//   $result = $stmt->get_result();

//   if ($result->num_rows == 1) {
//     $row = $result->fetch_assoc();
//     if (password_verify($password, $row['password'])) {
//       $_SESSION['logged_in'] = true;
//       $_SESSION['username'] = $row['username'];
//       header('Location: landingPage.php');
//       echo "<script>alert('LOGGED IN');</script>";
//       exit();
//     }
//   }
//   $error_message = 'Invalid username or password.';
// }

?>

<!-- HTML code remains the same -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="background_styles.css">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="login.css">

        <!-- <script src="authenticate.js"></script> -->
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
              <li><a href="landingPage.html">Home</a></li>
              <li><a href="#">support</a></li>
              <li><a href="">login</a></li>
            </ul>
          </div>
        </nav>

        <!-- login page -->
        <header class="header">
            Login
        </header>
        <form action="" id="login-form" method="post">
            <div class="imgcontainer">
              <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="Avatar" class="avatar">
            </div>
          
            <div class="container">
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" id="username"required>
          
              <label for="password"><b>Password</b></label>
              <input type="password" id = "password" placeholder="Enter Password" name="password"  required>
          
              <input type="submit" value="login" class="button">
              <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
              </label>
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" class="cancelbtn">Cancel</button>
              <span class="psw">Forgot <a href="#">password?</a></span>
              <div>Do not have a account?<a href="register.php"> register</a> </div>
            </div>
          </form>
    </body>
</html>