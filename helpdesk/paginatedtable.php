<?php 
	session_start();
	// Connect to SQL DB
	require("incl/sqlConnect.inc.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['pageNo'])) { // If page number was submitted...
			$urlParams = http_build_query(array_merge($_GET, array("page"=>$_POST['pageNo']))); // Merge page number into the url params
			header("Location: " . $_SERVER['PHP_SELF'] . "?" . $urlParams); // And reload the page so the url params go into effect
		}
		if (isset($_POST['searchFilter'])) {  // If search filter was submitted...
			$urlParams = http_build_query(array_merge($_GET, array("search"=>$_POST['searchFilter']))); // Merge search filter into the url params
			header("Location: " . $_SERVER['PHP_SELF'] . "?" . $urlParams); // And reload the page so the url params go into effect
		}
	}

		
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Users</title>
	<?php 
		require("incl/scripts.inc.html")
	?>	
</head>

<div class="row">

<?php 

	function column_sort($col_name) {
		//global $col_name; // Grab column name for use
		if (isset($_GET['sortBy']) && isset($_GET['sortOrder'])) { // If something is already set to sorting
			if ($_GET['sortBy'] !== $col_name->orgname) { // If not sorting by the link that was clicked, set it to the new sort
				$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
				echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "</a></th>";
			} else {
				if ($_GET['sortOrder'] == "ASC") { // If it was sorting ascending, swap it to descending
					$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->orgname,"sortOrder"=>"DESC"))); // Merge/add sort options into url params
					echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "</a></th>";
				} else { // Otherwise make it ascending
					$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
					echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "</a></th>";
				}
			}
		} else { // If nothing was previously set, add sorting
			$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
			echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "</a></th>";
		}
	}
	
	function next_page($page) {
		$page++; // Increment page counter upon click
		if ($_SERVER['QUERY_STRING']) { // If there are already url parameters, add page to the end
			$urlParams = http_build_query(array_merge($_GET, array("page"=>$page))); // Build new url params and add/merge page
			echo "<a href=\"?" . $urlParams . "\">Next</a>";
		} else { // Otherwise set the url parameter to page
			echo "<a href=\"?page=" . $page . "\">Next</a>";
		}
	}

	function prev_page($page) {
		$page--; // Increment page counter upon click
		if ($_SERVER['QUERY_STRING']) { // If there are already url parameters, add page to the end
			$urlParams = http_build_query(array_merge($_GET, array("page"=>$page))); // Build new url params and add/merge page
			echo "<a href=\"?" . $urlParams . "\">Previous</a>";
		} else { // Otherwise set the url parameter to page
			echo "<a href=\"?page=" . $page . "\">Previous</a>";
		}
	}

	function pagination_links($numRows,$rowsPerPage,$page) {
		//echo '<div class="large-6 columns">';
		//echo '<div class="large-4 columns">';
		// First determine number of pages needed
		if ($numRows % $rowsPerPage != 0) {
			$numPages = intval($numRows / $rowsPerPage) + 1;
		} else {
			$numPages = intval($numRows / $rowsPerPage);
		}
		// Previous page link
		if (!($page <= 1)) {
			prev_page($page);
		}
		// Echo out current page
		echo "<pre>" . $page . "</pre>";
		// Next page link
		if (!($page >= $numPages)) {
			next_page($page);
		}
		// Form logic for entering a page number manually
		echo '<form method="post" action="allusers.php?' . $_SERVER['QUERY_STRING'] . '">';
		echo '<input type="text" name="pageNo" placeholder="' . $page . '">';
		echo '<input class="button" type="submit" value="Go">';
		echo '</form>';
		// List total page number
		echo "<p>Number of pages: $numPages</p>";
	}

	function search_filter() {
		// Form for submitting search filter string
		// Reset page counter back to 1 when submitting form
		echo '<form method="post" action="allusers.php?' . http_build_query(array_merge($_GET, array("page"=>"1"))) . '">';
		echo '<input type="text" name="searchFilter" placeholder="' . "Search..." . '">';
		echo '<input class="button" type="submit" value="Search">';
		echo '</form>';
	}

	// ================== Table Page Start ====================

