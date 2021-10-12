$(document).ready(function(){
    $('#submit').click(function(e){
        
        //Stop form submission & check the validation
        e.preventDefault();
        
        // Variable declaration
        var error = false;
        var name = $('#name').val();
        var email = $('#email').val();
        var wish = $('#wish').val();
        var attend = $('#attend').val();
        var sesi = $('#sesi').val();
        
        
        $('#name,#email,#wish,#attend').click(function(){
            $(this).removeClass("is-invalid");
        });
        
         // Form field validation
        if(name.length == 0){
            var error = true;
            $('#name').addClass("is-invalid");
        }else{
            $('#name').removeClass("is-invalid");
        }
        var atposition=email.indexOf("@");  
        var dotposition=email.lastIndexOf(".");  
        if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length){
            var error = true;
            $('#email').addClass("is-invalid");
        }else{
            $('#email').removeClass("is-invalid");
        }
        if(wish.length == 0 || wish.length > 50 ){
            var error = true;
            $('#wish').addClass("is-invalid");
        }else{
            $('#wish').removeClass("is-invalid");
        }
       if(!$('#attend').val()) {
            var error = true;
            $('#attend').addClass("is-invalid");
        }else{
            $('#attend').removeClass("is-invalid");
        }
        if(sesi.length == 0){
            var error = true;
            $('#sesi').addClass("is-invalid");
        }else{
            $('#sesi').removeClass("is-invalid");
        }
        
        
        // If there is no validation error, next to process the mail function
        if(error == false){
           // Disable submit button just after the form processed 1st time successfully.
            $('#submit').attr({'disabled' : 'true', 'value' : 'Sending...' });
            
            /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
            $.post("rsvp.php", $("#rsvp1").serialize(),function(result){
                //Check the result set from email.php file.
                if(result == 'sent'){
                    //If the email is sent successfully, remove the submit button
                     $('#submit').remove();
                    //Display the success message
                    $('#mail_success').fadeIn(500);
                }else{
                    //Display the error message
                    $('#mail_fail').fadeIn(500);
                    // Enable the submit button again
                    $('#submit').removeAttr('disabled').attr('value', 'Confirm');
                }
            });
            /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
            $.post("rsvp.php", $("#rsvp1").serialize(),function(result){
                //Check the result set from email.php file.
                if(result == 'sent'){
                    //If the email is sent successfully, remove the submit button
                     $('#submit').remove();
                    //Display the success message
                    $('#mail_success').fadeIn(500);
                }else{
                    //Display the error message
                    $('#mail_fail').fadeIn(500);
                    // Enable the submit button again
                    $('#submit').removeAttr('disabled').attr('value', 'Confirm');
                }
            });
        }
    });    
});