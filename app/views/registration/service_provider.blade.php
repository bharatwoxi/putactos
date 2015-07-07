@extends('layouts.spRegistration')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
<!--                <div class="pull-right">-->
<!--                    <p  style="padding-top: 15px;">Not a Member?-->
<!--                        <button type="button" class="btn btn-default" style="background-color:#a92124; color:#ffffff">Join Putactos</button>-->
<!--                    </p>-->
<!--                </div>-->
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->






<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            <div class="row" style="font-family:Roboto Th; color:#fff; padding: 20px;">
                <span style="color:#fff;  font-size:36px">SERVICE PROVIDER REGISTRATION</span>
            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>
<div class="alert alert-danger">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    All fields are mandatory
</div>
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
<div class="container-fluid" style="background-image: url(../../assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            {{ Form::open(array('url' => 'save-sp-data','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'customerRegistration')) }}
                <div class="form-group">
                    {{ Form::label('firstName', 'First Name*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::text('firstName',Input::old('firstName'),array('class'=>'form-control','id'=>'firstName','required'=>'required')) }}
                        <span id="fname-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('lastName', 'Last Name*', array('class' => 'col-sm-3  control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::text('lastName',Input::old('lastName'),array('class'=>'form-control','id'=>'lastName','required'=>'required')) }}
                        <span id="lname-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('username', 'Screen-name/Username*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::text('username',Input::old('username'),array('class'=>'form-control','id'=>'username','required'=>'required')) }}
                        <span id="username-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email address*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::email('email',Input::old('email'),array('class'=>'form-control','id'=>'email','required'=>'required')) }}
                        <span id="email-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::password('password',array('class'=>'form-control','id'=>'password','required'=>'required')) }}
                        <span id="password-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('confirmPassword', 'Confirm Password*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::password('confirmPassword',array('class'=>'form-control','id'=>'confirmPassword','required'=>'required')) }}
                        <span id="cpassword-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Location*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::text('currentLocation','',array('class'=>'form-control','id'=>'currentLocation','required'=>'required')) }}
                        <span id="location-error"></span>
                    </div>
                    <!--<div id="map-canvas" style="height:500px;width:500px;display:none;float:left;"></div>-->
                </div>
                <div class="form-group" style="margin-top:10px;">
                    <label for="Name" class="col-sm-3 control-label" style="text-align: -webkit-auto;">Gender*</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="gender" name="gender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Birth Date*', array('class' => 'col-sm-3 control-label','style'=>'text-align: -webkit-auto')) }}
                    <div class="col-sm-3">
                        {{ Form::text('birthDate',null,array('class'=>'form-control readonly','required'=>'required','id'=>'birth_date')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label" style="text-align: -webkit-auto;">Upload Picture*</label>
                    <div class="col-md-2">
                        <!--<input type="text" class="form-control" id="inputPassword3">-->
                        {{ Form::file('profilePicture',array('class'=>'btn btn-small btn-danger btn-inverse','id'=>'profilePicture','required'=>'required')) }}
                        <span id="profilePicture-error" class="error-class">file type:jpeg,jpg,png (2MB max)</span>
                        <!--<input type="image"  src="{{URL::asset('assets/registration/img/Upload.png')}}" style="width:85px; margin-top: 15px; height: 32px;">-->
                    </div>
                   <!-- <div class="col-md-2">
                        <input type="image" src="{{URL::asset('assets/registration/img/Browse.png')}}" style="width: 85px; vertical-align: text-top;height: 32px; margin-left: -20px;">
                    </div>-->
                </div>
                {{ Form::hidden('latitude',NULL,array('class'=>'form-control','id'=>'latitude')) }}
                {{ Form::hidden('longitude',NULL,array('class'=>'form-control','id'=>'longitude')) }}
                {{ Form::hidden('city',NULL,array('class'=>'form-control','id'=>'city')) }}
                {{ Form::hidden('country',NULL,array('class'=>'form-control','id'=>'country')) }}
            <div style="margin-top: 30px; margin-bottom: 400px;">
                <!--<input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
                <input type="image" src="{{URL::asset('assets/registration/img/save-2.png')}}" style="width: 100px; margin-left: 20px;">-->
                {{ Form::submit('Submit',array('name'=>'submit','id'=>'submit','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px;border: 2px solid #fa4d51;padding: 2px 6px;box-shadow: none;text-transform: uppercase;font-size: 16px;text-align: center;font-weight: bold;color: #fff;border-radius: 5px;float: left;background-color: #fa4d51;height: 25px;margin: 0 0 0 20px;outline:none;'))}}
                {{ Form::reset('Reset',array('id'=>'reset','class'=>'btn btn-small btn-danger btn-inverse','style'=>'width: 100px;border: 2px solid #fa4d51;padding: 2px 6px;box-shadow: none;text-transform: uppercase;font-size: 16px;text-align: center;font-weight: bold;color: #fff;border-radius: 5px;float: left;background-color: #fa4d51;height: 25px;margin: 0 0 0 20px;outline:none;'))}}
            </div>

            {{ Form::close() }}






        </div>
    </div>
</div>






<div class="col-lg-12" style="background-image:url(../../assets/registration/img/background.png); background-repeat:repeat;"> <!--Footer start-->
    <div class="container">
        <div class="row" style="margin:30px 0">
            <div class="col-md-4">
                <h4 style="margin-bottom: 20px;">CONNECT WITH US</h4>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/youtube.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/social.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/twitter.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
                <div class="clearfix"></div>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/skype.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/linkedin.png')}}" style="width:52px; margin: 0 15px 10px 0px"></a>
                <a href="#" ><img src="{{URL::asset('assets/registration/img/facebook.png')}}" style="width:52px; margin: 0 0 10px 0px"></a>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #0f0f0f;">
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
@stop