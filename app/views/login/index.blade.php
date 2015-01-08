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
@extends('layouts.login')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
                <div class="pull-right">
                    <p  style="padding-top: 15px;">Not a Member?
                        <button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff"><a href="#" style="text-decoration: none;color:#FFF">Join Putactos</a></button>
                    </p>
                </div>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->






<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            <div class="row" style="font-family:Roboto Th; color:#fff; padding: 20px; margin-bottom: 15px;">
                <span style="color:#fff;  font-size:36px">LOGIN</span>

            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>

@if($errors->any())
<div class="alert alert-danger">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-danger">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    {{ Session::get('message') }}
</div>
@endif

<div class="container-fluid" style="background-image: url(../../public/assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
                {{ Form::open(array('url' => 'authenticate','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'customerRegistration')) }}
                <div class="form-group">
                    {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::email('email',Input::old('email'),array('class'=>'form-control','style'=>'padding-left:5px','id'=>'email','required'=>'required')) }}
                    </div>
                </div>
                <div class="form-group" style="">
                    {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3" style="overflow: hidden;">
                        {{ Form::password('password',array('class'=>'form-control','style'=>'padding-left:5px','id'=>'password','required'=>'required')) }}
                        <p style="font-size:12px;"><a href="#" style="text-decoration:none; color:#000">Forgot Password</a></p>

                        <!--<input type="image" src="img/Captcha.png" class="img-responsive">
                         <p style="font-size:16px; font-weight:bold">Type the words</p>
                           <input type="text" class="form-control" id="name">-->
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('captcha', 'Captcha', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3"">
                        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>" data-theme="dark"></div>
                        <script type="text/javascript"
                                src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3" style="overflow: hidden;">
                    {{ Form::submit('Login',array('name'=>'submit','id'=>'submit','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px'))}}
                    {{ Form::reset('Reset',array('id'=>'reset','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 85px'))}}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop