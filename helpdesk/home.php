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
		echo "<p>Welcome, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</p>";
		echo "<p>By the way, your registered email address is " . $_SESSION['email'] . "</p>";
		echo "<a href=\"logout.php\">Log Out</a>";
	?>
</body>
</html>