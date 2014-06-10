<?php
	// Open SQL DB connection
	require("incl/sqlConnect.inc.php");

	function user_nav($newMsgs) {
		?>
			<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="home.php">Greenwell Bank</a></h1>
    			</li>
     
    			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  			</ul>

  		<section class="top-bar-section">
		<ul class="right">
			<ul class="right">
				<li class="newTicketLink"><a data-reveal-id="newTicket" href="#">New Ticket</a></li>

				<li class="has-dropdown">
					<a href="#">View</a>
						<ul class="dropdown">
							<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
							<li><a class="myEquip" href="myequip.php">My Equipment</a></li>						
						</ul>
				</li>

				<li class="newMessage"><a data-reveal-id="newMessage" href="#">Compose</a></li>

				<li class="has-dropdown">
					<?php 
					if ($newMsgs) {
						echo '<a href="messaging.php?box=in">Mailbox (' . $newMsgs . ')</a>'; 
						//echo $newMsgs;
					} else {
						echo '<a href="messaging.php?box=in">Mailbox</a>'; 
					}
					?>
						<ul class="dropdown">
							<li><a class="inbox" href="messaging.php?box=in">Inbox</a></li>
							<li><a class="outbox" href="messaging.php?box=out">Outbox</a></li>
						</ul>
				</li>

				<li><a href="home.php">Home</a></li>

				<li><a href="logout.php">Log Out</a></li>
			</ul>	
		</ul>
		</section>
		</nav>
		<?php
	}

	function helpdesk_nav($newMsgs) {
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
			<li class="newTicketLink"><a data-reveal-id="newTicket" href="#">New Ticket</a></li>

			<li class="has-dropdown">
				<a href="#">View</a>
					<ul class="dropdown">
						<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
						<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
						<li><a class="allTickets" href="alltickets.php">Ticket Pool</a></li>
						<li><a class="assignedTickets" href="assignedtickets.php">Assigned Tickets</a></li>						
					</ul>
			</li>

			<li class="newMessage"><a data-reveal-id="newMessage" href="#">Compose</a></li>

				<li class="has-dropdown">
					<?php 
					if ($newMsgs) {
						echo '<a href="messaging.php?box=in">Mailbox (' . $newMsgs . ')</a>'; 
						//echo $newMsgs;
					} else {
						echo '<a href="messaging.php?box=in">Mailbox</a>'; 
					}
					?>
						<ul class="dropdown">
							<li><a class="inbox" href="messaging.php?box=in">Inbox</a></li>
							<li><a class="outbox" href="messaging.php?box=out">Outbox</a></li>
						</ul>
				</li>

			<li><a href="home.php">Home</a></li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function manager_nav($newMsgs) {
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
			<li class="newTicketLink"><a data-reveal-id="newTicket" href="#">New Ticket</a></li>

			<li class="has-dropdown">
				<a href="#">View</a>
				<ul class="dropdown">
					<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
					<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
					<li><a class="allTickets" href="alltickets.php">Ticket Pool</a></li>
					<li><a class="allEquip" href="allequip.php">All Equipment</a></li>
				</ul>
			</li>

			<li class="newMessage"><a data-reveal-id="newMessage" href="#">Compose</a></li>

				<li class="has-dropdown">
					<?php 
					if ($newMsgs) {
						echo '<a href="messaging.php?box=in">Mailbox (' . $newMsgs . ')</a>'; 
						//echo $newMsgs;
					} else {
						echo '<a href="messaging.php?box=in">Mailbox</a>'; 
					}
					?>
						<ul class="dropdown">
							<li><a class="inbox" href="messaging.php?box=in">Inbox</a></li>
							<li><a class="outbox" href="messaging.php?box=out">Outbox</a></li>
						</ul>
				</li>

			<li><a href="home.php">Home</a></li>

			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</section>
		</nav>
		<?php
	}

	function admin_nav($newMsgs) {
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
				<li class="newTicketLink"><a data-reveal-id="newTicket" href="#">New Ticket</a></li>
				
				<li class="has-dropdown">
					<a href="#">View</a>
						<ul class="dropdown">
							<li><a class="myTickets" href="mytickets.php">My Tickets</a></li>
							<li><a class="myEquip" href="myequip.php">My Equipment</a></li>
							<li><a class="allTickets" href="alltickets.php">Ticket Pool</a></li>
							<li><a class="assignedTickets" href="assignedtickets.php">Assigned Tickets</a></li>
							<li><a class="allEquip" href="allequip.php">All Equipment</a></li>
							<li><a class="alltables" href="alltables.php">All Tables</a></li>
							<li><a class="errorLogs" href="errorlogs.php">Error Logs</a></li>	
						</ul>
				</li>

				<li class="newMessage"><a data-reveal-id="newMessage" href="#">Compose</a></li>

				<li class="has-dropdown">
					<?php 
					if ($newMsgs) {
						echo '<a href="messaging.php?box=in">Mailbox (' . $newMsgs . ')</a>'; 
						//echo $newMsgs;
					} else {
						echo '<a href="messaging.php?box=in">Mailbox</a>'; 
					}
					?>
						<ul class="dropdown">
							<li><a class="inbox" href="messaging.php?box=in">Inbox</a></li>
							<li><a class="outbox" href="messaging.php?box=out">Outbox</a></li>
						</ul>
				</li>

				<li><a href="home.php">Home</a></li>

				<li><a href="logout.php">Log Out</a></li>
			</ul>
			</section>
		</nav>	
		<?php
	}
		
	if($_SERVER['REQUEST_METHOD'] == 'POST') {	
		if (isset($_POST['submitType'])) {
			switch ($_POST['submitType']) {
				case 'newMessage':
					$msgResult = mysqli_query($dbc, "SELECT userID FROM user WHERE username = '" . $_POST['msgTo'] . "'");
					//echo "SELECT userID FROM user WHERE username = " . $_POST['msgTo'];
					$rows = mysqli_fetch_array($msgResult);

					// Set variables
					$msgFrom = $_SESSION['userID'];
					// Sanitize message body and subject and escape special chars for mySQL query
					$msgTo = mysqli_real_escape_string($dbc, $rows[0]);
					$subject = mysqli_real_escape_string($dbc, $_POST['subject']);
					$body = mysqli_real_escape_string($dbc, $_POST['body']);
					$result = mysqli_query($dbc, "INSERT INTO message (msgSubject, msgTo, msgFrom, msgBody, timestamp) VALUES ('$subject', '$msgTo', '$msgFrom', '$body', NOW())") or die(mysqli_error($dbc));
					//echo "INSERT INTO message (msgSubject, msgTo, msgFrom, msgBody, timestamp, read) VALUES ('$subject', '$msgTo', '$msgFrom', '$body', NOW(), '0')";
					break;

				case 'newTicket':
					// Set variables
					$userID = $_SESSION['userID'];
					$categoryID = $_POST['category'];
					$priorityID = $_POST['priority'];
					// Sanitize ticket description and escape special chars for mySQL query
					$issueDesc = mysqli_real_escape_string($dbc, $_POST['desc']);
					$result = mysqli_query($dbc, "INSERT INTO ticket (userID,statusID,categoryID,priorityID,timestamp,issueDesc) VALUES ('$userID','1','$categoryID','$priorityID',NOW(),'$issueDesc')");
					break;
				
				default:
					break;
			}
		}
		
	}

	// Get new message count
	$userID = $_SESSION['userID'];
	$msgResult = mysqli_query($dbc, "SELECT * FROM message WHERE msgRead='0' AND msgTo='$userID'");
	$newMsgs = mysqli_num_rows($msgResult);
	//echo "SELECT * FROM message WHERE msgRead='0' AND msgTo='$userID'";

	// ============================ Page Content Start ===============================

	// Open navigation div
	echo "<div id='header'>";
	echo "<a href='home.php'><img src='images/greenwell_logo_flat.png' height='244'></a>";
	echo "</div>";
	echo "<div id=\"nav\">";

	switch ($_SESSION['privLevel']) {
			case '1':
				user_nav($newMsgs);
				break;
			case '2':
				helpdesk_nav($newMsgs);
				break;
			case '3':
				manager_nav($newMsgs);
				break;
			case '4':
				admin_nav($newMsgs);
				break;
		}
	echo "</div>" // Close navigation div
?>
	<!-- Modal div for creating new tickets -->
	<div id="newTicket" class="reveal-modal" data-reveal></div>
	<div id="newMessage" class="reveal-modal" data-reveal></div>