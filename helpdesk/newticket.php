<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Ticket</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<?php 
		session_start();

		include("navigation.php");
		require("incl/sqlConnect.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
		}
?>

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
		// Set variables
		$userID = $_SESSION['userID'];
		$categoryID = $_POST['category'];
		$priorityID = $_POST['priority'];
		// Sanitize ticket description and escape special chars for mySQL query
		$issueDesc = mysqli_real_escape_string($dbc, $_POST['desc']);
		$result = mysqli_query($dbc, "INSERT INTO ticket (userID,statusID,categoryID,priorityID,timestamp,issueDesc) VALUES ('$userID','1','$categoryID','$priorityID',NOW(),'$issueDesc')");

		// Confirmation box and refresh page ater post	
		?>
		<script type="text/javascript">
			alert("Your ticket has been submitted.");
			location.reload(true);
		</script>
		<?php
	}
	
?>
</div>
</body>
</html>
