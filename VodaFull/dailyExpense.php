<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

$expAmount  = $_POST['expAmount']; 
$expPurpose = $_POST['expPurpose']; 
$date = date('Y-m-d');
	$sql = "INSERT INTO expense (exp_amount,exp_purpose,exp_date) VALUES ('$expAmount', '$expPurpose', '$date')";

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