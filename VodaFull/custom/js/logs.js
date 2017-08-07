var manageLogsTable;

$(document).ready(function() {

	// top bar active
	$('#navLogs').addClass('active');
	
	// manage brand table
	manageLogsTable = $("#manageLogsTable").DataTable({
		'ajax': 'php_action/fetchLogs.php',
		'order': []		
	});
	});