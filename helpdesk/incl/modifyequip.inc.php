<?php 
	if (isset($_GET['delete'])) {
		echo "<h1>Deleting equip ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");
		mysqli_query($dbc, "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1");
		echo "DELETE FROM ticket WHERE ticketID='{$_GET['id']}' LIMIT 1";
	}

	if (isset($_GET['edit'])) {
		echo "<h1>Equip ID: {$_GET['id']}</h1>";
		require("sqlConnect.inc.php");

		$result = mysqli_query($dbc, "SELECT * FROM equipment WHERE equipID='{$_GET['id']}' LIMIT 1");
		$rows = mysqli_fetch_array($result);

		// Initialize variables
		if (isset($_GET['user'])) {
			$user = $_GET['user'];
		} else { // Set to none if does not exist
			$user = "none";
		}
		if (isset($_GET['dept'])) {
			$dept = $_GET['dept'];
		} else { // Set to none if does not exist
			$dept = "none";
		}
		if (isset($_GET['link'])) {
			$link = $_GET['link'];
		} else { // Set to none if does not exist
			$link = "none";
		}

		 ?>

		<form action="allequip.php" method="post">
			<div class="row">
				<div class="large-6 columns">
					
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="linkID" value="<?php echo $link; ?>">

					<label>User ID (Blank to Remove):</label>
					<input type="text" name="userID" value="<?php echo $user; ?>">
				</div>
				<div class="large-6 columns">
					<label>Department (Overrides UserID):</label>
					<select name="deptID" id="deptID">
						<option <?php if($dept == 'none') echo "selected=\"selected\"" ?> value="none">Assigned To Employee</option>
						<option <?php if($dept == '1') echo "selected=\"selected\"" ?> value="1">Management</option>
						<option <?php if($dept == '2') echo "selected=\"selected\"" ?> value="2">HR</option>
						<option <?php if($dept == '3') echo "selected=\"selected\"" ?> value="3">Marketing</option>
						<option <?php if($dept == '4') echo "selected=\"selected\"" ?> value="4">IT</option>
						<option <?php if($dept == '5') echo "selected=\"selected\"" ?> value="5">Customer Service</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
					<legend>Type</legend>	
					<select name="equipType" id="equipType">
						<option <?php if($rows['equipType'] == '1') echo "selected=\"selected\"" ?> value="1">Desktop PC</option>
						<option <?php if($rows['equipType'] == '2') echo "selected=\"selected\"" ?> value="2">Laptop PC</option>
						<option <?php if($rows['equipType'] == '3') echo "selected=\"selected\"" ?> value="3">Peripheral</option>
					</select>
				</div>
				<div class="large-6 columns">
					<label>Equipment Description:</label>
					<input type="text" name="equipDesc" value="<?php echo $rows['equipDesc']; ?>">
				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
					<label>Equipment Serial:</label>
					<input type="text" name="equipSerial" value="<?php echo $rows['equipSerial']; ?>">
				</div>
				<input class="button" type="submit" value="Edit">
			</div>
		</form>


	<?php	echo "<a class=\"close-reveal-modal\">&#215;</a>";
	}	

	?>