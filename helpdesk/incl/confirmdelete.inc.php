<?php 
	session_start();
	if (isset($_GET['delete'])) {
		
		require("sqlConnect.inc.php");
		//mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		//echo "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1";
?>
	
		<form action="<?php echo $_SESSION['ticketpage']; ?>.php" method="post">
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="id" value="<?php echo $_GET['delete']; ?>">
					<input type="hidden" name="submitType" value="delete">

					<h1>Deleting Ticket ID: <?php echo $_GET['delete']; ?></h1>
					<p>Are you sure you wish to delete this ticket?</p>
				</div>
				
				<input class="success button" type="submit" value="Confirm">
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>