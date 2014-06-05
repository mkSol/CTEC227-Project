<?php 
	// This script loads in when a message's status needs to change
	// The message itself is never actually removed from the DB, just marked deleted

	// Connect to DB
	require("sqlConnect.inc.php");
	
	//print_r($_GET);
	if (isset($_GET['read'])) {
		// Change read flag on message to 1
		$sqlMarkRead = "UPDATE message set msgRead='1' WHERE msgID=" . $_GET['read'];
		//echo $sqlMarkRead;
		mysqli_query($dbc,$sqlMarkRead) or die(mysqli_error($dbc));
	} elseif (isset($_GET['unread'])) {
		// Change read flag on message to 1
		$sqlMarkUnread = "UPDATE message set msgRead='0' WHERE msgID=" . $_GET['unread'];
		//echo $sqlMarkUnread;
		mysqli_query($dbc,$sqlMarkUnread);
	} elseif (isset($_GET['senderdelete'])) {
		// Mark as deleted from the sender's PoV
		$sqlSenderDeleted = "UPDATE message set senderDeleted='1' WHERE msgID=" . $_GET['senderdelete'];
		//echo $sqlSenderDeleted;
		mysqli_query($dbc,$sqlSenderDeleted);
	} elseif (isset($_GET['recieverdelete'])) {
		// Mark as deleted from the recipient's PoV
		$sqlRcvDeleted = "UPDATE message set recieverDeleted='1' WHERE msgID=" . $_GET['recieverdelete'];
		//echo $sqlRcvDeleted;
		mysqli_query($dbc,$sqlRcvDeleted);
	}
?>