<?php
// This include file outputs alert boxes on screen depending on the submitType of POST
if (isset($_POST['submitType'])) {
		echo '<div class="row">';
		switch ($_POST['submitType']) {
			case 'newPass':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your password has been updated.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'newMessage':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your message has been sent.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'newTicket':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your ticket has been submitted.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'editDynamic':
				echo '<div data-alert class="alert-box success radius">';
				echo "Record has been updated.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;
			
			case 'edit':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been updated.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'comment':
				echo '<div data-alert class="alert-box success radius">';
				echo "Your comment has been submitted.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'deleteDynamic':
				echo '<div data-alert class="alert-box success radius">';
				echo "Record has been deleted.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'delete':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been deleted.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'editEquip':
				echo '<div data-alert class="alert-box success radius">';
				echo "Equipment has been updated.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;

			case 'assign':
				echo '<div data-alert class="alert-box success radius">';
				echo "Ticket has been assigned to you.";
				echo '<a href="#" class="close">&times;</a>';
				echo '</div>';
				break;
			
			default:
				# code...
				break;
		}
		echo '</div>';
	}
?>