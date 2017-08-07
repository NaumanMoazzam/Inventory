<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName 		= $_POST['brandName'];
  // $productImage 	= $_POST['productImage'];
  $barCode 			= $_POST['barCode'];
	$date = date('Y-m-d');
				
				$userId = $_SESSION['userId'];
				$userName = $_SESSION['userName'];
				$activity = "Product Code: " . $barCode ." addedd by user name: " . $userName ;
				
				
				mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	
				$sql = "INSERT INTO product_detail (prd_id, prd_code, add_date) 
				VALUES ('$brandName', '$barCode', '$date')";

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