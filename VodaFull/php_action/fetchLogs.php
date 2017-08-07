<?php 	

require_once 'core.php';

$sql = "SELECT (SELECT username from users where users.user_id=logs.user_id) as name, activity, log_date FROM logs";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row['name'];
 	// active 
 	
 		$activeBrands = "<label >" . $row['activity'] ."</label>";
 	

 	$button = "<label >" . $row['log_date'] ."</label>";

 	$output['data'][] = array( 		
 		$row[0], 		
 		$activeBrands,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);