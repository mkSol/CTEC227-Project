<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error Logs</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 
		session_start();

		include("navigation.php");
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
</body>
</html>
