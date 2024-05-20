var UIConfirmations = function () {

    var handleSample = function () {
        

        $('.quizset_delete').on('confirmed.bs.confirmation', function () {
              var html = '';
              var quiz_id = $(this).attr('delete_ques_id');
              
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
            });


        $('#bs_confirmation_demo_1').on('confirmed.bs.confirmation', function () {
            alert('You confirmed action #1');
        });

        $('#bs_confirmation_demo_1').on('canceled.bs.confirmation', function () {
            alert('You canceled action #1');
        });   

        $('#bs_confirmation_demo_2').on('confirmed.bs.confirmation', function () {
            alert('You confirmed action #2');
        });

        $('#bs_confirmation_demo_2').on('canceled.bs.confirmation', function () {
            alert('You canceled action #2');
        });
    }


    return {
        //main function to initiate the module
        init: function () {

           handleSample();

        }

    };

}();

jQuery(document).ready(function() {    
   UIConfirmations.init();
});