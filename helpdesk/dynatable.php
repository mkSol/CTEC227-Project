
<div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="dynatable.js"></script>
<?php 
	require("incl/sqlConnect.inc.php"); // Connect to SQL DB
	$sql1 = "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID";
	$sql2 = "SELECT * FROM user";
	$result = mysqli_query($dbc, $sql2);
	$rows = mysqli_num_rows($result);
	$numCols = mysqli_num_fields($result);

	//echo $numCols;

	echo "<h2>Test Dynamic Table</h2>";

	echo "<table id=\"dyna_table\">";
	
	// Build table head
	echo "<thead>";
	echo "<tr>";

	// Insert edit/delete column
	echo "<th>";
	echo "Edit";
	echo "</th>";

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
		echo "<td>";
		// Insert edit button and pass first column value (ID) ass url parameter
		echo "<a id=\"testlink\" class=\"id={$rows['0']}\" href=\"#\">Test Link</a>";
		echo "</td>";
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
	//echo $_GET['id'];
?>
<a class="testlink" href="#">Test Link</a>
<div id="testdiv"></div>

</div>
