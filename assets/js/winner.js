var baseurl=window.location.origin+"/";
$(document).ready(function()
{   
	$('#UsrTable').DataTable();
	$('#UsrTable').show();
	
	if($('.alert').is(':visible')){
	 	$( ".alert" ).fadeOut( 5000 );
	}
	
	$(document).on('change','.winners_status', function(){
		var value = $(this).val();
		var winner_id = $(this).attr('data-id'); 
		
		$.ajax({
			url : baseurl + 'admin/winners/statusChk',
			data : {value:value, wid:winner_id},
			type : 'post',
			dataType : 'json',
			success : function(response){
				$(".scroll-to-top").trigger('click');
				if(response.result == 1)
				{
				  $('.content').prepend('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.success+'</div>');
				  $(".alert").fadeOut(5000);
				}
				else
				{
					$('.content').prepend('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.error+'</div>');
					$(".alert").fadeOut(5000);
				}
				
			}
		})
	});
});