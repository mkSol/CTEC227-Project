<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/pagetrans.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
</head>
<body>
	<h2>You are now logged in.</h2>
	<p>Landing page goes here.</p>

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
		include("dashboard.php");

		// Check privilege level and load appropriate pages
		switch ($_SESSION['privLevel']) {
				case '1': // Load pages for User level
					include("mytickets.php");
					include("newticket.php");
					include("myequip.php");
					break;
				case '2': // Load pages for Help Desk level
					include("mytickets.php");
					include("alltickets.php");
					include("newticket.php");
					include("myequip.php");
					include("assignedtickets.php");
					break;
				case '3': // Load pages for Manager level
					include("mytickets.php");
					include("viewalltickets.php");
					include("newticket.php");
					include("viewallequip.php");
					include("myequip.php");
					break;
				case '4': // Load pages for Sys Admin level
					include("mytickets.php");
					include("alltickets.php");
					include("newticket.php");
					include("assignedtickets.php");
					include("allequip.php");
					include("myequip.php");
					include("errorlogs.php");
					break;
				
				default:
					// User has no role and is invalid or not logged in
					// Throw user out to logout page
					header("Location: logout.php");
					break;
		}	
	?>
</body>
</html>
