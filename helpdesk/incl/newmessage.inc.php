<?php session_start(); ?>

	<form action="#" method="post" data-abide>
		<div class="row">
			<h1>Compose Message</h1>
			<div class="large-6 columns">
				<input type="hidden" name="submitType" value="newMessage">
				
				<label for="subject">Subject: </label>
				<input type="text" name="subject" required>

			</div>
			<div class="large-6 columns">
				<label for="msgTo">To: </label>
				<input type="text" list="users" name="msgTo" value="<?php if (isset($_GET['username'])) {echo $_GET['username'];} ?>" required>

				<?php 

					require("sqlConnect.inc.php"); 				

					$result = mysqli_query($dbc, "SELECT username FROM user");

					echo "<datalist id='users'>";

					while($row = mysqli_fetch_row($result)) {

						echo "<option value=\"{$row[0]}\">";
					}

					echo "</datalist>";

				 ?>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">

			<label for="body">Message: </label>
			<textarea name="body" rows="5" cols="100"></textarea>
			
			<br>
			<input class="success button" type="submit" value="Send">
			</div>
		</div>
	</form>
	<a class="close-reveal-modal">&#215;</a>
