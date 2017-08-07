<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$vendorName = $_POST['vendorName'];
  $vendorAddress = $_POST['vendorAddress']; 
$vendorCell = $_POST['vendorCell']; 
$vendorCnic = $_POST['vendorCnic']; 
//vendorCnic
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Vendor Name: " . $vendorName ." addedd by user name: " . $userName ;
	$date = date('Y-m-d');
	
	
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	$sql = "INSERT INTO vendor (vendor_name, vendor_address, vendor_cell,cnic) VALUES ('$vendorName', '$vendorAddress', '$vendorCell','$vendorCnic')";

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