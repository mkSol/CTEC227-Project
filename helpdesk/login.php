<?php ob_start(); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Greenwell IRS - Login</title>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<script src="js/vendor/modernizr.js"></script>
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
	}

	require("incl/sqlConnect.inc.php"); // Connect to SQL DB

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		display_login_form();
	} else {
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];
		// Query for username, password, first+last name, email, priv level and role
		$query = mysqli_query($dbc, "SELECT username,userID,passwd,firstName,lastName,email,privilege,privilege.privRole FROM user INNER JOIN privilege on user.privilege=privilege.privID WHERE username='$username' AND passwd=SHA1('$passwd')");
		$result = mysqli_fetch_array($query);

		if ($result) {
			session_start();
			set_session_variables();
			setcookie("privLevel", $result['privilege']);
			header("Location: home.php");
		} else {
			echo "<p>Incorrect username or password, please try again.</p>";
			echo "<a href=\"login.php\">Go Back</a>";
		}
	}

?>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>