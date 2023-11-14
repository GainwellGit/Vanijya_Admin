var baseurl=window.location.origin+"/";
  $(document).ready(function() {
    if($('.alert').is(':visible')){
     $( ".alert" ).fadeOut( 5000 );
   }
  $('#summernote').summernote({
     height: 100,
  });

   $('#content_setting').submit(function(e) {
     var flag=0;
   $('.help-error').remove();
   var question=$('#faqtitle').val();
   if(question=='')
    {
      $('#faqtitle').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
    if ($('#summernote').summernote('isEmpty')) {
        /*$('#summernote').val('');*/
        $('.note-editor').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
     if(flag=0)
    {
       form.submit();
    }
});




   $(document).on('click', '.btn1_delete', function(){
    var html = '';
    var faqid = $(this).attr('delete_faq_id');
      bootbox.confirm("Are you sure you want to delete?", function(result) {
            if(result){
        $.ajax({
            type:'POST',
                 url:baseurl+'admin/setting/delete_faq',
                 dataType:"json",
                 data:{
                      token: '<?php echo $this->security->get_csrf_hash();?>',
                      id:faqid
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

   $(document).on('click','.btn_edit',function(){
    $('#dvLoading').show();
     $('#summernote1').summernote({
     height: 100,
  });
    
    var faq_id=$(this).attr('edit_faq_id'); 
   
   $('#faq_update').attr('action',baseurl+'admin/setting/updatefaq/'+faq_id);
    
    $.ajax({
                 type:'POST',
                 url:baseurl+'admin/setting/edit_faq',
                 dataType:"json",
                 data:{
                      id:faq_id
                      },
                success: function(data){
                  //console.log(data);
                $('#faqtitle1').val(data[0].faq_question);
             $('#summernote1').summernote('code',data[0].faq_answer);
                $('#dvLoading').hide();
                
              }
            });
                $('.help-error').remove();
                $('#faqlModalLabel').html('Edit Faq');
                $('#faqModal').modal('show');
              });
   $('#faq_update').submit(function(e) {
     var flag=0;
   $('.help-error').remove();
   var question=$('#faqtitle1').val();
   if(question=='')
    {
      $('#faqtitle1').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
    if ($('#summernote1').summernote('isEmpty')) {
        $('.note-editor').after('<span class="help-error">Please input this field</span>');
       e.preventDefault(); 
    }
     if(flag=0)
    {
       form.submit();
    }
});
 });