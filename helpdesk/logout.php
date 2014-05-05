<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Logout</title>
</head>
<body>
	<h2>You are now logged in.</h2>
	<p>Landing page goes here.</p>

	<?php 
		session_start();
		session_destroy();
		header("Location: login.php");
	?>
</body>
</html>