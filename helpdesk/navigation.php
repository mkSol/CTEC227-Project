<?php
	// Open SQL DB connection
	require("incl/sqlConnect.inc.php");

	function user_nav($newMsgs) {
		?>
			<nav class="fixed top-bar" data-topbar>
  			<ul class="title-area">
    			<li class="name">
      			<h1><a href="home.php"><?php echo "Welcome, {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
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
      			<h1><a href="#"><?php echo "Welcome, {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
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
      			<h1><a href="#"><?php echo "Welcome, {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>
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

      			<h1><a href="#"><?php echo "Welcome, {$_SESSION['firstName']} {$_SESSION['lastName']}"; ?></a></h1>

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

				<li class="profile"><a data-reveal-id="profile" href="#">Profile</a></li>

				<li><a href="logout.php">Log Out</a></li>
			</ul>
			</section>
		</nav>	
		<?php
	}

	function profile_page() {
		// This function will display profile information to be used within a modal div
		global $dbc;
		$profileSQL = "SELECT userID, username, dateRegistered, datePassword, firstName, lastName, email, department.department FROM user JOIN department ON user.department=department.deptID WHERE userID='" .  $_SESSION['userID'] . "'";
		$profileResult = mysqli_query($dbc, $profileSQL);
		
		// Set vars for easier use
		while ($profileRow = mysqli_fetch_array($profileResult)) {
			$userID = $profileRow['userID'];
			$username = $profileRow['username'];
			$dateReg = 	$profileRow['dateRegistered'];
			$datePass = $profileRow['datePassword'];
			$first = $profileRow['firstName'];
			$last = $profileRow['lastName'];
			$dept = $profileRow['department'];
			$email = $profileRow['email'];
		}
		?>
		<h2>Profile Information</h2>
		<h4>Displaying for: <?php echo $username; ?></h4>
		<form action="#">
			<div class="row">
				<div class="large-6 columns">
					<label>User ID:</label>
					<input type="text" name="userID" readonly="readonly" value="<?php echo $userID; ?>">
				</div>
				<div class="large-6 columns">
					<label>Username:</label>
					<input type="text" name="username" readonly="readonly" value="<?php echo $username; ?>">
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>First Name:</label>
					<input type="text" name="first" readonly="readonly" value="<?php echo $first; ?>">
				</div>
				<div class="large-6 columns">
					<label>Last Name:</label>
					<input type="text" name="last" readonly="readonly" value="<?php echo $last; ?>">
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>Email:</label>
					<input type="text" name="email" readonly="readonly" value="<?php echo $email; ?>">
				</div>
				<div class="large-6 columns">
					<label>Department:</label>
					<input type="text" name="department" readonly="readonly" value="<?php echo $dept; ?>">
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>Date Registered:</label>
					<input type="text" name="dateReg" readonly="readonly" value="<?php echo $dateReg; ?>">
				</div>
				<div class="large-6 columns">
					<label>Last Password Update:</label>
					<input type="text" name="datePasswd" readonly="readonly" value="<?php echo $datePass; ?>">
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</form>
		<a class="success button" data-reveal-id="changePass" href="#">Change Password</a>
		<?php
	}

	function change_password() {
		// This function will display profile information to be used within a modal div
		?>
		<h2>Change Password</h2>
		<form action="#" method="post" data-abide>
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="submitType" value="newPass">
					<div class="password-field">
						<label>Type New Password:</label>
						<input type="password" id="newpass" name="newpass" required pattern="passwd">
						<small class="error">Your password must meet password requirements (Alphanumberic _+!@#$%^& and be at least 8 characters long</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<div class="password-field">
						<label>Type New Password Again:</label>
						<input type="password" name="newpass" required data-equalto="newpass">
						<small class="error">Password does not match the above</small>
					</div>

					<input class="success button" type="submit" value="Change Password">
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</form>
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

				case 'newPass':
					// Set variables
					$userID = $_SESSION['userID'];
					// Sanitize password and escape special chars for mySQL query
					$newPass = mysqli_real_escape_string($dbc, $_POST['newpass']);
					$newPassSQL = "UPDATE user SET passwd = SHA1('$newPass'), datePassword = NOW() WHERE userID = $userID";
					//echo $newPassSQL;
					$result = mysqli_query($dbc, $newPassSQL);
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
	echo "</div>"; // Close navigation div

	// Modal div for displaying profile information
	echo '<div id="profile" class="reveal-modal" data-reveal>';
	profile_page();
	echo '</div>';

	// Modal div for changing password
	echo '<div id="changePass" class="reveal-modal" data-reveal>';
	change_password();
	echo '</div>';

	// Alert Boxes
	if (isset($_POST['submitType'])) {
		echo '<div class="row">';
		switch ($_POST['submitType']) {
			case 'newPass':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your password has been updated.";
				echo '</div>';
				break;

			case 'newMessage':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your message has been sent.";
				echo '</div>';
				break;

			case 'newTicket':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your ticket has been submitted.";
				echo '</div>';
				break;

			case 'editDynamic':
				echo '<div data-alert class="alert-box success radius">';
				echo "Record has been updated.";
				echo '</div>';
				break;
			
			case 'edit':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been updated.";
				echo '</div>';
				break;

			case 'comment':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your comment has been submitted.";
				echo '</div>';
				break;

			case 'deleteDynamic':
				echo '<div data-alert class="alert-box success radius">';
				echo "Record has been deleted.";
				echo '</div>';
				break;

			case 'delete':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been deleted.";
				echo '</div>';
				break;

			case 'editEquip':
				echo '<div data-alert class="alert-box success radius">';
				echo "Equipment has been updated.";
				echo '</div>';
				break;

			case 'assign':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been assigned to you.";
				echo '</div>';
				break;
			
			default:
				# code...
				break;
		}
		echo '</div>';
	}
?>
	<!-- Modal div for creating new tickets -->
	<div id="newTicket" class="reveal-modal" data-reveal></div>
	<div id="newMessage" class="reveal-modal" data-reveal></div>