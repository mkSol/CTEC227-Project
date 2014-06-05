$(document).ready(function(){

	// =========================== Uncategorized ============================
	
	// Parse cokies for given cookie name and return value
	function checkCookie(cookieName) {
		var name = cookieName + "=";
		var allCookies = document.cookie.split(';');
		for(var i=0; i<allCookies.length; i++) {
			var cookie = allCookies[i].trim();
			if (cookie.indexOf(name)==0) {
				return cookie.substring(name.length,cookie.length);
			}
		}
		return "";
	}

	function setScrollPos() {
		document.cookie='scrollPosition=' + window.pageYOffset;	
	}

	function keepScroll() {
		//alert("!");
		window.scrollTo(0,checkCookie('scrollPosition'));
	}

	// Load Foundation
	$(document).foundation();

	// Load confirm assign modal
	$('span').on('click', 'a', function() {
		var id = $(this).attr('id');
		$('#assign').load('incl/confirmassign.inc.php' + id);
	});

	// =========================== Navigation Page ============================

	// Load new ticket modal
	$('.newTicketLink').on('click', 'a', function() {
		$('#newTicket').load('incl/newticket.inc.php');
	});

	// Load new message modal
	$('.newMessage').on('click', 'a', function() {
		$('#newMessage').load('incl/newmessage.inc.php');
	});

	// Load new message modal from a clicked username to pre=populate msgTo slot
	$('table').on('click', '[id^=message]', function() {
		var id = $(this).attr('class');
		$('#newMessage').load('incl/newmessage.inc.php' + id);
	});

	// =========================== My Tickets Page ============================

	// Load in ticket details for view modal
	$('#myTickets').on('click', '[id^=view]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#viewRecord').load('incl/viewticket.inc.php' + id);
	});

	// Load edit details confirmation modal
	$('#myTickets').on('click', '[id^=edit]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyticket.inc.php' + id);
		//$('#editTicketTimestamp').AnyTime_picker();
	});

	// Load delete confirmation modal
	$('#myTickets').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdelete.inc.php' + id);
	});	

	// =========================== Assigned Tickets Page ============================

	// Load in ticket details for view modal
	$('#assignedTickets').on('click', '[id^=view]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#viewRecord').load('incl/viewticket.inc.php' + id);
	});

	// Load edit details confirmation modal
	$('#assignedTickets').on('click', '[id^=edit]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyticket.inc.php' + id);
		//$('#editTicketTimestamp').AnyTime_picker();
	});

	// Load delete confirmation modal
	$('#assignedTickets').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdelete.inc.php' + id);
	});	

	// =========================== All Tickets Page ============================

	// Load in ticket details for view modal
	$('#allTickets').on('click', '[id^=view]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#viewRecord').load('incl/viewticket.inc.php' + id);
	});

	// Load edit details confirmation modal
	$('#allTickets').on('click', '[id^=edit]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyticket.inc.php' + id);
		//$('#editTicketTimestamp').AnyTime_picker();
	});

	// Load delete confirmation modal
	$('#allTickets').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdelete.inc.php' + id);
	});	

	// =========================== My Equipment Page ============================

	// Load in equip details for edit modal
	$('#myEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyequip.inc.php' + id);
	});

	// =========================== All Equipment Page ============================

	// Load in equip details for edit modal
	$('#tbl_UserEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyequip.inc.php' + id);
	});

	// Load in equip details for edit modal
	$('#tbl_DeptEquip').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyequip.inc.php' + id);
	});

	// Load in equip details for edit modal
	$('#tbl_equipment').on('click', 'a', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifyequip.inc.php' + id);
	});

	// Load delete confirmation modal
	$('#tbl_equipment').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdeletedynamic.inc.php' + id);
	});	

	// =========================== All Tables Page ============================

	// Load edit details modal
	$('#allTables').on('click', '[id^=edit]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#editRecord').load('incl/modifydynamic.inc.php' + id);
	});

	// Load delete confirmation modal
	$('#allTables').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdeletedynamic.inc.php' + id);
	});

	// =========================== Error Logs Page ============================

	// Load delete confirmation modal
	$('#tbl_errorLog').on('click', '[id^=delete]', function() {
		var id = $(this).attr('class');
		// Append url parameters to load request
		$('#deleteRecord').load('incl/confirmdeletedynamic.inc.php' + id);
	});	

});