<?php
session_start();
require_once('connect.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: admin_login.php");
  exit;
}

$name = $designation = $mobile = $email = $salary = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bus_name = $_POST["busname"];
  $bus_type = $_POST["bustype"];
  $bus_no = $_POST["busno"];
  $start_point = $_POST["startpoint"];
  $end_point = $_POST["endpoint"];
  $route_type= $_POST["routetype"];

  $stmt = $conn->prepare("INSERT INTO bus_schedule ( bus_name,bus_type ,bus_no ,start_point ,end_point, route_type ) VALUES (?, ?, ?, ?, ?,?)");
  $stmt->bind_param("ssssss", $bus_name, $bus_type, $bus_no, $start_point, $end_point,$route_type);
  $stmt->execute();

  header("Location: add_bus_schedule.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add a new Bus Schedule</title>
  <link rel="stylesheet" href="/dti/admin/add_bus_schedule.css">
</head>
<body>
  <h2>Add bus Schedule</h2>
  <div class = "container">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>Bus name</label>
    <input type="text" name="busname" placeholder="Enter bus Name" required>
    <br><br>
    <label>Bus type</label>
    <input type="text" name="bustype" placeholder="Enter bus Type" required>
    <br><br>
    <label>Bus number</label>
    <input type="text" name="busno" placeholder="Enter bus Number" required>
    <br><br>
    <label>Start point</label>
    <input type="text" name="startpoint" placeholder="Enter bus start point" required>
    <br><br>
    <label>end point</label>
    <input type="text" name="endpoint" placeholder="Enter bus End point" required>
    <br><br>
    <label>routetype</label>
    <input type="text" name="routetype" placeholder="Enter bus route type" required>
    
    <br><br>
    <input type="submit" value="Add" class="button">
  </form>
  <br>
  <a href="admin_dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>
