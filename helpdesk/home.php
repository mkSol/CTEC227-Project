<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/pagetrans.js"></script>
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

		include("dashboard.php");

		// ============================ Page Content Start ===============================

		echo "<p>Welcome, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</p>";
		echo "<p>By the way, your registered email address is " . $_SESSION['email'] . "</p>";
		echo "<p>Access level: {$_SESSION['role']}</p>";

		switch ($_SESSION['privLevel']) {
				case '1': // Load pages for User level
					include("mytickets.php");
					include("alltickets.php");
					break;
				case '2': // Load pages for Help Desk level
					include("mytickets.php");
					include("alltickets.php");
					break;
				case '3': // Load pages for Manager level
					include("mytickets.php");
					include("alltickets.php");
					break;
				case '4': // Load pages Sys Admin level
					include("mytickets.php");
					include("alltickets.php");
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