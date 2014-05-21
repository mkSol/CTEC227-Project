$(document).ready(function(){
	$('#testlink').click(function(event) {
	//	alert("!");
		var id = $(this).attr('class');
		alert(id);
		$('#testdiv').load('sql1.php' + id);
	});
});