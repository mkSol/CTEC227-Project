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
		session_start();

		include("navigation.php");
		require("incl/sqlConnect.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}

		// Set session var for view ticket form direct
		$_SESSION['equippage'] = "myequip";
?>

<div class="row">
<div class="large-12 columns" id="myEquip">
<?php 
	include("incl/paginatedtable.inc.php");

	// Get username
	$username = $_SESSION['username'];
	$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type', userEquip.userID AS ' User ID', user.username AS 'Username', user.firstName AS 'First', user.lastName AS 'Last', department.department AS 'Department' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'";
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
	}

	/*
	$username = $_SESSION['username'];
	//$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID WHERE user.username='$username'");
	$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View My Equipment</h2>";

	echo "<table id=\"myequip_table\">";
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
	while ($rows=mysqli_fetch_array($result)) {
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
	}
	echo "</tbody>";
	echo "</table>";
	*/
?>
</div>
</div>
</body>
</html>
