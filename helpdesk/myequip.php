<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

	// Set session var for view ticket form direct
	$_SESSION['equippage'] = "myequip";
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Equipment</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 
	function list_software($equipID) {
		global $dbc;
		// MySQL query to populate basic ticket details
		$result2 = mysqli_query($dbc, "SELECT softwareID, softwareName, softwareSerial FROM software WHERE equipID='$equipID'");
		$rows2 = mysqli_num_rows($result2);
		
		// Print out software for selected equipID
		//echo "<table>";
		echo "<thead>";
		echo "<tr>";
		echo "<th></th>"; // Blank column to indent software list from equip list
		echo "<th>Software ID</th>";
		echo "<th>Name</th>";
		echo "<th>Serial</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($rows2=mysqli_fetch_array($result2)) {
			echo "<tr>";
			echo "<td></td>"; // Blank column to indent software list from equip list
			echo "<td>" . $rows2['softwareID'] . "</td>";
			echo "<td>" . $rows2['softwareName'] . "</td>";
			echo "<td>" . $rows2['softwareSerial'] . "</td>";
			echo "</tr>";

		}
		echo "<tbody>";
		//echo "</table>";
	}

	// ============================ My Equip Page Content Start ===============================

	include("navigation.php"); // Load nav bar	
	
	

	echo '<div class="row">';
	echo '<div class="large-12 columns" id="myEquip">';

	echo '<h2>My Equipment</h2>';

	// Get username and ID
	$username = $_SESSION['username'];
	$userID = $_SESSION['userID'];
	$department = $_SESSION['deptID'];

	// MySQL query to list equipment associated with ticket owner
	$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.userID='$userID'");
	$rows = mysqli_num_rows($result);

	// MySQL query to list equipment associated with ticket owner's department
	$result2 = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, userEquip.linkID, department.deptID, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID WHERE department.deptID='$department'");
	$rows2 = mysqli_num_rows($result2);

	if ($rows || $rows2) { // if either user equip or dept equip exists...
		if ($rows) { // If equipment exists...
			echo "<p>Equipment Associated with $username:</p>";
			// Print out equipment in a table
			echo "<table id=\"ticketequip_table\">";
			
			while ($rows=mysqli_fetch_array($result)) {
				echo "<thead>";
				echo "<tr>";
				echo "<th>Equip ID</th>";
				echo "<th>Type</th>";
				echo "<th>Description</th>";
				echo "<th>User ID</th>";
				echo "<th>Username</th>";
				echo "<th>First</th>";
				echo "<th>Last</th>";
				echo "<th>Department</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				echo "<tr>";
				echo "<td>" . $rows['equipID'] . "</td>";
				echo "<td>" . $rows['equipType'] . "</td>";
				echo "<td>" . $rows['equipDesc'] . "</td>";
				echo "<td>" . $rows['userID'] . "</td>";
				echo "<td>" . $rows['username'] . "</td>";
				echo "<td>" . $rows['firstName'] . "</td>";
				echo "<td>" . $rows['lastName'] . "</td>";
				echo "<td>" . $rows['department'] . "</td>";
				echo "</tr>";
				echo "<tr>";
				list_software($rows['equipID']);
				echo "<tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
		if ($rows2) { // If dept equipment exists...
			echo "<p>Department Owned Equipment:</p>";

			echo "<table id=\"ticketdeptequip_table\">";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Equip ID</th>";
			echo "<th>Type</th>";
			echo "<th>Description</th>";
			echo "<th>Department</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while ($rows2=mysqli_fetch_array($result2)) {
				echo "<tr>";
				echo "<td>" . $rows2['equipID'] . "</td>";
				echo "<td>" . $rows2['equipType'] . "</td>";
				echo "<td>" . $rows2['equipDesc'] . "</td>";
				echo "<td>" . $rows2['department'] . "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		} 
	} else { // If no equipment...
		echo "<p>No equipment associated with $username.</p>";
	}

	/*
	$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type', userEquip.userID AS ' User ID', user.username AS 'Username', user.firstName AS 'First', user.lastName AS 'Last', department.department AS 'Department' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'";
	
	echo "<h2>My Equipment</h2>";

	// Output ticket table named MyTickets depending on pirvilege level, view=true, edit=fale, delete=false
	switch ($_SESSION['privLevel']) {
			case '1':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '2':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '3':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '4':
				output_table($sql,"MyEquip",0,1,0);
				break;
	} */

	
?>
</div>
</div>
</body>
</html>
