<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise

	switch ($_SESSION['privLevel']) {
		case '1':
			// Break out of switchcase for normal users and continue to display dashboard
			break;
		
		case '2':
			// Redirect helpdesk users to assigned tickets upon login
			header("Location: assignedtickets.php");
			break;
		case '3':
			// Redirect manager users to all equipment upon login
			header("Location: allequip.php");
			break;
		case '4':
			// Redirect admin users to all tables upon login
			header("Location: alltables.php");
			break;

		default:
			break;
	}

	?>

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

		// ============================ Page Content Start ===============================

		include("navigation.php"); // Load nav bar	
		include("incl/paginatedtable.inc.php"); // load function for displaying tables
		include("dashboard.php"); // Load Dashboard
	?>

</body>
</html>
