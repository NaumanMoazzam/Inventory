<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");
	

	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
	$query = $connect->query($sql);

	$expense = "";
	$sql1 = mysqli_query($connect,"SELECT SUM(exp_amount) as total  from expense where exp_date >= '$start_date' AND exp_date <= '$end_date'");
	
	
	while ($result1 = mysqli_fetch_array($sql1))
	{$expense = $result1['total'];}
	
	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
			</tr>';	
			$totalAmount += (int)$result['grand_total'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount </center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
		'
		;
		$totalAmount = $totalAmount - $expense;
		$table .= '<tr>
			<td colspan="3"><center>Total Expense</center></td>
			<td><center>'.$expense.'</center></td>
		</tr>
		<tr>
			<td colspan="3"><center>Total Ammount After Expense</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>