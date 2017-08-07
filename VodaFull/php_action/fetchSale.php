<?php 	



require_once 'core.php';

$sql = "SELECT * FROM sales INNER JOIN product_detail ON sales.sale_prd_id = product_detail.prd_code INNER JOIN product ON product.product_id = product_detail.prd_id";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
	 
	$imageUrl = substr($row['product_image'], 3);
	
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";
 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row['product_name'], 
		//Sale Product Code
		$row['sale_prd_id'],
 		// rate
 		$row['rate'],
 		// Sale Date 
 		$row['sale_date']		 	
 			
 		); 	
 } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
?>