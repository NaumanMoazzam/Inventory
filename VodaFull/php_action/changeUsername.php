<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$username = $_POST['username'];
	$userId = $_POST['user_id'];

	
		$userId = $_SESSION['userId'];
		$userName = $_SESSION['userName'];
		$activity = "User Change is his/her name from: " . $userName ." to new user name: " . $userName ;
		mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
	
	$sql = "UPDATE users SET username = '$username' WHERE user_id = {$userId}";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	$connect->close();

	echo json_encode($valid);

}

?>