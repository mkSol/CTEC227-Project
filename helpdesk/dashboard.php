<?php
	function user_dashboard() {
		?>
			<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="#">Greenwell Bank</a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
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
      			<h1><a href="#">Greenwell Bank</a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="allTickets" href="#">View Ticket Pool</a></li>
			<li><a class="assignedTickets" href="#">View Assigned Tickets</a></li>
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
      			<h1><a href="#">Greenwell Bank</a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul>
			<li><a class="myTickets" href="#">View My Tickets</a></li>
			<li><a class="newTicket" href="#">Create New Ticket</a></li>
			<li><a class="myEquip" href="#">View My Equipment</a></li>
			<li><a class="viewAllTickets" href="#">View Ticket Pool</a></li>
			<li><a class="viewAllEquip" href="#">View All Equipment</a></li>
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
      			<h1><a href="#">Greenwell Bank</a></h1>
    			</li>
     
    			<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
  			</ul>

  			<section class="top-bar-section">
			<ul class="right">
				<li><a class="myTickets" href="#">View My Tickets</a></li>
				<li><a class="newTicket" href="#">Create New Ticket</a></li>
				<li><a class="myEquip" href="#">View My Equipment</a></li>
				<li><a class="allTickets" href="#">View Ticket Pool</a></li>
				<li><a class="assignedTickets" href="#">View Assigned Tickets</a></li>
				<li><a class="allEquip" href="#">View All Equipment</a></li>
				<li><a class="errorLogs" href="#">View Error Logs</a></li>
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