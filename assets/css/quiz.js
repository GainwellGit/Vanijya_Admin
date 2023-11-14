var baseurl=window.location.origin+"/";
$(document).ready(function()
{   
	 if($('.alert').is(':visible')){
		 $( ".alert" ).fadeOut( 5000 );
	 }
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

	
	$(document).on('click','.toggle',function(){
    $('.editAdd').remove();
    $('.delmsg').remove();
  		var toggleVal = $(this).find('.status_chk').val();
		var qid = $(this).find('.status_chk').attr('data-quiz');
		if(toggleVal == 0){
			var value = 1;
		}else{
			var value = 0;	
		}
		
		$.ajax({
            type:'POST',
                 url:baseurl+'admin/Quiz/updateStatus',
                 dataType:"json",
                 data:{
                      value: value,
                      id:qid
                      },
                 success: function (data) {
                    table.ajax.reload();
					$(".scroll-to-top").trigger('click');
                    if(data=='success')
                    {
                      $('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Status Update successfully</div>');
					  $(".delmsg").fadeOut(5000)
                      //$('.delmsg').show();

                    }
                    else
                    {
                        $('.content').prepend('<div class="alert alert-success delmsg" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Status Update Failed</div>');
                    }
                   } ,
                    complete: function(){
                   
                          }  
                });
	});

    
    $(document).on('click','#btn_click',function(){

      alert('kunal');
      $('#exampleModalLabel').html('ADD QUIZ');
      $('#ques_add').attr('action',baseurl+'admin/Quiz/addquiz');
      var option_header = '<div class="row"><div class="col-xs-2"><div class="form-group"><label for="options"><strong>OPTION:</strong></label></div></div><div class="col-xs-4 addPbtn"><button type="button" class="btn btn-info pull-left" id="btn_add" name="btn">+</button></div></div>';
       options_html='<div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="A" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div><div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="B" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div>';
        $('.box_new2').html(option_header+options_html);
        $('#question').val('');
        $('#Points1').val('');
         $('#quizlevel').val('');
     $('#exampleModal').modal('show');
    });
	$(document).on('click','.btn_edit',function(){
    alert('test here');
    $('#dvLoading').show();
		var ques_id=$(this).attr('edit_ques_id');
    var optminus=0;
    $('#ques_add').attr('action',baseurl+'admin/Quiz/editsubmit/'+ques_id);
    var options_html='';
		$.ajax({
                 type:'POST',
                 url:baseurl+'admin/Quiz/edit_question',
                 dataType:"json",
                 data:{
                      id:ques_id
                      },
                 success: function(data){
                 $('#video').val(data[0].option_name);
                 $('#answer').val(data[0].option_name);
                 $('#question').val(data[0].title);
                 $('#Points1').val(data[0].points);
                 $('#quizlevel').val(data[0].level);
                 var answer = data[0].option_name;
                 var options = $.parseJSON(data[0].options);
                 var option_header = '<div class="row"><div class="col-xs-2"><div class="form-group"><label for="options"><strong>OPTION:</strong></label></div></div><div class="col-xs-4 addPbtn"><button type="button" class="btn btn-info pull-left" id="btn_add" name="btn">+</button></div></div>';
                 $.each(options,function(key,val){
                  console.log(val);
                  if(answer==val){
                    var checkbox = '<input name="optionscheck[]" type="checkbox" class="optionscheck" checked value="1">';
                  }else{
                    var checkbox = '<input name="optionscheck[]" type="checkbox" class="optionscheck" value="1">';
                  }
                  if(optminus>1){
                  var delrow='<div class="col-xs-4"><button type="button" class="btn btn-danger btn-circle btn_id1">-</button></div>';
                  var optionnum = '<input type="text" name="option-num[]" class="form-control option-num option-num-new" value="'+key+'" readonly>';
                }else{
                  var delrow='';
                  var optionnum = '<input type="text" name="option-num[]" class="form-control option-num" value="'+key+'" readonly>';
                }
                  options_html+='<div class="row"><div class="col-xs-2"><div class="form-group">'+optionnum+'<strong></strong></div></div><div class="col-xs-4"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value="'+val+'"><strong></strong></div></div><div class="col-xs-2"><div class="form-group"><div class="radio"><label class="radio-inline">'+checkbox+'</label></div></div></div>'+delrow+'<div class="clearfix"></div></div>';
                  optminus++;
                 }) 
                $('.box_new2').html(option_header+options_html);
                   $('#dvLoading').hide();
                 }
		
		});
    $('.help-error').remove();
    $('#exampleModalLabel').html('EDIT QUIZ');
     $('#exampleModal').modal('show');
    });
  $(document).on('click','#btn_subm_quiz',function(e){
    alert('test here1');
   var flag=0;
   $('.help-error').remove();
   var question=$('#question').val();
   if(question=='')
    {
      $('#question').after('<span class="help-error">Please input this field</span>');
         e.preventDefault(); 
    }
    var points=$('#Points1').val();
   if(points=='')
    {
      $('#Points1').after('<span class="help-error">Please input this field</span>');
         e.preventDefault(); 
    }
     var quizlevel=$('#quizlevel').val();
   if(quizlevel=='')
    {
      $('#quizlevel').after('<span class="help-error">Please input this field</span>');
         e.preventDefault(); 
    }


   $(".optionsval").each(function () {
        var optionval=$(this).val();
        if(optionval==''){
          $( this ).after('<span class="help-error">Please input this field</span>');
         e.preventDefault(); 
        }

    });

   $(".optionscheck").each(function(){
    if ($(this).prop('checked')==true){ 
        flag=1;
    }
  });
   if(flag==0){
     $('.addPbtn').after('<div class="col-xs-6"><span class="help-error" id="checkerror">Please select one option</span></div>'); 
      e.preventDefault(); 

    }

  });
    $(document).on('submit','#mulquiz_add',function(){
       $image=$('#uploadfile');
        if(image.files.length == 0){
        alert("Attachment Required");
       image.focus();
    return false;
     }
    });


    $(document).on('click','#btn_add',function(){
      var len1=$('.optionadd12 .col-xs-4').length;
      var len2= len1 + 1;
    
      /*var optionadd1='<div class="col-xs-2"></div><div class="col-xs-4"><div class="form-group"><input type="text" name="optionsval[]" class="form-control" value="" id="input'+len2+'"><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" id="optionscheck'+len2+'" value="1"></label></div><strong></strong></div></div><div class="clearfix"></div>';*/
      var last_option_num = $(".option-num").last().val();
    
      var new_option_num = nextChar(last_option_num);
      var optionadd1='<div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num option-num-new" value="'+new_option_num+'" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-2"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck" value="1"></label></div><strong></strong></div></div><div class="col-xs-2"><button type="button" class="btn btn-danger btn-circle btn_id1">-</button></div><div class="clearfix"></div></div>';
     $('.box_new2').append(optionadd1);
    });
    $(document).on('change',':checkbox',function(){
       var th = $(this), name = th.prop('name'); 
       if(th.is(':checked')){
           $(':checkbox[name="'  + name + '"]').not($(this)).prop('checked',false);   
        }
      });
    $(document).on('change','.optionscheck',function(){
        var answer = $(this).parent().parent().parent().parent().prev().find('.optionsval').val();
        if(answer!=''){
            $('#answer').val(answer);
        }else{
            alert('Please enter option value first.');
            $(this).prop('checked', false);
        }
    });
    $(document).on('click','.btn_id1',function(e){
          $(e.target ).closest( ".row" ).remove();
          var last_option = 'B';
          $('.option-num-new').each(function(){
              $(this).val(nextChar(last_option));
              last_option = nextChar(last_option);
          })

        });
    $("#ques_add").validate({

      rules:{
            question:{required: true,},
            Points:{required: true,},
            quizlevel:{required: true,},
            optionval:{required: true,},
            },
           messages:
            {
              question:{required:"<span class='help-error'>Enter Question</span>"},
              Points:{required: "<span class='help-error'>Enter points</span>"},
              quizlevel:{required: "<span class='help-error'>Enter level</span>"},
              optionval:{required:"Enter Option"}
            },
            submitHandler: function(form) {

             form.submit();
             }
              });

      	
	 $(document).on('click', '.btn1_delete', function(){
	  var html = '';
	  var qid = $(this).attr('delete_ques_id');
	    bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){
			  $.ajax({
            type:'POST',
                 url:baseurl+'admin/Quiz/delete_question',
                 dataType:"json",
                 data:{
                      token: '<?php echo $this->security->get_csrf_hash();?>',
                      id:qid
                      },
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

  $(document).on('click','#btn_mulquiz',function(){
    /*alert('hji');*/
   $('#quizmulModalLabel').html('Add CSV QUIZ');
   $('#quizmullModal').modal('show');

  });

  });
  function nextChar(c) {
    return String.fromCharCode(c.charCodeAt(0) + 1);
}

