<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise

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
	
<?php 
	// ======================= Assigned Tickets Page Content Start ========================

	include("navigation.php"); // Load nav bar	
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

	echo '<div class="row">';
	echo '<div class="large-12 columns" id="assignedTickets">';

	echo '<h2>Tickets Assigned To Me</h2>';

	// Get userID
	$userID = $_SESSION['userID'];
	$sql = "SELECT ticketID AS 'Ticket ID',user.firstName AS 'First',user.lastName AS 'Last',user.username AS 'Username',timestamp AS 'Date',issueDesc AS 'Issue Description',category.category AS 'Category',status.status AS 'Status', ticket.assignedTo AS 'Assigned To', priority.priority AS 'Priority' FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.assignedTo = '$userID'";
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

?>

</div>
</div>
</body>
</html>
