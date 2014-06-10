<?php 
function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
	global $dbc;
	// Print out user-friendly error message
	echo "<p>An error has occured. Please try again later. If problem persists, contact an administrator.";

	/*
	echo "WARNING!";
	echo "<pre>Errno: $errno</pre>";
	echo "<pre>Errstr: $errstr</pre>";
	echo "<pre>Errfile: $errfile</pre>";
	echo "<pre>Errline: $errline</pre>";
	echo "<pre>Errcontext: " . print_r($errcontext) . "</pre>";
	*/

	// Submit error data to database
	mysqli_query($dbc, "INSERT INTO errorLog (errorNo, errorLine, errorFile, errorStr, timestamp) VALUES ('$errno', '$errline', '$errfile', '$errstr', NOW())") or die(mysqli_error($dbc));
	//echo "INSERT INTO errorLog (errorNo, errorLine, errorFile, errorStr, timestamp) VALUES ('$errno', '$errline', '$errfile', '$errstr', NOW())";
	// Break out of errors so message is only displayed once, no matter how many errors occur
	//die();

	// Prevent default err handler from activating
	return true;
}

// Enable custom error handler
set_error_handler("errorHandler");

?>