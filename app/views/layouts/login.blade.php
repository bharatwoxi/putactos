<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('assets/registration/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/registration/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- <link href="css/styles.css" media="all" rel="stylesheet">-->
    <link href="{{URL::asset('assets/registration/css/jquery.nstSlider.css')}}" rel="stylesheet">


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

    <div class="col-lg-12" style="background-image:url(../../assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
        <div class="container">
            <div class="row" style="margin:30px 0">
                <div class="col-md-3">
                    <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                    <div class="clearfix"></div>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                    <a href="#" ><img src="{{URL::asset('assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                </div>
                <div class="col-md-4" style="border-left: 2px solid #0f0f0f; padding-left: 70px;">
                    <h4 style="margin-bottom: 20px;">GET IN TOUCH</h4>
                    <p><a href="#" ><img src="{{URL::asset('assets/registration/img/tele.png')}}" style="width:52px"></a>         <strong>1-800-355-2626</strong> </p>
                    <P><a href="#" ><img src="{{URL::asset('assets/registration/img/msg.png')}}" style="width:52px"></a>      <strong>abc@putactos.com</strong>
                    </P>
                </div>
                <div class="col-md-4" style="border-left: 2px solid #0f0f0f; height: 175px;">
                    <ul style="list-style:none">
                        <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">ABOUT US</a></li>
                        <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">MEDIA </a></li>
                        <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">TESTIMONIALS </a></li>
                        <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">CAREERS</a></li>
                        <li><a href="#" style="text-decoration:none; font-size:24px; color:#000">FAQ'S</a></li>
                    </ul>
                </div>

            </div>


        </div><!-- CONTAINER ENDS HERE-->
    </div>
    <script src="{{URL::asset('assets/registration/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/registration/js/bootstrap.min.js')}}"></script>
</body>
</html>