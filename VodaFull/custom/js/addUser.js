$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active');

	// change username
	$("#addUserForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		var username = $("#username").val();
		var userPassword = $("#userPassword").val();
		var userEmail = $("#userEmail").val();
		if(username == "") {
			$("#username").after('<p class="text-danger">Username field is required</p>');
			$("#username").closest('.form-group').addClass('has-error');
		}
		if(userPassword == "") {
			$("#userPassword").after('<p class="text-danger">Password field is required</p>');
			$("#userPassword").closest('.form-group').addClass('has-error');
		} 
		if(userEmail == "") {
			$("#userEmail").after('<p class="text-danger">User Email field is required</p>');
			$("#userEmail").closest('.form-group').addClass('has-error');
		} 
		if (userEmail) {
			
			$(".text-danger").remove();
			$('.form-group').removeClass('has-error');

			$("#insertUserRecord").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					$("#insertUserRecord").button('reset');
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".form-group").removeClass('has-error').removeClass('has-success');

					if(response.success == true)  {												
																
						// shows a successful message after operation
						$('.addUserForm').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          					
						
					} else {
						// shows a successful message after operation
						$('.addUserForm').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          					
					}
				} // /success 
			}); // /ajax
		}
			
		return false;
	});
});

	

		
