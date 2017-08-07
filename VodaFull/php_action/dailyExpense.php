<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

$fetchExpenseLimit = mysqli_query($connect,"Select exp_rg_max from expense_range Order By id DESC limit 1");
$range = "";
while($rows = mysqli_fetch_array($fetchExpenseLimit))
{ $range = $rows[0]; }

$fetchCurrentExpense = mysqli_query($connect,"Select SUM(exp_amount) as total  from expense where MONTH(exp_date) =MONTH(NOW())");
$currentExpense = "";
while($rowss = mysqli_fetch_array($fetchCurrentExpense))
{ $currentExpense = $rowss[0]; }



$expAmount  = $_POST['expAmount']; 
$expPurpose = $_POST['expPurpose']; 

$currentExpense = $currentExpense + $expAmount;
if ($currentExpense > $range) {
		 	$valid['success'] = false;
			$valid['messages'] = "Expense exced the limit";
}
else {
		
		$userId = $_SESSION['userId'];
		$userName = $_SESSION['userName'];
		$date = date('Y-m-d');
		$activity = "Expense Title/Purpose is: " . $expPurpose ." and Amount is: ". $expAmount . "addedd by user name: " . $userName ;
		mysqli_query($connect,"Insert into logs (user_id, activity, log_date) VALUES ('$userId','$activity','$date')");
		
		$sql = "INSERT INTO expense (exp_amount,exp_purpose,exp_date) VALUES ('$expAmount', '$expPurpose', '$date')";

		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Added";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while adding the members";
		}
	 
}
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST