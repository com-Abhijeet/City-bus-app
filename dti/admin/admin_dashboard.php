<?php
session_start();
require_once('connect.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: admin_login.php");
  exit;
}

$stmt = $conn->prepare("SELECT * FROM employee");
$stmt->execute();
$employees = $stmt->get_result();

$stmt = $conn->prepare("SELECT * FROM inventory");
$stmt->execute();
$inventory = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h2>Admin Dashboard</h2>
  <h3>Employees</h3>
  <table>
    <tr>
      <th>Name</th>
      <th>Designation</th>
      <th>Mobile</th>
      <th>Email</th>
      <th>Salary</th>
    </tr>
    <?php while ($row = $employees->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row["Name"]; ?></td>
        <td><?php echo $row["Designation"]; ?></td>
        <td><?php echo $row["Mobile"]; ?></td>
        <td><?php echo $row["Email"]; ?></td>
        <td><?php echo $row["Salary"]; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <h3>Inventory</h3>
  <table>
    <tr>
      <th>Item</th>
      <th>Quantity</th>
      <th>In Use</th>
      <th>In Reserve</th>
      <th>Date of Purchase</th>
      <th>Cost per Item</th>
    </tr>
    <?php while ($row = $inventory->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row["Item"]; ?></td>
        <td><?php echo $row["Quantity"]; ?></td>
        <td><?php echo $row["In_use"]; ?></td>
        <td><?php echo $row["In_reserve"]; ?></td>
        <td><?php echo $row["date_of_purchase"]; ?></td>
        <td><?php echo $row["cost_per_item"]; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <a href="add_employe.php">Add Employee</a>
  <br>
  <a href="update_employe.php   ">Update Employee</a>
  <br>
  <a href="add_inventory.php">Add Inventory</a>
  <br>
  <a href="update_inventory.php">Update Inventory</a>
  <br>
  <br>
  <a href="logout.php">Logout</a>
</body>
</html>
