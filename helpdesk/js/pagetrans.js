$(document).ready(function(){
	
	//alert(checkCookie("currentPage"));

	// Create array with all page divs for navigation
	var pages = ['#allTickets','#myTickets','#allEquip','#allTickets','#newTicket','#myEquip',"#viewAllTickets","#viewAllEquip","#errorLogs","#assignedTickets"];

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

	// Hide all unwanted pages except page specified
	function hideAllPagesExcept(page) {
		for (var p = 0; p < pages.length; p++) {
			//alert(pages[p]);
			$(pages[p]).css("display", "none");
			$(page).css("display", "block");	
		};
	}

	// Function to navigate to page and hide other pages
	function pageTrans(navlink,dest) {
		$(navlink).click(function(event) {
			for (var p = 0; p < pages.length; p++) {
				// Cycle through pages array and hide them all
				//alert(pages[p]);
				$(pages[p]).fadeOut(500);	
			};
			// Guarantee everything is faded before fading in page
			setTimeout(function(){
				// Then unhide the needed page
				$("#" + dest).fadeIn(500);	
			}, 500);
			// Set current page cookie
			document.cookie = "currentPage=" + dest + "; expires=0; path=/";	
		});
	}

	// Check privilege level to determine which page to load upon refresh
	switch(checkCookie("privLevel")) {
		case "1": // User level
			switch(checkCookie("currentPage")) {
				case "default":
					hideAllPagesExcept("#myTickets");
					break;
				case "myTickets":
					hideAllPagesExcept("#myTickets");
					break;
				case "newTicket":
					hideAllPagesExcept("#newTicket");
					break;
				case "myEquip":
					hideAllPagesExcept("#myEquip");
					break;
			}
			break;
		case "2": // Help Desk level
			switch(checkCookie("currentPage")) {
				case "default":
					hideAllPagesExcept("#allTickets");
					break;
				case "myTickets":
					hideAllPagesExcept("#myTickets");
					break;
				case "allTickets":
					hideAllPagesExcept("#allTickets");
					break;
				case "newTicket":
					hideAllPagesExcept("#newTicket");
					break;
				case "myEquip":
					hideAllPagesExcept("#myEquip");
					break;
				case "assignedTickets":
					hideAllPagesExcept("#assignedTickets");
					break;
			}
			break;
		case "3": // Manager level
			switch(checkCookie("currentPage")) {
				case "default":
					hideAllPagesExcept("#viewAllTickets");
					break;
				case "myTickets":
					hideAllPagesExcept("#myTickets");
					break;
				case "viewAllTickets":
					hideAllPagesExcept("#viewAllTickets");
					break;
				case "newTicket":
					hideAllPagesExcept("#newTicket");
					break;
				case "myEquip":
					hideAllPagesExcept("#myEquip");
					break;
				case "viewAllEquip":
					hideAllPagesExcept("#viewAllEquip");
					break;
			}
			break;
		case "4": // Sys Admin level
			//alert(checkCookie("currentPage"));
			switch(checkCookie("currentPage")) {
				case "default":
					hideAllPagesExcept("#allEquip");
					break;
				case "myTickets":
					hideAllPagesExcept("#myTickets");
					break;
				case "allTickets":
					hideAllPagesExcept("#allTickets");
					break;
				case "newTicket":
					hideAllPagesExcept("#newTicket");
					break;
				case "myEquip":
					hideAllPagesExcept("#myEquip");
					break;
				case "allEquip":
					hideAllPagesExcept("#allEquip");
					break;
				case "assignedTickets":
					hideAllPagesExcept("#assignedTickets");
					break;
				case "errorLogs":
					hideAllPagesExcept("#errorLogs");
					//alert("test");
					break;
			}
			break;
	}

	// Dashboard link page transitions
	pageTrans("a.myTickets","myTickets");
	pageTrans("a.allTickets","allTickets");
	pageTrans("a.newTicket","newTicket");
	pageTrans("a.assignedTickets","assignedTickets");
	pageTrans("a.myEquip","myEquip");
	pageTrans("a.allEquip","allEquip");
	pageTrans("a.errorLogs","errorLogs");
	pageTrans("a.viewAllEquip","viewAllEquip");
	pageTrans("a.viewAllTickets","viewAllTickets");


	// Testing modal functionality
	/*
	$('#newTicketss').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });

	$('#new_ticket_form').submit(function() {
		$("$newTicket").css.display("none");
		return false;
	});
	*/

});