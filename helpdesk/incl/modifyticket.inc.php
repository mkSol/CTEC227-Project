<?php 
	if (isset($_GET['delete'])) {
		echo "<h1>Deleting ticket ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");
		mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		echo "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1";
	}

	if (isset($_GET['edit'])) {
		echo "<h1>Editing ticket ID: {$_GET['id']}</h1>";
	}	

?>