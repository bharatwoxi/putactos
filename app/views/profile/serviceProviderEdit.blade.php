<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 23/1/15
 * Time: 2:40 PM
 */
?>
@extends('layouts.serviceProviderProfile')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="#" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->

<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row erawa">
                <span style="color:#fff;  font-size:43px">EDIT YOUR INFORMATION</span>
                @include('header.userMenu')
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
            {{ Form::open(array('url' => 'service-provider/savePersonalData','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
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
                <div class="col-md-4"><img height="100" width="100" id="profileImagePreview" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($userData['systemUser']->id) }}/profile_image/{{ $userData['systemUser']->profile_image }}" alt="your image" /></div><br/>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Profile Picture</label>
                <div class="col-md-6">
                    {{ Form::file('profilePicture',array('class'=>'btn btn-small btn-danger btn-inverse','id'=>'profilePicture')) }}
                    <span style="color: #f74d4d;font-size:16px;font-weight:900">(Max upload size is 2MB)</span>
                </div>
            </div>
            <div class="pull-left" style="margin-top:30px;margin-bottom: 30px;">
                <input type="image" src="{{URL::asset('public/assets/registration/img/save.png')}}" style="width: 100px;">
            </div>
            {{ Form::close() }}
        </div>

        <div class="col-md-6 ecolsix">
            {{ Form::open(array('url' => 'service-provider/savePassword','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label" style="text-align: left;">Current password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                </div>
            </div>
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
                <input type="image" src="{{URL::asset('public/assets/registration/img/save.png')}}" style="width: 100px;">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="container-fluid econte">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{ Form::open(array('url' => 'service-provider/saveProfileData','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Gender</label>
                    <div class="col-sm-7">
                        @foreach($genders as $gender)
                        <label class="col-sm-3" style="padding-left: 0;">
                            <input type="radio" name="gender" id="inlineRadio1" value="{{ $gender->id }}" @if($userData['systemUser']->gender==$gender->id) checked="true" @endif>{{ strtolower($gender->gender) }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Pubic Hair</label>
                    <div class="col-sm-7">
                        <label class="col-sm-3" style="padding-left: 0;">
                            <input type="radio" name="pubicHair" id="pubicHair" value="1" @if($userData['serviceProvider']->pubic_hair==1) checked="true" @endif>Yes
                        </label>
                        <label class="col-sm-3" style="padding-left: 0;">
                            <input type="radio" name="pubicHair" id="pubicHair" value="0" @if($userData['serviceProvider']->pubic_hair==0) checked="true" @endif>No
                        </label>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Ethnicity</label>
                    <div class="col-sm-4 selectContainer">
                        <select class="fonza custom-select" name="ethnicity">
                            if(@if($userData['serviceProvider']->ethnicity==NULL)
                            <option value="0">Please Select</option>
                            @endif
                            @foreach($ethnicitys as $ethnicity)
                            <option value="{{ $ethnicity->id }}" @if($userData['serviceProvider']->ethnicity==$ethnicity->id) selected="selected" @endif>{{ $ethnicity->ethnicity }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Hair Color</label>
                    <div class="col-sm-4 selectContainer">
                        <select class="custom-select fonza" name="hairColor">
                            if(@if($userData['serviceProvider']->hair_color==NULL)
                                <option value="0">Please Select</option>
                            @endif
                            @foreach($hairColors as $hairColor)
                            <option value="{{ $hairColor->id  }}" @if($userData['serviceProvider']->hair_color==$hairColor->id) selected="selected" @endif>{{ $hairColor->hair_color }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Eye Color</label>
                    <div class="col-sm-4 selectContainer">
                        <select class="fonza custom-select" name="eyeColor">
                            if(@if($userData['serviceProvider']->eye_color==NULL)
                             <option value="0">Please Select</option>
                            @endif
                            @foreach($eyeColors as $eyeColor)
                            <option value="{{ $eyeColor->id  }}" @if($userData['serviceProvider']->eye_color==$eyeColor->id) selected="selected" @endif>{{ $eyeColor->eye_color }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($userData['systemUser']->gender == 2)
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Cup Size</label>
                    <div class="col-sm-4 selectContainer">
                        <select class="custom-select fonza" name="cup_size" id="cup_size">
                            @if($userData['serviceProvider']->cup_size==NULL)
                            <option value="0">Please Select</option>
                            @endif
                            @foreach($cupSizes as $cupSize)
                            <option value="{{ $cupSize->id  }}" @if($userData['serviceProvider']->cup_size==$cupSize->id) selected="selected" @endif>{{ $cupSize->cup_size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Bust</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="bust" id="bust" value="{{ $userData['serviceProvider']->bust }}" placeholder="in cm"/>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Waist</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="waist" id="waist" value="{{ $userData['serviceProvider']->waist }}" placeholder="in cm"/>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Hips</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="hips" id="hips" value="{{ $userData['serviceProvider']->hips }}" placeholder="in cm"/>
                    </div>
                </div>
                @endif
                @if($userData['systemUser']->gender == 1)
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Penis Size</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="penis_size" id="penis_size" value="{{ $userData['serviceProvider']->penis_size }}" placeholder="in cm"/>
                    </div>
                </div>
                @endif
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Height</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="height" id="height" value="{{ $userData['serviceProvider']->height }}" placeholder="in cm"/>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-sm-5 ecolfour" control-label>Weight</label>
                    <div class="col-sm-4 selectContainer">
                        <input type="text" class="form-control" name="weight" id="weight" value="{{ $userData['serviceProvider']->weight }}" placeholder="in kg"/>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Age Range</label>
                    <div class="col-md-7">
                        <div class='slider-example'>
                            <div class="well">
                                @if($userData['systemUser']->from_age!=null && $userData['systemUser']->to_age!=null)
                                    <b>18&nbsp;&nbsp;</b><input name="ageRange" id="ex2" type="text" class="span2" value="" data-slider-min="18" data-slider-max="99" data-slider-step="1" data-slider-value="[{{ $userData['systemUser']->from_age }},{{ $userData['systemUser']->to_age }}]"/><b>&nbsp;&nbsp;99</b>
                                @else
                                    <b>18&nbsp;&nbsp;</b><input name="ageRange" id="ex2" type="text" class="span2" value="" data-slider-min="18" data-slider-max="99" data-slider-step="1" data-slider-value="[18,99]"/><b>&nbsp;&nbsp;99</b>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Location', array('class' => 'col-sm-5 control-label','style'=>'text-align: left;')) }}
                    <div class="col-sm-4">
                        {{ Form::text('currentLocation','',array('class'=>'form-control','id'=>'currentLocation')) }}
                        <span id="location-error">Current Location: {{ $userData['systemUser']->city }} {{ $userData['systemUser']->country }}</span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Birth Date', array('class' => 'col-sm-5 control-label','style'=>'text-align: left;')) }}
                    <div class="col-sm-4">
                        {{ Form::text('birthDate',$userData['systemUser']->birth_date,array('class'=>'form-control','readonly'=>'readonly','id'=>'birth_date')) }}
                    </div>
                </div>
                {{ Form::hidden('latitude',$userData['systemUser']->latitude,array('class'=>'form-control','id'=>'latitude')) }}
                {{ Form::hidden('longitude',$userData['systemUser']->longitude,array('class'=>'form-control','id'=>'longitude')) }}
                {{ Form::hidden('city',$userData['systemUser']->city,array('class'=>'form-control','id'=>'city')) }}
                {{ Form::hidden('country',$userData['systemUser']->country,array('class'=>'form-control','id'=>'country')) }}
            </div>

            <div class="col-md-6">
                <h4 class="ehfour">Turns Me On</h4>
                <textarea class="form-control" rows="3"  placeholder="100 words" name="turnsMeOn" maxlength="100">{{$userData['serviceProvider']->turns_me_on}}</textarea>
            </div>
        </div> <!--close of row-->
    </div> <!--Close of Container-->
</div> <!--Close of container-->
<div class="clearfix"></div>
<div class="container-fluid econter">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <!--<div class="form-group">
                    <label class="col-sm-4 ecolfour" control-label>Interested In</label>

                    <div class="col-sm-7">
                        <label class="col-sm-3" style="padding-left: 0;">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Men
                        </label>
                        <label class="col-sm-5">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Woman
                        </label>
                        <label class="col-sm-4">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Both
                        </label>
                    </div>
                </div>
            <div class="clearfix"></div>-->
                <!--<form>
                    <div class="form-group">
                        <label class="col-sm-4 ecolfour" control-label>Availablity</label>				       								</div>
                </form>
                <div class="col-md-7">
                    <p class="epara"> Days</p>
                    <p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello1" value="" style="padding:15px"> Mon
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello2" value="" style="padding:15px"> Tue
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello3" value="" style="padding:15px"> Wed
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello4" value="" style="padding:15px"> Thu
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello5" value="" style="padding:15px"> Fri
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello6" value="" style="padding:15px"> Sat
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm colda">
                            <input type="checkbox" name="hello7" value="" style="padding:15px"> Sun
                        </label>
                    </div>

                    </p>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="Name" class="col-sm-2 control-label">Time</label>
                                <div class="col-sm-3" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;text-align: left;">to</label>
                                <div class="col-sm-3 pull-left" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="Name" class="col-sm-2 control-label" style="padding-left: 0;">Time</label>
                                <div class="col-sm-3" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;text-align: left;">to</label>
                                <div class="col-sm-3 pull-left" style="padding-left: 0;">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <input type="image" src="{{URL::asset('public/assets/registration/img/plus.png')}}" style="width:40px">

                            </div>
                            <label class="col-sm-4">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Set for all
                            </label>
                        </div>
                    </form>
                </div>-->
                <div class="pull-left" style="margin-top: 30px; margin-bottom: 50px;">
                    <input type="image" src="{{URL::asset('public/assets/registration/img/save.png')}}" style="width: 100px;">
<!--                    <input type="image" src="{{URL::asset('public/assets/registration/img/save-2.png')}}" style="width: 100px; margin-left: 20px;">-->
                </div>
                {{ Form::close() }}
            </div>
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