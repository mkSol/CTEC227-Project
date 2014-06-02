<?php 
	session_start();
	if (isset($_GET['delete'])) {
		require("sqlConnect.inc.php");
	?>
	
		<form action="#" method="post">
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="id" value="<?php echo $_GET['delete']; ?>">
					<input type="hidden" name="submitType" value="deleteDynamic">

					<h1>Deleting Ticket ID: <?php echo $_GET['delete']; ?></h1>
					<p>Are you sure you wish to delete this?</p>
				</div>
				
				<input class="button" type="submit" value="Confirm">
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>