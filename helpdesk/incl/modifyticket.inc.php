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
					<div class="large-6 columns">
						<legend>Category</legend>	
						<select name="category" id="category">
							<option <?php if($rows['categoryID'] == '1') echo "selected=\"selected\"" ?> value="1">PC Hardware</option>
							<option <?php if($rows['categoryID'] == '2') echo "selected=\"selected\"" ?> value="2">Software</option>
							<option <?php if($rows['categoryID'] == '3') echo "selected=\"selected\"" ?> value="3">Email</option>
							<option <?php if($rows['categoryID'] == '4') echo "selected=\"selected\"" ?> value="4">Printer/Scanner/Fax/Misc</option>
							<option <?php if($rows['categoryID'] == '5') echo "selected=\"selected\"" ?> value="5">General</option>
						</select>
					</div>
				</div>

			<div class="row">
				<div class="large-6 columns">
					<label for="priority">Priority (Default: Low)</label>
					<select name="priority" id="priority">
						<option <?php if($rows['priorityID'] == '1') echo "selected=\"selected\"" ?> value="1">High</option>
						<option <?php if($rows['priorityID'] == '2') echo "selected=\"selected\"" ?> value="2">Medium</option>
						<option <?php if($rows['priorityID'] == '3') echo "selected=\"selected\"" ?> value="3">Low</option>
					</select>
				</div>

				<div class="large-6 columns">
					<label for="status">Status:</label>
					<select name="status" id="priority">
						<option selected="selected" value="1">Open</option>
						<option <?php if($rows['statusID'] == '1') echo "selected=\"selected\"" ?> value="2">Assigned</option>
						<option <?php if($rows['statusID'] == '2') echo "selected=\"selected\"" ?> value="3">Closed(Solved)</option>
						<option <?php if($rows['statusID'] == '3') echo "selected=\"selected\"" ?> value="4">Closed(Cannot Fix)</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">

				<label for="desc">Problem Description</label>
				<textarea name="desc" id="desc" rows="5" cols="100"><?php echo $rows['issueDesc']; ?></textarea>
				
				<br>
				<input class="button" type="submit" value="Edit">
				</div>
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>