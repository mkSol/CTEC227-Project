<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>
<body>
	<?php 
		session_start();
		require("incl/sqlConnect.inc.php"); // Connect to SQL DB

		// Display navigation
		include("navigation.php");
		
		// Kick user out to login page if not logged in
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}

		// ============================ Page Content Start ===============================


		// Check privilege level and load appropriate pages
		include("dashboard.php");
	?>

</body>
</html>
