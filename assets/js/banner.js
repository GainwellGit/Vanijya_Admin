var baseurl=window.location.origin+"/";
$(document).ready(function()
{  

    if($('.alert').is(':visible')){
     $( ".alert" ).fadeOut( 5000 );
   }

    $(document).on('click','#btn_click',function(){
      $('#exampleModalLabel').html('ADD BANNER');
      $('#banner_add').attr('action',baseurl+'admin/Banner/addbanner');
       $('#bannerdesc').val();
       $('#bannercat').val();
      $('#exampleModal1').modal('show');
    });
    
    
    $('.typebanner').on('change', function() {
      if ($(this).val() == 'category')
      {
       
        $(".catlst").show();
        $(".rwdlst").hide();
      }
      else if ($(this).val() == 'reward')
      {
        
        $(".rwdlst").show();
        $(".catlst").hide();
      }
      else
      {
         $(".catlst").hide();
         $(".rwdlst").hide();
      }
    });
    
  $(document).on('click','.btn1_edit1',function(){

    $('#dvLoading').show();
    var banner_id=$(this).attr('banner_id');
   $('#banner_add').attr('action',baseurl+'admin/Banner/editbanner/'+banner_id);

    $.ajax({
                 type:'POST',
                 url:baseurl+'admin/Banner/edit_banner',
                 dataType:"json",
                 data:{
                      id:banner_id
                      },
                 success: function(data){
                $('#image_upload_preview').attr('src',baseurl+'assets/uploads/logo/'+data[0].banner_image);
                 $('#bannerdesc').val(data[0].banner_description);
                  $('#bannertype').val(data[0].banner_type);

                  if(data[0].banner_type=='category')
                  {
                    $('#bannercat').val(data[0].category_id);
                    $('.catlst').show();
                     $('.rwdlst').hide();
                  }else if(data[0].banner_type=='reward'){
                    $('#bannerreward').val(data[0].category_id);
                    $('.rwdlst').show();
                     $('.catlst').hide();
                  }
                 //$('#bannercat').val(data[0].category_id)*/;
                 console.log(data);
                }
              });
    $('.help-error').remove();
    $('#exampleModalLabel').html('EDIT BANNER');
     $('#exampleModal1').modal('show');
    });

  

 
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#image_upload_preview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
    }
    $("#inputFile_image").change(function () {
        readURL(this);
    });

  
 $("#banner_add").validate({

      rules:{
            bannerdesc:{required: true,},
            bannercat:{required: true,},
            },
           messages:
            {
              bannerdesc:{required:"<span class='help-error'>Enter Description</span>"},
              bannercat:{required: "<span class='help-error'>Enter url</span>"},
    

            },
            submitHandler: function(form) {

             form.submit();
             }
              });
  
    jQuery(document).on('click', '.banner_delete', function(){
	  var html = '';
	  var banner_id = jQuery(this).attr('delete_banner');
	    bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){
			  jQuery.ajax({
				url:baseurl+'admin/Banner/bannerdelete',
				data:{'banner_id':banner_id},
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

    jQuery(document).on('click', '.toggle', function(){
      var html = '';
      var status_chk = $(this).find('.banner_status_chk').val();
      var banner_id = $(this).find('.banner_status_chk').attr('bannerid');

      jQuery.ajax({
        url:baseurl+'admin/banner/bannerstatuschk',
        data:{'banner_id':banner_id,'status_chk':status_chk},
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
  });
 
