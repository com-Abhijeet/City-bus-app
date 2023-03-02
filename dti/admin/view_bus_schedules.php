<?php
// Include database connection code here
require_once("connect.php");
// Fetch bus schedules from database
$sql = "SELECT * FROM bus_schedule";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Bus Schedules</title>
	<style>
		/* Styles for the credit card container */
		.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			width: 300px;
			margin-bottom: 20px;
			background-color: #f2f2f2;
			padding: 10px;
			cursor: pointer;
		}
		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}
		.card img {
			width: 100%;
			height: 150px;
		}
		.card-container {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			justify-content: space-around;
		}
		.card-content {
			display: none;
			padding: 10px;
		}
		.card-content p {
			margin: 0;
		}
	</style>
	
</head>
<body>
	
	<h1>View Bus Schedules</h1>

	<div class="card-container">
		<?php
		// Loop through bus schedules and display them in credit card format
		while($row = mysqli_fetch_assoc($result)) {
			$name = $row['bus_name'];
			$start_point = $row['start_point'];
			$end_point = $row['end_point'];
			$bus_no = $row['bus_no'];
			$bus_type = $row['bus_type'];
			$route_type = $row['route_type'];
			$start_time = $row['start_time'];
			$end_time = $row['end_time'];
			$price = $row['price'];
			// $seats_available = $row['seats_available'];
		?>
		<div class="card" onclick="toggleCardContent(this)">
			<img src="bus_image.jpg" alt="Bus Image">
			<h2><?php echo $name . ' - ' . $bus_no; ?></h2>
			<p><?php echo $start_point . ' - ' . $end_point; ?></p>
			<div class="card-content">
				<p>Bus Type: <?php echo $bus_type; ?></p>
				<p>Route Type: <?php echo $route_type; ?></p>
				<p>Start Time: <?php echo $start_time; ?></p>
				<p>End Time: <?php echo $end_time; ?></p>
				<p>Price: <?php echo $price; ?></p>
				<!-- <p>Seats Available: <?php echo $seats_available; ?></p> -->
			</div>
		</div>
		<?php } ?>
	</div>

	<script>
		// Function to toggle card content
		function toggleCardContent(card) {
			card.querySelector('.card-content').classList.toggle('show');
			
		}
	</script>
</body>
</html>
