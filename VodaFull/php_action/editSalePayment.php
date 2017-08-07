<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$orderId 					= $_POST['orderId'];
	$payAmount 				= $_POST['payAmount']; 
  $paymentType 			= $_POST['paymentType'];
  $paidAmount        = $_POST['paidAmount'];
  $grandTotal        = $_POST['grandTotal'];
  $cuNic             = $_POST['cuNic'];	
  
	$date    = date('Y-m-d');
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Payment against SALE: " . $orderId  ." edited by user name: " . $userName ;
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
  
  
  $updatePaidAmount = $payAmount + $paidAmount;
  $updateDue = $grandTotal - $updatePaidAmount;

	$sql = "UPDATE sale SET paid = '$updatePaidAmount', due = '$updateDue', payment_type = '$paymentType' WHERE sale_id = {$orderId}";

	if($connect->query($sql) === TRUE) {
	    mysqli_query($connect, "INSERT into cust_installment ( cus_nic, sale_id, amount, install_date, install_type) VALUES ('$cuNic','$orderId','$payAmount','$date','$paymentType')");
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	 
$connect->close();

echo json_encode($valid);
 
} // /if $_POST