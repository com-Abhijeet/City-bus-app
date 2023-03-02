<!DOCTYPE html>
<html>
    <head>
      <!-- <link rel="stylesheet" href="background_styles.css"> -->
      <link rel="stylesheet" href="styles.css">
      <link rel="stylesheet" href="landingPage.css">
      <script src="script.js" defer></script>
      <title>AceBUS</title>
    </head>
    <body>
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
      <div class="page-heading">
        <span class ="find">Find</span>
        <span class="mybus">my Bus</span>
        <span class="bus-icon">
       <img src="bus.png" alt="bus-icon">
        </span>
      </div>
      <hr>
      <div class="container">
        <label for="uname"><b>Current Location</b></label>
        <input type="text" placeholder="Enter location" name="uname" required>
    
        <label for="psw"><b>Destination</b></label>
        <input type="text" placeholder="Enter Destination">
    
        <button type="submit">Search</button>
      </div>
      <div class="feature-bar">
        <div class="feature-icon">
          <!-- <span class="f-payments"> -->
            <img src="mobile-payment.png" alt="Payments-icon">
          <!-- </span> -->
          <!-- <span class="f-tickets"> -->
            <img src="ticket.png" alt="tickets-icon">
          <!-- </span> -->
          <!-- <span class="f-pass"> -->
            <img src="pass.png" alt="Pass-icon">
          <!-- </span> -->

        </div>
      </div>
      <div class="map-section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.9590367038118!2d77.58200911548867!3d28.45065119903943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cbf94deb6bc39%3A0x7ba6bedc9a2b537f!2sBennett%20University%20(Times%20of%20India%20Group)!5e0!3m2!1sen!2sin!4v1676872290159!5m2!1sen!2sin" width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      </div>
    </body>
</html>