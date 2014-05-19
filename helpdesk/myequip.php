
<div id="myEquip">
<?php 
	$username = $_SESSION['username'];
	//$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID WHERE user.username='$username'");
	$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View My Equipment</h2>";

	echo "<table>";
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
	echo "</table>";
?>
</div>
