<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

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

<?php 
	// ======================= Ticket Pool Page Content Start ========================

	include("navigation.php"); // Load nav bar	

	echo '<div class="row">';
	echo '<div id="allTickets">';

	//$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status',priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID";
	$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status', ticket.assignedTo AS 'Assigned To', priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID";
	$_SESSION['sql'] = $sql;
	//include("incl/outputtable.inc.php");

	echo "<h2>Ticket Pool</h2>";

	output_table($sql,"TicketPool",1,1,1);
	//echo '<a href="incl/outputtable.inc.php" class="success button">Export Table</a>';
	
?>

</div>
</div>
</body>
</html>
