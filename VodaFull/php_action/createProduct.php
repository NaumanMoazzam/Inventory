<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName 		= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $rate 					= $_POST['rate'];
  $brandName 			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];
  $vendorName 			= $_POST['vendorName'];

	 $userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Product Name: " . $productName ." addedd by user name: " . $userName ;
	$date = date('Y-m-d');
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
  
  
    $fetchExpenseLimit = mysqli_query($connect,"Select exp_rg_max from expense_range Order By id DESC limit 1");
    $range = "";
    while($rows = mysqli_fetch_array($fetchExpenseLimit))
    { $range = $rows[0]; }

    $fetchCurrentExpense = mysqli_query($connect,"Select SUM(exp_amount) as total  from expense where MONTH(exp_date) =MONTH(NOW())");
    $currentExpense = "";
    while($rowss = mysqli_fetch_array($fetchCurrentExpense))
    { $currentExpense = $rowss[0]; }
    
    $currentExpense = $currentExpense + ($quantity * $rate);
    $amountt = ($quantity * $rate);
    if ($currentExpense > $range) {
    		 	$valid['success'] = false;
    			$valid['messages'] = "Expense exced the limit";
    }
    else
    {
    	$type = explode('.', $_FILES['productImage']['name']);
    	$type = $type[count($type)-1];		
    	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
    	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
    		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
    			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
    				$act = $productName . ' Purchased';
    				mysqli_query($connect,"INSERT INTO expense (exp_amount,exp_purpose,exp_date) VALUES ('$amountt','$act','$date')" );
    				
    				$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, quantity, rate, active, status , vendor_id) 
    				VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1, '$vendorName')";
    
                    $product_id;
    				if($connect->query($sql) === TRUE) {
    				    $product_id = $connect->insert_id;
    				    mysqli_query($connect, "INSERT INTO vendor_installment (vendor_id, prd_id, amount, installmentDate, installment_type) VALUES ('$vendorName','$product_id',0,'$date','None')");
    					$valid['success'] = true;
    					$valid['messages'] = "Successfully Added";	
    				} else {
    					$valid['success'] = false;
    					$valid['messages'] = "Error while adding the members";
    				}
    
    			}	else {
    				return false;
    			}	// /else	
    		} // if
    	} // if in_array 		
    }

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST