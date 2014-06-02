<?php 
	require("sqlConnect.inc.php");
	if (isset($_GET['table'])) {
		$sql = "SELECT * FROM " . $_GET['table']; // Basic general query for table passed in via url params
		//echo "SELECT * FROM " . $_GET['table'];
		$result = mysqli_query($dbc,$sql);
		
		// Setup var to hold all column names
		$columns = [];
		while ($col_name = mysqli_fetch_field($result)) { // Get columns and loop through each
			array_push($columns, $col_name->name); // Store column names in array
		}
		$sql = "SELECT * FROM " . $_GET['table'] . " WHERE " . $columns[0] . " = '" . $_GET['id'] . "'"; // Search table and pick selected record
		$result = mysqli_query($dbc,$sql);
		
		echo '<h1>Edit ID: ' . $_GET['id'] . '</h1>';
		// Open form
		echo '<form action="#" method="post">';
		// Include hidden field to identify table being edited
		echo '<input type="hidden" name="table" value="' . $_GET['table'] . '">';
		// Include hidden field of sybmitType so result page knows how to process this form (As EDIT)
		echo '<input type="hidden" name="submitType" value="editDynamic">';

		while ($rows = mysqli_fetch_row($result)) { // Get record rows and loop through each
			$count = 0; // Set counter for row placement
			$firstField = true;
			echo '<div class="row">' . "\n"; // Open a row before the loops
			for ($i=0; $i < count($columns); $i++) { 
				if ($count == 2) {
					echo '<div class="row">' . "\n"; // Open row
					$count = 0;
				}
				echo '<div class="large-6 columns">' . "\n"; // Open row
				// Input label and text input for data for this loop iteration
				echo '<label>' . $columns[$i] . ': </label>';
				if ($firstField) { // Make first field (ID) read-only
					echo '<input type="text" name="' . $columns[$i] . '" value="' . $rows[$i] . '" readonly="true">';
				} else {
					echo '<input type="text" name="' . $columns[$i] . '" value="' . $rows[$i] . '">';
				}
				$firstField = false; // Invalidate firstField var after firing once
				echo '</div>' . "\n"; // Close column
				$count++;
				if ($count == 2) {
					echo '</div>' . "\n"; // Close row
				}
			}
			// Submit button
			echo '<input type="submit" value="Edit" class="button">';
			// Close form
			echo '</form>';
			// Close modal button
			echo '<a class="close-reveal-modal">&#215;</a>';
		}
	}

	?>