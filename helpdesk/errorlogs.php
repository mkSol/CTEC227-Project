
<div id="errorLogs">
<?php 
	$result = mysqli_query($dbc, "SELECT errorLog.errorID, errorLog.timestamp, user.userID, user.username, errorLog.errorDump FROM errorLog JOIN user ON errorLog.userID=user.userID");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View Error Logs</h2>";


	echo "<table>";
	echo "<tr>";
	echo "<th>Error ID</th>";
	echo "<th>Timestamp</th>";
	echo "<th>User ID</th>";
	echo "<th>Username</th>";
	echo "<th>Error Dump</th>";
	echo "</tr>";
	while ($rows=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $rows['errorID'] . "</td>";
		echo "<td>" . $rows['timestamp'] . "</td>";
		echo "<td>" . $rows['userID'] . "</td>";
		echo "<td>" . $rows['username'] . "</td>";
		echo "<td>" . $rows['errorDump'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	/*

	errorID, errorDump, timestamp, userID, username, privilege

	SELECT errorLog.errorID, errorLog.timestamp, user.userID, user.username, errorLog.errorDump FROM errorLog JOIN user ON errorLog.userID=user.userID;


	*/
?>
</div>
