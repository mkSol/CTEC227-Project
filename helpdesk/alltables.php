<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Tables</title>
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
<div class="large-12 columns" id="allTables">
<?php 

	echo "<h2>View All Tables</h2>";

	$tblresult = mysqli_query($dbc, "SHOW TABLES");
	while($tables = mysqli_fetch_row($tblresult)) {
		echo "<div id=tbl" . $tables['0'] . ">";

		$result = mysqli_query($dbc, "SELECT * FROM " . $tables['0']);
		$rows = mysqli_num_rows($result);
		$numCols = mysqli_num_fields($result);

		echo "<p>Table: " . $tables['0'] . "</p>";

		echo "<table id=\"dyna_table\">";
		
		// Build table head
		echo "<thead>";
		echo "<tr>";

		// Insert edit/delete column
		/*echo "<th>";
		echo "Edit";
		echo "</th>";*/

		// Continue building table head
		while ($col_name = mysqli_fetch_field($result)) { // While more columns exist...
			echo "<th>" . $col_name->name . "</th>"; // Output table column name
		}
		echo "</tr>";
		echo "</thead>";

		// Build table body
		echo "<tbody>";
		while ($rows=mysqli_fetch_row($result)) { // While more rows exist...
			echo "<tr>";
			/*echo "<td>";
			// Insert edit button and pass first column value (ID) as url parameter
			echo "<a class=\"?id={$rows['0']}\" href=\"#\">Test Link</a>";
			echo "</td>";*/
			for ($col_num=0; $col_num < $numCols; $col_num++) { // Run through $numCols number of columns each row
				echo "<td>";
				echo $rows[$col_num]; // Spit out data for specified column on this row
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</tbody>";

		// Close table
		echo "</table>";
		echo "</div>";
	}




	/*$result = mysqli_query($dbc, "SELECT errorLog.errorID, errorLog.timestamp, user.userID, user.username, errorLog.errorDump FROM errorLog JOIN user ON errorLog.userID=user.userID");
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
	*/
?>
</div>
</div>
</body>
</html>
