var baseURL = window.location.origin+'/';
jQuery(document).ready(function(e){
	//e.preventDefault();

	jQuery('#password_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                old_password: {
                    required: true,
					minlength : 6,
                },
				new_password: {
                    required: true,
					minlength : 6, 
                    
                },
               
            },
            messages: { // custom messages for radio buttons and checkboxes
				old_password: {
                    required: "Old Password is required."
                },
				new_password: {
                    required: "New Password is required.",  
                },
				
            },
			
	});
	
	
	
	$(document).on("click",".activebtn",function(e){
		

		  var user_id = $(this).attr("data-id");
		  var status = $(this).attr("data-status");
		  var blockName = $(this).closest("tr").find("td:eq(1)").html();

		  if (status==1) {

			  $.ajax({

				  url: baseURL+'admin/home/change_status/'+ user_id,
				  type: 'POST',
				  data: {'user_id': user_id,'status': status},
				  dataType: 'JSON',

				 success: function(response){
					  //alert(user_id);
					 console.log("Success");
					 $("#statusbtn").hide();
					 $('#statusbtn').html('<button type="button" class="btn btn-error btn-sm activebtn" name="activebtn">Inactive</button>');
					 $(".flashmsg").append(" <b>Status became Inactive Successfully</b>.");
					  //window.location.reload();
				},
				error: function(response){
					console.log("Error");
				}
				

				  });

		  }else{
			  $.ajax({

				  url: baseURL+'admin/home/change_status/'+ user_id,
				  type: 'POST',
				  data: {'user_id': user_id,'status': status}, 
				  dataType: 'JSON',
				  
				  success: function(response){
					 console.log("Success");
					 $("#statusbtn").hide();
					 $('#statusbtn').html('jgyjhbbjkhk');
					 $(".flashmsg").append(" <b>Status became Active Successfully</b>.");
					 //window.location.reload();
				},
				error: function(response){
					console.log("Error"); 
				}

				  });

		  };

	});
	
	
	
	});