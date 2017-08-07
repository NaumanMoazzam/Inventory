<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Customers</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Customers</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

						
				
				<table class="table" id="manageCustomerTable">
					<thead>
						<tr>							
							<th>Customer Name</th>
							<th>Sale NIC</th>
							<th>Sale ID</th>
							<th>Sale Date</th>
							<th style="width:15%;">Action</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->





<script src="custom/js/customer.js"></script>

<?php require_once 'includes/footer.php'; ?>
