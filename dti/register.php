<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create database connection
    $servername = "localhost";  // Replace with your server name
    $username = "root";  // Replace with your SQL username
    $password = "";  // Replace with your SQL password
    $dbname = "acebusDB";  // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve values from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $repeat_password = $_POST['repeat_password'];

    // Check if username or email already exists
    $check_user = "SELECT * FROM users WHERE name = '$name' OR email = '$email'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Username or email already exists")';  //not showing an alert box.
        echo '</script>';
        // echo "Username or email already exists";
    } else {
        // Check if password matches repeat password
        if ($password != $repeat_password) {
            // echo "Passwords do not match";
            echo '<script type="text/javascript">';
            echo ' alert("Passwords do not match!   ")';  //not showing an alert box.
            echo '</script>';
            
        } else {
            // Insert values into database
            $sql = "INSERT INTO users (Name,username ,email, password) VALUES ('$name','$username', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header("Location: mainPage.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="register.css">
    <script src="script.js" defer></script>
</head>
<body>
    <!-- responsive navbar design -->
    <nav class="navbar">
        <div class="brand-title">AceBUS</div>
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
        <div class="navbar-links">
          <ul>
            <li><a href="#landingPage.html">Home</a></li>
            <li><a href="#">support</a></li>
            <li><a href="login.html">login</a></li>
          </ul>
        </div>
      </nav>

      <!-- register section -->
      <form action="" method="post">
        <div class="container">
          <h1>Register</h1> 
          <p>Please fill in this form to create an account.</p>
          <hr>
            
          <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" id="name" required>
          
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter UserName" name="username" id="username" required>

          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" id="email" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="password" required>
      
          <label for="repeat_password"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="repeat_password" id="repeat_pasword" required>
          <hr>
      
          <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          <button type="submit" class="registerbtn">Register</button>
        </div>
      
        <div class="container signin">
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
      </form>

</body>
</html>