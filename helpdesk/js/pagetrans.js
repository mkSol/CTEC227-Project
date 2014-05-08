
$(document).ready(function(){
	// Hide all pages by default on page load
	$("#myTickets,#allTickets").css("display", "none");

	// When My Tickets link is clicked
	$("a.myTickets").click(function(event) {
		// Hide pages not in use
		$("#allTickets").fadeOut(500, function(){
			// Wait for fade out before fading in selected page
			$("#myTickets").fadeIn(500);
		});
		
	});

	// When All Tickets link is clicked
	$("a.allTickets").click(function(event) {
		// Hide pages not in use
		$("#myTickets").fadeOut(500, function(){
			// Wait for fade out before fading in selected page
			$("#allTickets").fadeIn(500);
		});
		
	});
});