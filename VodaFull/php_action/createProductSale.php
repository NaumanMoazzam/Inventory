<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$prdCode 		= $_POST['prdCode'];
 
 
	$date = date('Y-m-d');
				$available = "";
				$id = "";
				$data = mysqli_query($connect, "Select product.quantity, product.product_id from product inner join product_detail on product.product_id = product_detail.prd_id where product_detail.prd_code ='$prdCode'");  
				$countRows = mysqli_num_rows($data);
				if ($countRows == 1)
				{
					while ($rows = mysqli_fetch_array($data))
					{$available = $rows[0]; $id = $rows[1];}
					 $available = $available -1;
					 
					$updateSql = "Update product SET quantity = '$available' where product_id='$id'";
					if (mysqli_query($connect,$updateSql))
					{
						$sql = "INSERT INTO sales ( sale_prd_id, sale_date) 
						VALUES ( '$prdCode', '$date')";

						if($connect->query($sql) === TRUE) {
							$valid['success'] = true;
							$valid['messages'] = "Successfully Added";	
						} else {
							$valid['success'] = false;
							$valid['messages'] = "Error while adding the members";
						}
					}
				}
				else
				{
							$valid['success'] = false;
							$valid['messages'] = "Error while adding the members";
				}
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST