<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Equipment</title>
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

		// Set session var for view ticket form direct
		$_SESSION['equippage'] = "myequip";
?>

<div class="row">
<div class="large-12 columns" id="myEquip">
<?php 
	include("incl/paginatedtable.inc.php");

	// Get username
	$username = $_SESSION['username'];
	$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type', userEquip.userID AS ' User ID', user.username AS 'Username', user.firstName AS 'First', user.lastName AS 'Last', department.department AS 'Department' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'";
	// Output ticket table named MyTickets depending on pirvilege level, view=true, edit=fale, delete=false
	switch ($_SESSION['privLevel']) {
			case '1':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '2':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '3':
				output_table($sql,"MyEquip",0,0,0);
				break;
			case '4':
				output_table($sql,"MyEquip",0,1,0);
				break;
	}

	
?>
</div>
</div>
</body>
</html>
