<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$orderId = $_POST['orderId'];




  $saleDate 		        = $_POST['saleDate'];
  $clientName 				= $_POST['clientName'];
  $clientContact 			= $_POST['clientContact'];
  $clientCnic 				= $_POST['clientCnic'];
  $paymentType 				= $_POST['paymentType'];
  $dueValue 				= $_POST['dueValue'];
  $paid 				    = $_POST['paid'];
  $subTotalValue 		    = $_POST['grandTotalValue'];
  $paymentStatus 			= $_POST['paymentStatus'];
  $vatValue 				= $_POST['vatValue'];
  $discount 				= $_POST['discount'];
  
  
  
  
    $date                     = date('Y-m-d');
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Sale ID: " . $orderId  ." to Client Name: " . $clientName ." edited by user name: " . $userName ;
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	
				
	$sql = "UPDATE sale SET sale_date = '$saleDate', client_name = '$clientName', client_address = '$clientContact', client_nic = '$clientCnic',  grand_total = '$subTotalValue', paid = '$paid', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status= '$paymentStatus', vat = '$vatValue', discount='$discount'  WHERE sale_id = {$orderId}";	
	$connect->query($sql);


	// remove the Sale item data from order item table
	for($x = 0; $x < count($_POST['prdCode']); $x++) {			
		$removeOrderSql = "DELETE FROM sale_details WHERE sale_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	
			// insert the order item data 
		for($x = 0; $x < count($_POST['prdCode']); $x++) {			
		$orderItemSql = "INSERT INTO sale_details 
					VALUES ('$orderId', '".$_POST['prdCode'][$x]."', '".$_POST['prdRate'][$x]."')";

				$connect->query($orderItemSql);		
			} // while	
	
	

	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);