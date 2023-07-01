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

		// Get the employee name from the URL parameter
		$employeeName = basename($_SERVER['REQUEST_URI']);

		// Remove any leading or trailing slashes
		$employeeName = trim($employeeName, '/');

		// Prepare the SQL statement with a parameter
		$sql = "SELECT * FROM employees WHERE first_name = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $employeeName);

		// Execute the prepared statement
		$stmt->execute();

		// Get the result set
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			// Display table headers
			echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
			// Loop through results and display each row in the table
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["emp_no"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["email_id"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}

		// Close statement and database connection
		$stmt->close();
		$conn->close();
	?>
</body>
</html>
