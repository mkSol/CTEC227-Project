
<div id="allTickets">
<?php 
	$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID");
	$rows = mysqli_num_rows($result);

	echo "<h2>View All Tickets</h2>";

	echo "<table id=\"alltickets_table\">";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Ticket ID</th>";
	echo "<th>First</th>";
	echo "<th>Last</th>";
	echo "<th>Username</th>";
	echo "<th>Date</th>";
	echo "<th>Category</th>";
	echo "<th>Priority</th>";
	echo "<th>Status</th>";
	echo "<th>Description</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($rows=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $rows['ticketID'] . "</td>";
		echo "<td>" . $rows['firstName'] . "</td>";
		echo "<td>" . $rows['lastName'] . "</td>";
		echo "<td>" . $rows['username'] . "</td>";
		echo "<td>" . $rows['timestamp'] . "</td>";
		echo "<td>" . $rows['category'] . "</td>";
		echo "<td>" . $rows['priority'] . "</td>";
		echo "<td>" . $rows['status'] . "</td>";
		echo "<td>" . $rows['issueDesc'] . "</td>";
		echo "</tr>";
	}
	echo "<tbody>";
	echo "</table>";
?>
</div>
