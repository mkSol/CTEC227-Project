<?php 
	require("incl/sqlConnect.inc.php"); // Connect to SQL DB
	echo $_GET['id'];

	$sql2 = "SELECT * FROM user WHERE userID = {$_GET['id']}";
	$result = mysqli_query($dbc, $sql2);
	$rows = mysqli_num_rows($result);
	$numCols = mysqli_num_fields($result);

	//echo $numCols;

	echo "<h2>Test Dynamic Table</h2>";

	echo "<table id=\"dyna_table\">";
	
	// Build table head
	echo "<thead>";
	echo "<tr>";
	while ($col_name = mysqli_fetch_field($result)) { // While more columns exist...
		echo "<th>" . $col_name->name . "</th>"; // Output table column name
	}
	echo "</tr>";
	echo "</thead>";

	// Build table body
	echo "<tbody>";
	while ($rows=mysqli_fetch_row($result)) { // While more rows exist...
		echo "<tr>";
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
	echo "<p>TEST LINK CLICKED</p>";
 ?>