<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$categoriesName = $_POST['categoriesName'];
  $categoriesStatus = $_POST['categoriesStatus']; 
	
	
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$activity = "Category Name: " . $categoriesName ." addedd by user name: " . $userName ;
	$date = date('Y-m-d');
	mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	
	$sql = "INSERT INTO categories (categories_name, categories_active, categories_status) 
	VALUES ('$categoriesName', '$categoriesStatus', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST