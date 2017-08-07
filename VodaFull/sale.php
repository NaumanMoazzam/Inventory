<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
$errors = array();

if(isset($_REQUEST['prdCode'])) {	

	$prdCode 		= $_POST['prdCode'];
 
		if ($prdCode != "")
		{
				//$num = 1;
				$date = date('Y-m-d');
							$sql = "INSERT INTO cart (  prd_code) 
							VALUES ( '$prdCode')";
							if($connect->query($sql) === TRUE) {
									$errors[] = "Successfully Added";
									echo "<script type='text/javascript'>
											subAmount();	
											</script>";
							} else {
							$errors[] = "Error while adding the members"; }
		}					
}
?>


<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Sales</li>
  <li class="active">
Add Sales Record
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	Sales Record

</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		Add Products
	</div> <!--/panel-->	
	<div class="panel-body">
			
					

			<div class="success-messages">
			
			<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
			
			</div> <!--/success-messages-->

			<?php
				$count =1 ;
		
			  		$arrayNumber = 1;
					?>
					
			<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="" id="createProductForm">

				  <div class="form-group">	
					<label for="orderDate" class="col-sm-2 control-label">Product Code</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="prdCode" name="prdCode" autocomplete="off" />
					</div>
							
										
				  </div> <!--/form-group-->
			  
			</form>
			  
			 <!-- Show Record of Added Sale --> 
			  <form class="form-horizontal" method="POST" action="php_action/createSales.php" id="createSaleForm">

			  <div class="uccess-messages"></div>
			  
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  

			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client CNIC</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientCnic" name="clientCnic" placeholder="Contact Number" autocomplete="off" />
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
					$count = 1;
					$productSql = mysqli_query($connect,"SELECT * FROM cart Inner Join product_detail ON product_detail.prd_code = cart.prd_code Inner Join product on product.product_id = product_detail.prd_id Order BY cart.id DESC");
			  							while($row = mysqli_fetch_array($productSql)) {									 					  								

			  		?>
			  			<tr id="row<?php echo $count; ?>" class="">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">
									<input  type="text" name="prdCode[]" id="prdCode<?php echo $count; ?>" value="<?php echo $row['prd_code']; ?>" onkeyup="" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="prdName[]" id="prdName<?php echo $count; ?>" value="<?php echo $row['product_name']; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="prdRate[]" onkeyup="subAmount()"  id="prdRate<?php echo $count; ?>" value="<?php echo $row['rate']; ?>" onkeyup="" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $count; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
					$count++;
										}
					?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->	
				<div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">VAT %</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat"  onkeyup="subAmount()"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue"   />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"  />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue"   />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true"   />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue"   />
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  
				  
				  			  
				  
			  
			   <div class="col-md-6">
			  	
				
				<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->	
		
			  
				<div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
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
				
				
					<div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="full">Full Payment</option>
			      	<option value="advance">Advance Payment</option>
			      	<option value="credit">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->		
			  
			  
			  
				
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">			  
			  </div> <!--/col-md-6-->
			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" id="createSaleBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			    </div>
			  </div>
			</form>
		
				
			 
	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
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
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
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

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog --
</div><!-- /.modal -->
<!-- /remove order-->



<script src="custom/js/saleDetail.js"></script>
<?php require_once 'includes/footer.php'; ?>



	