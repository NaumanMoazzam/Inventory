var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navVendor').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchVendor.php',
		'order': []		
	});

	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var vendorName = $("#vendorName").val();
		var vendorAddress = $("#vendorAddress").val();
		var vendorCell = $("#vendorCell").val();
		var vendorCnic = $("#vendorCnic").val();
		//vendorCnic

		if(vendorName == "") {
			$("#vendorName").after('<p class="text-danger">Vendor Name field is required</p>');
			$('#vendorName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorName").find('.text-danger').remove();
			// success out for form 
			$("#vendorName").closest('.form-group').addClass('has-success');	  	
		}

		if(vendorAddress == "") {
			$("#vendorAddress").after('<p class="text-danger">Vendor Address field is required</p>');
			$('#vendorAddress').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorAddress").find('.text-danger').remove();
			// success out for form 
			$("#vendorAddress").closest('.form-group').addClass('has-success');	  	
		}
		
		if(vendorCell == "") {
			$("#vendorCell").after('<p class="text-danger">Vendor Cell field is required</p>');
			$('#vendorCell').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorCell").find('.text-danger').remove();
			// success out for form 
			$("#vendorCell").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorCnic == "") {
			$("#vendorCnic").after('<p class="text-danger">Vendor CNIC field is required</p>');
			$('#vendorCnic').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorCnic").find('.text-danger').remove();
			// success out for form 
			$("#vendorCnic").closest('.form-group').addClass('has-success');	  	
		}

		if(vendorName && vendorAddress && vendorCell && vendorCnic) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			
			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageBrandTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit brand form function

});




function editBrands(brandId = null) {
	if(brandId) {
		// remove hidden brand id text
		$('#brandId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedVendor.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editVendorName').val(response.vendor_name);
				// setting the brand status value
				$('#editVendorAddress').val(response.vendor_address);
				// setting the brand name value 
				$('#editVendorCell').val(response.vendor_cell);
				// brand id 
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.vendor_id+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var editVendorName = $('#editVendorName').val();
					var editVendorAddress = $('#editVendorAddress').val();
					var editVendorCell = $('#editVendorCell').val();

					if(brandName == "") {
						$("#editVendorName").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editVendorName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorName").find('.text-danger').remove();
						// success out for form 
						$("#editVendorName").closest('.form-group').addClass('has-success');	  	
					}

					if(editVendorAddress == "") {
						$("#editVendorAddress").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editVendorAddress').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorAddress").find('.text-danger').remove();
						// success out for form 
						$("#editVendorAddress").closest('.form-group').addClass('has-success');	  	
					}
					
					if(editVendorCell == "") {
						$("#editVendorCell").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editVendorCell').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorCell").find('.text-danger').remove();
						// success out for form 
						$("#editVendorCell").closest('.form-group').addClass('has-success');	  	
					}

					if(editVendorName && editVendorAddress && editVendorCell) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function





