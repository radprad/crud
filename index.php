<!DOCTYPE html>
<html>
<head>
	<title>MySQL Table Viewer</title>
</head>
<body>
	<h1>MySQL Table Viewer</h1>
	<?php
		// Define database connection variables
		$servername = "gl-mysql-server.mysql.database.azure.com";
		$username = "glsqladmin";
		$password = "Gladmin123";
		$dbname = "mydatabase";

		// Create database connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Check if an employee name is provided in the URL
		if (isset($_GET['name'])) {
			$employeeName = $_GET['name'];

			// Prepare and execute the query with a WHERE clause
			$sql = "SELECT * FROM employees WHERE name = '$employeeName'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display table headers
				echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
				// Loop through results and display each row in the table
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
				}
				echo "</table>";
			} else {
				echo "No results found for employee: " . $employeeName;
			}
		} else {
			// Query database for all rows in the table
			$sql = "SELECT * FROM employees";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display table headers
				echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
				// Loop through results and display each row in the table
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
				}
				echo "</table>";
			} else {
				echo "0 results";
			}
		}

		// Close database connection
		$conn->close();
	?>
</body>
</html>
