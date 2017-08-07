<?php 	

require_once 'core.php';

$sql = "SELECT exp_amount, exp_purpose, exp_date FROM expense ";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[1];
 	// active 
 	
 		$activeBrands = "<label >" . $row[0] ."</label>";
 	

 	$button = "<label >" . $row[2] ."</label>";

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeBrands,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);