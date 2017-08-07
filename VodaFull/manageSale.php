<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 



?>
<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Sales</li>
  <li class="active">
Manage Sales Record
  </li>
</ol>

<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if(isset( $_GET['o'] ) == 'editOrd') { 
		echo "Edit Sales Record";
	} else if (isset( $_GET['o'] ) == 'manage'){ ?>
	Manage Sales Record
	<?php } ?>

</h4>

<div class="panel panel-default">
	<div class="panel-heading">

			<i class="glyphicon glyphicon-edit"></i> 
				<?php if($_GET['o']  == 'manage') { 
		echo "Manage Sale Record";
			} else if( $_GET['o']  == 'editOrd') { 
		echo "Edit Sale Record";
			}
		?>
		

	</div> <!--/panel-->	
	<div class="panel-body">
	
<div class="success-messages"></div> 

<div id="success-messages"></div>
			
			
			<?php if( $_GET['o'] == 'manage') {  ?>
			<table class="table" id="manageSaleTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Sale Date</th>
						<th>Client Name</th>
						<th>Contact</th>
						<th>Total Order Item</th>
						<th>Payment Status</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>
			
			
		<?php
			}
			else if($_GET['o'] == 'editOrd') {
				
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editSale.php" id="editSaleForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT sale.sale_id, sale.sale_date, sale.client_name, sale.client_address, sale.grand_total, sale.paid, sale.due, sale.payment_type,sale.client_nic,sale.payment_status,sale.vat, sale.discount, SUm(sale_details.rate) as subTotal FROM sale inner join sale_details on sale.sale_id=sale_details.sale_id WHERE sale.sale_id=$orderId";

				$result = $connect->query($sql);
				$data = $result->fetch_row();	
				$grandTotal = $data[4];
				$paid = $data[5];
				$due = $data[6];
				$paymentType = $data[7];
				$paymentStatus = $data[9];
				$vat = $data[10];
				$discount = $data[11];
				$subTotal = $data[12];
				
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Sale Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="saleDate" name="saleDate" autocomplete="off" value="<?php echo $data[1] ?>" />
				  <input type="hidden" class="form-control" id="orderId" name="orderId" autocomplete="off" value="<?php echo $data[0] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  		
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> <!--/form-group-->			  

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Client CNIC</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientCnic" name="clientCnic" autocomplete="off" value="<?php echo $data[8] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  
			  
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product Code</th>
			  			<th style="width:20%;">Product Name</th>
			  			<th style="width:15%;">Rate</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$saleItemSql = "SELECT sale_details.prd_code, product.product_name, sale_details.rate FROM sale_details Inner Join product_detail ON product_detail.prd_code = sale_details.prd_code Inner Join product on product.product_id = product_detail.prd_id WHERE sale_details.sale_id = $orderId";
						$orderItemResult = $connect->query($saleItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		$count=1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				
			  					<td style="margin-left:20px;">
			  					<div class="form-group">
									<input  type="text" name="prdCode[]" id="prdCode<?php echo $count; ?>" value="<?php echo $orderItemData[0]; ?>" onkeyup="" autocomplete="off" class="form-control" min="1" readonly />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="prdName[]" id="prdName<?php echo $count; ?>" value="<?php echo $orderItemData[1]; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="prdRate[]" onkeyup="subAmount()"  id="prdRate<?php echo $count; ?>" value="<?php echo $orderItemData[2]; ?>" onkeyup="" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
							<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
		  			$count++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	
				<div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $subTotal; ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $subTotal; ?>"  />
				    </div>
				  </div> <!--/form-group-->	

				  
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">VAT %</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat"  onkeyup="subAmount()"   />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $vat; ?>"   />
				    </div>
				  </div> <!--/form-group-->	
				  
				
				<div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"  value="<?php echo $grandTotal; ?>"  />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue"  value="<?php echo $grandTotal; ?>"   />
				    </div>
				  </div> <!--/form-group-->	
				  
				 <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $discount; ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				

				<div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true"  value="<?php echo $grandTotal; ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $grandTotal; ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				  
				
			  
			  

				  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	

				<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $paid; ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				  
				   <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $due; ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $due; ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				  
				  
				  
				  
				   <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="full" <?php if ($paymentStatus == 'full') echo "selected"; ?> >Full Payment</option>
			      	<option value="advance" <?php if ($paymentStatus == 'advance') echo "selected"; ?> >Advance Payment</option>
			      	<option value="credit" <?php if ($paymentStatus == 'credit') echo "selected"; ?> >No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->	
			  
			  
				 
				  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="cheque" <?php if($paymentType == 'cheque') {
				      		echo "selected";
				      	} ?> >Cheque</option>
				      	<option value="cash" <?php if($paymentType == 'cash') {
				      		echo "selected";
				      	} ?>  >Cash</option>
				      	<option value="creditCard" <?php if($paymentType == 'creditCard') {
				      		echo "selected";
				      	} ?> >Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  
				  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">

			    <input type="hidden" name="saleId" id="saleId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get order else  ?>
		
		
		
		
			
				</div> <!--/panel-->	
</div> <!--/panel-->	

<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			    <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="cheque">Cheque</option>
				      	<option value="cash">Cash</option>
				      	<option value="creditCard">Credit Card</option>
				      </select>
			    </div>
			  </div> <!--/form-group-->							  
						  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<script src="custom/js/manageSale.js"></script>

<?php require_once 'includes/footer.php'; ?>

