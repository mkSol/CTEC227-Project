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
	<title>All Equip</title>
	<?php 
		require("incl/scripts.inc.html"); // CSS, Javascript, etc
		
	?>	
</head>

<?php 

	function table_user_assigned_equip() {
		global $dbc;
		$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type', userEquip.userID AS 'User ID', user.username AS 'Username', user.firstName AS 'First', user.lastName AS 'Last', department.department AS 'Department', userEquip.linkID AS 'Link ID' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID";
		// Output ticket table named AssignedTickets depending on pirvilege level, view=true, edit=fale, delete=false
		echo '<div class="row">';
		echo '<div class="large-12 columns" id="userEquip">';

		echo "<p>Equipment Assigned to Employees:</p>";
		switch ($_SESSION['privLevel']) {
				case '1':
					break;
				case '2':
					output_table($sql,"UserEquip",0,1,0);
					break;
				case '3':
					output_table($sql,"UserEquip",0,0,0);
					break;
				case '4':
					output_table($sql,"UserEquip",0,1,0);
					break;
		}
		echo "</div>";
		echo "</div>";
		
	}

	function table_dept_assigned_equip() {
		global $dbc;
		$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type', department.department AS 'Department', userEquip.linkID AS 'Link ID' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID";
		// Output ticket table named AssignedTickets depending on pirvilege level, view=true, edit=fale, delete=false
		echo '<div class="row">';
		echo '<div class="large-12 columns" id="deptEquip">';

		echo "<p>Equipment Assigned to Departments:</p>";
		switch ($_SESSION['privLevel']) {
				case '1':
					break;
				case '2':
					output_table($sql,"DeptEquip",0,1,0);
					break;
				case '3':
					output_table($sql,"DeptEquip",0,0,0);
					break;
				case '4':
					output_table($sql,"DeptEquip",0,1,0);
					break;
		}
		echo "</div>";
		echo "</div>";
		
	}

	function table_unassigned_equip() {
		global $dbc;
		$sql = "SELECT equipment.equipID AS 'Equipment ID', equipment.equipSerial AS 'Serial', equipment.equipDesc AS 'Description', equipType.equipType AS 'Type' FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID WHERE NOT EXISTS (SELECT userEquip.equipID FROM userEquip WHERE equipment.equipID=userEquip.equipID)";
		// Output ticket table named AssignedTickets depending on pirvilege level, view=true, edit=fale, delete=false
		echo '<div class="row">';
		echo '<div class="large-12 columns" id="unassignedEquip">';

		echo "<p>Unassigned Equipment:</p>";
		switch ($_SESSION['privLevel']) {
				case '1':
					break;
				case '2':
					output_table($sql,"equipment",0,1,0);
					break;
				case '3':
					output_table($sql,"equipment",0,0,0);
					break;
				case '4':
					output_table($sql,"equipment",0,1,1);
					break;
		}
		echo "</div>";
		echo "</div>";
		
	}

	//=================================All Equip Page content start=================================

	include("navigation.php"); // Load nav bar	
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

	echo '<div class="row">';
	echo '<div class="large-12 columns" id="allEquip">';

	echo "<h2>All Equipment</h2>";

	?>
		<a href="?tbl=UserEquip" class="success button">Equipment Assigned to Users</a>
		<a href="?tbl=DeptEquip" class="success button">Equipment Assigned to Departments</a>
		<a href="?tbl=UnassignedEquip" class="success button">Unassigned Equipment</a>
	<?php

	// Check GET param to choose which table to display
	if (isset($_GET['tbl'])) {
		switch ($_GET['tbl']) {
			case 'UserEquip':
				table_user_assigned_equip();
				break;

			case 'DeptEquip':
				table_dept_assigned_equip();
				break;

			case 'UnassignedEquip':
				table_unassigned_equip();
				break;
			
			default:
				# code...
				break;
		}
	} else { // Load UserEquip by default on clean page load
		table_user_assigned_equip();
	}
	//table_dept_assigned_equip();
	//table_unassigned_equip();

	/*
	
	// MySQL Notes:

	###Query for equipment assigned to users:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType, 
		userEquip.userID, 
		userEquip.linkID, 
		user.username, 
		user.firstName, 
		user.lastName, 
		department.department 
	FROM equipment 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	JOIN userEquip ON userEquip.equipID=userEquip.equipID 
	JOIN user ON userEquip.userID=user.userID 
	JOIN department ON user.department=department.deptID 
	AND userEquip.userID=user.userID 
	AND userEquip.equipID=equipment.equipID

	###Query for equipment assigned to departments:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType, 
		userEquip.userID, 
		userEquip.linkID, 
		department.deptID, 
		department.department
	FROM equipment 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	JOIN userEquip ON userEquip.equipID=userEquip.equipID 
	JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID

	###Query for equipment that is unassigned:

	SELECT 
		equipment.equipID, 
		equipment.equipDesc, 
		equipType.equipType 
	FROM equipment 
	WHERE NOT EXISTS
	(SELECT
		userEquip.equipID
	FROM userEquip 
	JOIN equipType ON equipment.equipType=equipType.equipTypeID 
	WHERE
		equipment.equipID=userEquip.equipID
	)

	*/
?>

</div>
</div>
<div id="editEquip" class="reveal-modal" data-reveal></div>
</body>
</html>
