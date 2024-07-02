var baseurl=window.location.origin+"/vanijya/";
$(document).ready(function()
{
	if($('.alert').is(':visible')){
     $( ".alert" ).fadeOut( 5000 );
 }

  $(document).on('click','#btn_group',function(){

        $('#bulkupload').modal('show');

    });

    $(document).on('click','#btn_customer',function(){

        $('#customer_promo').modal('show');

    });


    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });

  

    $(document).on('click','#btn_group',function(){

          $('#group_promo').modal('show');

    });

    $(document).on('click','#btn_location',function(){

        $('#location_promo').modal('show');

    });

    $(document).on('click','#btn_insert_model',function(){

        $('#upload_model').modal('show');

    });

    

 $(document).on('click','#btn_click',function(){

     

 	$('#exampleModalLabel').html('ADD Group');
 	$('#group_add').attr('action',baseurl+'admin/Group/addgroup');
 	$('#exampleModal1').modal('show');
 });
 $("#group_add").validate({
 	rules:{
 		groupname:{required: true,},
 	},
 	messages:
 	{
 		groupname:{required:"<span class='help-error'>Enter Group Name</span>"},
 	},
 	submitHandler: function(form) {
 		form.submit();
 	}
 });
 jQuery(document).on('click', '.toggle', function(){
 	var html = '';
 	var status_chk = $(this).find('.group_status_chk').val();
 	var group_id = $(this).find('.group_status_chk').attr('groupid');
 	jQuery.ajax({
 		url:baseurl+'admin/group/groupstatuschk',
        data:{'group_id':group_id,'status_chk':status_chk},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
		  table.ajax.reload();
          if(response.success == 1 ){
			$(".scroll-to-top").trigger('click');
            $('.error_msg').show();
            $('.error_msg').html(response.message);
            $('.error_msg').fadeOut(5000);
          }
        },
        error: function(){
          console.log("Error");
        }
      });
    });

    jQuery(document).on('click', '#gencoupon', function(){
    var html = '';
    var user_id = $(this).attr("data-id");
    $('.generate').text('Please wait...');
    jQuery.ajax({
        url:baseurl+'admin/usercoupon/generatecode',
        data:{'user_id':user_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
            $(".couponcode").val(response.code);
            $('.generate').text('Generate');
            
          }
        },
        error: function(){
          console.log("Error");
        }
      });
    });

    jQuery(document).on('click', '#gengroupcoupon', function(){
    var html = '';
    var group_id = $(this).attr("data-id");
    $('.generate').text('Please wait...');
    jQuery.ajax({
        url:baseurl+'admin/group/generatecode',
        data:{'group_id':group_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
            $(".couponcode").val(response.code);
            $('.generate').text('Generate');
            
          }
        },
        error: function(){
          console.log("Error");
        }
      });
    });



 $(document).on('click','.btn1_edit1',function(){
 	$('#dvLoading').show();
 	var group_id=$(this).attr('group_id');
 	$('#group_add').attr('action',baseurl+'admin/group/editgroup/'+group_id);
 	$.ajax({
 		type:'POST',
 		url:baseurl+'admin/group/edit_group',
        dataType:"json",
        data:{
        	id:group_id
        },
        success: function(data){
        	$('#groupname').val(data[0].group_name);
          $('#groupcode').val(data[0].group_code);
            console.log(data);
        }
    });
    $('.help-error').remove();
    $('#exampleModalLabel').html('EDIT GROUP NAME');
    $('#exampleModal1').modal('show');
});
 jQuery(document).on('click', '.group_delete', function(){
 	var html = '';
 	var group_id = jQuery(this).attr('delete_group');
 	bootbox.confirm("Are you sure you want to delete?", function(result) {
    if(result){
    	jQuery.ajax({
    		url:baseurl+'admin/group/groupdelete',
			data:{'group_id':group_id},
			type:"POST",
			cache:false,
			dataType:"json",
			success: function(response){
				if(response.success == 1 ){
				location.reload();
				console.log(response);
			}
		},
		error: function(){
			console.log("Error");
		}
	});
	}
});
 });
});