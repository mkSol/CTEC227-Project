<?php
	$dbc = mysqli_connect("localhost", "root", "pass", "irs") OR die("<p>Could not connect: " . mysql_connect_error() . "</p>");
	mysqli_set_charset($dbc, 'utf8');
?>