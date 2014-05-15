
<div id="viewAllEquip">
<?php 
	$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View All Equipment (Read Only)</h2>";

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
