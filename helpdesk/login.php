<?php ob_start(); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Greenwell IRS - Login</title>
	<?php 
		require("incl/scripts.inc.html"); // CSS, Javascript, etc
		require("incl/sqlConnect.inc.php"); // Connect to SQL DB
		include("incl/errorhandler.inc.php"); // Error handling
	?>	
</head>
<body>
	<script type="text/javascript">
		document.cookie = "currentPage=default; expires=0; path=/";
	</script>
<?php
	function display_login_form() {
		?>
		<div class="row">
			<div class="large-12 columns"><h1>Welcome to the Greenwell Bank Incident Reporting System</h1></div>
		</div>
		<div class="row">
			<div class="large-8 columns" id="login">
				<form id="login_form" method="post" action="login.php">
					<fieldset>
	    				<legend>Login:</legend>
						<label for="username">Username</label>
						<input type="text" id="username" name="username">

						<label for="passwd">Password</label>
						<input type="password" id="passwd" name="passwd">
					
						<input class="success button" type="submit" value="Login">
					</fieldset>
				</form>
				<small>If you are unable to log in, please contact an administrator at root@greenwellbank.com</small>
			</div>
			<div class="large-4 columns"></div>
		</div>	
		<?php
	}

	function set_session_variables() {
		global $result;
		$_SESSION['logged_in'] = "1";
		$_SESSION['firstName'] = $result['firstName'];
		$_SESSION['lastName'] = $result['lastName'];
		$_SESSION['username'] = $result['username'];
		$_SESSION['userID'] = $result['userID'];
		$_SESSION['email'] = $result['email'];
		$_SESSION['role'] = $result['privRole'];
		$_SESSION['privLevel'] = $result['privilege'];
		$_SESSION['deptID'] = $result['department'];
	}

	function pass_date_check($datePassword) {
		$now = time();
		// If password date plus 90 days is less than current time...
		if ((strtotime($datePassword) + 7776000) < $now) {
			return false;
		} else {
			return true;
		}
	}

	function change_password() {
		// This prints a form to change passwords
		?>
		<h2>Change Password</h2>
		<h4>Your password is more than 90 days old and needs to be updated</h4>
		<form action="#" method="post" data-abide>
			<div class="row">
				<div class="large-12 columns">
					<input type="hidden" name="submitType" value="newPass">
					<div class="password-field">
						<label>Type New Password:</label>
						<input type="password" id="newpass" name="newpass" required pattern="passwd">
						<small class="error">Your password must meet password requirements (Alphanumberic _+!@#$%^& and be at least 8 characters long</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<div class="password-field">
						<label>Type New Password Again:</label>
						<input type="password" name="newpass" required data-equalto="newpass">
						<small class="error">Password does not match the above</small>
					</div>

					<input class="success button" type="submit" value="Change Password">
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</form>
		<?php
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		display_login_form();
	} else {
		if (!isset($_POST['submitType'])) {
			// Set sanitized vars for query ahead
			$username = mysqli_real_escape_string($dbc, $_POST['username']);
			$passwd = mysqli_real_escape_string($dbc, $_POST['passwd']);
			// Query for username, password, first+last name, email, priv level and role
			$query = mysqli_query($dbc, "SELECT username,userID,passwd,firstName,lastName,email,department,privilege,privilege.privRole, datePassword FROM user INNER JOIN privilege on user.privilege=privilege.privID WHERE username='$username' AND passwd=SHA1('$passwd')");
			$result = mysqli_fetch_array($query);

			if ($result) {
				session_start();
				set_session_variables(); // Set session vars
				// Check if password was set under 90 days ago
				if (pass_date_check($result['datePassword'])) { 
					// Record user login to DB
					$activitylog_var = "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Login', '{$_SESSION['username']} logged in')";
					$activity_result =mysqli_query($dbc, $activitylog_var);	
					// Push user to home page after successful login
					header("Location: home.php");
				} else { // Password expired and needs updating
					change_password();
				}
			} else {
				echo "<p>Incorrect username or password, please try again.</p>";
				echo "<a href=\"login.php\">Go Back</a>";
			}
		} else {
			session_start();
			// Set variables
			$userID = $_SESSION['userID'];
			// Sanitize password and escape special chars for mySQL query
			$newPass = mysqli_real_escape_string($dbc, $_POST['newpass']);
			$newPassSQL = "UPDATE user SET passwd = SHA1('$newPass'), datePassword = NOW() WHERE userID = $userID";
			//echo $newPassSQL;
			$result = mysqli_query($dbc, $newPassSQL);
			// Continue login process after updating password
			// Record user login to DB
			$activitylog_var = "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Login', '{$_SESSION['username']} logged in')";
			$activity_result =mysqli_query($dbc, $activitylog_var);	
			// Push user to home page after successful login
			header("Location: home.php");
		}
	}

?>
</body>
</html>

<?php ob_end_flush(); ?>