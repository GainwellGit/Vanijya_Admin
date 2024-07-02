var url=window.location.origin+"/vanijya/";
    jQuery(document).on('click', '#genlocationcoupon', function(){
        var html = '';
        var location_id = $(this).attr("data-id");
        $('.generate').text('Please wait...');
        jQuery.ajax({
            url:url+'admin/location/generatecode',
            data:{'location_id':location_id},
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


    jQuery(document).on('click', '.deletemapping', function(){
        var html = '';
        var r = confirm("This will delete the particular Ordering Plant and also delete all Delivery center related to this Plant");
        var plant_id = $(this).attr("data-id");
        if (r == true) {
            $('.deletemapping').text('wait...');
            jQuery.ajax({
                url:url+'admin/location/deletemapping',  
                data:{'plant_id':plant_id},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    if(response == 1 ){
                        location.reload();
                        
                    }
                },
                error: function(){
                    console.log("Error");
                }
            });
        }
    });
	
	jQuery(document).on('click', '.deleteemail', function(){
        var html = '';
        var r = confirm("Are you sure to delete this email ? ");
        var email_id = $(this).attr("data-id");
        if (r == true) {
            $('.email'+email_id).text('wait...');
            jQuery.ajax({
                url:url+'admin/location/deleteemail',  
                data:{'id':email_id},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    if(response == 1 ){
                        location.reload();
                        
                    }
                },
                error: function(){
                    console.log("Error");
                }
            });
        }
    });



    jQuery(document).on('click', '.deliveryDelete', function(){
        var html = '';
        var r = confirm("Are you sure to delete this Delivery Center ?");
        var delivery_id = $(this).attr("data-id");
        if (r == true) {
           
            jQuery.ajax({
                url:url+'admin/location/deletedelivery',  
                data:{'delivery_id':delivery_id},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    if(response == 1 ){
                        location.reload();
                        
                    }
                },
                error: function(){
                    console.log("Error");
                }
            });
        }
    });

    jQuery(document).on('click', '#genzonecoupon', function(){
        
        var html = '';
        var location_id = $(this).attr("data-id");
        
        $('.generate').text('Please wait...');

        jQuery.ajax({
            url:url+'admin/location/generatezonecode',
            data:{'location_id':location_id},
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




