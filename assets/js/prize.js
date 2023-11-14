var baseurl=window.location.origin+"/";
$(document).ready(function()
{   
   if($('.alert').is(':visible')){
	 $( ".alert" ).fadeOut( 5000 );
   }
	
   $(document).on('click',".toggle",function(){
  		var toggleVal = $(this).find('.status_chk').val();
		var pid = $(this).find('.status_chk').attr('data-prize');
		
		if(toggleVal == 0){
			var value = 1;
		}else{
			var value = 0;	
		}
		
		$.ajax({
            type:'POST',
                 url:baseurl+'admin/prize/updateStatus',
                 dataType:"json",
                 data:{
                      value: value,
                      id:pid
                      },
                 success: function (data) {
					$(".scroll-to-top").trigger('click');
                    table.ajax.reload();
                    if(data=='success')
                    {
                      $('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Status Update successfully</div>');
					  $(".delmsg").fadeOut(5000);
                    }
                    else
                    {
                        $('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Status Update Failed</div>');
						$(".delmsg").fadeOut(5000);
                    }
                   } ,
                    complete: function(){ }  
                });
	});

   $(document).on('click','#btn_prize_click',function(){ 
      $('#prizeModalLabel').html('ADD PRIZE');
        $('#prizeModal').find("input").val("");
        /*$('#quizset_drpdwn').select2('val','');*/
         // Just clear the contents.
      $('#prizeModal').modal('show');
    });
	
    $(document).on('click','#btn_sub_prize',function(e){
   		$('.help-error').remove();
		var prizeTitle=$('#prizeTitle').val();
		var prizePoints=$('#prizePoints').val();
	   var prizequantity=$('#prizequantity').val();
	   if(prizeTitle=='')
	   {
	   	$('#prizeTitle').after('<span class="help-error">Please enter reward_text</span>');
	   	$('#prizeTitle').css('border','1px solid #FF0000');
	   	return false;

	   }
	   else{
	   	$('.help-error').remove();
	   	$('#prizeTitle').css('border','1px solid #008000');


	   }
	   if(prizePoints=='')
	   {
	   	$('#prizePoints').after('<span class="help-error">Please enter points</span>');
	   	$('#prizePoints').css('border','1px solid #FF0000');
	   	return false;
       }
	   else if(!$.isNumeric(prizePoints))
	   {
        $('#prizePoints').after('<span class="help-error">Please enter Numeric value in the points field</span>');
         $('#prizePoints').css('border','1px solid #FF0000');
        return false;
	   }
	   else{
	   		$('.help-error').remove();
	   	    $('#prizePoints').css('border','1px solid #008000');
	   }
	   if(prizequantity=='')
	   {
	   	$('#prizequantity').after('<span class="help-error">Please enter Quantity</span>');
	   	$('#prizequantity').css('border','1px solid #FF0000');
	   	return false;
	   }
	    else if(!$.isNumeric(prizequantity))
	   {
        $('#prizequantity').after('<span class="help-error">Please enter Numeric value in the quantity field</span>');
        $('#prizequantity').css('border','1px solid #FF0000');

        return false;
	   }
	   else{
         $('#prizequantity').css('border','1px solid #FF0000');
	   	 return true;
	   }
	   });

  

  
		





  
   /*$("#prize_add").validate({ 
       rules:
	   {
          prizeTitle:{required: true,},
          prizePoints:{required: true,maxlength: 4,},
          prizequantity:{required:true,},
         
       },
	   messages:
	   {
		  prizeTitle:{required:"<span class='help-error'>Title is required.</span>"},
		  prizePoints:{required: "<span class='help-error'>Points is required.</span>"},
		  prizequantity:{required: "<span class='help-error'>Quantity is required.</span>"},
		

	   },
	   submitHandler: function(form) {
		  form.submit();
	   }
  });*/
			  
   $(document).on('click', '.btn1_delete', function(){
	  var html = '';
	  var pid = $(this).attr('delete_prize_id');
	    bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){
			  $.ajax({
            type:'POST',
                 url:baseurl+'admin/prize/delete',
                 dataType:"json",
                 data:{id:pid},
                success: function(response){
				  table.ajax.reload();
				  if(response.result == 1 ){
					$('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Prize deleted successfully.</div>');
					$(".delmsg").fadeOut(5000);
				  }
				},
				error: function(){
				  $('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Prize deleted successfully.</div>');
				  $(".delmsg").fadeOut(5000);
				}
                });
            }
        }); 
    });
	
   $(document).on('click','.btn_edit', function(){
		var prize_id = $(this).attr('edit_prize_id');
    	$('#prize_add').attr('action', baseurl+'admin/prize/edit/'+prize_id);
		$.ajax({
			 type:'POST',
			 url:baseurl+'admin/prize/get_data',
			 dataType:"json",
			 data:{
				  id:prize_id
			 },
			 success: function(data){
			 	console.log(data);
				 $('#prizeTitle').val(data.reward_text);
				 $('#prizePoints').val(data.points);
				  $('#prizequantity').val(data.quantity);
				 /* $('#quizset_drpdwn').select2('data', {id: 100, a_key: data.category_name});*/
	/*$("#quizset_drpdwn").select2("val", data.category_id);*/
			 }
		});
     $('#prizeModalLabel').html('EDIT PRIZE');
     $('#prizeModal').modal('show');
    });

});
  