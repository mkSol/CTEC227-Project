<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Logout</title>
</head>
<body>
	<?php
		require("incl/sqlConnect.inc.php");
		session_start();

		// Record user login to DB
		$activitylog_var = "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Logout', '{$_SESSION['username']} logged out')";
		$activity_result =mysqli_query($dbc, $activitylog_var);	

		// Destroy dession vars before pushing user to login page
		session_destroy();
		header("Location: login.php");
	?>
</body>
</html>