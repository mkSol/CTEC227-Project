<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error Logs</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
</head>

<?php 
		session_start();

		include("dashboard.php");
		require("incl/sqlConnect.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}
?>

<div class="row">
<div class="large-12 columns" id="errorLogs">
<?php 
	$result = mysqli_query($dbc, "SELECT errorLog.errorID, errorLog.timestamp, user.userID, user.username, errorLog.errorDump FROM errorLog JOIN user ON errorLog.userID=user.userID");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View Error Logs</h2>";


	echo "<table id=\"errorlogs_table\">";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Error ID</th>";
	echo "<th>Timestamp</th>";
	echo "<th>User ID</th>";
	echo "<th>Username</th>";
	echo "<th>Error Dump</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($rows=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $rows['errorID'] . "</td>";
		echo "<td>" . $rows['timestamp'] . "</td>";
		echo "<td>" . $rows['userID'] . "</td>";
		echo "<td>" . $rows['username'] . "</td>";
		echo "<td>" . $rows['errorDump'] . "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

	/*

	errorID, errorDump, timestamp, userID, username, privilege

	SELECT errorLog.errorID, errorLog.timestamp, user.userID, user.username, errorLog.errorDump FROM errorLog JOIN user ON errorLog.userID=user.userID;


	*/
?>
</div>
</div>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script> $(document).foundation(); </script>
</body>
</html>
