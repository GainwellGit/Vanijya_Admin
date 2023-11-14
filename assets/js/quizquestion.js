var baseurl=window.location.origin+"/";
$(document).ready(function()
{   
	 if($('.alert').is(':visible')){
		 $( ".alert" ).fadeOut( 5000 );
	 }

	
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
                 url:baseurl+'admin/Quizquestion/updateStatus',
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
      
      $('#quesModalLabel').html('Add Question'); 
      $('#quizques_add').attr('action',baseurl+'admin/Quizquestion/addquestion');
    
        $('#messagetitle').val('');
        $('#quesPoints').val('');
        $('#queslevel').val('');
        $('#optionsval1').val('');
        $('#optionsval2').val('');
        $('#quesanswer').val('');
     $('#quizquesModal').modal('show');
    });


	$(document).on('click','.btn_edit',function(){
    $('#dvLoading').show();
		var ques_id=$(this).attr('edit_ques_id'); 
   
   $('#quizques_add').attr('action',baseurl+'admin/Quizquestion/editsubmit/'+ques_id);
    
		$.ajax({
                 type:'POST',
                 url:baseurl+'admin/Quizquestion/edit_question',
                 dataType:"json",
                 data:{
                      id:ques_id
                      },
                success: function(data){
                  //console.log(data);
                $('#messagetitle').val(data[0].message);
                $('#quesPoints').val(data[0].point);
                $('#queslevel').val(data[0].level);
                $('#optionsval1').val(data[0].opt1);
                $('#optionsval2').val(data[0].opt2);
                $('#quesanswer').val(data[0].answer);
                $('#sel1').val(data[0].category).change();
                $('#dvLoading').hide();
                
              }
            });
                $('.help-error').remove();
                $('#quesModalLabel').html('Edit Question');
                $('#quizquesModal').modal('show'); 
   
    });

    $("#quizques_add").validate({

      rules:{
            messagetitle:{required: true,},
            Points:{required: true,},
            quizlevel:{required: true,},
            optionsval1:{required: true,},
            optionsval2:{required: true,},
            answer:{required: true,},
            sel1:{required: true,},
            },
           messages:
            {
              messagetitle:{required:"<span class='help-error'>Enter Question</span>"},
              Points:{required: "<span class='help-error'>Enter point</span>"},
              quizlevel:{required: "<span class='help-error'>Enter Level</span>"},
              optionsval1:{required:"<span class='help-error'>Enter Option 1</span>"},
              optionsval2:{required:"<span class='help-error'>Enter Option 2</span>"},
              answer:{required:"<span class='help-error'>Enter Answer</span>"},

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
                 url:baseurl+'admin/Quizquestion/delete_question',
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

    $(document).on('click','#btn_mulques',function(){
    /*alert('hji');*/
   $('#quesmulModalLabel').html('Add CSV QUIZ');
   $('#quesmullModal').modal('show');

  });

     $(document).on('submit','#mulques_add',function(){
       $image=$('#uploadquesfile');
        if(image.files.length == 0){
        alert("Attachment Required");
       image.focus();
    return false;
     }
    });

  });

