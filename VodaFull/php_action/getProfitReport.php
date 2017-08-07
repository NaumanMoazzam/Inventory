<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate2'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");
	

	$endDate = $_POST['endDate2'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT product.product_name, product_detail.prd_code, product.rate, sale_details.sale_id, (sale_details.rate) as Srate  FROM  sale INNER JOIN sale_details ON sale.sale_id = sale_details.sale_id INNER JOIN product_detail on sale_details.prd_code = product_detail.prd_code INNER JOIN product on product_detail.prd_id = product.product_id where sale.sale_date >= '$start_date' AND sale.sale_date <= '$end_date'";
	$orderItemResult = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<thead>
			<tr>
				<th colspan="5">
					<center>
						<center> Profit/Loss Report</center>
						<center> From: ' . $startDate . ' </center>
						<center> To: ' . $endDate .'  </center>
					</center>		
				</th>
			</tr>
		</thead>
	</table>
	
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.no</th>
			<th>Product Name</th>
			<th>Product Code</th>
			<th>Product Rate</th>
			<th>Sale Id</th>
			<th>Salling Rate</th>
			<th>Profit</th>
			<th>Loss</th>
		</tr>';		
		
		$x = 1;
		while($row = $orderItemResult->fetch_array()) {	
			$profit = 0;
			$loss = 0;
			if ($row['rate'] > $row['Srate'])
			{ $loss = $row['rate'] - $row['Srate']; }
		
			if ($row['rate'] == $row['Srate'])
			{ $profit = 0; $loss=0; }
			
			if ($row['rate'] < $row['Srate'])
			{ $profit = $row['Srate'] - $row['rate']; }
		
			$table .= '<tr>
				<th>'.$x.'</th>	
				<th>'.$row['product_name'].'</th>
				<th>'.$row['prd_code'].'</th>
				<th>'.$row['rate'].'</th>
				<th>'.$row['sale_id'].'</th>
				<th>'.$row['Srate'].'</th>
				<th>'.$profit.'</th>
				<th>'.$loss.'</th>
			</tr>
			';
			$x++;
			$sum += $profit;
			$summ += $loss;
		} // /while
		$table .= '<tr>
			
		</tr>
	</tbody>
</table>
 ';
 
 $table .= '<tr><br>
			<td colspan="2"><center>Total Profit: '.$sum.'</center></td><br>
			<td colspan="2"><center>Total Loss: '.$summ.'</center></td><br>
		</tr>
	</table>
	';
$connect->close();
echo $table;
}