function output_table($sql,$tableName) {
	global $dbc;
	
	// Set sorting and page variables
	if (isset($_GET['sortBy'])) {
		$sortBy = mysqli_real_escape_string($dbc,$_GET['sortBy']);
	} else {
		$sortBy = "userID";
	}
	if (isset($_GET['sortOrder'])) {
		$sortOrder = mysqli_real_escape_string($dbc,$_GET['sortOrder']);
	} else {
		$sortOrder = "ASC";
	}
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "1";
	}
	if (isset($_GET['search'])) {
		$searchFilter = mysqli_real_escape_string($dbc,$_GET['search']);
	} else {
		$searchFilter = "";
	}
	// Begin search filter paramters with blank
	$searchParams = null;
	if ($searchFilter) {
		// First reset page counter to 1 for search results
		array_merge($_GET, array("page"=>"1"));
		$result = mysqli_query($dbc,$sql);
		while ($col_name = mysqli_fetch_field($result)) { // Get columns and loop through each
			if (!$searchParams) {
				// Begin search string to inject into SQL
				$searchParams = "WHERE ";
			} else {
				// Continue string search building and connect with the next one
				$searchParams .= "OR ";
			}
			// Add in [table name] LIKE [search filter]
			$searchParams .= $col_name->orgname . " LIKE \"%$searchFilter%\" ";
		}
		$rowsPerPage = 10;
		$pageOffset = 0;
		$page = 1;
	} else {
		$rowsPerPage = 10;
		$pageOffset = $page * $rowsPerPage - $rowsPerPage;	
	}

	
	$numRows = mysqli_num_rows(mysqli_query($dbc,$sql . " " . $searchParams));
	$result = mysqli_query($dbc, $sql . " " . $searchParams . " ORDER BY $sortBy $sortOrder LIMIT $pageOffset, $rowsPerPage");
	echo mysqli_error($dbc);
	$numCols = mysqli_num_fields($result);

	// Begin table
	echo "<table id=\"$tableName\">";
	
	// *********** I have no idea how the hell to format these things here
	echo '<div class=large-12 columns>';
	echo '<div class=large-6 columns>';
	pagination_links($numRows,$rowsPerPage,$page);
	echo '</div>';
	echo '<div class=large-6 columns>';
	search_filter();
	echo '</div>';
	echo '</div>';
	echo "</div>";

	echo '<div class="row">';
	// Build table head
	echo "<thead>";
	echo "<tr>";

	// Insert edit/delete column
	/*echo "<th>";
	echo "Edit";
	echo "</th>";*/

	// Continue building table head
	while ($col_name = mysqli_fetch_field($result)) { // While more columns exist...
		column_sort($col_name); // Output table column name with sort links
	}
	echo "</tr>";
	echo "</thead>";

	// Build table body
	echo "<tbody>";
	while ($rows=mysqli_fetch_row($result)) { // While more rows exist...
		echo "<tr>";
		/*echo "<td>";
		// Insert edit button and pass first column value (ID) as url parameter
		echo "<a class=\"?id={$rows['0']}\" href=\"#\">Test Link</a>";
		echo "</td>";*/
		for ($col_num=0; $col_num < $numCols; $col_num++) { // Run through $numCols number of columns each row
			echo "<td>";
			echo $rows[$col_num]; // Spit out data for specified column on this row
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody>";

	// Close table
	echo "</table>";
	echo "</div>";
}


// ====================== Page Content Start ================================

$sql = "SELECT userID AS 'User ID', username AS Username, email AS Email, firstName AS First, lastName AS Last FROM user";

// This function is all that's needed to call a full table
// Just pass in an SQL statement and the name of the table you want it labeled as
output_table($sql,"User_Table");

?>

</div>
</body>
</html>
