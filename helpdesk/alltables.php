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

		echo '<div class="large-10 columns">' . "\n";
		echo '<select name="tableSelect" id="tableSelect">' . "\n";
			for ($tblCount=0; $tblCount < count($tables); $tblCount++) { 
			echo '<option value="' . $tables[$tblCount] . '">' . $tables[$tblCount] . '</option>' . "\n";
		}
		echo '</select>' . "\n";
		echo '</div>';

		echo '<div class="small-2 columns" id="allTablesSubmit">' . "\n";
		echo '<input type="submit" value="Go" class="success button">' . "\n";
		echo '</div>';

		//echo '</div>'; // Close row collapse
		echo '</div>'; // Close large-6
		echo '</div>'; // CLose row

		echo '</form>' . "\n";
	}

		session_start();

		include("navigation.php");
		require("incl/sqlConnect.inc.php");
		include("incl/paginatedtable.inc.php");

		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== '1') {
			header("Location: login.php");
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

	echo '<div class="row">';
	echo "<h2>View All Tables</h2>" . "\n";
	echo '<h3>Select a Table: </h3>' . "\n";	
	echo '</div>';

	table_select($tables);
	

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['tableSelect'])) {
			$_SESSION['tableSelect'] = $_POST['tableSelect'];
		}
	}
	if (isset($_SESSION['tableSelect'])) {
		$tblSQL = "SELECT * FROM " . $_SESSION['tableSelect'];
		//echo "INSERT TABLE FOR " . $_SESSION['tableSelect'] . "!!!";

		echo '<div id="allTables" class="row">';
		output_table($tblSQL,$_SESSION['tableSelect'],0,1,1);
		echo '</div>';
	} else {
		echo '<div id="allTables" class="row">';
		output_table("SELECT * FROM user","user",0,1,1);
		echo '</div>';
	}

?>

</body>
</html>
