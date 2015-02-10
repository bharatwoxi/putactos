<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRATION</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('public/assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <script src="{{URL::asset('public/assets/registration/js/modernizr.min.js')}}"></script>
</head>
<style type="text/css">
    #buttonGroupForm .btn-group .form-control-feedback {
        top: 0;
        right: -30px;
    }

    select {
        background-color: #fff!important;
        color: #333!important;
        padding-right: 16px;
        width: auto;
        height: 22px;

        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;

    }
    input:first-child, input#f {
        -webkit-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -moz-box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        box-shadow: inset 1px 1px 5px 0px #C7C1C1;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        left: -5px!important;
    }
    .mini_nav a{
        color:#ff9a9a;
        font-family:Calibri;
        font-size:16px;
    }

    .mini_nav a:hover{
        color:#fff;
        font-weight:bold;
        text-decoration:none;


    }
    /*.lan_nav a{
        color:#ff9a9a;
        font-size:36px;
        }

    .lan_nav a:hover{
        text-decoration:underline;

        }
    */


</style>
<body>


@yield('content')



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('public/assets/registration/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('public/assets/registration/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/plugin.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/js/main.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#username').keyup(function(e) {
            var username = $('#username').val();
            var mydata = 'username='+username;
            //##### Send Ajax request to response.php #########
            $.ajax({
                type: "POST", // HTTP method POST or GET
                url: "{{URL::to('/')}}/check-username", //Where to make Ajax calls
                dataType:"json", // Data type, HTML, json etc.
                data:mydata, //Form variables
                success:function(response){
                    if(response.success == false)
                    {
                        var arr = response.errors;
                        $("#display-errors").html('');
                        $.each(arr, function(index, value)
                        {
                            if (value.length != 0)
                            {
                                //$('#submit').attr('disabled','disabled');
                                $("#validation-errors").show();
                                $("#display-errors").append('<li class="error"><strong>'+ value +'</strong></li>');
                            }
                        });
                    }
                    else{
                        $("#validation-errors").hide();
                    }



                },
                error:function (xhr, ajaxOptions, thrownError){
                    //On error, we alert user
                    alert(thrownError);
                }
            });



        });
    });
</script>
</body>
</html>