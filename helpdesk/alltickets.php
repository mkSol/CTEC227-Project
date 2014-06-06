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
		
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ticket Pool</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<div class="row">
<div id="allTickets">
<?php 
	include("incl/paginatedtable.inc.php");

	//$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status',priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID";
	$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status', ticket.assignedTo AS 'Assigned To', priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID";
	
	echo "<h2>Ticket Pool</h2>";

	output_table($sql,"TicketPool",1,1,1);
	
?>

</div>
</div>
</body>
</html>
