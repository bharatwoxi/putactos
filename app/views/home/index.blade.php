<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 9/12/14
 * Time: 11:01 AM
 */
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = $_ENV['reCaptchSiteKey'];
$secret = $_ENV['reCaptchaSecretKey'];
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "en";

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;


?>
@extends('layouts.home')
@section('content')
<div class="container-fluid">
<div class="container">
    <div class="col-lg-12" >
        <div>
            <a href="#" class="navbar-static pull-left" style="margin:0"><img src="{{ URL::to('/public/assets/registration/img/Puktatos 3 b.png') }}" class="img-responsive" width="150"  /></a>
            <div class="pull-right">
                @if(!Auth::check())
                <p  style="padding-top: 15px;">Not a Member?
                    <a href="{{ URL::to('/signup/customer') }}" style="text-decoration:none; color:#ffffff">
                    <button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff">
                        <strong>Join Putactos</strong></button>
                    </a>
                    <button type="button" class="btn btn-primary" style="background-color:#a92124; color:#ffffff" data-toggle="modal" data-target="#myModal1"><strong>Login Now</strong></button>
                </p>
                @endif

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border-radius: 15px;">
                            <div class="modal-header" style="background: url(../../public/assets/registration/img/background1.png); background-repeat: repeat; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom: none;">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            </div>
                            <div class="modal-body" style="background: url(../../public/assets/registration/img/background1.png);
background-repeat: repeat;background-repeat: repeat; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                <div class="container-fluid">
                                    <div class="container">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="Name" class="col-sm-2 control-label" style="text-align: -webkit-auto;">Age Range</label>
                                                <div class="col-sm-3">
                                                    <div class="nstSlider" data-range_min="14" data-range_max="50"
                                                         data-cur_min="10"  data-cur_max="90" style="width: 240px;">

                                                        <div class="highlightPanel"></div>
                                                        <div class="bar"></div>
                                                        <div class="leftGrip"></div>
                                                        <div class="rightGrip"></div>
                                                    </div>

                                                    <div class="leftLabel" style=""></div>
                                                    <div class="rightLabel" style="margin-top: -25px; padding-left: 224px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="Name" class="col-sm-2 control-label" style="text-align: -webkit-auto;">Looking for</label>
                                                <div class="col-sm-3">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Female
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Both
                                                    </label>
                                                    <a href="people_near_by_en.html" target="_blank" style="text-decoration:none"><input type="image" src="{{ URL::to('/public/assets/registration/img/Go.png')}}" class="img-responsive" style="width:60px; padding-top:20px">
                                                    </a>

                                                </div>

                                            </div>

                                        </form>
                                    </div><!--End of container-->
                                </div> <!--End of container-fluid-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: url(../../public/assets/registration/img/background1.png);
background-repeat: repeat; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom: none;">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            </div>
                            <div class="modal-body" style="background: url(../../public/assets/registration/img/background1.png);
