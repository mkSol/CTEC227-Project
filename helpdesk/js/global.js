$(document).ready(function(){

	// Call DataTables plugin for tables that need sort and filter
	$('#alltickets_table').dataTable();
	$('#allequip_table').dataTable();
	$('#viewalltickets_table').dataTable();
	$('#viewalltickets_table').dataTable();
	$('#assignedtickets_table').dataTable();
	$('#mytickets_table').dataTable();
	$('#myequip_table').dataTable();
	$('#errorlogs_table').dataTable();

	$('#allTickets a').bind('click', function(e) {
		//alert("!");
		var id = $(this).attr('class');
		$('#editTicket').load('incl/modifyticket.inc.php' + id);
	});

	/*
	function confirmDelete() {
		if (confirm("Are you sure you wish to remove this ticket?"))
		{
			$('#editTicket').load('incl/modifyticket.inc.php' + id);
		}
	}
	*/
});