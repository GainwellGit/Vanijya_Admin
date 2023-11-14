var baseurl=window.location.origin+"/";
$(document).ready(function() {

  // Initialize Croppie for Banner
  var $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:620,
      height:300,
      type:'square', //circle//square
      enableResize: true,
    },
    boundary:{
      width:630,
      height:310
    }
  }); 
  var $thumbnail_crop = $('#thumbnail_demo').croppie({
    enableExif: true,
    viewport: {
      width:250,
      height:250,
      type:'square', //circle//square
      enableResize: true,
    },
    boundary:{
      width:260,
      height:260
    }
  }); 

  jQuery(document).on('keyup', '#search_question', function(event) {
    var search_item = $('#search_question').val();
    var category_id = $(this).attr('quizset_id');
    // console.log(search_item);
    // AJAX call for Search Questions
    jQuery.ajax({
        url: baseurl + 'admin/Quizset/searchquestion',
        data: { search_item, category_id},
        type: "POST",
        cache: false,
        dataType: "json",
        success: function (response) {
          if(response) {
            console.log(response);
            var htmlDOM = `<ul class="list-group qadd">`;
            var easy = [1, 2];
            var medium = [3, 4];
            var hard = [5];
            htmlDOM += response.map(function(value, key){
              var childHtmlDOM = `<li class="list-group-item">`;
              if (jQuery.inArray(value.level, easy)) {
                childHtmlDOM += `<span class="label label-success levelsquiz">Easy</span>`;
              } else if (jQuery.inArray(value.level, medium)) {
                childHtmlDOM += `<span class="label label-warning levelsquiz">Medium</span>`;
              } else {
                childHtmlDOM += `<span class="label label-danger levelsquiz">Hard</span>`;
              }
              childHtmlDOM += `<div class="qtitle" style="padding-top: 14px;">${key+1}. ${value.title}</div> 
                              <span class="btn-close badge badge-secondary" data-quiz-id="${value.quiz_set_id}" data-level="${value.level}">
                                <img class="svg-icon" src="${window.location.origin}/assets/image/outline-close-24px.svg" >
                              </span><div class="clearfix"></div></li>`;
              return childHtmlDOM;
            });
            htmlDOM += `</ul></div>`;
            $('.select-question-list').html(htmlDOM);
            var numberOfQuestion = response.length ? response.length+' Questions': '0 Question';
            $('.song-select').html(numberOfQuestion);
          } else {
            console.log(response);
            $('.song-select').html('0 Question');
            $('.select-question-list').html(`<div class="no-data-found">no data found</div>`);
          }
        }  
    });
  });
   // $('#exampleModal1').on('shown.bs.modal', function() {
  $('#quizsetdesc').summernote({
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true,                  // set focus to editable area after initializing summernote
      disableResizeEditor: true
  });
  $('.note-btn-group.btn-group.note-view').remove();
   // });



    $('#btn_click').click(function(){

       $('#quizsetdesc').summernote({
       height:100,

       });
      $('#exampleModalLabel').html('ADD CATEGORY');
      $('#exampleModal1').modal('show');


    });

    if($('.alert').is(':visible')){
		 $( ".alert" ).fadeOut( 5000 );
	 }
   

 
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image_upload_preview1').attr('src', e.target.result);
              //   $('#thumbnail_image').val(e.target.result);
              // $thumbnail_crop.croppie('bind', {
              //   url: e.target.result
              // }).then(function(){
              //   console.log('jQuery bind complete');
              // });
              $('#image_upload_preview_banner').parent().addClass('banner-image-loaded');
              $('#category-image-choose').hide();
              $('#category-image-show').show();
              // $('#thumbnail-image-cropper').modal('show');
          }
           
          reader.readAsDataURL(input.files[0]);
      }
    }

    function readURL1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image_upload_preview_banner').attr('src',e.target.result); 
              // $('#banner_image').val(e.target.result);
              // $image_crop.croppie('bind', {
              //   url: e.target.result
              // }).then(function(){
              //   console.log('jQuery bind complete');
              // });
              $('#image_upload_preview_banner').parent().addClass('banner-image-loaded');
              $('#category-banner-image-choose').hide();
              $('#category-banner-image-show').show();
              // $('#banner-image-cropper').modal('show');
          }

          reader.readAsDataURL(input.files[0]);
      }
    }

    $("#inputFile_image1").change(function () {
        var file, img;
        var _self = this;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function () {
                if(this.width==256 && this.height==256)
                  readURL(_self);
                else{
                  alert('Banner Image Dimension must be 256 X 256');
                  var $el = $('#inputFile_image1');
                  $el.wrap('<form>').closest('form').get(0).reset();
                  $el.unwrap();
                }
            };
            img.src = _URL.createObjectURL(file);
        }
    });
    var _URL = window.URL || window.webkitURL;
    $("#inputFile_image_banner").change(function (e) {
        var file, img;
        var _self = this;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function () {
                if(this.width==990 && this.height==464)
                  readURL1(_self);
                else {
                  alert('Banner Image Dimension must be 990 X 464');
                  var $el = $('#inputFile_image_banner');
                  $el.wrap('<form>').closest('form').get(0).reset();
                  $el.unwrap();
                }
            };
            img.src = _URL.createObjectURL(file);
        }
    });

    $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
           $('#banner_image').val(response);
           $('#image_upload_preview_banner').attr('src', response);
           $('#banner-image-cropper').modal('hide');
          //var result=response.split(';');
          //result=result[1].split(',');
          //$('#content_of_image').html(atob(result[1]));
         /* $.ajax({
            url:"upload.php",
            type: "POST",
            data:{"image": response},
            success:function(data)
            {
              $('#uploadimageModal').modal('hide');
              $('#uploaded_image').html(data);
            }
          });*/
        })
    });

    $('.thumbnail_crop').click(function(event){
        $thumbnail_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $('#thumbnail_image').val(response);
          $('#image_upload_preview1').attr('src', response);
          $('#thumbnail-image-cropper').modal('hide');
          //var result=response.split(';');
          //result=result[1].split(',');
          //$('#content_of_image').html(atob(result[1]));
         /* $.ajax({
            url:"upload.php",
            type: "POST",
            data:{"image": response},
            success:function(data)
            {
              $('#uploadimageModal').modal('hide');
              $('#uploaded_image').html(data);
            }
          });*/
        })
    });
	
	function addQuestion(quiz_set_id){
		var html ='';
		 jQuery.ajax({
        url:baseurl+'admin/Quizset/quizmenusubmit',
        data:{'quiz_id':quiz_set_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
              var count = 0;
              var easy=["1", "2"];
              var medium=["3", "4"];
              var hard=["5"];
              var setquizlistdetails = response.setquizlistdetails;
            jQuery.each( response.setquizlistdetails, function( i, val ) {
                count++;
                var html1 = '';

                if(jQuery.inArray(val.level,easy)!=-1) {
                    html1='<span class="label label-success levelsquiz">Easy</span>';
                }

                if(jQuery.inArray(val.level,medium)!=-1) {
                    html1='<span class="label label-warning levelsquiz">Medium</span>';
                }
                 
                if(jQuery.inArray(val.level,hard)!=-1) {
                    html1='<span class="label label-danger levelsquiz">Hard</span>';
                }
				         //var limg = baseurl+'assets/image/outline-sort-24px.svg';
				          var rimg = baseurl+'assets/image/outline-close-24px.svg';
                html += '<li class="list-group-item">'+html1+'<div class="qtitle" style="padding-top: 14px;">'+count + '. '+ val.title+'</div><span class="btn-close badge badge-secondary" data-quiz-id="'+val.id+'"><img class="svg-icon" src="'+rimg+'"></span><div class="clearfix"></div></li>';
            });
			       
            jQuery('.qadd').html(html);
			var countQno = (count == 1) ? "<span>"+count+"</span> "+ 'Question' : "<span>"+count+"</span> "+ 'Questions' ;
			$('.song-select').html(countQno);
			$('.qAttempt').html(count+' Attempted' );
          }
        },
        error: function(){
          console.log("Error");
        }
      });
	}
	
	/*function uncheckedQuestion(quiz_set_id){ 

      var html = '';
      jQuery.ajax({
        url:baseurl+'admin/Quizset/quizUnchecked',
        data:{'quiz_set_id':quiz_set_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
            console.log(response);
            var count = 0;
            var easy=["1","2"];
            var medium=["3","4"];
            var hard=["5"];
            jQuery.each( response.result.quiz_list, function( i, val ) {
            if(jQuery.inArray(val.level,easy)!=-1)
            {
               html1='<span class="label label-success levelsquiz">Easy</span>';
            }

           else if(jQuery.inArray(val.level,medium)!=-1)
            {
                html1='<span class="label label-success levelsquiz">Medium</span>';
            }

             else if(jQuery.inArray(val.level,hard)!=-1)
            {
                 html1='<span class="label label-success levelsquiz">Hard</span>';
            }

                count++;
                html += '<li class="list-group-item">'+html1+'<div class="qzTitle">';
                html += val.title +'</div><span class="radio"><label class="radio-inline"><input type="checkbox" class="quizcheck1" value="'+ val.id +'" qset_id="'+quiz_set_id+'" name="quizcheck1[]"></label></span><div class="clearfix"></div></li>';
            });
            console.log(html);

            jQuery('.qblck').html('').html(html);

          }
        },
        error: function(){
          console.log("Error");
        }
      });
    	
	}*/


     
   /* $(document).on('click','#btn_subm',function(e){
      if($('#q_settitle').val() != '' || $('#quizsetdesc').val() != '' || $('#inputFile_image').val() != ''){
        $('#btn_subm').html('Uploading..');        
      }else{
        if($('#q_settitle').val() == ''){
          $('#title-error').html('');
          $('#title-error').html("Catagory Required");
        }
         if($('#quizsetdesc').val() == ''){
          $('#title-error1').html('');
          $('#title-error1').html("Description Required");
        }
        else{
          $(document).find('#title-error1').remove();
        }
      
         
        
        return false;
      }
    });*/

