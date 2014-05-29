<?php 
	session_start();
	// Connect to SQL DB
	require("incl/sqlConnect.inc.php");
	include("navigation.php");

	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
		header("Location: login.php");
	}

	// Set session var for view ticket form direct
	$_SESSION['ticketpage'] = "alltickets";

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		switch ($_POST['submitType']) {
			case 'edit':
				// Sanitize ticket description and escape special chars for mySQL query
				$desc = mysqli_real_escape_string($dbc, $_POST['desc']);
				$date = mysqli_real_escape_string($dbc, $_POST['date']);
				mysqli_query($dbc, "UPDATE ticket SET timestamp='$date', categoryID='{$_POST['category']}', priorityID='{$_POST['priority']}', statusID='{$_POST['status']}', issueDesc='$desc' WHERE ticketID='{$_POST['id']}' LIMIT 1");
				break;
			
			case 'comment':
				// Sanitize ticket description and escape special chars for mySQL query
				$comment = mysqli_real_escape_string($dbc, $_POST['comment']);
				mysqli_query($dbc, "INSERT INTO ticketComment (ticketID, userID, timestamp, comment) VALUES ('{$_POST['ticketID']}','{$_POST['userID']}', NOW(), '{$_POST['comment']}')");
				break;

			case 'delete':				
				mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_POST['id']}' LIMIT 1");
				mysqli_query($dbc, "DELETE FROM ticketComment WHERE ticketID='{$_POST['id']}'");
				break;

			default:
				break;
		}
		// Refresh page after recieving edit form post to update page table
		header("Location: alltickets.php");
	}

		
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Tickets</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<div class="row">
<div class="large-12 columns" id="allTickets">
<?php 
	$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID");
	$rows = mysqli_num_rows($result);

	echo "<h2>View All Tickets</h2>";

	echo "<table id=\"alltickets_table\">";
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
		echo "<span><a data-reveal-id=\"viewTicket\" id=\"view" . $rows['0'] . "\" class=\"?viewid=" . $rows['0'] . "\" href=\"#\"><img src=\"images/view.png\"></a></span>";
		echo "<span><a data-reveal-id=\"deleteTicket\" id=\"delete" . $rows['0'] . "\" class=\"?delete=" . $rows['0'] . "\" href=\"#\"><img src=\"images/delete.png\"></a></span>";
		echo "<span><a data-reveal-id=\"editTicket\" id=\"edit" . $rows['0'] . "\" class=\"?edit=1&id=" . $rows['0'] . "\" href=\"#\" href=\"#\" id=\"edit" . $rows['0'] . "\"><img src=\"images/edit.png\"></a></span>";
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
	echo "<tbody>";
	echo "</table>";
?>
<div id="editTicket" class="reveal-modal" data-reveal></div>
<div id="viewTicket" class="reveal-modal" data-reveal></div>
<div id="deleteTicket" class="reveal-modal" data-reveal></div>
</div>
</div>
</body>
</html>
