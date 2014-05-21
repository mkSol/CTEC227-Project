<?php
	function user_dashboard() {
		?>
			<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="#">Greenwell Bank - <?php echo "Welcome {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
    			</li>
     
    			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li class="has-dropdown">
				<a href="#">Create</a>
					<ul class="dropdown">
						<li><a class="newTicket" href="#">Create New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
					<ul class="dropdown">
						<li><a class="myTickets" href="#">My Tickets</a></li>
						<li><a class="myEquip" href="#">My Equipment</a></li>						
					</ul>
			</li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function helpdesk_dashboard() {
		?>
		<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="#">Greenwell Bank - <?php echo "Welcome {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li class="has-dropdown">
				<a href="#">Create</a>
					<ul class="dropdown">
						<li><a class="newTicket" href="#">New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
					<ul class="dropdown">
						<li><a class="myTickets" href="#">My Tickets</a></li>
						<li><a class="myEquip" href="#">My Equipment</a></li>
						<li><a class="allTickets" href="#">Ticket Pool</a></li>
						<li><a class="assignedTickets" href="#">Assigned Tickets</a></li>						
					</ul>
			</li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function manager_dashboard() {
		?>
		<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="#">Greenwell Bank - <?php echo "Welcome {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li class="has-dropdown">
				<a href="#">Create</a>
					<ul class="dropdown">
						<li><a class="newTicket" href="#">New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
				<ul class="dropdown">
					<li><a class="myTickets" href="#">My Tickets</a></li>
					<li><a class="myEquip" href="#">My Equipment</a></li>
					<li><a class="viewAllTickets" href="#">Ticket Pool</a></li>
					<li><a class="viewAllEquip" href="#">All Equipment</a></li>
				</ul>
			</li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function admin_dashboard() {
		?>
		<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="#">Greenwell Bank - <?php echo "Welcome {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  			<section class="top-bar-section">
			<ul class="right">
				<li class="has-dropdown">
					<a href="#">Create</a>
						<ul class="dropdown">
							<li><a class="newTicket" href="#">New Ticket</a></li>
						</ul>
				</li>

				<li class="has-dropdown">
					<a href="#">View</a>
						<ul class="dropdown">
							<li><a class="myTickets" href="#">My Tickets</a></li>
							<li><a class="myEquip" href="#">My Equipment</a></li>
							<li><a class="allTickets" href="#">Ticket Pool</a></li>
							<li><a class="assignedTickets" href="#">Assigned Tickets</a></li>
							<li><a class="allEquip" href="#">All Equipment</a></li>
							<li><a class="errorLogs" href="#">Error Logs</a></li>	
						</ul>
				</li>

				<li><a href="logout.php">Log Out</a></li>
			</ul>
			</section>
		</nav>	
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