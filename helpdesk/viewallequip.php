<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Equipment</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/pagetrans.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
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
<div class="large-12 columns" id="viewAllEquip">
<?php 
	$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID");
	$rows = mysqli_num_rows($result);

	// ============================ Page Content Start ===============================

	echo "<h2>View All Equipment (Read Only)</h2>";

	echo "<table id=\"viewallequip_table\">";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Equip ID</th>";
	echo "<th>Type</th>";
	echo "<th>Description</th>";
	echo "<th>User ID</th>";
	echo "<th>Username</th>";
	echo "<th>First</th>";
	echo "<th>Last</th>";
	echo "<th>Department</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($rows=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $rows['equipID'] . "</td>";
		echo "<td>" . $rows['equipType'] . "</td>";
		echo "<td>" . $rows['equipDesc'] . "</td>";
		echo "<td>" . $rows['userID'] . "</td>";
		echo "<td>" . $rows['username'] . "</td>";
		echo "<td>" . $rows['firstName'] . "</td>";
		echo "<td>" . $rows['lastName'] . "</td>";
		echo "<td>" . $rows['department'] . "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
?>
</div>
</div>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script> $(document).foundation(); </script>
</body>
</html>

