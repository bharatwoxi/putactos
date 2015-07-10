$(document).ready(function(){
    $('#currentLocation').val('');
    $('#latitude').val('');
    $('#longitude').val('');
    $('#city').val('');
    $('#country').val('');


    /* Check Form Submit */
    $('#customerRegistration').submit(function(event){

        if($('#latitude').val()!='' && $('#longitude').val()!=''){
            $('#currentLocation').removeClass('validation-fail');
            $('#currentLocation').addClass('validation-success');
            $("#location-error").hide();
            return true;
        }else{
            event.preventDefault();
            //$("#username-error").show();
            $("#location-error").empty().html('<li class="error-class"><strong>Please select your location from google places</strong></li>');
            $('#currentLocation').removeClass('validation-success');
            $('#currentLocation').addClass('validation-fail');

        }

    });
    $('#username').keyup(function(e) {
        var username = $('#username').val();
        var mydata = 'username='+username;
        //##### Send Ajax request to response.php #########
        $.ajax({
            type: "POST", // HTTP method POST or GET
            url: checkUsernameUrl, //Where to make Ajax calls
            dataType:"json", // Data type, HTML, json etc.
            data:mydata, //Form variables
            success:function(response){
                if(response.success == false)
                {
                    $('#username').removeClass('validation-success');
                    $('#username').addClass('validation-fail');
                    var arr = response.errors;
                    $("#username-error").html('');
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                            //$('#submit').attr('disabled','disabled');
                            $("#username-error").show();
                            $("#username-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                        }
                    });
                }
                else{
                    $('#username').removeClass('validation-fail');
                    $('#username').addClass('validation-success');
                    $("#username-error").hide();
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //On error, we alert user
                alert(thrownError);
            }
        });
    });
});
$('#username').on("blur",function (e) {
    var username = $('#username').val();
    var mydata = 'username='+username;
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkUsernameUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false)
            {
                $('#username').removeClass('validation-success');
                $('#username').addClass('validation-fail');
                var arr = response.errors;
                $("#username-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#username-error").show();
                        $("#username-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#username').removeClass('validation-fail');
                $('#username').addClass('validation-success');
                $("#username-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});
$('#firstName').on("blur",function (event) {
    var mydata = 'firstName='+$(this).val();
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkFnameUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false)
            {
                $('#firstName').removeClass('validation-success');
                $('#firstName').addClass('validation-fail');
                var arr = response.errors;
                $("#fname-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#fname-error").show();
                        $("#fname-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#firstName').removeClass('validation-fail');
                $('#firstName').addClass('validation-success');
                $("#fname-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});
$('#lastName').on("blur",function (event) {
    var mydata = 'lastName='+$(this).val();
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkLnameUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false)
            {
                $('#lastName').removeClass('validation-success');
                $('#lastName').addClass('validation-fail');
                var arr = response.errors;
                $("#lname-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#fname-error").show();
                        $("#lname-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#lastName').removeClass('validation-fail');
                $('#lastName').addClass('validation-success');
                $("#lname-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});
$('#email').on("blur",function (event) {
    var mydata = 'email='+$(this).val();
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkEmailUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false)
            {
                $('#email').removeClass('validation-success');
                $('#email').addClass('validation-fail');
                var arr = response.errors;
                $("#email-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#email-error").show();
                        $("#email-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#email').removeClass('validation-fail');
                $('#email').addClass('validation-success');
                $("#email-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});
$('#password').on("blur",function (event) {
    var mydata = 'password='+$(this).val();
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkPasswordUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false){
                $('#password').removeClass('validation-success');
                $('#password').addClass('validation-fail');
                var arr = response.errors;
                $("#password-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#password-error").show();
                        $("#password-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#password').removeClass('validation-fail');
                $('#password').addClass('validation-success');
                $("#password-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});
$('#confirmPassword').on("blur",function (event) {
    var mydata = 'password='+$('#password').val()+'&confirmPassword='+$(this).val();
    //##### Send Ajax request to response.php #########
    $.ajax({
        type: "POST", // HTTP method POST or GET
        url: checkCpasswordUrl, //Where to make Ajax calls
        dataType:"json", // Data type, HTML, json etc.
        data:mydata, //Form variables
        success:function(response){
            if(response.success == false)
            {
                $('#confirmPassword').removeClass('validation-success');
                $('#confirmPassword').addClass('validation-fail');
                var arr = response.errors;
                $("#cpassword-error").html('');
                $.each(arr, function(index, value)
                {
                    if (value.length != 0)
                    {
                        //$('#submit').attr('disabled','disabled');
                        $("#cpassword-error").show();
                        $("#cpassword-error").append('<li class="error-class"><strong>'+ value +'</strong></li>');
                    }
                });
            }
            else{
                $('#confirmPassword').removeClass('validation-fail');
                $('#confirmPassword').addClass('validation-success');
                $("#cpassword-error").hide();
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //On error, we alert user
            alert(thrownError);
        }
    });
});