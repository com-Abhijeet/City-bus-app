<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bus Staff</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          alert("Geolocation is not supported by this browser.");
        }
      }

      function showPosition(position) {
        $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
        $.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&key=<YOUR_GOOGLE_MAPS_API_KEY>", function(data) {
          $("#address").val(data.results[0].formatted_address);
        });
      }
    </script>
  </head>
  <body>
    <h1>Bus Staff</h1>
    <form method="post" action="update_location2.php">
      <label for="bus_id">Enter Bus ID:</label>
      <input type="text" id="bus_id" name="bus_id">
      <br><br>
      <label for="latitude">Latitude:</label>
      <input type="text" id="latitude" name="latitude" readonly>
      <br><br>
      <label for="longitude">Longitude:</label>
      <input type="text" id="longitude" name="longitude" readonly>
      <br><br>
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" readonly>
      <br><br>
      <button type="button" onclick="getLocation()">Get Location</button>
      <br><br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
