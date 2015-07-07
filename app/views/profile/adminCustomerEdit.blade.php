<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 23/1/15
 * Time: 2:40 PM
 */
?>
@extends('layouts.adminServiceProviderProfile')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="#" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->

<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row erawa">
                <span style="color:#fff;  font-size:43px">Customer</span>
                @include('header.adminUserMenu')
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
<div class="container-fluid econta">

    <div class="container">
        <div class="col-lg-6 ecolsix">
            {{ Form::open(array('url' => array('admin/cust/savePersonalData', $userData['systemUser']->customer_id),'class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
            <div class="form-group">
                <label for="Name" class="col-sm-5 control-label" style="text-align: left;">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{ ucwords($userData['systemUser']->user_first_name) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ ucwords($userData['systemUser']->user_last_name) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Screename/Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="userName" name="userName" value="{{ $userData['systemUser']->username }}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-5 control-label" style="text-align: left;">Email address</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" name="email" value="{{ $userData['systemUser']->email }}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Image Preview</label>
                <div class="col-md-4"><img height="100" width="100" id="profileImagePreview" src="{{URL::to('uploads/userdata/customer')}}/{{ sha1($userData['systemUser']->id) }}/profile_image/{{ $userData['systemUser']->profile_image }}" alt="your image" /></div><br/>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Profile Picture</label>
                <div class="col-md-6">
                    {{ Form::file('profilePicture',array('class'=>'btn btn-small btn-danger btn-inverse','id'=>'profilePicture')) }}
                    <span style="color: #f74d4d;font-size:16px;font-weight:900">(Max upload size is 2MB)</span>
                </div>
            </div>
            <div class="pull-left" style="margin-top:30px;margin-bottom: 30px;">
                <input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
            </div>
            {{ Form::close() }}
        </div>

        <div class="col-md-6 ecolsix">
            {{ Form::open(array('url' => array('admin/cust/savePassword',$userData['systemUser']->customer_id),'class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
            <!--<div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Current password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                </div>
            </div>-->
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">New password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">New password<br><span style="font-size:14px">(retype)</span></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                </div>
            </div>
            <div class="pull-left" style="margin-top:30px;margin-bottom: 30px;">
                <input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="container-fluid econte">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{ Form::open(array('url' => array('admin/cust/savePreferences', $userData['systemUser']->customer_id),'class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
                <div class="form-group">
                    <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Age Range</label>
                    <div class="col-md-7">
                        <div class='slider-example'>
                            <div class="well">
                                <b>18&nbsp;&nbsp;</b><input name="ageRange" id="ex2" type="text" class="span2" value="" data-slider-min="18" data-slider-max="99" data-slider-step="1" data-slider-value="[{{ $userData['systemUser']->from_age }},{{ $userData['systemUser']->to_age }}]"/><b>&nbsp;&nbsp;99</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" style="text-align: left;">Looking For</label>
                    <div class="col-sm-7">
                        @if($userData['gender']!=null && $userData['gender']->looking_for=='male')
                        <input type="radio" name="looking_for" value="male" checked/>Male
                        @else
                        <input type="radio" name="looking_for" value="male" />Male
                        @endif
                        @if($userData['gender']!=null && $userData['gender']->looking_for=='female')
                        <input type="radio" name="looking_for" value="female" checked/>Female
                        @else
                        <input type="radio" name="looking_for" value="female" />Female
                        @endif
                        @if($userData['gender']!=null && $userData['gender']->looking_for=='both')
                        <input type="radio" name="looking_for" value="both" checked/>Both
                        @else
                        <input type="radio" name="looking_for" value="both" />Both
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Location', array('class' => 'col-sm-5 control-label','style'=>'text-align: left;')) }}
                    <div class="col-sm-5">
                        {{ Form::text('currentLocation','',array('class'=>'form-control','id'=>'currentLocation')) }}
                        <span id="location-error">Current Location: {{ $userData['systemUser']->city }} {{ $userData['systemUser']->country }}</span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Birth Date', array('class' => 'col-sm-5 control-label','style'=>'text-align: left;')) }}
                    <div class="col-sm-5">
                        {{ Form::text('birthDate',$userData['systemUser']->birth_date,array('class'=>'form-control','readonly'=>'readonly','id'=>'birth_date')) }}
                    </div>
                </div>
                {{ Form::hidden('latitude',$userData['systemUser']->latitude,array('class'=>'form-control','id'=>'latitude')) }}
                {{ Form::hidden('longitude',$userData['systemUser']->longitude,array('class'=>'form-control','id'=>'longitude')) }}
                {{ Form::hidden('city',$userData['systemUser']->city,array('class'=>'form-control','id'=>'city')) }}
                {{ Form::hidden('country',$userData['systemUser']->country,array('class'=>'form-control','id'=>'country')) }}
                <div class="pull-left" style="margin-top:30px;margin-bottom: 30px;">
                    <input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@include('footer.index')
@stop