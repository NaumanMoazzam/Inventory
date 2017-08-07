<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT product.rate, product.quantity, SUm(vendor_installment.amount), product.vendor_id FROM product INNER JOIN vendor_installment ON product.product_id = vendor_installment.prd_id  WHERE product.product_id={$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['order'] = $data;


$connect->close();

echo json_encode($valid);