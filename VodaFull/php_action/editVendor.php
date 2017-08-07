<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editVendorName = $_POST['editVendorName'];
  $editVendorAddress = $_POST['editVendorAddress']; 
  $editVendorCell = $_POST['editVendorCell']; 
  $brandId = $_POST['brandId'];

  	$date    = date('Y-m-d');
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Vendor Name: " . $editVendorName  ." edited by user name: " . $userName ;
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	$sql = "UPDATE vendor SET vendor_name = '$editVendorName', vendor_address = '$editVendorAddress' WHERE vendor_id = '$brandId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST