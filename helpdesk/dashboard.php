<?php
	function user_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}

	function helpdesk_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="allTickets" href="#">View Ticket Pool</a></li>
			<li><a class="assignedTickets" href="#">View Assigned Tickets</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}

	function manager_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="viewAllTickets" href="#">View Ticket Pool</a></li>
			<li><a class="viewAllEquip" href="#">View All Equipment</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}

	function admin_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#newTicket">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="allTickets" href="#">View Ticket Pool</a></li>
			<li><a class="assignedTickets" href="#">View Assigned Tickets</a></li>
			<li><a class="allEquip" href="#">View All Equipment</a></li>
			<li><a class="errorLogs" href="#">View Error Logs</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}
		
	// ============================ Page Content Start ===============================

	// Open dasboard div
	echo "<div id=\"dashboard\">";

	switch ($_SESSION['privLevel']) {
			case '1':
				user_dashboard();
				break;
			case '2':
				helpdesk_dashboard();
				break;
			case '3':
				manager_dashboard();
				break;
			case '4':
				admin_dashboard();
				break;
		}
	echo "</div>" // Close dashboard div
?>