/*$("#quesset_add").validate({

      rules:{
            q_settitle:{required: true,},
            quizsetdesc:{required: true,},
           
            },
           messages:
            {
              q_settitle:{required:"<span class='help-error'>Enter Category</span>"},
              quizsetdesc:{required:"<span class='help-error'>Enter Description</span>"},
              },
            submitHandler: function(form) {
            form.submit();
             }
              });*/

$("#quesset_edit").validate({

      rules:{
            q_settitle:{required: true,},
            quizsetdesc:{required: true,},
           
            },
           messages:
            {
              q_settitle:{required:"<span class='help-error'>Enter Category</span>"},
              quizsetdesc:{required:"<span class='help-error'>Enter Description</span>"},
              
    

            },
            submitHandler: function(form) {

             form.submit();
             }
              });



 $('#quesset_add').submit(function(e) {
     var flag=0;
   $('.help-error').remove();
    var bannertitle=$('#bannertitle').val();
   if(bannertitle=='')
    {
      $('#bannertitle').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
   var title=$('#q_settitle').val();
   if(title=='')
    {
      $('#q_settitle').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
    if ($('#quizsetdesc').summernote('isEmpty')) {
        /*$('#summernote').val('');*/
        $('.note-editor').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
     if(flag=0)
    {
       form.submit();
    }
});


    $(document).on('click','.quizcheck1',function(){
        var currentpos = $(this);
           currentpos.each(function(){
            if (currentpos.prop('checked')==true){ 
                flag=1;
               // alert('hello');
               $q_id=currentpos.val();
                $q_setid=currentpos.attr('qset_id');
                /*alert($q_id);
                alert( $q_setid);*/
                  $.ajax({
                    type:'POST',
                         url:baseurl+'admin/Quizset/insertquizset',
                         dataType:"json",
                         data:{
                           qset_id:$q_setid,
                              quiz_id:$q_id
                             },
                         success: function(data){
                            console.log(data); 
                            if(data)
                            {
                              currentpos.parent().parent().parent().remove();
                              $('#menucount').html(data.count);
                               /*  $(".box2").append(currentpos.parent().parent().parent().parent().parent());*/
							  addQuestion($q_setid);
                            }
                            else
                            {
                          }

                           } 
                        });
            }
          });
    });
    $(document).on('click','.quizuncheck1',function(){
      var currentpos = $(this);
        currentpos.each(function(){
        if (currentpos.prop('checked')==true){ 
          var r = confirm("Do you want to unset this question??");
          if (r == true) {
              flag=1;
              $q_id=currentpos.val();
              $q_setid=currentpos.attr('qset_id');
              $.ajax({
                type:'POST',
                url:baseurl+'admin/Quizset/deletequizset',
                dataType:"json",
                data:{qset_id:$q_setid,quiz_id:$q_id},
                success: function(data){
                  console.log(data); 
                  if(data)
                  {
                    currentpos.parent().parent().parent().remove();
                    $('#menucount').html(data.count);
                     //  $(".box2").append(currentpos.parent().parent().parent().parent().parent());
                    //alert(data.message);
                  }
                  else
                  {
                  }
                } 
              });

          } else {
            currentpos.prop('checked' , 'disabled');
            //$("input.group1").attr("disabled", true);
          }
        }
      });
    });
    jQuery(document).on('click', '.quizmenu', function(){
      var html = '';
      var quiz_id = jQuery(this).attr('quiz_id');
      
      jQuery.ajax({
        url:baseurl+'admin/Quizset/quizmenusubmit',
        data:{'quiz_id':quiz_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
              var count = 0;
            
              var setquizlistdetails = response.setquizlistdetails;
            jQuery.each( response.setquizlistdetails, function( i, val ) {
                count++;
                html += '<div class="question"><label>';
                html += count + '. '+ val.title +'<br>';
                html += '</label><span class="radio"><label class="radio-inline"><input name="quizuncheck1[]" type="checkbox" qset_id="'+quiz_id+'" value="'+ val.id +'" class="quizuncheck1"></label></span></div>';
            });
            

            jQuery('.question_text_menu').html(html);
            console.log(response.setquizlistdetails);
          }
        },
        error: function(){
          console.log("Error");
        }
      });
    });
    jQuery(document).on('click', '.quiztab', function(){
      var html = '';
      var quiz_id = jQuery(this).attr('quiz_id');
      
      jQuery.ajax({
        url:baseurl+'admin/Quizset/quiztabsubmit',
        data:{'quiz_id':quiz_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
            var count = 0;
            var result = response.result;
            jQuery.each( response.result.quiz_list, function( i, val ) {
              if(jQuery.inArray( val.id , response.result.set_quiz_list ) !== -1){

              }else{
                count++;
                html += '<div class="question"><label>';
                html += count + '. '+ val.title +'<br>';
                html += '</label><span class="radio"><label class="radio-inline"><input name="quizcheck1[]" type="checkbox" qset_id="'+quiz_id+'" value="'+ val.id +'" class="quizcheck1"></label></span></div>';
              
              }
            });
            console.log(html);

            jQuery('.question_text_tab').html('').html(html);
          }
        },
        error: function(){
          console.log("Error");
        }
      });
    });
    jQuery(document).on('click', '.quizset_delete', function(){
	  var html = '';
	  var quiz_id = jQuery(this).attr('delete_ques_id');
	    bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){
			  jQuery.ajax({
				url:baseurl+'admin/Quizset/quizsetdelete',
				data:{'quiz_id':quiz_id},
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


//no of question set

 jQuery(document).on('change', '.select_no_question', function(){

 
    var html = '';
    var cat_id = jQuery(this).attr('cat_id');
    var no_of_question = jQuery(this).val();
    /* alert(cat_id);
    alert(no_of_question);*/

        jQuery.ajax({
        url:baseurl+'admin/Quizset/updatenoofquestion',
        data:{'cat_id':cat_id,'no_question':no_of_question},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          console.log(response);
          if(response.success === 1 ){
            $('#message').html('<div class="alert alert-success fade in alert-dismissable level" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+"</div>");
            //location.reload(); 
            console.log(response);
          }
          if(response.success === 0 ){
            console.log(response);
            $('#message').html('<div class="alert alert-danger fade in alert-dismissable level" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+"</div>");
            window.scrollTo(0,0);
            setTimeout(function(){location.reload();},2000);
             
            console.log(response);
          }
        },
        error: function(){
          console.log("Error");
        }
        });
           
    });


//add group//
$(document).on('click','.editbtno',function(){
  $('#cattitle').val('');

  var cat_id=$(this).attr('edit_ques_id');
 /* alert('ffdfdfd');
  alert(cat_id);*/
  $('.picker').addClass('form-control1');

  var title=$('#cattitle').val();
  var title1=$('#grouptitle').val();

        $.ajax({
            url: baseurl+'admin/Quizset/getcatdetails',
            type: 'POST',
            dataType: 'json', 
            data: {
                name: title,
                cat_id:cat_id,

            },
            success: function(res) {
              console.log(res);
               /* $.each(res, function(key,value) {*/
                $("#cattitle").html('<option value="' +res.id + '">' +res.title + '</option>');
           /*    });*/
                  /*var $elem = $('#cattitle');
                  $elem.picker();*/
                  /*$elem.on('sp-change', function(){
                            alert('Great! Thanks for letting me know!');
                          });*/
            }
               });


          $.ajax({
            url: baseurl+'admin/Quizset/groupdetails',
            type: 'POST',
            dataType: 'json',  
            data: {
                    cat_id:cat_id,
                  },
            success: function(res) {
              console.log(res);
              if(res)
              {


                var domData='<div class="form-group"><div class="col-xs-12 text-left"><label for="grouptitle" class="title_text">Seleted Group:</label></div><div class="col-xs-12 text-left"><div class="form-control" style="min-height: 100px;height: auto;">';

                
               $.each(res, function(key,value) {
                  domData += '<span class="group-badge">'+value.group_name+'<span class="remove_group remove-group" groupbyid="'+value.id+'">&times;</span></span>';
               });
               domData +='</div></div></div>';
                $("#grp_select").html(domData);
              }
              else{
                $("#grp_select").html('');
              }
    
            }
               });

          $.ajax({
            url: baseurl+'admin/Quizset/getgroupdetails',
            type: 'POST',
            dataType: 'json',
            data: {
                name1:title1,
                category_id:cat_id,
            },
            success: function(res) {
               var domElement = '';
               $.each(res, function(key,value) {
                  domElement += '<option value="' + value.id + '">' + value.group_name + '</option>';
               });
              $(".selectpicker").html(domElement);
                /*var $elem =*/ $('.selectpicker').selectpicker();
                                $(".selectpicker").selectpicker("refresh");

                  /*$elem.*/
                  /*$elem.on('sp-change', function(){
                            alert('Great! Thanks for letting me know!');
                          });*/
            }
               });


  $('#groupcategoryModalLabel').html('ADD Group Category');
  $('#groupcategoryModal').modal('show');
});

$(document).on('click', '.remove_group',function(){
//alert($(this).attr('groupbyid'));
var groupbyid=$(this).attr('groupbyid');
  var parent = $(this).parent();
 jQuery.ajax({
        url:baseurl+'admin/Quizset/deleteselectedgroup',
        data:{'groupbyid':groupbyid},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
         if(response==true)
         parent.remove();
        },
        error: function(){
          console.log("Error");
        }
      });

});


 jQuery(document).on('keyup', '.quiz_search', function(){ 
      var html ='';
      var serach_key = this.value; 
      var quiz_id = jQuery(this).attr('quiz_id'); 
	  var quizset_id =  jQuery("#quizset_id").val(); 
      jQuery.ajax({
        url:baseurl+'admin/Quizset/quizsearch',
        data:{'serach_key':serach_key,'quizset_id':quizset_id},
        type:"POST",
        cache:false,
        dataType:"json",
        success: function(response){
          if(response.success == 1 ){
            var count = 0;
            var result = response.result;
            jQuery.each( response.result, function( i, val ) {
                count++;
                html += '<li class="list-group-item">';
                html += count + '. '+ val.title +'<span class="radio"><label class="radio-inline"><input type="checkbox" class="quizcheck1" value="'+ val.id +'" qset_id="'+quizset_id+'" name="quizcheck1[]"></label></span></li>';
            });
            console.log(html);

            jQuery('.qblck').html('').html(html);
          }else{
			 jQuery('.qblck').html('').html("<div class='text-center'> "+response.result+" <div>"); 
		  }
        },
        error: function(){
          console.log("Error");
        }
      });
    });
    jQuery(document).on('click', '.toggle', function(){
      var html = '';
      var status_chk = $(this).find('.quizset_status_chk').val();
      var quiz_set_id = $(this).find('.quizset_status_chk').attr('quizsetid');

      jQuery.ajax({
        url:baseurl+'admin/Quizset/quizsetstatuschk',
        data:{'quiz_set_id':quiz_set_id,'status_chk':status_chk},
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
	$(document).on('click','.badge',function(){

      var currentpos = $(this);
        currentpos.each(function(){
          
              flag=1;
              $q_id=currentpos.attr('data-quiz-id');
              $q_level=currentpos.attr('data-level');
              //alert($q_level);
              $q_setid=$("#quizset_id").val();
              $.ajax({
                type:'POST',
                url:baseurl+'admin/Quizset/deletequizset',
                dataType:"json",
                data:{qset_id:$q_setid,quiz_id:$q_id,level:$q_level},
                success: function(data){
                  console.log(data); 
                   bootbox.confirm("Are you sure you want to delete?", function (result) {
                  if(data)
                  {
					  if(data.success == 1){
              //alert('hello');
						currentpos.parent().remove();

						var qCount = $(".badge:visible").length;
						var countQno = (qCount == 1) ? "<span>"+qCount+"</span> "+ 'Question' : "<span>"+qCount+"</span> "+ 'Questions' ;
						$('.song-select').html(countQno);
						$('.qAttempt').html(qCount+' Attempted' );
            $('#message').html('<div class="alert alert-danger fade in alert-dismissable level" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data.message+"</div>");

						//uncheckedQuestion($q_setid); 

					  }else{
						 //return false; 
             $('#message').html('<div class="alert alert-success fade in alert-dismissable level" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data.message+"</div>");

					  }
                  }
                });
                } 
              });

          
      });
    });
	
	$(document).on('click',".editTitle", function(){
    $('#quizsetdesc').summernote({
     height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true,                  // set focus to editable area after initializing summernote
  disableResizeEditor: true
  });
  $('.note-btn-group.btn-group.note-view').remove();
		$("#editModal").modal();
	});
	
	$(document).on('change','#pname',function(){
		var value = $(this).val();
		var quizset_id = $("#quizset_id").val();
		$.ajax({
			type:'POST',
			url:baseurl+'admin/Quizset/editQuizsetTitle',
			dataType:"json",
			data:{quizset_id:quizset_id, title:value},
			success: function(data){
			  if(data)
			  {
				  if(data.success == 1){
					$('.editTitle').show();
				  }else{
					 return false; 
				  }
			  }
			} 
		  });
	});
	
	$(document).on('click','#btn_quiz_click',function(){
      //////////////////////////
       var url = window.location.href;
       var id = url.substring(url.lastIndexOf('/') + 1);
       var category_id=$('#btn_quiz_click').attr('quizset_id');
       var category_title=$('#btn_quiz_click').attr('quizset_title');
       
      /////////////////////////
      $('#exampleModalLabel').html('ADD QUIZ');
      $('#ques_add').attr('action',baseurl+'admin/Quizset/addquiz');
      var option_header = '<div class="row"><div class="col-xs-2"><div class="form-group"><label for="options"><strong>OPTION:</strong></label></div></div><div class="col-xs-4 addPbtn"><button type="button" class="btn btn-info pull-left" id="btn_add" name="btn">+</button></div></div>';
       options_html='<div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="A" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div><div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="B" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div>';
        $('.box_new2').html(option_header+options_html);
        $('#question').val('');
        $('#Points1').val('');
        $('#quizlevel').val('');
        $('#quizset_id1').val(id);
        $('#category_list').html('<option value="'+category_id+'">'+category_title+'</option>');
        $("#category_list").attr("disabled", true);
     $('#exampleModal').modal('show');

      /*$('#quizModalLabel').html('ADD QUIZ');
      $('#ques_add_quiz').attr('action',baseurl+'admin/Quizset/addquiz');
      var option_header = '<div class="row"><div class="col-xs-2"><div class="form-group"><label for="options"><strong>OPTION:</strong></label></div></div><div class="col-xs-4 addPbtn"><button type="button" class="btn btn-info pull-left" id="btn_add" name="btn">+</button></div></div>';
       options_html='<div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="A" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div><div class="row"><div class="col-xs-2"><div class="form-group"><input type="text" name="option-num[]" class="form-control option-num" value="B" readonly><strong></strong></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="optionsval[]" class="form-control optionsval" value=""><strong></strong></div></div><div class="col-xs-4"><div class="form-group"><div class="radio"><label class="radio-inline"><input name="optionscheck[]" type="checkbox" class="optionscheck"  value="1"></label></div></div></div><div class="clearfix"></div></div>';
        $('.box_new2').html(option_header+options_html);
        $('#question').val('');
        $('#Points1').val('');
        $('#quizlevel').val('');
     $('#quizModal').modal('show');*/
    });


  $(document).on('click','#btn_subm1',function(e){
    $('.help-error').remove();
      var flag=0;
      var group_cat=$('#grouptitle').val();
     
      if(group_cat!==null)
      {
        $('#quesgroup_add').submit();
      }
      else{
       
        $('#grouptitle').after('<span class="help-error">Please input this field</span>');
        e.preventDefault(); 
       flag1=1;
          
      }
  });
	 
/*	$(document).on('click','#btn_quiz',function(e){
   
   	  var flag=0;
      var flag1=0;
      $('.help-error').remove();
      var question=$('#question').val();
      if(question=='')
      {
      	$('#question').after('<span class="help-error">Please input this field</span>');
	  	e.preventDefault(); 
      flag1=1;
      }
      var points=$('#Points1').val();
   	  if(points=='')
      {
      	$('#Points1').after('<span class="help-error">Please input this field</span>');
        e.preventDefault(); 
          flag1=1;
      }
      var quizlevel=$('#quizlevel').val();
      if(quizlevel=='')
      {
        $('#quizlevel').after('<span class="help-error">Please input this field</span>');
        e.preventDefault(); 
          flag1=1; 
      }
	  $(".optionsval").each(function () {
			var optionval=$(this).val();
			if(optionval==''){
			  $( this ).after('<span class="help-error">Please input this field</span>');
			  event.preventDefault(); 
          flag1=1;
      }
      });
   	  $(".optionscheck").each(function(){
		if ($(this).prop('checked')==true){ 
			flag=1;
		}
	  });
   	  if(flag==0 || flag1==1){
         if(flag==0){
     	$('.addPbtn').after('<div class="col-xs-6"><span class="help-error" id="checkerror">Please select one option</span></div>'); 
      	}
       return false;  
      }
       else{
       $('#ques_add_quiz').submit();
    }
  });*/


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
          });

        });
	 /*$(document).find("#ques_add_quiz").validate({
       	   rules:{
			 question:{required: true,},
			 Points:{required: true,},
			 optionval:{required: true,},
       quizlevel:{required: true,},
           },
           messages:{
			  question:{required:"<span class='help-error'>Enter Question</span>"},
			  Points:{required: "<span class='help-error'>Enter points</span>"},
        quizlevel:{required: "<span class='help-error'>Enter Level</span>"},
			  optionval:{required:"Enter Option"}
           },
           submitHandler: function(form) {
             form.submit();
           }
      });*/

  });
function nextChar(c) {
    return String.fromCharCode(c.charCodeAt(0) + 1);
} 
 
