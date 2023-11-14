var baseurl=window.location.origin+"/";
$(document).ready(function() {  
  
  if($('.alert').is(':visible')){
    $( ".alert" ).fadeOut( 5000 );
  }

  $(document).on('click','#btn_click',function() {
    $('#exampleModalLabel').html('ADD REWARD');
    $('#reward_add').attr('action',baseurl+'admin/Reward/addreward');
    $('#image_upload_preview').attr('src', baseurl + 'assets/image/images.png');
    $('#image_upload_preview_banner').attr('src', baseurl + 'assets/image/images.png');
    $('#image_upload_preview_banner').parent().removeClass('banner-image-loaded');
    $('#rewardtitle').val('');
    $('#rewarddesc').val('');
    $('#rewardcoin').val('');
    $('#category-banner-image-choose').show();
    $('#category-banner-image-show').hide();
    $('#category-image-choose').show();
    $('#category-image-show').hide();
    $('#exampleModal1').modal('show');
  });

  $(document).on('click','.btn1_edit1',function() {
    $('#dvLoading').show();
    var reward_id=$(this).attr('reward_id');
    $('#reward_add').attr('action',baseurl+'admin/reward/editreward/'+reward_id);
    
    $.ajax({
      type:'POST',
      url:baseurl+'admin/reward/edit_reward',
      dataType:"json",
      data:{ id:reward_id },
      success: function(data) {
        $('#category-banner-image-choose').hide();
        $('#category-banner-image-show').show();
        $('#category-image-choose').hide();
        $('#category-image-show').show();
        $('#image_upload_preview').attr('src',baseurl+'assets/uploads/logo/'+data[0].reward_image);
        $('#image_upload_preview_banner').attr('src', baseurl + 'assets/uploads/logo/' + data[0].banner_image);
        $('#image_upload_preview_banner').parent().addClass('banner-image-loaded');
        $('#rewardtitle').val(data[0].title);
        $('#rewarddesc').val(data[0].description);
        $('#rewardcoin').val(data[0].coin);
        // console.log(data);
      }
    });

    $('.help-error').remove();
    $('#exampleModalLabel').html('EDIT REWARD');
    $('#exampleModal1').modal('show');
  });

  function readURL(input) {
    if (input.files && input.files[0] ) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_upload_preview').attr('src', e.target.result);
        // $('#image_upload_preview_banner').attr('src',e.target.result); 
        $('#image_upload_preview_banner').parent().addClass('banner-image-loaded');
        $('#category-image-choose').hide();
        $('#category-image-show').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  var _URL = window.URL || window.webkitURL;
  function readURL1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        // console.log(e.target.result);
        $('#image_upload_preview_banner').attr('src',e.target.result); 
        $('#image_upload_preview_banner').parent().addClass('banner-image-loaded');
        $('#category-banner-image-choose').hide();
        $('#category-banner-image-show').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inputFile_image").change(function () {
    var file, img;
    var _self = this;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
            if(this.width==256 && this.height==256)
              readURL(_self);
            else{
              alert('Banner Image Dimension must be 256 X 256');
              var $el = $('#inputFile_image');
              $el.wrap('<form>').closest('form').get(0).reset();
              $el.unwrap();
            }
        };
        img.src = _URL.createObjectURL(file);
    }
    // readURL(this);
  });

  $("#inputFile_image_banner").change(function () {
    var file, img;
    var _self = this;
    if ((file = this.files[0])) {
      img = new Image();
      img.onload = function () {
        if(this.width==990 && this.height==464)
          readURL1(_self);
        else
          alert('Banner Image Dimension must be 990 X 464');
      };
      img.src = _URL.createObjectURL(file);
    }
  });

 $("#reward_add").validate({

      rules:{
            rewardtitle:{required: true,},
            rewarddesc:{required: true,},
            rewardcoin:{required: true,},
            },
           messages:
            {
              rewardtitle:{required:"<span class='help-error'>Enter Title</span>"},
              rewarddesc:{required:"<span class='help-error'>Enter Description</span>"},
              rewardcoin:{required:"<span class='help-error'>Enter Coin</span>"}
    

            },
            submitHandler: function(form) {

             form.submit();
             }
              });
  

    jQuery(document).on('click', '.reward_delete', function(){
	  var html = '';
	  var reward_id = jQuery(this).attr('delete_reward');
	    bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){  
			  jQuery.ajax({
				url:baseurl+'admin/reward/rewarddelete',
				data:{'reward_id':reward_id},
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
      var status_chk = $(this).find('.reward_status_chk').val();
      var reward_id = $(this).find('.reward_status_chk').attr('rewardid');

      jQuery.ajax({ 
        url:baseurl+'admin/reward/rewardstatuschk',
        data:{'reward_id':reward_id,'status_chk':status_chk},
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
 
