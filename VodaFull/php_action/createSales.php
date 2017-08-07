<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

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
  //discount
   
	$date = date('Y-m-d');
	
	$sql = "INSERT INTO sale (client_name, client_nic, client_address, sale_date, grand_total, paid, due, payment_type, payment_status, vat, discount ) VALUES ('$clientName', '$clientCnic','$clientContact','$date','$subTotalValue','$paid','$dueValue','$paymentType','$paymentStatus','$vatValue','$discount')";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Sale ID: " . $order_id  ." to Client Name: " . $clientName ." addedd by user name: " . $userName ;
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
		// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['prdCode']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity,product.product_id FROM product Inner Join product_detail On product.product_id = product_detail.prd_id WHERE product_detail.prd_code = ".$_POST['prdCode'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			if ($updateProductQuantityResult[0] > 0)
			{
				$updateQuantity[$x] = $updateProductQuantityResult[0] - 1;	
				$updateProductId[$x] = $updateProductQuantityResult[1];
					// update product table
					$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$updateProductId[$x]."";
					$connect->query($updateProductTable);

					// add into order_item
					$orderItemSql = "INSERT INTO sale_details 
					VALUES ('$order_id', '".$_POST['prdCode'][$x]."', '".$_POST['prdRate'][$x]."')";

					$connect->query($orderItemSql);		
                	$prd = $_POST['prdCode'][$x];
				    mysqli_query($connect,"Delete from cart where prd_code= $prd");
			}				
		} // while	
		if($x == count($_POST['prdCode']) -1) {
						$orderItemStatus = true;
					}
	} // /for quantity
	

        //For Installment
    	mysqli_query($connect, "INSERT into cust_installment ( cus_nic, sale_id, amount, install_date, install_type) VALUES ('$clientCnic','$order_id','$paid','$date','$paymentType')");
	
	if ($orderItemStatus == true)
		{
			mysqli_query($connect,"Delete from cart");
		}

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);