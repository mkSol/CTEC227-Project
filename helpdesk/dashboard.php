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
				echo "<p>No Help Desk Dashboard Yet!";
				//helpdesk_dashboard();
				break;
			case '3':
				echo "<p>No Manager Dashboard Yet!";
				//manager_dashboard();
				break;
			case '4':
				echo "<p>No Admin Dashboard Yet!";
				//admin_dashboard();

				// Testing timestamp conversions, ignore
				$mdate = date('Y-m-d H:i:s',strtotime('Tue, 06 Dec 2011 16:47:11 +0000'));
				$sdate = date("F jS\, Y h:i:s A", strtotime($mdate));
				echo "<p>" . $mdate . "</p>";
				echo "<p>" . $sdate . "</p>";
				break;
	}

	echo "</div>"; //close dashboard div

?>



