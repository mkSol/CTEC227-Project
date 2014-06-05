<?php 
	session_start();
	// Connect to SQL DB
	require("incl/sqlConnect.inc.php");
	include("navigation.php");

	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
		header("Location: login.php");
	}

	// Set session var for view ticket form direct
	$_SESSION['ticketpage'] = "assignedtickets";

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Assigned Tickets</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<div class="row">
<div class="large-12 columns" id="assignedTickets">
	
<?php 
	include("incl/paginatedtable.inc.php");

	// Get userID
	$userID = $_SESSION['userID'];
	$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status',priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.assignedTo = '$userID'";
	// Output ticket table named AssignedTickets depending on pirvilege level, view=true, edit=fale, delete=false
	switch ($_SESSION['privLevel']) {
			case '1':
				output_table($sql,"AssignedTickets",1,0,0);
				break;
			case '2':
				output_table($sql,"AssignedTickets",1,1,0);
				break;
			case '3':
				output_table($sql,"AssignedTickets",1,0,0);
				break;
			case '4':
				output_table($sql,"AssignedTickets",1,1,1);
				break;
	}

	/*
	$userID = $_SESSION['userID'];
	$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.assignedTo = '$userID'");
	$rows = mysqli_num_rows($result);

	echo "<h2>My Assigned Tickets</h2>";

	echo "<table id=\"assignedtickets_table\">";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Action</th>";
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
		echo "<td>";
		echo "<span id=\"view" . $rows['0'] . "\"><a data-reveal-id=\"viewTicket\" class=\"?viewid=" . $rows['0'] . "\" href=\"#\"><img src=\"images/view.png\"></a></span>";
		echo "<span id=\"edit" . $rows['0'] . "\"><a data-reveal-id=\"editTicket\" class=\"?edit=1&id=" . $rows['0'] . "\" href=\"#\" href=\"#\" id=\"edit" . $rows['0'] . "\"><img src=\"images/edit.png\"></a></span>";
		echo "</td>";
		echo "<td>" . $rows['ticketID'] . "</td>";
		echo "<td>" . $rows['firstName'] . "</td>";
		echo "<td>" . $rows['lastName'] . "</td>";
		echo "<td>" . $rows['username'] . "</td>";
		echo "<td>" . date("m/d/y g:i A", strtotime($rows['timestamp'])) . "</td>";
		echo "<td>" . $rows['category'] . "</td>";
		echo "<td>" . $rows['priority'] . "</td>";
		echo "<td>" . $rows['status'] . "</td>";
		echo "<td>" . $rows['issueDesc'] . "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	*/
?>
<!--div id="viewTicket" class="reveal-modal" data-reveal></div>
<div id="editTicket" class="reveal-modal" data-reveal></div-->
</div>
</div>
</body>
</html>
