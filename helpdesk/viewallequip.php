<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Equip</title>
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

<?php 

	function table_user_assigned_equip() {
		global $dbc;
		$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, userEquip.linkID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID");
		$rows = mysqli_num_rows($result);

		echo '<div class="row">';
		echo '<div class="large-12 columns" id="userEquip">';

		echo "<p>Equipment Assigned to Employees:</p>";

		echo "<table id=\"userequip_table\">";
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
		echo "</div>";
		echo "</div>";
	}

	function table_dept_assigned_equip() {
		global $dbc;
		$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, userEquip.linkID, department.deptID, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID");
		$rows = mysqli_num_rows($result);

		echo '<div class="row">';
		echo '<div class="large-12 columns" id="deptEquip">';

		echo "<p>Equipment Assigned to Departments:</p>";

		echo "<table id=\"deptequip_table\">";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Equip ID</th>";
		echo "<th>Type</th>";
		echo "<th>Description</th>";
		echo "<th>Department</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($rows=mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $rows['equipID'] . "</td>";
			echo "<td>" . $rows['equipType'] . "</td>";
			echo "<td>" . $rows['equipDesc'] . "</td>";
			echo "<td>" . $rows['department'] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";
	}

	function table_unassigned_equip() {
		global $dbc;
		$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID WHERE NOT EXISTS (SELECT userEquip.equipID FROM userEquip WHERE equipment.equipID=userEquip.equipID)");
		$rows = mysqli_num_rows($result);

		echo '<div class="row">';
		echo '<div class="large-12 columns" id="unassignedEquip">';

		echo "<p>Unassigned Equipment:</p>";

		echo "<table id=\"unassignedequip_table\">";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Equip ID</th>";
		echo "<th>Type</th>";
		echo "<th>Description</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($rows=mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $rows['equipID'] . "</td>";
			echo "<td>" . $rows['equipType'] . "</td>";
			echo "<td>" . $rows['equipDesc'] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";
	}

	//=================================Page content start=================================

	echo "<h2>View All Equipment</h2>";

	?>
		<button type="button" id="showUserEquip">Equipment Assigned to Users</button>
		<button type="button" id="showDeptEquip">Equipment Assigned to Departments</button>
		<button type="button" id="showUnassignedEquip">Unassigned Equipment</button>
	<?php

	table_user_assigned_equip();
	table_dept_assigned_equip();
	table_unassigned_equip();

	/*
	
	// MySQL Notes:

	###Query for equipment assigned to users:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType, 
		userEquip.userID, 
		userEquip.linkID, 
		user.username, 
		user.firstName, 
		user.lastName, 
		department.department 
	FROM equipment 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	JOIN userEquip ON userEquip.equipID=userEquip.equipID 
	JOIN user ON userEquip.userID=user.userID 
	JOIN department ON user.department=department.deptID 
	AND userEquip.userID=user.userID 
	AND userEquip.equipID=equipment.equipID

	###Query for equipment assigned to departments:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType, 
		userEquip.userID, 
		userEquip.linkID, 
		department.deptID, 
		department.department
	FROM equipment 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	JOIN userEquip ON userEquip.equipID=userEquip.equipID 
	JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID

	###Query for equipment that is unassigned:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType 
	FROM equipment 
	WHERE NOT EXISTS
	(SELECT
		userEquip.equipID
	FROM userEquip 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	WHERE
		equipment.equipID=userEquip.equipID
	)

	*/
?>

</body>
</html>
