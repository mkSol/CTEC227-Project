<?php
	function user_nav() {
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
						<li><a class="newTicket" href="newticket.php">Create New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
					<ul class="dropdown">
						<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
						<li><a class="myEquip" href="myequip.php">My Equipment</a></li>						
					</ul>
			</li>

			<li><a href="home.php">Home</a></li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function helpdesk_nav() {
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
						<li><a class="newTicket" href="newticket.php">New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
					<ul class="dropdown">
						<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
						<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
						<li><a class="allTickets" href="alltickets.php">Ticket Pool</a></li>
						<li><a class="assignedTickets" href="assignedtickets.php">Assigned Tickets</a></li>						
					</ul>
			</li>

			<li><a href="home.php">Home</a></li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function manager_nav() {
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
						<li><a class="newTicket" href="newticket.php">New Ticket</a></li>
					</ul>
			</li>

			<li class="has-dropdown">
				<a href="#">View</a>
				<ul class="dropdown">
					<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
					<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
					<li><a class="viewAllTickets" href="viewalltickets.php">Ticket Pool</a></li>
					<li><a class="viewAllEquip" href="viewallequip.php">All Equipment</a></li>
				</ul>
			</li>

			<li><a href="home.php">Home</a></li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function admin_nav() {
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
							<li><a class="newTicket" href="newticket.php">New Ticket</a></li>
						</ul>
				</li>

				<li class="has-dropdown">
					<a href="#">View</a>
						<ul class="dropdown">
							<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
							<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
							<li><a class="allTickets" href="alltickets.php">Ticket Pool</a></li>
							<li><a class="assignedTickets" href="assignedtickets.php">Assigned Tickets</a></li>
							<li><a class="allEquip" href="allequip.php">All Equipment</a></li>
							<li><a class="errorLogs" href="errorlogs.php">Error Logs</a></li>	
						</ul>
				</li>

				<li><a href="home.php">Home</a></li>

				<li><a href="logout.php">Log Out</a></li>
			</ul>
			</section>
		</nav>	
		<?php
	}
		
	// ============================ Page Content Start ===============================

	// Open dasboard div
	echo "<div id=\"nav\">";

	switch ($_SESSION['privLevel']) {
			case '1':
				user_nav();
				break;
			case '2':
				helpdesk_nav();
				break;
			case '3':
				manager_nav();
				break;
			case '4':
				admin_nav();
				break;
		}
	echo "</div>" // Close dashboard div
?>