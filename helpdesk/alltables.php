<?php 
	session_start();
	require("incl/sqlConnect.inc.php"); // Connect to DB
	include("incl/errorhandler.inc.php"); // Error handling
	include("incl/logincheck.inc.php"); // Check if user is logged in, boot otherwise
	include("incl/paginatedtable.inc.php"); // load function for displaying tables

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Tables</title>
	<?php 
		require("incl/scripts.inc.html");
		//$scrollPosition = $_COOKIE['scrollPosition'];
	?>	
</head>
<body>
<?php 
//echo "<body onScroll=\"setScrollPos()\" onload=\"keepScroll()\">";

	function table_select ($tables) {	
		echo '<form method="post" action="?">' . "\n";

		echo '<div class="row">' . "\n";
		echo '<div class="large-6 columns">' . "\n";
		//echo '<div class="row collapse">' . "\n";
		echo '<div class="row collapse">';
		echo '<div class="large-10 columns">' . "\n";
		echo '<select name="tableSelect" id="tableSelect">' . "\n";
			for ($tblCount=0; $tblCount < count($tables); $tblCount++) { 
			if (isset($_POST['tableSelect']) && $_POST['tableSelect'] == $tables[$tblCount]) {
				echo '<option selected="selected" value="' . $tables[$tblCount] . '">' . $tables[$tblCount] . '</option>' . "\n";
			} elseif (isset($_SESSION['tableSelect']) && $_SESSION['tableSelect'] == $tables[$tblCount]) {
				echo '<option selected="selected" value="' . $tables[$tblCount] . '">' . $tables[$tblCount] . '</option>' . "\n";
			} else {
				echo '<option value="' . $tables[$tblCount] . '">' . $tables[$tblCount] . '</option>' . "\n";
			}
		}
		echo '</select>' . "\n";
		echo '</div>';

		echo '<div class="small-2 columns" id="allTablesSubmit">' . "\n";
		echo '<input type="submit" value="Go" class="success button postfix">' . "\n";
		echo '</div>';
		echo '</div>';

		//echo '</div>'; // Close row collapse
		echo '</div>'; // Close large-6
		echo '</div>'; // CLose row

		echo '</form>' . "\n";
	}

	$tblresult = mysqli_query($dbc, "SHOW TABLES");
	$tables = [];
	while($table = mysqli_fetch_row($tblresult)) {
		array_push($tables, $table[0]);

		$result = mysqli_query($dbc, "SELECT * FROM " . $tables['0']);
		$rows = mysqli_num_rows($result);
		$numCols = mysqli_num_fields($result);

	}
	
	// ======================= All Tables Page Content Start ========================

	include("navigation.php"); // Load nav bar	
	

	echo '<div class="row">';
	echo '<div class="large-12 columns">';
	echo "<h2>View All Tables</h2>" . "\n";
	echo '</div>';	
	echo '</div>';
	
	table_select($tables);
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") { 
		if (isset($_POST['tableSelect'])) { // When new table is selected
			$_SESSION['tableSelect'] = $_POST['tableSelect']; // set tableSelect to session var
		}
	} else {
		if (!isset($_SESSION['tableSelect'])) { // If no session var for table select, set default
			$_SESSION['tableSelect'] = "activityLog";
		}
	}

	// Set session var for use with exporting table files
	$_SESSION['sql'] = "SELECT * FROM " . $_SESSION['tableSelect'];

	if (isset($_SESSION['tableSelect'])) {
		$tblSQL = "SELECT * FROM " . $_SESSION['tableSelect'];
		//echo "INSERT TABLE FOR " . $_SESSION['tableSelect'] . "!!!";

		echo '<div id="allTables" class="row">';
		echo '<h4>Table: ' . $_SESSION['tableSelect'] . '</h4>' . "\n";
		output_table($tblSQL,$_SESSION['tableSelect'],0,1,1);
		echo '</div>';
	} else {
		echo '<div id="allTables" class="row">';
		echo '<h4>Table: ' . 'activityLog' . '</h4>' . "\n";
		output_table("SELECT * FROM activityLog","activityLog",0,1,1);
		echo '</div>';
	}

	echo '<div class="row">';
	// Export table link
	echo '<a href="incl/outputtable.inc.php" class="success button">Export Table</a>';
	echo '</div>';
?>

</body>
</html>
