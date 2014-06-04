<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<?php 
	include("incl/scripts.inc.html");
	?>
</head>
<body>
	<div>
		<a data-reveal-id="newTicket" href="#">Test Modal 1</a>
		<a data-reveal-id="newMessage" href="#">Test Modal 2</a>
	</div>
	<div id="newTicket" class="reveal-modal" data-reveal>Test 1 Success!<a data-reveal-id="newMessage" href="#">Test Modal 2</a></div>
	<div id="newMessage" class="reveal-modal" data-reveal>Test 2 Success!<a data-reveal-id="newTicket" href="#">Test Modal 1</a></div>
</body>
</html>