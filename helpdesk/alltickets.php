<?php 
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			require("incl/sqlConnect.inc.php");
			
			// Sanitize ticket description and escape special chars for mySQL query
			$desc = mysqli_real_escape_string($dbc, $_POST['desc']);
			mysqli_query($dbc, "UPDATE ticket SET timestamp='{$_POST['date']}', categoryID='{$_POST['category']}', priorityID='{$_POST['priority']}', statusID='{$_POST['status']}', issueDesc='$desc' WHERE ticketID='{$_POST['id']}' LIMIT 1");
			
			// Refresh page after recieving edit form post to update page table
			header("Location: alltickets.php");

	?>
		<script type="text/javascript">
			//alert("Your ticket has been submitted.");
			//location.reload(true);
		</script>
		<?php 
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Tickets</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
</head>

<?php 
		session_start();

		include("dashboard.php");
		require("incl/sqlConnect.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}
?>

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
		echo "<td><a class=\"?delete=1&id=" . $rows['0'] . "\" href=\"#\"><img src=\"images/delete.png\"></a><a data-reveal-id=\"editTicket\" class=\"?edit=1&id=" . $rows['0'] . "\" href=\"#\"><img src=\"images/edit.png\"></a></td>";
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
<div id="editTicket" class="reveal-modal" data-reveal>

</div>

<<<<<<< HEAD
=======



>>>>>>> fac09b309870ef277b93c00e97a78d378b5bf3e7
</div>
</div>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script> $(document).foundation(); </script>
</body>
</html>
