<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 29/1/14
 * Time: 15:57 PM
 */
?>
@extends('layouts.customerRegistration')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
                                <div class="pull-right">
                                    <p  style="padding-top: 15px;">Not a Member?
                                        <button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff">Join Putactos</button>
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
            <div class="row" style="font-family:Roboto Th; color:#fff; padding: 20px;">
                <span style="color:#fff;  font-size:36px">FORGOT PASSWORD</span>
                                <div class="mini_nav pull-right" style="color:#ffff; font-family:Calibri">
                                    <span style="padding-right:20px; color:#fff">Select Language</span>
                                    <a href="#" class="lan_nav" style="padding-right:20px; color:#fff; text-decoration:underline;">ENGLISH</a>
                                    <a href="#" class="lan_nav" style="">SPANISH</a>
                                </div>
            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>

<!--Ajax errors-->
<div id="validation-errors" style="display:none">
    <div class="alert alert-danger" id="display-errors">

    </div>
</div>
<?
echo Session::get('error');
  ?>

@if($errors->any())
<div class="alert alert-danger">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    {{ Session::get('message') }}
</div>
@endif

<div class="container-fluid rconta">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            {{ Form::open(array('action' => 'RemindersController@postRemind','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'customerRegistration')) }}
            <div class="form-group">
                {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label','style'=>'text-align: -webkit-auto')) }}
                <div class="col-sm-3">
                    {{ Form::email('email',null,array('class'=>'form-control','id'=>'email')) }}
                </div>
            </div>
            <div style="margin-top: 30px; margin-bottom: 400px;">
                {{ Form::submit('Submit',array('name'=>'submit','id'=>'submit','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px'))}}
                {{ Form::reset('Reset',array('id'=>'reset','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 85px'))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>




<div class="col-lg-12" style="background-image:url(../../public/assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-3">
                <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('public/assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f; padding-left: 70px;">
                <h4 style="margin-bottom: 20px;">GET IN TOUCH</h4>
                <p><a href="#" ><img src="{{URL::asset('public/assets/registration/img/tele.png')}}" style="width:52px"></a>         <strong>1-800-355-2626</strong> </p>
                <P><a href="#" ><img src="{{URL::asset('public/assets/registration/img/msg.png')}}" style="width:52px"></a>      <strong>abc@putactos.com</strong>
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
@stop