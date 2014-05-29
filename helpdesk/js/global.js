$(document).ready(function(){

	// =========================== Uncategorized ============================
	
	// Load Foundation
	$(document).foundation();

	// Call DataTables plugin for all tables to add sort and filter
	$('table').dataTable();

	// Load new ticket modal
	$('.newTicketLink').on('click', 'a', function() {
		$('#newTicket').load('incl/newticket.inc.php');
	});

	// =========================== All Tickets Page ============================

	// Load in ticket details for edit modal
	$('#allTickets').on('click', '[id^=edit]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editTicket').load('incl/modifyticket.inc.php' + id);
	});


	$(document).ajaxStop(function() {
		//alert("!");
		//$('#editTicketTimestamp').AnyTime_picker();
	});

	// Load in ticket details for view modal
	$('#allTickets').on('click', '[id^=view]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#viewTicket').load('incl/viewticket.inc.php' + id);
	});

	// Load delete confirmation modal
	$('#allTickets').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteTicket').load('incl/confirmdelete.inc.php' + id);
	});

	// =========================== Edit Ticket ============================

	

	// =========================== All Equipment Page ============================

	// Hide equipment listings for dept and unassigned by default on load
	$('#deptEquip').hide();
	$('#unassignedEquip').hide();

	$('#showUserEquip').click(function() {
		$('#deptEquip').hide();
		$('#unassignedEquip').hide();
		$('#userEquip').fadeIn(500);
	});

	$('#showDeptEquip').click(function() {
		$('#userEquip').hide();
		$('#unassignedEquip').hide();
		$('#deptEquip').fadeIn(500);
	});

	$('#showUnassignedEquip').click(function() {
		$('#deptEquip').hide();
		$('#userEquip').hide();
		$('#unassignedEquip').fadeIn(500);
	});

	// Load in equip details for edit modal
	$('#userEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editEquip').load('incl/modifyequip.inc.php' + id);
	});

	// Load in equip details for edit modal
	$('#deptEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editEquip').load('incl/modifyequip.inc.php' + id);
	});

	// Load in equip details for edit modal
	$('#unassignedEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editEquip').load('incl/modifyequip.inc.php' + id);
	});

	/*
	function confirmDelete() {
		if (confirm("Are you sure you wish to remove this ticket?"))
		{
			$('#editTicket').load('incl/modifyticket.inc.php' + id);
		}
	}
	*/

	// =========================== All Tables Page ============================


});