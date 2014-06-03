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
	$(document).foundation({
		abide: {
			patterns: {  // 2013-01-26 00:00:00
				mysqldatetime: /^[0-9][0-9][0-9][0-9]\-[0-9][0-9]-[0-9][0-9]\ [0-9][0-9]\:[0-9][0-9]\:[0-9][0-9]&/
				//mysqldatetime: /^((([0-9]{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|(([0-9]{4})(-)(0[469]|1‌​1)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468]‌​[048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(0‌​2)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02‌​)(-)(29)))([ ]([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))$/
			}
		}
	});

	// Call DataTables plugin for all tables to add sort and filter
	//$('table').dataTable({paging: false});

	// =========================== Navigation Page ============================

	// Load new ticket modal
	$('.newTicketLink').on('click', 'a', function() {
		$('#newTicket').load('incl/newticket.inc.php');
	});

	// Load new message modal
	$('.newMessage').on('click', 'a', function() {
		$('#newMessage').load('incl/newmessage.inc.php');
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

});