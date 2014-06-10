<?php 

// Check if user is logged in. If not, boot to login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
	header("Location: login.php");
}
?>