
$(document).ready(function()
{

$(document).on('click','#btn_subm',function(){
   var flag=0;
    $('.help-error').remove();
   var msdinuser=$('#msdinval').val();
  if(msdinuser=='')
  {
  $('#msdinval').after('<span class="help-error">Please input this field</span>');
       flag=1;
     }
  else
  {
    flag=0;
    table = $('#UsrTable').DataTable({ 
      "language": {
            "infoEmpty": "No records available",
        },
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo base_url('admin/trackinguserquiz/quiz_list')?>",
          "type": "POST",
          "data":  {msdin:msdinuser},
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          
          "targets": "_all", //first column / numbering column
          "orderable": false, //set not orderable
        },
        ],
       //data: 'dsdfsdfsd',

    });
    $.fn.dataTable.ext.errMode = 'none';
   $('#UsrTable').show(); 
  }

  
});

  });
 