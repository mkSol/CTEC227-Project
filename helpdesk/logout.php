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
		$errorlog_var = "INSERT INTO errorLog VALUES (" . "NULL" . "," . "{$_SESSION['userID']}"  .  "," . "now()" . "," . "'user logged out'" . ")";
		echo "$errorlog_var";
		$err_result =mysqli_query($dbc, $errorlog_var);
		session_destroy();
		header("Location: login.php");
	?>
</body>
</html>