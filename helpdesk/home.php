<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
</head>
<body>
	<?php 
		session_start();
		require("incl/sqlConnect.inc.php"); // Connect to SQL DB

		// Kick user out to login page if not logged in
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}

		// ============================ Page Content Start ===============================

		// Misc debug info
		/*
		print_r($_SESSION);

		echo "<p>Welcome, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</p>";
		echo "<p>By the way, your registered email address is " . $_SESSION['email'] . "</p>";
		echo "<p>Access level: {$_SESSION['role']}</p>";
		echo "<p>User ID: {$_SESSION['userID']}</p>";
		*/

		// Display dashboard
		include("navigation.php");

		// Check privilege level and load appropriate pages
		echo "Home Page Content Goes Here.";
	?>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script> $(document).foundation(); </script>	
</body>
</html>
