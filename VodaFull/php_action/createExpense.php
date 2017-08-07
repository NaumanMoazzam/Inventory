<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
$maxAmount = $_POST['maxAmount']; 
$date = date('Y-m-d');

	$sql = "INSERT INTO expense_range (exp_rg_min,exp_rg_max,exp_rg_date) VALUES (0, '$maxAmount', '$date')";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST