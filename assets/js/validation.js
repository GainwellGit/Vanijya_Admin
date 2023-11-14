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
		  if (status==1) {
			  
			   $('#loading').addClass("loading-block"); 
			   var image = baseURL+'/upload/loading.gif';
			   $('#loading').html("<img src='"+image+"' />");
			  $.ajax({
				  url: baseURL+'admin/home/change_status/'+ user_id,
				  type: 'POST',
				  data: {'user_id': user_id,'status': status},
				  dataType: 'JSON',
				  success: function(response){
					 $('#loading').html("").hide();
					 console.log(user_id);
					 $("#statusbtn"+user_id).hide();
					 $('#btn'+user_id).html('<button type="button" class="btn btn-error btn-sm activebtn" name="activebtn">Inactive</button>');
					 $(".flashmsg").html(" <b>Status became Inactive Successfully</b>.");
					  //window.location.reload();
				 },
				 error: function(response){
					 console.log("Error");
				}
				
				  });
		  }else{
			  
			   $('#loading').addClass("loading-block"); 
			   var image = baseURL+'/upload/loading.gif';
			   $('#loading').html("<img src='"+image+"' />");
			   
			   
			  $.ajax({
				  url: baseURL+'admin/home/change_status/'+ user_id,
				  type: 'POST',
				  data: {'user_id': user_id,'status': status}, 
				  dataType: 'JSON',
				  
				  success: function(response){
					 $('#loading').html("").hide();
					 console.log("Success");
					 $("#statusbtn"+user_id).hide();
					 $('#btn'+user_id).html('<button type="button" id="statusbtn" class="btn btn-success btn-sm activebtn" name="activebtn">Active</button>');
					 $(".flashmsg").html(" <b>Status became Active Successfully</b>."); 
					 //window.location.reload();
				},
				error: function(response){
					console.log("Error"); 
				}
				  });
		  };
	});
	
	
	
	});