<?php 
	session_start();

	function ticket_details() {
		global $dbc;
		// MySQL query to populate basic ticket details
		$result = mysqli_query($dbc, "SELECT ticketID,user.userID,user.firstName,user.lastName,user.username,user.department,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.ticketID = '{$_GET['viewid']}'");
		$rows = mysqli_num_rows($result);

		// Print out small table with ticket details
		echo "<table id=\"viewticket_table\">";
		echo "<thead>";
		echo "<tr>";
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
			echo "<td>" . $rows['ticketID'] . "</td>";
			echo "<td>" . $rows['firstName'] . "</td>";
			echo "<td>" . $rows['lastName'] . "</td>";
			echo "<td>" . $rows['username'] . "</td>";
			echo "<td>" . date("m/d/y g:i A", strtotime($rows['timestamp'])) . "</td>";
			echo "<td>" . $rows['category'] . "</td>";
			echo "<td>" . $rows['priority'] . "</td>";
			echo "<td>" . $rows['status'] . "</td>";
			echo "<td>" . $rows['issueDesc'] . "</td>";
			echo "</tr>";

		}
		echo "<tbody>";
		echo "</table>";
	}

	function ticket_equip($userID,$username,$department) {
		global $dbc;
		// MySQL query to list equipment associated with ticket owner
		$result = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, user.username, user.firstName, user.lastName, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN user ON userEquip.userID=user.userID JOIN department ON user.department=department.deptID AND userEquip.userID=user.userID AND userEquip.equipID=equipment.equipID WHERE user.userID='$userID'");
		$rows = mysqli_num_rows($result);

		// MySQL query to list equipment associated with ticket owner's department
		$result2 = mysqli_query($dbc, "SELECT equipment.equipID, equipment.equipDesc, equipType.equipType, userEquip.userID, userEquip.linkID, department.deptID, department.department FROM equipment JOIN equipType ON equipment.equipType=equipType.equipTypeID JOIN userEquip ON userEquip.equipID=userEquip.equipID JOIN department ON userEquip.deptID=department.deptID AND userEquip.equipID=equipment.equipID WHERE department.deptID='$department'");
		$rows2 = mysqli_num_rows($result2);

		if ($rows || $rows2) { // if either user equip or dept equip exists...
			if ($rows) { // If equipment exists...
				echo "<p>Equipment Associated with $username:</p>";
				// Print out equipment in a table
				echo "<table id=\"ticketequip_table\">";
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
			}
			if ($rows2) { // If dept equipment exists...
				echo "<p>Department Owned Equipment:</p>";

				echo "<table id=\"ticketdeptequip_table\">";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Equip ID</th>";
				echo "<th>Type</th>";
				echo "<th>Description</th>";
				echo "<th>Department</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				while ($rows2=mysqli_fetch_array($result2)) {
					echo "<tr>";
					echo "<td>" . $rows2['equipID'] . "</td>";
					echo "<td>" . $rows2['equipType'] . "</td>";
					echo "<td>" . $rows2['equipDesc'] . "</td>";
					echo "<td>" . $rows2['department'] . "</td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			} 
		} else { // If no equipment...
			echo "<p>No equipment associated with $username.</p>";
		}
	}

	function ticket_comments() {
		global $dbc;
		// MySQL query to list comments associated with ticket
		$result = mysqli_query($dbc, "SELECT ticketComment.timestamp, ticketComment.comment, user.username FROM ticketComment JOIN user ON ticketComment.userID=user.userID WHERE ticketComment.ticketID = '{$_GET['viewid']}'");
		$rows = mysqli_num_rows($result);

		if ($rows) { // If comments exist...
			// Print out comments in a table
			echo "<table id=\"ticket_comment_table\">";
			echo "<thead>";
			echo "<tr>";
			echo "<th>User</th>";
			echo "<th>Date</th>";
			echo "<th>Comment</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while ($rows=mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $rows['username'] . "</td>";
				echo "<td>" . $rows['timestamp'] . "</td>";
				echo "<td>" . $rows['comment'] . "</td>";
				echo "</tr>";
			}
			echo "<tbody>";
			echo "</table>";
		} else { // If no comments...
			// Placeholder, not sure if this will be used
		}
	}

	// =================================== Page Start ===========================================

	if (isset($_GET['viewid'])) {
		echo "<h1>View Details for Ticket ID: {$_GET['viewid']}</h1>";
		require("sqlConnect.inc.php"); // Connect to SQL DB

		// Page to submit form to
		$submitTo = $_SESSION['ticketpage']

		 ?>
		<!-- Open form on modal to apply formatting to tables below -->
		<form action="<?php echo $_SESSION['ticketpage']; ?>.php" method="post">
			<div class="row">
				<?php

				// Get some variables
				$result = mysqli_fetch_array(mysqli_query($dbc, "SELECT ticketID,user.userID,user.firstName,user.lastName,user.username,user.department,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.ticketID = '{$_GET['viewid']}'"));
				$userID = $result['userID'];
				$username = $result['username'];
				$department = $result['department'];
				
				// Print out details to page
				ticket_details();
				ticket_equip($userID,$username,$department);
				ticket_comments();
				?>

			<!-- Print out form to submit new ticket comments -->
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="ticketID" value="<?php echo $_GET['viewid']; ?>">
					<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
					<input type="hidden" name="submitType" value="comment">

					<label for="desc">Add a Comment</label>
				<textarea name="comment" id="comment" rows="5" cols="100"></textarea>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
				<br>
				<input class="button" type="submit" value="Submit Comment">
				</div>
			</div>
		</form>

		<a class="close-reveal-modal">&#215;</a>
	<?php	} // Close function	?>