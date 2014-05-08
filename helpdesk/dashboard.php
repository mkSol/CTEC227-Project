<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Logout</title>
</head>
<body>
	<div id="dashboard">
	<?php
	function user_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="createTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}

	function helpdesk_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="createTicket" href="#">Create New Ticket</a></li>
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
			<li><a class="createTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="allTickets" href="#">View Ticket Pool</a></li>
			<li><a class="allEquip" href="#">View All Equipment</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}

	function admin_dashboard() {
		?>
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="createTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="allTickets" href="#">View Ticket Pool</a></li>
			<li><a class="allEquip" href="#">View All Equipment</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		<?php
	}
		//session_start(); //This session is already started on home.php since this file is included
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
	?>
	</div>
</body>
</html>