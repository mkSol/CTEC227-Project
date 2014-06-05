<?php 
	session_start();
	if (isset($_GET['delete'])) {
		require("sqlConnect.inc.php");
		if (isset($_GET['table'])) {
			$sql = "SELECT * FROM " . $_GET['table']; // Basic general query for table passed in via url params
			//echo $sql;
			$result = mysqli_query($dbc,$sql);
			
			// Setup var to hold all column names
			$columns = [];
			while ($col_name = mysqli_fetch_field($result)) { // Get columns and loop through each
				array_push($columns, $col_name->name); // Store column names in array
			}
		}
	?>
	
		<form action="#" method="post">
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="id" value="<?php echo $_GET['delete']; ?>">
					<input type="hidden" name="submitType" value="deleteDynamic">
					<input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
					<input type="hidden" name="firstColumn" value="<?php echo $columns[0]; ?>">

					<h1>Deleting <?php echo $_GET['table']; ?> ID: <?php echo $_GET['delete']; ?></h1>
					<p>Are you sure you wish to delete this?</p>
				</div>
				
				<input class="success button" type="submit" value="Confirm">
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>