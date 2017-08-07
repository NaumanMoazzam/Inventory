<?php 	

require_once 'core.php';

$productId = $_POST['productId'];


$sql = "SELECT product.product_name, product.rate FROM product inner join product_detail on product.product_id = product_detail.prd_id where product_detail.prd_code=$productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);