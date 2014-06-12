<?php 
	//session_start();
	// Connect to SQL DB
	require("incl/sqlConnect.inc.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		//print_r($_POST);
		if (isset($_POST['pageNo'])) { // If page number was submitted...
			$urlParams = http_build_query(array_merge($_GET, array("page"=>$_POST['pageNo']))); // Merge page number into the url params
			header("Location: " . $_SERVER['PHP_SELF'] . "?" . $urlParams); // And reload the page so the url params go into effect
		}
		if (isset($_POST['searchFilter'])) {  // If search filter was submitted...
			$urlParams = http_build_query(array_merge($_GET, array("search"=>$_POST['searchFilter'],"page"=>"1"))); // Merge search filter into the url params
			header("Location: " . $_SERVER['PHP_SELF'] . "?" . $urlParams); // And reload the page so the url params go into effect
		}
		if (isset($_POST['submitType'])) {
			switch ($_POST['submitType']) {
				case 'editDynamic':
					// Build MySQL Statement while sanitizing inputted data
					$postCount = 0;
					$sqlEdit = "UPDATE " . $_POST['table'] . " SET ";
					foreach ($_POST as $key => $value) { // Loops through POST (ignore first 2 values of submitType and table)
						if ($postCount > 1) {
							if ($postCount == 2) { // Make sure to ignore leading comma on first field entry
								$sqlEdit .= $key . "=" . "'" . mysqli_real_escape_string($dbc,$value) . "'";
								$idName = $key;
								$idVal = mysqli_real_escape_string($dbc,$value);
							} else {
								// And continue building SQL update statement
								$sqlEdit .= ", " . $key . "=" . "'" . mysqli_real_escape_string($dbc,$value) . "'";	
							}
						}
						$postCount++;
					}
					// Finalize SQL statement with a qualifier and limit
					$sqlEdit .= " WHERE " . $idName . "='" . $idVal . "' LIMIT 1";
					//echo $sqlEdit;
					mysqli_query($dbc,$sqlEdit);
					// Log edit to database
					$activityLog = mysqli_real_escape_string($dbc,$sqlEdit);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Edit', '$activityLog')");
					break;

				case 'edit':
					// Sanitize ticket description and escape special chars for mySQL query
					$desc = mysqli_real_escape_string($dbc, $_POST['desc']);
					$date = mysqli_real_escape_string($dbc, $_POST['date']);
					$category = mysqli_real_escape_string($dbc, $_POST['category']);
					$priority = mysqli_real_escape_string($dbc, $_POST['priority']);
					$status = mysqli_real_escape_string($dbc, $_POST['status']);
					if ($status == "1") { // If setting ticket to OPEN status
						// Then make sure to clear assignedTo field
						$sqlEdit = "UPDATE ticket SET timestamp='$date', categoryID='$category', priorityID='$priority', statusID='$status', issueDesc='$desc', assignedTo=null WHERE ticketID='{$_POST['id']}' LIMIT 1";
						mysqli_query($dbc, $sqlEdit);	
					} else { // Otherwise, simply update ticket details
						$sqlEdit = "UPDATE ticket SET timestamp='$date', categoryID='$category', priorityID='$priority', statusID='$status', issueDesc='$desc' WHERE ticketID='{$_POST['id']}' LIMIT 1";
						mysqli_query($dbc, $sqlEdit);
					}
					// Log edit to database
					$activityLog = mysqli_real_escape_string($dbc,$sqlEdit);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Edit Ticket', '$activityLog')");
					break;

				case 'comment':
					// Sanitize ticket description and escape special chars for mySQL query
					$comment = mysqli_real_escape_string($dbc, $_POST['comment']);
					mysqli_query($dbc, "INSERT INTO ticketComment (ticketID, userID, timestamp, comment) VALUES ('{$_POST['ticketID']}','{$_POST['userID']}', NOW(), '$comment')");
					break;

				case 'delete':
					// Delete selected ticket
					$sqlDelete = "DELETE FROM ticket WHERE ticketID='{$_POST['id']}' LIMIT 1";	
					mysqli_query($dbc, $sqlDelete);
					// Remove all comments associated with this ticket too
					mysqli_query($dbc, "DELETE FROM ticketComment WHERE ticketID='{$_POST['id']}'");
					// Log deletion to database
					$activityLog = mysqli_real_escape_string($dbc,$sqlDelete);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Delete Ticket', '$activityLog')");
					break;

				case 'deleteDynamic':	
					// Build MySQL Statement to delete record
					$sqlDelete = "DELETE FROM " . $_POST['table'] . " WHERE " . $_POST['firstColumn'] . "=" . $_POST['id'];
					//echo $sqlDelete;
					mysqli_query($dbc,$sqlDelete);			
					// Log deletion to database
					$activityLog = mysqli_real_escape_string($dbc,$sqlDelete);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Delete', '$activityLog')");
					break;
				case 'editEquip':
					// Set variables, assign "none" to userID if deptID is used
					if ($_POST['deptID'] == "none") {
						$userID = mysqli_real_escape_string($dbc, $_POST['userID']);
						$deptID = "none";
					} else {
						$userID = "";
						$deptID = $_POST['deptID'];	
					}
					
					// Sanitize ticket description and escape special chars for mySQL query
					$equipDesc = mysqli_real_escape_string($dbc, $_POST['equipDesc']);
					$equipSerial = mysqli_real_escape_string($dbc, $_POST['equipSerial']);

					// If a linkID is set in userEquip table:
					if ($_POST['linkID'] !== "none") {
						$sqlEquip = "UPDATE equipment SET equipDesc='$equipDesc', equipSerial='$equipSerial', equipType='{$_POST['equipType']}' WHERE equipID='{$_POST['id']}' LIMIT 1";
						mysqli_query($dbc, $sqlEquip);
						if ($userID == "" && $deptID == "none") { // If no user and dept is set, delete userEquip record
							mysqli_query($dbc, "DELETE FROM userEquip WHERE linkID='{$_POST['linkID']}' LIMIT 1");
						} else { // Otherwise update userEquip record
							mysqli_query($dbc, "UPDATE userEquip SET userID='$userID', deptID='$deptID' WHERE linkID='{$_POST['linkID']}' LIMIT 1");
						}
					} else { // Create a new userEquip link if there isn't one
						$sqlEquip = "UPDATE equipment SET equipDesc='$equipDesc', equipSerial='$equipSerial', equipType='{$_POST['equipType']}' WHERE equipID='{$_POST['id']}' LIMIT 1";
						mysqli_query($dbc, $sqlEquip);
						if ($userID == "") { // Set when no userID is set
							mysqli_query($dbc, "INSERT INTO userEquip (equipID, userID, deptID) VALUES ('{$_POST['id']}', NULL, '$deptID')");
						} else { // Set when no deptID is set
							mysqli_query($dbc, "INSERT INTO userEquip (equipID, userID, deptID) VALUES ('{$_POST['id']}', '$userID', NULL)");
						}	
					}
					// Log edit to database
					$activityLog = mysqli_real_escape_string($dbc,$sqlEquip);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Edit Equip', '$activityLog')");
					break;

				case 'assign':
					// Update ticket and change assignedTo field to help desk's userID, then set status to assigned
					$userID = $_SESSION['userID'];
					$assignSQL = "UPDATE ticket SET assignedTo='" . $userID . "', statusID='2' WHERE ticketID='{$_POST['id']}'";
					//echo $assignSQL;
					mysqli_query($dbc,$assignSQL);
					// Log ticket assignment to database
					$activityLog = mysqli_real_escape_string($dbc,$assignSQL);
					mysqli_query($dbc, "INSERT INTO activityLog (userID, timestamp, type, logDump) VALUES ('{$_SESSION['userID']}', NOW(), 'Assign Ticket', '$activityLog')");

				default:
					break;
			}
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
	// Set some vars
	// Check if sortBy matches current column to determine sort icon
	if (isset($_GET['sortBy']) && isset($_GET['sortOrder'])) {
		if ($_GET['sortBy'] == $col_name->table . "." . $col_name->orgname) {
			if ($_GET['sortOrder'] == "DESC") { // If it's descending, use desc icon
				$sortImg = '<img src="images/sort_desc.png">';
			} else { // Else it's ascending, use asc icon
				$sortImg = '<img src="images/sort_asc.png">';
			}
		} else { // If no match, use the blank sort icon
			$sortImg = '<img src="images/sort_both.png">';
		}
	} else { // if no url params set, default to blank sort icon
		$sortImg = '<img src="images/sort_both.png">';
	}
	

	if (isset($_GET['sortBy']) && isset($_GET['sortOrder'])) { // If something is already set to sorting
		if ($_GET['sortBy'] !== $col_name->table . "." . $col_name->orgname) { // If not sorting by the link that was clicked, set it to the new sort
			$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->table . "." . $col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
			echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "$sortImg</a></th>";
		} else {
			if ($_GET['sortOrder'] == "ASC") { // If it was sorting ascending, swap it to descending
				$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->table . "." . $col_name->orgname,"sortOrder"=>"DESC"))); // Merge/add sort options into url params
				echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "$sortImg</a></th>";
			} else { // Otherwise make it ascending
				$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->table . "." . $col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
				echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "$sortImg</a></th>";
			}
		}
	} else { // If nothing was previously set, add sorting
		$urlParams = http_build_query(array_merge($_GET, array("sortBy"=>$col_name->table . "." . $col_name->orgname,"sortOrder"=>"ASC"))); // Merge/add sort options into url params
		echo "<th><a href=\"?" . $urlParams . "\">" . $col_name->name . "$sortImg</a></th>";
	}
}

function next_page($page) {
	$page++; // Increment page counter upon click
	if ($_SERVER['QUERY_STRING']) { // If there are already url parameters, add page to the end
		$urlParams = http_build_query(array_merge($_GET, array("page"=>$page))); // Build new url params and add/merge page
		echo "<a href=\"?" . $urlParams . "\"><img src=\"images/forward_disabled.png\"></a>";
	} else { // Otherwise set the url parameter to page
		echo "<a href=\"?page=" . $page . "\"><img src=\"images/forward_disabled.png\"></a>";
	}
}

function prev_page($page) {
	$page--; // Increment page counter upon click
	if ($_SERVER['QUERY_STRING']) { // If there are already url parameters, add page to the end
		$urlParams = http_build_query(array_merge($_GET, array("page"=>$page))); // Build new url params and add/merge page
		echo "<a href=\"?" . $urlParams . "\"><img src=\"images/back_disabled.png\"></a>";
	} else { // Otherwise set the url parameter to page
		echo "<a href=\"?page=" . $page . "\"><img src=\"images/back_disabled.png\"></a>";
	}
}

function pagination_links($numRows,$rowsPerPage,$page) {
	//echo '<div class="large-6 columns">';
	//echo '<div class="large-4 columns">';
	// First determine number of pages needed
	// Form logic for entering a page number manually
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . '">';
	echo "<div class='row'>";
	echo "<div class='row collapse'>";
	echo "<div class='small-6 columns'>";		
	echo '<input type="text" name="pageNo" placeholder="' . $page . '">';
	echo "</div>";
	echo "<div class='small-6 columns'>";		
	echo '<input class="success button postfix" type="submit" value="Jump to Page">';
	echo "</div>";
	echo "</div>";
	echo "</div>";		
	echo '</form>';

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
	echo $page;
	// Next page link
	if (!($page >= $numPages)) {
		next_page($page);
	}

	// List total page number
	echo "<p>Number of pages: $numPages</p>";
}

