<?php 
	if (isset($_GET['viewid'])) {
		echo "<h1>View Details for Ticket ID: {$_GET['viewid']}</h1>";
		require("sqlConnect.inc.php");

		$result = mysqli_query($dbc, "SELECT * FROM ticket WHERE ticketID='{$_GET['viewid']}' LIMIT 1");
		$rows = mysqli_fetch_array($result);


		 ?>

		<form action="alltickets.php" method="post">
			<div class="row">
				<?php

				$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE ticket.ticketID = '{$_GET['viewid']}'");
				$rows = mysqli_num_rows($result);

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
					echo "<td>" . $rows['timestamp'] . "</td>";
					echo "<td>" . $rows['category'] . "</td>";
					echo "<td>" . $rows['priority'] . "</td>";
					echo "<td>" . $rows['status'] . "</td>";
					echo "<td>" . $rows['issueDesc'] . "</td>";
					echo "</tr>";
				}
				echo "<tbody>";
				echo "</table>";

				// ----- Start ticket comments -----

				$result = mysqli_query($dbc, "SELECT ticketComment.timestamp, ticketComment.comment, user.username FROM ticketComment JOIN user ON ticketComment.userID=user.userID WHERE ticketComment.ticketID = '{$_GET['viewid']}'");
				$rows = mysqli_num_rows($result);

				if ($rows) { // If comments exist...
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
				

				?>

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


	<?php	
		echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>