<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 9/12/14
 * Time: 11:01 AM
 */
?>
@extends('layouts.login')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12 xyz" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
                <div class="pull-right">
                    <p  style="padding-top: 15px;">Not a Member?
                        <a href="{{ URL::to('/signup/customer') }}" style="text-decoration: none;color:#FFF"><button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff">Join Putactos</button></a>
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

<div class="container-fluid" style="background-image: url(../../assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
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
                        <p style="font-size:12px;"><a href="{{ URL::to('/forgot-passowrd') }}" style="text-decoration:none; color:#000">Forgot Password</a></p>

                        <!--<input type="image" src="img/Captcha.png" class="img-responsive">
                         <p style="font-size:16px; font-weight:bold">Type the words</p>
                           <input type="text" class="form-control" id="name">-->
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('captcha', 'Captcha', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3"">
                    {{ Form::sweetcaptcha() }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3" style="overflow: hidden;">
                    {{ Form::submit('Login',array('name'=>'submit','id'=>'submit','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px;border: 2px solid #fa4d51;padding: 2px 6px;box-shadow: none;text-transform: uppercase;font-size: 16px;text-align: center;font-weight: bold;color: #fff;border-radius: 5px;float: left;background-color: #fa4d51;height: 25px;margin: 0 0 0 20px;outline:none;'))}}
                    {{ Form::reset('Reset',array('id'=>'reset','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px;border: 2px solid #fa4d51;padding: 2px 6px;box-shadow: none;text-transform: uppercase;font-size: 16px;text-align: center;font-weight: bold;color: #fff;border-radius: 5px;float: left;background-color: #fa4d51;height: 25px;margin: 0 0 0 20px;outline:none;'))}}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop