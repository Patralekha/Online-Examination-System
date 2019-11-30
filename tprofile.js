// Ajax call to updateusername.php
$("#updateusernameform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "tupdateusername.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updateusernamemessage").html(data);
            }else{
                location.reload();   
            }
        },
        error: function(){
            $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});

// Ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updatepasswordmessage").html(data);
            }else{
                location.reload();   
            }
        },
        error: function(){
            $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});



// Ajax call to updateemail.php
$("#updateemailform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "tupdateemail.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updateemailmessage").html(data);
            }else{
                location.reload();   
            }
        },
        error: function(){
            $("#updateemailmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});