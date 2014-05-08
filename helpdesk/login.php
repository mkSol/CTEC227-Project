<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Greenwell IRS - Login</title>
</head>
<body>
<?php
	function display_login_form() {
		?>
		<div id="login">
			<form id="login_form" method="post" action="">
				<fieldset>
	    			<legend>Welcome to the Greenwell Bank Incident Reporting System</legend> 
					<label for="username">Username</label>
					<input type="text" id="username" name="username">

					<label for="passwd">Password</label>
					<input type="password" id="passwd" name="passwd">
					
					<input type="submit" value="Login">
				</fieldset>
			</form>
		</div>
		<?php
	}

	function set_session_variables() {
		global $result;
		$_SESSION['logged_in'] = "1";
		$_SESSION['firstName'] = $result['firstName'];
		$_SESSION['lastName'] = $result['lastName'];
		$_SESSION['username'] = $result['username'];
		$_SESSION['email'] = $result['email'];
		$_SESSION['role'] = $result['privRole'];
		$_SESSION['privLevel'] = $result['privilege'];
	}

	require("incl/sqlConnect.inc.php"); // Connect to SQL DB

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		display_login_form();
	} else {
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];
		// Query for username, password, first+last name, email, priv level and role
		$query = mysqli_query($dbc, "SELECT username,passwd,firstName,lastName,email,privilege,privilege.privRole FROM user INNER JOIN privilege on user.privilege=privilege.privID WHERE username='$username'");
		$result = mysqli_fetch_array($query);

		if ($result['passwd'] === $passwd) {
			session_start();
			set_session_variables();
			header("Location: home.php");
		} else {
			echo "<p>Incorrect username or password, please try again.</p>";
			echo "<a href=\"login.php\">Go Back</a>";
		}
	}

?>
</body>
</html>