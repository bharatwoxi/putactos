<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRATION</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/datepicker/css/datepicker.css')}}" media="all" rel="stylesheet">
    <script src="{{URL::asset('assets/registration/js/modernizr.min.js')}}"></script>
</head>
<style type="text/css">
    .validation-success{
        border:2px solid green;
    }
    .validation-fail{
        border:2px solid red;
    }
    .error-class{
        color:red;font-size: 12px; padding: 8px 0;
    }
    /* Disclaimer: remove 'powered by Google' */
    .pac-container:after {
        background-image: none !important;
        height: 0px;
    }
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
<body  onload="initialize()">


@yield('content')



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('assets/registration/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/plugin.js')}}"></script>
<script src="{{URL::asset('assets/registration/js/main.js')}}"></script>
<script>
    var checkUsernameUrl = "{{URL::to('/check-username')}}";
    var checkFnameUrl = "{{URL::to('/check-firstname')}}";
    var checkLnameUrl = "{{URL::to('/check-lastname')}}";
    var checkEmailUrl = "{{URL::to('/check-email')}}";
    var checkPasswordUrl = "{{URL::to('/check-password')}}";
    var checkCpasswordUrl = "{{URL::to('/check-cpassword')}}";
    $(document).ready(function() {
        $('#birth_date').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script src="{{URL::asset('assets/registration/js/custom/registration-validation.js')}}"></script>
<!-- Google Places -->
<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places"></script>
<script src="{{URL::asset('assets/registration/js/custom/google-place.js')}}"></script>
<script src="{{URL::asset('assets/registration/datepicker/js/bootstrap-datepicker.js')}}"></script>
</body>
</html>