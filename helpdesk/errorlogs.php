<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error Logs</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 

	// ======================= All Tables Page Content Start ========================

	include("navigation.php"); // Load nav bar	
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

	echo '<div class="row">';
	echo '<div class="large-12 columns" id="errorLogs">';

	$sql = "SELECT errorLog.errorID AS 'Error ID', errorLog.timestamp AS 'Timestamp', user.userID AS 'User ID', user.username AS 'Username', errorLog.errorNo AS 'Error Number', errorLog.errorFile AS 'Error File', errorLog.errorLine AS 'Error Line', errorLog.errorStr AS 'Error Dump' FROM errorLog JOIN user ON errorLog.userID=user.userID";
	
	echo "<h2>Error Logs</h2>";

	// Output ticket table, view=true, edit=fale, delete=false
	output_table($sql,"errorLog",0,0,1);

	
?>
</div>
</div>
</body>
</html>
