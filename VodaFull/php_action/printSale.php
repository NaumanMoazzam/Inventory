<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT * FROM sale where sale_id=$orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$clientName = $orderData['client_name'];
$sale_date = $orderData['sale_date'];
$clientContact = $orderData['client_address'];
$paid = $orderData['paid'];
$due = $orderData['due'];
$paymentType = $orderData['payment_type'];
$grandTotal = $orderData['grand_total'];
$vat = $orderData['vat'];
$discount = $orderData['discount'];



$orderItemSql = "SELECT sale_details.prd_code, sale_details.rate , product.product_name from sale_details inner join product_detail on sale_details.prd_code = product_detail.prd_code inner join product on product_detail.prd_id = product.product_id WHERE sale_details.sale_id=$orderId";
$orderItemResult = $connect->query($orderItemSql);


 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Sale Date : '.$sale_date.'
				<center>Client Name : '.$clientName.'</center>
				Contact : '.$clientContact.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.no</th>
			<th>Product</th>
			<th>Product Code</th>
			<th>Rate</th>
		</tr>';		
			$x = 1;
			$totalAmount = 0;
		while($row = $orderItemResult->fetch_array()) {	
			$totalAmount = $totalAmount + $row['rate'];
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row['product_name'].'</th>
				<th>'.$row['prd_code'].'</th>
				<th>'.$row['rate'].'</th>
			</tr>
			';
			$x++;
		} // /while
		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>Sub Amount</th>
			<th>'.$totalAmount.'</th>			
		</tr>

		<tr>
			<th>VAT </th>
			<th>'.$vat.'</th>			
		</tr>

		<tr>
			<th>Discount</th>
			<th>'.$discount.'</th>			
		</tr>

		<tr>
			<th>Grand Total</th>
			<th>'.$grandTotal.'</th>			
		</tr>

		<tr>
			<th>Paid Amount</th>
			<th>'.$paid.'</th>			
		</tr>

		<tr>
			<th>Due Amount</th>
			<th>'.$due.'</th>			
		</tr>

	</tbody>
</table>
 ';


$connect->close();

echo $table;