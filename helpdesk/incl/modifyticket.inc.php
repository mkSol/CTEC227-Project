<?php 
	if (isset($_GET['delete'])) {
		echo "<h1>Deleting ticket ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");
		mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		echo "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1";
	}

	if (isset($_GET['edit'])) {
		echo "<h1>Ticket ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");

		$result = mysqli_query($dbc, "SELECT * FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		$rows = mysqli_fetch_array($result);


		 ?>

		<form action="alltickets.php">
			<div class="row">
				<div class="large-6 columns">
					<label>Date:</label>
					<input type="text" name="date" value="<?php echo $rows['timestamp']; ?>">
				</div>

					<?php 

				//Okay this looks like the most convoluted case/switch statement ever, but basicly I 
				//have it emit a default selection based on what $row['catagoryID'] value is. Because
				//I didn't want to have to echo out the html so I excaped the php after every case.

					switch ($rows['categoryID']) {
					 	case '1': ?>
							<div class="large-6 columns">
								<legend>Category</legend>	
								<select name="category" id="category">
									<option selected="selected" value="1">PC Hardware</option>
									<option value="2">Software</option>
									<option value="3">Email</option>
									<option value="4">Printer/Scanner/Fax/Misc</option>
									<option value="5">General</option>
								</select>
							</div>
					<?php	break;
					 	
					 	case '2': ?>
							<div class="large-6 columns">
								<legend>Category</legend>	
								<select name="category" id="category">
									<option value="1">PC Hardware</option>
									<option selected="selected" value="2">Software</option>
									<option value="3">Email</option>
									<option value="4">Printer/Scanner/Fax/Misc</option>
									<option value="5">General</option>
								</select>
							</div>

					 		
					<?php 	break;

						case '3': ?>
							<div class="large-6 columns">
								<legend>Category</legend>	
								<select name="category" id="category">
									<option value="1">PC Hardware</option>
									<option value="2">Software</option>
									<option selected="selected" value="3">Email</option>
									<option value="4">Printer/Scanner/Fax/Misc</option>
									<option value="5">General</option>
								</select>
							</div>

					 		
					<?php 	break;

						case '4': ?>
							<div class="large-6 columns">
								<legend>Category</legend>	
								<select name="category" id="category">
									<option value="1">PC Hardware</option>
									<option value="2">Software</option>
									<option selected="selected" value="3">Email</option>
									<option value="4">Printer/Scanner/Fax/Misc</option>
									<option value="5">General</option>
								</select>
							</div>

					 		
					<?php 	break;

						case '5': ?>
							<div class="large-6 columns">
								<legend>Category</legend>	
								<select name="category" id="category">
									<option value="1">PC Hardware</option>
									<option value="2">Software</option>
									<option value="3">Email</option>
									<option value="4">Printer/Scanner/Fax/Misc</option>
									<option selected="selected" value="5">General</option>
								</select>
							</div>

					 		
					<?php 		break;
					} 
						?>
			</div>

			<div class="row">

					<?php

					switch ($rows['priorityID']) {
					 	case '1': ?>
					 		<div class="large-6 columns">
								<label for="priority">Priority (Default: Low)</label>
								<select name="priority" id="priority">
									<option selected="selected" value="1">High</option>
									<option value="2">Medium</option>
									<option value="3">Low</option>
								</select>
							</div>
					<?php 	break;

						case '2': ?>
					 		<div class="large-6 columns">
								<label for="priority">Priority (Default: Low)</label>
								<select name="priority" id="priority">
									<option value="1">High</option>
									<option selected="selected" value="2">Medium</option>
									<option value="3">Low</option>
								</select>
							</div>
					<?php 	break;

						case '3': ?>
					 		<div class="large-6 columns">
								<label for="priority">Priority (Default: Low)</label>
								<select name="priority" id="priority">
									<option value="1">High</option>
									<option value="2">Medium</option>
									<option selected="selected" value="3">Low</option>
								</select>
							</div>
					<?php 	break;
					} 
						?>

					<?php	

					switch ($rows['statusID']) {
					 	case '1': ?>
					 		<div class="large-6 columns">
								<label for="status">Status:</label>
								<select name="status" id="priority">
									<option selected="selected" value="1">Open</option>
									<option value="2">Assigned</option>
									<option value="3">Closed(Solved)</option>
									<option value="4">Closed(Cannot Fix)</option>
								</select>
							</div>
					<?php 	break;

						case '2': ?>
					 		<div class="large-6 columns">
								<label for="status">Status:</label>
								<select name="status" id="priority">
									<option value="1">Open</option>
									<option selected="selected" value="2">Assigned</option>
									<option value="3">Closed(Solved)</option>
									<option value="4">Closed(Cannot Fix)</option>
								</select>
							</div>
					<?php 	break;

						case '3': ?>
					 		<div class="large-6 columns">
								<label for="status">Status:</label>
								<select name="status" id="priority">
									<option value="1">Open</option>
									<option value="2">Assigned</option>
									<option selected="selected" value="3">Closed(Solved)</option>
									<option value="4">Closed(Cannot Fix)</option>
								</select>
							</div>
					<?php 	break;

						case '4': ?>
					 		<div class="large-6 columns">
								<label for="status">Status:</label>
								<select name="status" id="priority">
									<option value="1">Open</option>
									<option value="2">Assigned</option>
									<option value="3">Closed(Solved)</option>
									<option selected="selected" value="4">Closed(Cannot Fix)</option>
								</select>
							</div>
					<?php 	break;
					} 
						?>
			</div>
			<div class="row">
				<div class="large-12 columns">

				<label for="desc">Problem Description</label>
				<textarea name="desc" id="desc" rows="5" cols="100"><?php echo $rows['issueDesc']; ?></textarea>
				
				<br>
				<input class="button" type="submit" value="Edit">
			</fieldset>
				</div>
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>