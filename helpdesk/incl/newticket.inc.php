<?php session_start(); ?>

	<form action="mytickets.php" method="post">
		<div class="row">
			<h1>Create New Ticket</h1>
			<div class="large-6 columns">
				<input type="hidden" name="submitType" value="newTicket">

				<label for="priority">Priority (Default: Low)</label>
				<select name="priority" id="priority">
					<option value="3">Please Select</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
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
			<div class="large-12 columns">

			<label for="desc">Problem Description</label>
			<textarea name="desc" id="desc" rows="5" cols="100" placeholder="Please describe the problem you are experiencing here."></textarea>
			
			<br>
			<input class="success button" type="submit" value="Submit">
			</div>
		</div>
	</form>
	<a class="close-reveal-modal">&#215;</a>