background-repeat: repeat;
 border-bottom-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom: none;">
                                <div class="container-fluid">
                                    <div class="container">
                                        {{ Form::open(array('url' => 'authenticate','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'login')) }}
                                        <div class="form-group">
                                            {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                                            <div class="col-sm-3">
                                                {{ Form::email('email',Input::old('email'),array('class'=>'form-control','style'=>'padding-left:5px','id'=>'email','required'=>'required')) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                                            <div class="col-sm-3" style="overflow: hidden;">
                                                {{ Form::password('password',array('class'=>'form-control','style'=>'padding-left:5px','id'=>'password','required'=>'required')) }}
                                                <p style="font-size:12px; padding-bottom: 30px;"><a href="#" style="text-decoration:none; color:#000">Forgot Password</a></p>

                                                <!-- <input type="image" src="img/Captcha.png" class="img-responsive">
                                                  <p style="font-size:16px; font-weight:bold">Type the words</p>
                                                    <input type="text" class="form-control" id="name">-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('captcha', 'Captcha', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                                            <div class="col-sm-3">
                                                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>" data-theme="dark"></div>
                                                <script type="text/javascript"
                                                        src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
                                                </script>
                                            </div><br/> <div class="clearfix"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5" style="overflow: hidden; margin-left: 10px;">
                                                    <input type="image" src="{{ URL::to('/public/assets/registration/img/LOgin.png')}}" class="img-responsive center-block" style="width:70px; margin-top: 20px;cursor:pointer;" id="login-image">
                                                </div>
                                            </div>
                                            </form>
                                        </div><!--End of container-->
                                    </div> <!--End of container-fluid-->
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->


<div class="clearfix"></div>
<div class="container-fluid">

    <div id="da-slider" class="da-slider">
        <!--<div class="da-slide" style="background:url(slider/images/slide.png) repeat;">

            <div style="background:url(slider/images/transperant.png) no-repeat; min-height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA;"><strong>MEET NEW PEOPLE</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;">SIMPLY</span><br>
                <span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;"><strong>AND FASTER</strong></span><br>
                <strong>Putactos is a great way to find real people</strong></p><br>

                <div class=""><a href="#" class="da-link" style="margin-top: 60px;"><img src="img/join.png" width="180" style="border:2px solid #fff;"></a></div>
            </div>
        </div>-->
        <div class="da-slide" style="background:url(../../public/assets/registration/slider/images/slide.png) repeat;">

            <div style="background:url(../../public/assets/registration/slider/images/transperant.png) no-repeat; min-height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA; text-transform:uppercase;"><strong>Get exactly what</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                    <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;text-transform:uppercase;">you</span><br>
                    <span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>want when</strong></span><br>
                    <strong>you want it</strong></p><br>

                <div class=""><a href="#" data-toggle="modal" data-target="#myModal" class="da-link" style="margin-top: 60px;"><img src="{{ URL::to('/public/assets/registration/img/join.png')}}" width="180" style="border:2px solid #fff;"></a></div>
            </div>
        </div>

        <div class="da-slide" style="background:url(../../public/assets/registration/slider/images/slide.png) repeat;">
            <div style="background:url(../../public/assets/registration/slider/images/transperant.png) no-repeat; height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>You only see</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                    <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;text-transform:uppercase;">people</span><br>
                    <span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>who are</strong></span><br>
                    <strong>nearby, and are up for a date</strong></p><br>
            </div>

            <div class=""><a href="#" data-toggle="modal" data-target="#myModal" class="da-link" style="margin-top: 60px;"><img src="{{ URL::to('/public/assets/registration/img/join.png')}}" width="180" style="border:2px solid #fff;"></a></div>
        </div>
        <div class="da-slide" style="background:url(../../public/assets/registration/slider/images/slide.png) repeat;">
            <div style="background:url(../../public/assets/registration/slider/images/transperant.png) no-repeat; height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>Leave</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                    <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;text-transform:uppercase;">no trace</span><br>
                    <!--<span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;"><strong>AND FASTER</strong></span><br>
                    <strong>Putactos is a great way to find real people</strong></p><br>-->
            </div>

            <div class=""><a href="#" data-toggle="modal" data-target="#myModal" class="da-link" style="margin-top: 60px;"><img src="{{ URL::to('/public/assets/registration/img/join.png')}}" width="180" style="border:2px solid #fff;"></a></div>
        </div>
        <div class="da-slide" style="background:url(../../public/assets/registration/slider/images/slide.png) repeat; ">
            <div style="background:url(../../public/assets/registration/slider/images/transperant.png) no-repeat; height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>Straight</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                    <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;text-transform:uppercase;">to the </span><br>
                    <span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>point</strong></span><br>
                    <!--  <strong>Putactos is a great way to find real people</strong></p><br>-->
            </div>

            <div class=""><a href="#" data-toggle="modal" data-target="#myModal" class="da-link" style="margin-top: 60px;"><img src="{{ URL::to('/public/assets/registration/img/join.png')}}" width="180" style="border:2px solid #fff;"></a></div>
        </div>


        <div class="da-slide" style="background:url(../../public/assets/registration/slider/images/slide.png) repeat; ">
            <div style="background:url(../../public/assets/registration/slider/images/transperant.png) no-repeat; height:200px;margin: 70px 0px; width:100%;">
                <h2 style="font-family:Roboto Th; color:#000; font-size:24px;text-shadow: 0px 0px 1px #BABABA;text-transform:uppercase;"><strong>No</strong></h2>
                <p style="font-family:Roboto Th; color:#000;">
                    <span style="font-family:Roboto Th; font-size:54px; color:#fff;text-shadow: -2px 1px 3px #000000;text-transform:uppercase;">disappointments</span><br>
                    <!-- <span style="font-family:Roboto Th; font-size:32px;color:#000;text-shadow: 0px 0px 1px #BABABA;"><strong>AND FASTER</strong></span><br>
                     <strong>Putactos is a great way to find real people</strong></p><br>-->
            </div>

            <div class=""><a href="#" data-toggle="modal" data-target="#myModal" class="da-link" style="margin-top: 60px;"><img src="{{ URL::to('/public/assets/registration/img/join.png')}}" width="180" style="border:2px solid #fff;"></a>


            </div>
        </div>
        <!--<nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>
        </nav>-->

    </div>



</div> <!--slider ends here-->
<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png);background-repeat: repeat;">
    <div class="container" style="">

        <!--<div class="row">
            <div class="col-lg-4" style="margin: 100px 0px;  style="text-transform: uppercase;"">
                <span class="mody">Learn how</span>
                <span class="mody1">Putactos <span style="color:#f74d4d;">is</span></span>
                <span class="mody">Changing the way</span>
                <span class="mody">People meet online</span>
            </div>


          </div>
            -->
        <div class="row">

            <div class="col-md-3" style="margin: 50px 0px;">
                <img src="{{ URL::to('/public/assets/registration/img/tv.png')}}" class="img-responsive center-block">
            </div>




            <div class="col-md-3" style="text-align:center; margin-top:250px;">
                <img src="{{ URL::to('/public/assets/registration/img/right_mark_lgo.png')}}">

                <h3><strong>SAFE</strong></h3>
                <p style="font-weight: 600;">
                    Your card details are encrypted<br> and stored only on your phone<br> - nowhere else.
                    We don’t know<br> them, and neither will shops or<br> restaurants.
                </p>
            </div>



            <div class="col-md-3" style="margin-top:70px;">
                <img src="{{ URL::to('/public/assets/registration/img/apple.png')}}" width="235" class="img-responsive center-block">
            </div>



            <div class="col-md-3" style="text-align:center; margin-top:80px;">
                <img src="{{ URL::to('/public/assets/registration/img/gift.png')}}" style="margin-right: 100px;">


                <p style="font-weight: 600;">
                    Putactos is free, and there are<br> no additional charges when<br> you use it.
                    It’s like swiping your<br> card - only faster, safer and<br> more convenient.
                </p>
            </div>




            <div class="col-md-3" style="text-align:center; margin-top:10px;">


                <h3><strong>EASY</strong></h3>
                <p style="font-weight: 600;">
                    Using Putactos is easy, fast<br> and fun. In few simple clicks<br> you will be ready
                    to meet<br> thousands of people across<br> the world and in locality<br> near you
                </p>
                <img src="{{ URL::to('/public/assets/registration/img/tea.png')}}" style="margin: -50px 0 0 200px;">
            </div>

        </div>

    </div> <!--container ends here-->
</div><!--container-fluid ends here-->


<div style="text-align:center;padding:10px 0px;background:#f74d4d; font-size:36px;color:#fff;font-weight: 600;">

    PUTACTOS IS THE FASTEST GROWING ADULT SOCIAL NETWORK IN EUROPE

</div>


<div class="container-fluid" style="background-image:url(../../public/assets/registration/img/grp_people.png); width:100%; max-width:1600px; height:655px;">
    <!--<img src="img/grp_people.png" class="img-responsive">-->

    <img src="{{ URL::to('/public/assets/registration/img/matches.png')}}" class="img-responsive center-block" style="padding-top: 50px;">



    <p style="text-transform: uppercase; font-weight:600; font-family:Roboto Th; font-size:32px; text-align:center; color:#fff; padding-top:20px;">
        Play our popular Encounters game and get matched with other<br>
        users. It’s a great way to break the ice and chat to new people.
    </p>


    <img src="{{ URL::to('/public/assets/registration/img/play_enconter.png')}}" class="img-responsive center-block" style="padding-top:50px;">

</div>

<div class="container-fluid">

    <div class="col-md-3 col-xs-offset-1" style="padding-top:40px;">

        <img src="{{ URL::to('/public/assets/registration/img/hand_phone.png')}}" class="img-responsive">

    </div>
    <div class="col-md-7" style="padding-top: 100px;">

        <img src="{{ URL::to('/public/assets/registration/img/chat_anywhere.png')}}" class="img-responsive pull-left center-block">



        <p class="pull-left" style="font-family:Roboto Th; padding-left:40px;font-size: 32px;line-height: 30px;
                        padding-top: 10px;color: #b73c34;text-transform: uppercase;font-weight: 600;">
            Putactos works on your<br>
            computer and your mobile.<br>
            Keep in touch<br>
            wherever you go,<br>
            whenever you want.
        </p>

    </div>

    <div class="col-md-5" style="padding-top: 50px;">

        <img src="{{ URL::to('/public/assets/registration/img/download.png')}}" class="img-responsive center-block">

    </div>
</div>


<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png);background-repeat: repeat;">

    <p class="text-center center-block" style="font-family: calibri;font-size: 60px; margin:0">
        GET PUTACTOS NOW
    </p>


    <p style="font-family:Roboto Th; font-size:32px; text-transform:uppercase; text-align:center;font-weight: 600;">
        Download it for free from your favourite app store
    </p>

</div>

<div class="container-fluid" style="background:#b73c34;">
    <div class="container">
        <div class="col-md-4" style="padding: 50px 0px;">

            <img src="{{ URL::to('/public/assets/registration/img/android.png')}}" class="img-responsive center-block">

        </div>
        <div class="col-md-4" style="padding: 50px 0px;">

            <img src="{{ URL::to('/public/assets/registration/img/apple_logo.png')}}" class="img-responsive center-block">

        </div>
        <div class="col-md-4" style="padding: 50px 0px;">

            <img src="{{ URL::to('/public/assets/registration/img/blackberry.png')}}" class="img-responsive center-block">

        </div>
    </div>
</div>


<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png);background-repeat: repeat; padding:10px 0"></div>


<div class="container-fluid" style="background-color: #b13935;">
    <div class="container" style="background:url(../../public/assets/registration/img/all_grp_people.png); width:100%; max-width:1378px; height:510px;">

        <div class="col-md-3 col-xs-offset-1" style="padding-top:40px;">

            <img src="{{ URL::to('/public/assets/registration/img/profile.png')}}" class="img-responsive">

        </div>
        <div class="col-md-8 pull-right" style="padding-top: 100px;">

            <img src="{{ URL::to('/public/assets/registration/img/people_nearby.png')}}" class="img-responsive pull-left">



            <p class="pull-left" style="font-family:Roboto Th; padding-left:40px;font-size: 32px;line-height: 36px;padding-top: 10px;color: #fff;
    text-transform: uppercase;font-weight: 600;">
                We won’t show your exact <br>
                location, but you’ll be<br>
                able to find people nearby who<br>
                like the same things you do.
            </p>


        </div>

        <div class="col-md-5" style="padding-top: 50px;">

            <img src="{{ URL::to('/public/assets/registration/img/find.png')}}" class="img-responsive center-block">

        </div>

    </div>
</div>

<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png);background-repeat: repeat;">
    <div class="container" style="padding: 50px 0px;">
        <div class="row">
            <div class="col-md-6">

                <img src="{{ URL::to('/public/assets/registration/img/six_icons.png')}}" class="img-responsive">

            </div>

            <div class="col-md-6" style="padding-top:40px;">

                <img src="{{ URL::to('/public/assets/registration/img/share_intrest.png')}}" class="img-responsive">


                <p class="pull-left" style="font-family:Roboto Th; padding-left:30px;font-size: 32px;line-height: 36px;padding-top: 10px;color: #b73c34;
    text-transform: uppercase;font-weight: 600;">
                    Raise your chances of being<br>
                    found by people. who share <br>
                    your interests, and get chatting.
                </p>

            </div>

        </div>
    </div>
</div>
@if(!Auth::check())
<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/blacl_strip.png);background-repeat: repeat;height: 286px;">

    <p style="text-align:center; font-family:Roboto Th; font-size:54px;color: #fff;padding-top: 70px;">
        SIGN UP NOW
    </p>
        <button type="button" class="btn btn-default center-block" onclick="redirect()" style="background-color:#a92124; color:#ffffff" data-toggle="modal" data-target="#myModa">
            <strong>Join Putactos</strong></button>
    <p style="text-align:center; font-family:Roboto Th; font-size:18px;color: #fff;">
        Join the fastest growing adult network in Europe
    </p>

</div>
@endif

<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png);background-repeat: repeat; background-color:#dbdbdb;">
    <div class="container" style="padding:0; background:url(../../public/assets/registration/img/bg_pelple.png); width:100%; max-width:1327px; min-height:944px;margin-top: 80px;">
        <div class="container">

            <div class="col-lg-6" style="padding-top: 100px;">

                <img src="{{ URL::to('/public/assets/registration/img/testi1.png')}}" class="img-responsive">

            </div>
            <div class="col-md-6" style="padding-top: 90px;">

                <p style="font-family:Roboto Th;font-size: 40px;font-weight: 600;padding: 60px 0 0 30px;text-transform: uppercase;">
                    Rashiq Fataar
                </p>

                <p style="font-family:calibri; font-size: 16px;padding-left: 35px;margin-top: -20px;">
                    Bree Street, Cape Town CBD
                </p>

                <p style="font-family:calibri;font-size: 36px;padding-left: 35px;line-height: 36px;">
                    “Putactos is changing the way<br> people meet for fun. It's the next<br> big step towards making life awe-<br>some in our society.”
                </p>

            </div>

            <div class="clearfix"></div>

            <div class="col-md-6" style="padding-top: 90px;">

                <p style="font-family:Roboto Th;font-size: 40px;font-weight: 600;padding: 60px 0 0 30px;text-transform: uppercase;">
                    Kebone Bolofo
                </p>

                <p style="font-family:calibri; font-size: 16px;padding-left: 35px;margin-top: -20px;">
                    Sandton, Johannesburg
                </p>

                <p style="font-family:calibri;font-size: 36px;padding-left: 35px;line-height: 36px;">
                    “My work place is always full of<br> people I want to avoid but i need<br> an avenue to meet fun people too.<br> Putactos gives me that perfectly”
                </p>

            </div>
            <div class="col-lg-6" style="padding-top: 100px;">

                <img src="{{ URL::to('/public/assets/registration/img/testi2.png')}}" class="img-responsive">

            </div>

        </div>
    </div>
</div>

<div class="clearfix"></div>
@stop