<?php 	

require_once 'core.php';

$sql = "SELECT client_name, client_nic, sale_date, sale_id FROM sale Group By client_nic ";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	
 		$activeBrands = "<label >" . $row[1] ."</label>";
 	

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	     <li><a type="button" href="php_action/saleLedger.php?id='.$row[1].'" target="_blank"> <i class="glyphicon glyphicon-edit"></i> Print Ledger</a></li>
	  
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[0], 		
 		$activeBrands,
		$row[2],
		$row[3],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);