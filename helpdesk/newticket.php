
<div id="newTicket">
<?php 

function new_ticket_form() {
	?>
	<div class="row">
	<div class="large-12 columns" id="newticketform">
		<form id="new_ticket_form" method="post" action="#newticket">
			<fieldset>
    			<legend>Create New Ticket</legend> 
				<label for="category">Category (Default: General)</label>
				<select name="category" id="category">
					<option value="5">Please Select</option>
					<option value="1">PC Hardware</option>
					<option value="2">Software</option>
					<option value="3">Email</option>
					<option value="4">Printer/Scanner/Fax/Misc</option>
					<option value="5">General</option>
				</select>
				
				<label for="priority">Priority (Default: Low)</label>
				<select name="priority" id="priority">
					<option value="3">Please Select</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
				<br>
				<label for="desc">Problem Description</label><br>
				<textarea name="desc" id="desc" rows="5" cols="100" placeholder="Please describe the problem you are experiencing here."></textarea>
				
				<br>
				<input class="button" type="submit" value="Submit">
			</fieldset>
		</form>
	</div>
	</div>
	<?php
}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		new_ticket_form();
	} else {
		$userID = $_SESSION['userID'];
		$categoryID = $_POST['category'];
		$priorityID = $_POST['priority'];
		$issueDesc = $_POST['desc'];
		$result = mysqli_query($dbc, "INSERT INTO ticket (userID,statusID,categoryID,priorityID,timestamp,issueDesc) VALUES ('$userID','1','$categoryID','$priorityID',NOW(),'$issueDesc')");
		echo "<p>INSERT INTO ticket (userID,statusID,categoryID,priorityID,timestamp,issueDesc) VALUES ('$userID','1','$categoryID','$priorityID',NOW(),'$issueDesc')</p>";

		echo "<p>Thank you for submitting a ticket with Greenweel Bank IRS!</p>";
		echo "<p>Your problem has been submitted and is pending investigation with our help desk associates.</p>";
		echo "<p><a href=\"home.php\">Return</a></p>";

		// Set current page cookie to myTickets rather than newTicket again
		setcookie("currentPage", "myTickets");
	}
	
?>
</div>