function search_filter() {
	// Form for submitting search filter string
	// Reset page counter back to 1 when submitting form
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET) . '">';
	echo "<div class='row'>";
	echo "<div class='row collapse'>";
	echo "<div class='small-10 columns'>";
	echo '<input type="text" name="searchFilter" placeholder="' . "Search..." . '">';
	echo "</div>";
	echo "<div class='small-2 columns'>";
	echo '<input class="success button postfix" type="submit" value="Search">';
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo '</form>';
}

function output_table($sql,$tableName,$view,$edit,$delete) {
	global $dbc;
	
	// Set sorting and page variables
	if (isset($_GET['sortBy'])) {
		$sortBy = mysqli_real_escape_string($dbc,$_GET['sortBy']);
	} else {
		$sortBy = null;
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
		//array_merge($_GET, array("page"=>"1"));
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
		//$page = 1;
	} else {
		$rowsPerPage = 10;
		$pageOffset = $page * $rowsPerPage - $rowsPerPage;	
	}
	
	// Set sort parameters for SQL query
	$sortParams = null;
	if ($sortBy) {
		$sortParams = "ORDER BY $sortBy $sortOrder";
	} else {
		// Overrides to sort order for errorLog and activityLog to show newest records first
		if (preg_match("/alltables.php/", $_SERVER['PHP_SELF'])) {// Make sure to only do this part on alltables page
			if (isset($_SESSION['tableSelect']) && $_SESSION['tableSelect'] == "activityLog") {
				$sortParams = "ORDER BY logID DESC";
			}
			if (isset($_SESSION['tableSelect']) && $_SESSION['tableSelect'] == "errorLog") {
				$sortParams = "ORDER BY errorID DESC";
			}
		}
	}
	
	$result = mysqli_query($dbc,$sql . " " . $searchParams);
	if ($result) {
		$numRows = mysqli_num_rows($result);
	} else {
		$numRows = "0";
	}
	
	$result = mysqli_query($dbc, $sql . " " . $searchParams . $sortParams . " LIMIT $pageOffset, $rowsPerPage");
	//echo $sql . " " . $searchParams . $sortParams . " LIMIT $pageOffset, $rowsPerPage";
	if ($result) { // If records were found...
		//echo mysqli_error($dbc);
		$numCols = mysqli_num_fields($result);
		
		// *********** I have no idea how the hell to format these things here
		echo "<div class='row'>";
		echo "<div class='large-3 columns'>";
		pagination_links($numRows,$rowsPerPage,$page);
		echo '</div>';
		echo "<div class='large-3 columns'>";
		echo "</div>";
		echo "<div class='large-6 columns'>";
		search_filter();
		echo '</div>';
		echo "</div>";

		echo '<div class="row">';

		// Begin table
		echo "<table id=\"" . "tbl_" . $tableName . "\">";

		// Build table head
		echo "<thead>";
		echo "<tr>";

		// Insert edit/delete column if selected
		if ($view || $edit || $delete) {
			echo "<th>";
			echo "<a href=\"\">Action</a>";
			echo "</th>";
		}

		// Continue building table head
		$columnList = [];
		while ($col_name = mysqli_fetch_field($result)) { // While more columns exist...
			column_sort($col_name); // Output table column name with sort links
			// Store column names in an arrya for later use
			array_push($columnList, $col_name->orgname);
		}
		//print_r($columnList);
		echo "</tr>";
		echo "</thead>";

		// Build table body
		echo "<tbody>";

		if (!$rows=mysqli_fetch_row($result)) { // If no records are returned...
			echo "<tr><td>No Entries Found.</td></tr>";
		}
		// Reset pointer after above empty check, otherwise we lose first record
		mysqli_data_seek($result,0);
		
		while ($rows=mysqli_fetch_array($result)) { // While more rows exist...			

			echo "<tr>";

			// Insert View/Edit/Delete options if enabled
			if ($view || $edit || $delete) {
			echo "<th>";
			if ($view) { // Anyone can view
				echo "<a data-reveal-id=\"viewRecord\" id=\"view" . $rows['0'] . "\" class=\"?viewid=" . $rows['0'] . "&assignedTo=" . $rows['8'] . "\" href=\"#\"><img src=\"images/view.png\"></a>";
			}
			if ($edit && ($_SESSION['privLevel'] == '2' || $_SESSION['privLevel'] == '4')) { // Make certain only help desk and admins can edit
				echo "<a data-reveal-id=\"editRecord\" id=\"edit" . $rows['0'] . "\" class=\"?table=" . $tableName . "&id=" . $rows['0'] . "\" href=\"#\" id=\"edit" . $rows['0'] . "\"><img src=\"images/edit.png\"></a>";
			}
			if ($delete && $_SESSION['privLevel'] == '4') { // Make certain only admins can delete
				echo "<a data-reveal-id=\"deleteRecord\" id=\"delete" . $rows['0'] . "\" class=\"?delete=" . $rows['0'] . "&table=" . $tableName . "\" href=\"#\"><img src=\"images/delete.png\"></a>";
			}
			echo "</th>";
		
		}
			for ($col_num=0; $col_num < $numCols; $col_num++) { // Run through $numCols number of columns each row
				echo "<td>";
				
				if ($columnList[$col_num] == "username") { // If it's a username column
					//echo "Username!";
					//echo $rows[$col_num]; // Echo out username
					echo '<a data-reveal-id="newMessage" href="#" id="message' . $rows[0] . '"class="?username=' . $rows[$col_num] . '">' . $rows[$col_num] . '</a>';
				} elseif ($columnList[$col_num] == "assignedTo") { // If it's an AssignedTo column
					//echo "AssignedTo!";
					
					if ($rows[$col_num]) { // If a help desk person is listed...
						$assignedTo = $rows[$col_num]; // Store assignedTo userID
						// Query SQL for the username of specified help desk person since we cannot join ticket table on username twice, use separate query
						$assignedToSQL = "SELECT user.username FROM user JOIN ticket ON ticket.assignedTo=user.userID WHERE ticket.assignedTo='$assignedTo'";
						$assignedToResult = mysqli_query($dbc,$assignedToSQL);
						while ($assignedToRows=mysqli_fetch_array($assignedToResult)) { // While more rows exist...	
							// Echo out username of help desk person with link to message user
							echo '<a data-reveal-id="newMessage" href="#" id="message' . $rows[0] . '"class="?username=' . $assignedToRows[0] . '">' . $assignedToRows[0] . '</a>';
							//echo $assignedToRows[0];
							// Not sure why this loops, so break out after listing help desk username once
							break;
						}
					} else {
						if ($_SESSION['privLevel'] == '2' || $_SESSION['privLevel'] == '4') { // Make sure user is help desk or admin to be able to assign themselves
							//echo "UNASSIGNED";
							// Make a link to allow assigning ticket to self
							echo '<span id="assign' . $rows[0] . '"><a data-reveal-id="assign" href="#" class="tiny success button" id="?ticketID=' . $rows[0] . '">Click to Assign</a></span>';
						} else { // If user or manager, just list as unassigned
							echo "Unassigned";
						}
					}
				} else { // For everything else...
					echo $rows[$col_num]; // Spit out data for specified column on this row
				}
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</tbody>";

		// Close table
		echo "</table>";
		echo "</div>";

	} else { // SQL query returned no records
		pagination_links($numRows,$rowsPerPage,$page);
		search_filter();
		echo "<p>No Results.</p>";
	}

	// Include modal divs for view/edit/delete functions
	echo '<div id="viewRecord" class="reveal-modal" data-reveal></div>';
	echo '<div id="editRecord" class="reveal-modal" data-reveal></div>';
	echo '<div id="deleteRecord" class="reveal-modal" data-reveal></div>';
	echo '<div id="assign" class="reveal-modal" data-reveal>Testing</div>';
	
}

?>

</div>
</body>
</html>
