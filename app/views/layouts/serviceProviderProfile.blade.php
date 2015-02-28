<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 23/1/15
 * Time: 2:51 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Information</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('public/assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/styles.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/edit_info.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/css/bootstrap-slider.css')}}" media="all" rel="stylesheet">
    <link href="{{URL::asset('public/assets/registration/datepicker/css/datepicker.css')}}" media="all" rel="stylesheet">
    <style>
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
    </style>
</head>
<body onload="initialize()">
@yield('content')

</body>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="{{URL::asset('public/assets/registration/js/bootstrap.min.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('public/assets/registration/js/bootstrap-slider.js')}}"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        /* Example 2 */
        $("#ex2").slider({});
        $('#birth_date').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select").each(function(){
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');
    })
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profileImagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profilePicture").change(function(){
        readURL(this);
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places"></script>
<script src="{{URL::asset('public/assets/registration/js/custom/google-place.js')}}"></script>
<script src="{{URL::asset('public/assets/registration/datepicker/js/bootstrap-datepicker.js')}}"></script>
</html>
