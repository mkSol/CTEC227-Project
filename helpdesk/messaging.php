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
	
	/* 
		===Messaging system===

	Inbox / Outbox / Compose / View Msg

	DB Fields: msgID, fromUser, toUser, read, deletedRcv, deletedSnd

	*/

	function inbox() {
		global $dbc;
		echo "<h1>Inbox</h1>";
		$userID = $_SESSION['userID'];
		$result = mysqli_query($dbc, "SELECT msgSubject, msgBody, timestamp, user.username FROM message JOIN user ON message.msgFrom=user.userID WHERE msgTo='$userID'");
		$rows = mysqli_num_rows($result);
		while ($rows = mysqli_fetch_array($result)) {
			echo "<p>FROM: " . $rows['username'] . "</p>";
			echo "<p>SUBJECT: " . $rows['msgSubject'] . "</p>";
			echo "<p>TIMESTAMP: " . $rows['timestamp'] . "</p>";
			echo "<p>BODY: " . $rows['msgBody'] . "</p>";
		}
	}

	function outbox() {
		global $dbc;
		echo "<h1>Outbox</h1>";
		$userID = $_SESSION['userID'];
		$result = mysqli_query($dbc, "SELECT msgSubject, msgBody, timestamp, user.username FROM message JOIN user ON message.msgTo=user.userID WHERE msgFrom='$userID'");
		$rows = mysqli_num_rows($result);
		while ($rows = mysqli_fetch_array($result)) {
			echo "<p>TO: " . $rows['username'] . "</p>";
			echo "<p>SUBJECT: " . $rows['msgSubject'] . "</p>";
			echo "<p>TIMESTAMP: " . $rows['timestamp'] . "</p>";
			echo "<p>BODY: " . $rows['msgBody'] . "</p>";
			echo "<br>";
		}
	}

	session_start();

	include("navigation.php");
	require("incl/sqlConnect.inc.php");
	include("incl/paginatedtable.inc.php");

	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
		header("Location: login.php");
	}

	if (isset($_GET['box']) && $_GET['box'] == "in") {
		inbox();
	} elseif (isset($_GET['box']) && $_GET['box'] == "out") {
		outbox();
	}


	
	//$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.username='$username'");
	//$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	//$sql = "SELECT * FROM message";
	//output_table($sql,"User_Table");

?>
</div>
</div>
</body>
</html>
