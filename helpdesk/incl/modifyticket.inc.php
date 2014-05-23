<?php 
	if (isset($_GET['delete'])) {
		echo "<h1>Deleting ticket ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");
		mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		echo "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1";
	}

	if (isset($_GET['edit'])) {
		echo "<h1>Editing ticket ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");

		$result = mysqli_query($dbc, "SELECT * FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		$rows = mysqli_num_rows($result);

		print_r($rows)

		 ?>

		<form action="alltickets.php">
			<div class="row">
				<div class="large-6 columns">
					<label>Date:</label>
					<input type="text" name="date" value="<?php $rows['timestamp']; ?>">
				</div>

				<div class="large-6 columns">
				<legend>Category</legend>	
				<select name="category" id="category">
					<option value="5">Please Select</option>
					<option value="1">PC Hardware</option>
					<option value="2">Software</option>
					<option value="3">Email</option>
					<option value="4">Printer/Scanner/Fax/Misc</option>
					<option value="5">General</option>
				</select>

				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
				<label for="priority">Priority (Default: Low)</label>
				<select name="priority" id="priority">
					<option value="3">Please Select</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>

				</div>
				<div class="large-6 columns">
				<label for="status">Status:</label>
				<select name="status" id="priority">
					<option value="1">Please Select</option>
					<option value="1">Open</option>
					<option value="2">Assigned</option>
					<option value="3">Closed(Solved)</option>
					<option value="4">Closed(Cannot Fix)</option>
				</select>
					
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">

				<label for="desc">Problem Description</label>
				<textarea name="desc" id="desc" rows="5" cols="100" placeholder="Please describe the problem you are experiencing here."></textarea>
				
				<br>
				<input class="button" type="submit" value="Submit">
			</fieldset>
				</div>
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

?>