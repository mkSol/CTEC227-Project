<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
</head>
<body>
	<h2>You are now logged in.</h2>
	<p>Landing page goes here.</p>

	<?php 
		session_start();

		// Kick user out to login page if not logged in
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}

		echo "<p>Welcome, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</p>";
		echo "<p>By the way, your registered email address is " . $_SESSION['email'] . "</p>";
		echo "<a href=\"logout.php\">Log Out</a>";
	?>
</body>
</html>