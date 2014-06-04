<?php 
	session_start();
	if (isset($_GET['ticketID'])) {
		
		require("sqlConnect.inc.php");

?>

	<form action="assignedtickets.php" method="post">
		<div class="row">
			<div class="large-12 columns">
				<input type="hidden" name="id" value="<?php echo $_GET['ticketID']; ?>">
				<input type="hidden" name="submitType" value="assign">

				<h1>Assign Ticket ID: <?php echo $_GET['ticketID']; ?></h1>
				<p>Are you sure you wish to assign yourself to this ticket?</p>
			</div>
			
			<input class="button" type="submit" value="Confirm">
		</div>
	</form>

	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>