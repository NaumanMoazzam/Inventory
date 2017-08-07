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
	 
	$sql2 = "SELECT *  from expense where exp_date >= '$start_date' AND exp_date <= '$end_date'";
	$querys = $connect->query($sql2);

	
	

	
	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
	<tbody>
	
	
	
	<thead>
	<tr>
	    <td colspan="4">
	    <div style=""> <img alt="VodaComm" src="http://thevoda.com.pk/assests/images/VodaComm.png" /> </div>
	    </td>
	</tr>
	
	
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>
	</thead>
		';
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
		</tbody>
		</table>
		
		<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		
		<thead>
		<center>Expense Report</center>
		</thead>
			<tr>
				<th>Expense Date</th>
				<th>Expense Title</th>
				<th>Amount</th>
			</tr>
			
			<tr>';
		while ($result = $querys->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['exp_date'].'</center></td>
				<td><center>'.$result['exp_purpose'].'</center></td>
				<td><center>'.$result['exp_amount'].'</center></td>
			</tr>';	
		}
		$table .= '
		</tr>
		
		<tr>
			<td colspan="2"><center>Total Amount </center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
		'
		;
		$totalAmount = $totalAmount - $expense;
		$table .= '<tr>
			<td colspan="2"><center>Total Expense</center></td>
			<td><center>'.$expense.'</center></td>
		</tr>
		<tr>
			<td colspan="2"><center>Total Ammount After Expense</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>