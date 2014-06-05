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
		session_start();

		include("navigation.php");
		require("incl/sqlConnect.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}
?>

<div class="row">
<div class="large-12 columns" id="errorLogs">
<?php 
	include("incl/paginatedtable.inc.php");

	$sql = "SELECT errorLog.errorID AS 'Error ID', errorLog.timestamp AS 'Timestamp', user.userID AS 'User ID', user.username AS 'Username', errorLog.errorDump AS 'Error Dump' FROM errorLog JOIN user ON errorLog.userID=user.userID";
	// Output ticket table named MyTickets, view=true, edit=fale, delete=false
	output_table($sql,"errorLog",0,0,1);

	
?>
</div>
</div>
</body>
</html>
