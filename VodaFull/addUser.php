<?php require_once 'includes/header.php'; ?>



<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Add User</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> User Info</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				

				<form action="php_action/insertUser.php" method="post" class="form-horizontal" id="addUserForm">
					<fieldset>
						<legend>Enter User Info</legend>

						<div class="addUserForm"></div>			

						<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value=""/>
					    </div>
					  </div>
					  
					  
					  <div class="form-group">
					    <label for="userEmail" class="col-sm-2 control-label">Enter Email</label>
					    <div class="col-sm-10">
					      <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="some@some.com" value=""/>
					    </div>
					  </div>
					  
					  
					  <div class="form-group">
					    <label for="userPassword" class="col-sm-2 control-label">Enter Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="*****" value=""/>
					    </div>
					  </div>

						<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-success" data-loading-text="Loading..." id="insertUserRecord"> <i class="glyphicon glyphicon-ok-sign"></i> Insert User </button>
					    </div>
					  </div>
					</fieldset>
				</form>

				
					

					  

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->


<script src="custom/js/addUser.js"></script>
<?php require_once 'includes/footer.php'; ?>