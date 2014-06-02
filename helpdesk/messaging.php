<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Messaging</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 
		session_start();

		include("navigation.php");
		require("incl/sqlConnect.inc.php");
		include("paginatedtable.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}

		/* 
			===Messaging system===

		Inbox / Outbox / Compose / View Msg

		DB Fields: msgID, fromUser, toUser, read, deletedRcv, deletedSnd

		*/
?>

<div class="row">
<div class="large-12 columns" id="msging">
<?php 
	$username = $_SESSION['username'];
	//$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID WHERE user.username='$username'");
	$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	//$sql = "SELECT * FROM message";
	//output_table($sql,"User_Table");

?>
</div>
</div>
</body>
</html>
