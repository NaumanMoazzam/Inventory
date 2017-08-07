<?php 	

require_once 'core.php';

$sql = "SELECT sale_id, sale_date, client_name, client_address, payment_type, due FROM sale ";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$saleId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM sale_details WHERE sale_id = $saleId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[5] > 0) { 		
 		$paymentStatus = "<label class='label label-warning'>Payment Remaining</label>";
 	} else if($row[5] == 0) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="manageSale.php?o=editOrd&i='.$saleId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    
	    <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$saleId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

	    <li><a href="php_action/sale_reports.php?id='.$saleId .'" > <i class="glyphicon glyphicon-print"></i> Print </a></li>
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		$row[1],
 		// client name
 		$row[2], 
 		// client contact
 		$row[3], 		 	
 		$itemCountRow, 		 	
 		$paymentStatus,
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);