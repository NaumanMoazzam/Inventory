<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$username = $_POST['username'];
	$userEmail = $_POST['userEmail'];
	$userPassword = $_POST['userPassword'];
	$userPassword = md5($userPassword);
	$fetchUsers = mysqli_query($connect,"Select * from users");
	$count = mysqli_num_rows($fetchUsers);
	$count = $count +1;
	$sql = "INSERT INTO  users (user_id,username, password, email) VALUES ('$count','$username','$userPassword','$userEmail')";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Insert User Info";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while inserting user info" . $connect->error;
	}

	$connect->close();

	echo json_encode($valid);

}

?>