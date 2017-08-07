var manageSaleTable;

$(document).ready(function() {

$('#navProduct').addClass('active');

		manageSaleTable = $("#manageSaleTable").DataTable({
			'ajax': 'php_action/fetchSales.php',
			'order': []
		});
		
		$("#editSaleForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var clientName = $("#clientName").val();
			var clientContact = $("#clientContact").val();
			var clientCnic = $("#clientCnic").val();
			var paymentType = $("#paymentType").val();
			var dueValue = $("#dueValue").val();	
			var saleDate = $("#saleDate").val();	
			var paid = $("#paid").val();
			//clientCnic
			// form validation 
			if(clientName == "") {
				$("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else
				
			if(saleDate == "") {
				$("#saleDate").after('<p class="text-danger"> The Sale Date field is required </p>');
				$('#saleDate').closest('.form-group').addClass('has-error');
			} else {
				$('#saleDate').closest('.form-group').addClass('has-success');
			} // /else
				
			if(paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid Amount field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if(clientContact == "") {
				$("#clientContact").after('<p class="text-danger"> The Client Contact field is required </p>');
				$('#clientContact').closest('.form-group').addClass('has-error');
			} else {
				$('#clientContact').closest('.form-group').addClass('has-success');
			} // /else

			if(clientCnic == "") {
				$("#clientCnic").after('<p class="text-danger"> The Contact CNIC is required </p>');
				$('#clientCnic').closest('.form-group').addClass('has-error');
			} else {
				$('#clientCnic').closest('.form-group').addClass('has-success');
			} // /else
			
			if(paymentType == "") {
				$("#paymentType").after('<p class="text-danger"> The Contact CNIC is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			} // /else
				
			if(dueValue == "") {
				$("#dueValue").after('<p class="text-danger"> The Contact CNIC is required </p>');
				$('#dueValue').closest('.form-group').addClass('has-error');
			} else {
				$('#dueValue').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	        		   	
	   	
	  
      	
	   	
	
			
			if( clientName) {
				
				
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
		
			subAmount();

			return false;
		}); // /edit order form function	
		
		
});

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#prdRate"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);
	
	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);
	
	
	var apply = $("#vat").val();
	//var vatv = $("#vat").val();
	if (apply)
	{
		var vat = (Number($("#subTotal").val())/100) * apply;
		$("#vatValue").val(vat);
		// total amount
		var totalAmount = (Number($("#subTotal").val()) + Number($("#vatValue").val()));
		totalAmount = totalAmount.toFixed(2);
		
		
		$("#totalAmount").val(totalAmount);
		$("#totalAmountValue").val(totalAmount);
	}
	else
	{
			$("#totalAmount").val(totalSubAmount);
			$("#totalAmountValue").val(totalSubAmount);
	}
	

	
	
	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	
	
	
	
	//var totalAmount = (Number($("#subTotal").val());
	
	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  Number($("#grandTotalValue").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#grandTotalValue").val());
		$("#dueValue").val($("#grandTotalValue").val());
	} // else
			
} // /sub total amount



function discountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#totalAmount").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#grandTotal").val(grandTotal);
 		$("#grandTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#paid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#grandTotalValue").val()) - Number($("#paid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#due").val(dueAmount);
 		$("#dueValue").val(dueAmount);
 	} else {
 		$("#due").val($("#grandTotalValue").val());
 		$("#dueValue").val($("#grandTotalValue").val());
 	}

} // /discount function



function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

function paidAmount() {
	var grandTotal = $("#grandTotalValue").val();

	if(grandTotal) {
		var dueAmount = Number($("#grandTotalValue").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amoutn function


function paymentOrder(orderId = null) {
	if(orderId) {

		$("#orderDate").datepicker();

		$.ajax({
			url: 'php_action/fetchSaleData.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'json',
			success:function(response) {				

				// due 
				$("#due").val(response.order[1]);				

				// pay amount 
				$("#payAmount").val(response.order[2]);

				var paidAmount = response.order[2] ;
				var dueAmount = response.order[1];							
				var grandTotal = response.order[3];
				var cuNic      = response.order[4];

				// update payment
				$("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
					var payAmount = $("#payAmount").val();
					var paymentType = $("#paymentType").val();
				
					
					if(payAmount == "") {
						$("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#payAmount").closest('.form-group').addClass('has-error');
					} else {
						$("#payAmount").closest('.form-group').addClass('has-success');
					}

					if(paymentType == "") {
						$("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#paymentType").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentType").closest('.form-group').addClass('has-success');
					}

					

					if(payAmount && paymentType ) {
						$("#updatePaymentOrderBtn").button('loading');
						$.ajax({
							url: 'php_action/editSalePayment.php',
							type: 'post',
							data: {
								orderId: orderId,
								payAmount: payAmount,
								paymentType: paymentType,
								paidAmount: paidAmount,
								grandTotal: grandTotal,
								cuNic: cuNic
							},
							dataType: 'json',
							success:function(response) {
								$("#updatePaymentOrderBtn").button('loading');

								// remove error
								$('.text-danger').remove();
								$('.form-group').removeClass('has-error').removeClass('has-success');

								$("#paymentOrderModal").modal('hide');

								$("#success-messages").html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

								// remove the mesages
			          $(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert	

			          // refresh the manage order table
								manageOrderTable.ajax.reload(null, false);

							} //

						});
					} // /if
						
					return false;
				}); // /update payment			

			} // /success
		}); // fetch order data
	} else {
		alert('Error ! Refresh the page again');
	}
}


function printOrder(orderId = null) {
	
	if(orderId) {		
		
		$.ajax({
			url: 'php_action/sale_reports.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Sale Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function