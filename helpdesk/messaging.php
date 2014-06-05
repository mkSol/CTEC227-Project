<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Messaging</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 
	
	/* 
		===Messaging system===

	Inbox / Outbox / Compose / View Msg

	DB Fields: msgID, fromUser, toUser, read, deletedRcv, deletedSnd

	*/

	function inbox() {
		global $dbc;
		echo "<h2>Inbox</h2>";
		$userID = $_SESSION['userID'];
		$result = mysqli_query($dbc, "SELECT msgID, msgSubject, msgBody, timestamp, user.username FROM message JOIN user ON message.msgFrom=user.userID WHERE recieverDeleted='0' AND msgTo='$userID'");
		$rows = mysqli_num_rows($result);
		
		// Terrible column titles for accordions below
		echo '<table>';
		echo '<thead>';
		echo '<tr>';
		echo '<th width="200">Sent On</th>';
		echo '<th width="100">From</th>';
		echo '<th width="100">To</th>';
		echo '<th width="400">Subject</th>';
		echo '</tr>';
		echo '</table>';
		echo '<div class="large-12 columns">';
		if (!$rows=mysqli_fetch_row($result)) { // If no messages are returned...
			echo "<tr><td>No Messages.</td></tr>";
		}
		// Reset pointer after above empty check, otherwise we lose first record
		mysqli_data_seek($result,0);
		echo '<dl class="accordion" data-accordion="inbox" id="inbox_accordion">';
		while ($rows = mysqli_fetch_array($result)) {
			echo '<dd>' . "\n";
			// Accordion link with timestamp, sender, and subject
			echo '<a href="#panel-' . $rows['msgID'] . '" id="?read=' . $rows['msgID'] . '">' . date('F jS\, Y h:i:a A', strtotime($rows['timestamp'])) . ' --- ' . $rows['username'] . ' --- ' . $_SESSION['username'] . ' --- ' . $rows['msgSubject'] . '</a>' . "\n";
			// Open div for hidden accordion content for message
			echo '<div id="panel-' . $rows['msgID'] . '" class="content">' . "\n";
			echo '<p>' . $rows['msgBody'] . '</p>';
			// Display buttons for deletion and marking messages as unread
			echo '<a href="messaging.php?box=in" class="success button tiny" id="?recieverdelete=' . $rows['msgID'] . '">Delete</a>' . "\n";
			echo '<a href="messaging.php?box=in" class="success button tiny" id="?unread=' . $rows['msgID'] . '">Mark As Unread</a>' . "\n";
			echo '</div>'; // Close message accordian div
			echo '</dd>' . "\n";
		}
		echo '</dl>';
		echo '</div>';
	}

	function outbox() {
		global $dbc;
		echo "<h1>Outbox</h1>";
		$userID = $_SESSION['userID'];
		$result = mysqli_query($dbc, "SELECT msgID, msgSubject, msgBody, timestamp, user.username FROM message JOIN user ON message.msgTo=user.userID WHERE senderDeleted='0' AND msgFrom='$userID'");
		$rows = mysqli_num_rows($result);

		// Terrible column titles for accordions below
		echo '<table>';
		echo '<thead>';
		echo '<tr>';
		echo '<th width="200">Sent On</th>';
		echo '<th width="100">From</th>';
		echo '<th width="100">To</th>';
		echo '<th width="400">Subject</th>';
		echo '</tr>';
		echo '</table>';
		echo '<div class="large-12 columns">';
		if (!$rows=mysqli_fetch_row($result)) { // If no messages are returned...
			echo "<tr><td>No Messages.</td></tr>";
		}
		// Reset pointer after above empty check, otherwise we lose first record
		mysqli_data_seek($result,0);
		echo '<dl class="accordion" data-accordion="inbox" id="inbox_accordion">';
		while ($rows = mysqli_fetch_array($result)) {
			echo '<dd>' . "\n";
			// Accordion link with timestamp, sender, and subject
			echo '<a href="#panel-' . $rows['msgID'] . '" id="?read=' . $rows['msgID'] . '">' . date('F jS\, Y h:i A', strtotime($rows['timestamp'])) . ' --- ' . $_SESSION['username'] . ' --- ' . $rows['username'] . ' --- ' . $rows['msgSubject'] . '</a>' . "\n";
			// Open div for hidden accordion content for message
			echo '<div id="panel-' . $rows['msgID'] . '" class="content">' . "\n";
			echo '<p>' . $rows['msgBody'] . '</p>';
			// Display button for deletion
			echo '<a href="messaging.php?box=out" class="success button tiny" id="?senderdelete=' . $rows['msgID'] . '">Delete</a>' . "\n";
			echo '</div>'; // Close message accordian div
			echo '</dd>' . "\n";
		}
		echo '</dl>';
		echo '</div>';
	}

	session_start();

	include("navigation.php");
	require("incl/sqlConnect.inc.php");
	include("incl/paginatedtable.inc.php");

	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
		header("Location: login.php");
	}

	// ============================ Page Content Start ===============================

	echo '<div class="row">';
	// Check if we should load inbox or outbox based on url params given by navigation links
	if (isset($_GET['box']) && $_GET['box'] == "in") {
		inbox();
	} elseif (isset($_GET['box']) && $_GET['box'] == "out") {
		outbox();
	} else { // If somehow there are no url params, default to inbox
		inbox();
	}
	echo '</div>';

?>
<div id="updateMessage"></div>
</div>
</div>
</body>
</html>
