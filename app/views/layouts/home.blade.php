<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>putactos.com</title>

    <!-- Bootstrap -->
    <link href="{{URL::to('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('assets/registration/css/jquery.nstSlider.css')}}" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/registration/slider/css/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/registration/slider/css/style2.css')}}" />
    <script type="text/javascript" src="{{URL::to('assets/registration/slider/js/modernizr.custom.28468.js')}}"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="{{URL::to('assets/registration/slider/css/nojs.css')}}" />
    </noscript>

    <script src="{{URL::to('assets/registration/src/jquery.min.js')}}"></script>
    <!--	<script src="src/jquery.easing.min.js"></script>
        <script src="src/jquery.fadethis.js"></script>-->

    <style>
        .mody{
            font-size:36px;
            font-family:Calibri;
            color:#f74d4d;
            line-height: 30px;
        }
        .mody1{
            font-size:58px;
            font-family:Calibri;
            color:#000;
            line-height: 50px;
        }


    </style>



</head>
<body>
    @yield('content')
    <!--footer-->
    @include('footer.index')

    <!--footer ends here-->




    <script src="{{URL::to('assets/registration/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{URL::to('assets/registration/js/jquery.nstSlider.min.js')}}"></script>
    <script>
        $('.nstSlider').nstSlider({
            "left_grip_selector": ".leftGrip",
            "right_grip_selector": ".rightGrip",
            "value_bar_selector": ".bar",
            "value_changed_callback": function(cause, leftValue, rightValue) {
                $(this).parent().find('.leftLabel').text(leftValue);
                $(this).parent().find('.rightLabel').text(rightValue);
                $('#minimumAge').val(leftValue);
                $('#maximumAge').val(rightValue);
            }
        });
    </script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::to('assets/registration/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/registration/slider/js/jquery.cslider.js')}}"></script>
    <script type="text/javascript">
        $(function() {

            $('#da-slider').cslider({
                autoplay	: false,
                bgincrement	: 450
            });

        });
    </script>
    <script>
        function redirect(){
            window.location.href ='{{ URL::to('/signup/service-provider') }}';
        }
    </script>

    <!--fade js -->


</body>
@if(Auth::check())
@include('toastr.index')
@endif
</html>