var manageCustomerTable;

$(document).ready(function() {
	// top bar active
	$('#navCustomer').addClass('active');
	
	// manage brand table
	manageCustomerTable = $("#manageCustomerTable").DataTable({
		'ajax': 'php_action/fetchCustomer.php',
		'order': []		
	});
	});

	





