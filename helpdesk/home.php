<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise

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
