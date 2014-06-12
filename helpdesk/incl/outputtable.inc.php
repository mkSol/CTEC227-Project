<?php 
require("sqlConnect.inc.php");
session_start();

// Outputs contets of SQL query results to a CSV spreadsheet
$sql = $_SESSION['sql'];
$result = mysqli_query($dbc, $sql);
$outfile = "";
$colCount = 0;

// Get column titles
while ($col_name = mysqli_fetch_field($result)) {
	$outfile .= '"' . $col_name->orgname . '",'; 
	$colCount++;
}
$outfile .= "\n"; // New line
while ($rows = mysqli_fetch_array($result)) {
	for ($col=0; $col < $colCount; $col++) { 
		$outfile .= '"' . $rows[$col] . '",'; 
	}
	$outfile .= "\n"; // New line
}
//$file = fopen("exportTable.csv", "w"); // Open file handler
//fwrite($file, $outfile); // Write table data to file
//fclose($file); // Close file handler

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename='exportTable.csv'");
//readfile("exportTable.csv");
echo $outfile;

?>