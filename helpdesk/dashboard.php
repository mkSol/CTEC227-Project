<?php

	function display_newest_tickets() {

		require("incl/sqlConnect.inc.php");
		$username = $_SESSION['username'];
		$result = mysqli_query($dbc, "SELECT ticketID,user.firstName,user.lastName,user.username,timestamp,issueDesc,category.category,status.status,priority.priority FROM ticket JOIN category ON ticket.categoryID=category.categoryID JOIN status ON ticket.statusID=status.statusID JOIN priority ON ticket.priorityID = priority.priorityID JOIN user ON ticket.userID = user.userID WHERE user.username = '$username' ORDER BY timestamp DESC LIMIT 5 ");
		//$rows = mysqli_num_rows($result);

		echo "<h2>Latest Tickets</h2>\n";
		echo "<div class='panel callout radius'>";
		echo "<dl class=\"accordion\" data-accordion=\"newest-tickets\">";

			while ($rows=mysqli_fetch_array($result)) {

				echo "<dd>\n";
				echo "<a href='#panel-{$rows['ticketID']}'>Date: " . $rows['timestamp'] ." Category: " . $rows['category'] . " Priority: " . $rows['priority'] ." Status: " . $rows['status'] ."</a>\n";
				echo "<div id='panel-{$rows['ticketID']}' class='content'>\n";
				//echo "<h5>Description:</h5>\n";
				echo "<p>" . $rows['issueDesc'] . "</p>\n";
				echo "</div>\n";
				echo "</dd>\n"; 
			}
		echo "</dl>";
		echo "</div>";	
	}



	function user_dashboard() {	

		?>
		<div class="row">
			<div class="large-12 columns">
				<?php echo "<h1>{$_SESSION['firstName']} {$_SESSION['lastName']}'s Dashboard</h1>"; ?>
			</div>
		</div>
		
		<div class="row">
			<div class="large-4 columns">
				
			</div>

			<div class="large-8 columns">
				<?php display_newest_tickets(); ?>
			</div>
		</div>
<?php

	}

	//=================================Page content start=================================


	//open dashboard div
	echo "<div id=\"dashboard\">";

	switch ($_SESSION['privLevel']) {
			case '1':
				user_dashboard();
				break;
			case '2':
				header("Location: assignedtickets.php");
				echo "<p>No Help Desk Dashboard Yet!";
				//helpdesk_dashboard();
				break;
			case '3':
				header("Location: allequip.php");
				echo "<p>No Manager Dashboard Yet!";
				//manager_dashboard();
				break;
			case '4':
				header("Location: alltables.php");
				echo "<p>No Admin Dashboard Yet!";
				//admin_dashboard();
				?>
				<dl class="accordion" data-accordion="software1">
					<dd>
						<a href="#softwareFor<?php echo "1" ?>">Software</a>
						<div id="softwareFor<?php echo "1" ?>" class="content">
							Test
						</div>
					</dd>
				</dl>
				<?php
				break;
	}

	echo "</div>"; //close dashboard div

?>



