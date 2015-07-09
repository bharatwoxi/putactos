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
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
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
            <fieldset style="box-shadow: 1px 1px 2px 2px #FA4B48;padding: 1.4em 1.4em 0.2em 1.4em !important;border-radius: 5px;">
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
                    <label for="Name" class="col-sm-5 control-label" style="text-align: left;">Screen-name/Username</label>
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
                    <div class="col-md-4"><img height="100" width="100" id="profileImagePreview" src="{{URL::to('uploads/userdata/service_provider')}}/{{ sha1($userData['systemUser']->id) }}/profile_image/{{ $userData['systemUser']->profile_image }}" alt="your image" /></div><br/>
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
            </fieldset>
        </div>

        <div class="col-md-6 ecolsix">
            <fieldset style="box-shadow: 1px 1px 2px 2px #FA4B48;padding: 1.4em 1.4em 0.2em 1.4em !important;border-radius: 5px;">
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
                    <input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
                </div>
                {{ Form::close() }}
            </fieldset>
        </div>
        <div class="col-md-6 ecolsix">
            <span>Drop files to upload or click</span>
            {{ Form::open(array('url' => 'add-multiple-images','class'=>'dropzone uploadform no-margin dz-clickable form-horizontal','role'=>'form','files'=>true,'id'=>'myDropzone')) }} {{Form::close()}}
            <!--                <form action="#" enctype="multipart/form-data" method="POST" class="dropzone uploadform no-margin dz-clickable" id="myDropzone"></form>-->
        </div>
    </div>
</div>

<div class="container-fluid econte">
<div class="container">
<fieldset style="box-shadow: 1px 1px 2px 2px #FA4B48;margin-bottom: 20px;padding: 1.4em 1.4em 0em 1.4em !important;border-radius: 5px;">
<div class="row">
<div class="col-md-6">
{{ Form::open(array('url' => 'service-provider/saveProfileData','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveSpData')) }}
<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>P H</label>
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
    	<span class="select-wrapper1">
        <select class="fonza custom-select1" name="ethnicity">
            @if($userData['serviceProvider']->ethnicity==NULL)
            <option value="0">Please Select</option>
            @endif
            @foreach($ethnicitys as $ethnicity)
            <option value="{{ $ethnicity->id }}" @if($userData['serviceProvider']->ethnicity==$ethnicity->id) selected="selected" @endif>{{ $ethnicity->ethnicity }}</option>
            @endforeach
        </select>
        </span>
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>Hair Color</label>
    <div class="col-sm-4 selectContainer">
    	<span class="select-wrapper1">
        <select class="custom-select1 fonza" name="hairColor">
            @if($userData['serviceProvider']->hair_color==NULL)
            <option value="0">Please Select</option>
            @endif
            @foreach($hairColors as $hairColor)
            <option value="{{ $hairColor->id  }}" @if($userData['serviceProvider']->hair_color==$hairColor->id) selected="selected" @endif>{{ $hairColor->hair_color }}</option>
            @endforeach
        </select>
        </span>
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>Eye Color</label>
    <div class="col-sm-4 selectContainer">
    	<span class="select-wrapper1">
        <select class="fonza custom-select1" name="eyeColor">
            @if($userData['serviceProvider']->eye_color==NULL)
            <option value="0">Please Select</option>
            @endif
            @foreach($eyeColors as $eyeColor)
            <option value="{{ $eyeColor->id  }}" @if($userData['serviceProvider']->eye_color==$eyeColor->id) selected="selected" @endif>{{ $eyeColor->eye_color }}</option>
            @endforeach
        </select>
        </span>
    </div>
</div>
@if($userData['systemUser']->gender == 2)
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>C S</label>
    <div class="col-sm-4 selectContainer">
        <select class="fonza custom-select1" name="cup_size" id="cup_size">
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
    <label class="col-sm-5 ecolfour" control-label>B</label>
    <div class="col-sm-4 selectContainer">
        <input type="text" class="form-control" name="bust" id="bust" value="{{ $userData['serviceProvider']->bust }}" placeholder="in cm"/>
    </div>
</div>

<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>W</label>
    <div class="col-sm-4 selectContainer">
        <input type="text" class="form-control" name="waist" id="waist" value="{{ $userData['serviceProvider']->waist }}" placeholder="in cm"/>
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>H</label>
    <div class="col-sm-4 selectContainer">
        <input type="text" class="form-control" name="hips" id="hips" value="{{ $userData['serviceProvider']->hips }}" placeholder="in cm"/>
    </div>
</div>
@endif
@if($userData['systemUser']->gender == 1)
<div class="clearfix"></div>
<div class="form-group">
    <label class="col-sm-5 ecolfour" control-label>P S</label>
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
<div class="col-md-5" style="padding-left:0">
    <label class="col-sm-3 ecolfour" style="padding-left:0" control-label>Availablity</label>
</div>
<div class="container">

    <div class="row col-md-8">
        <div class="col-md-12">
            <div class="col-md-1" style="float:right; padding-top:5px;">
                <input type="image" src="{{URL::asset('assets/registration/img/plus.png')}}" id="addButton" style="width: 40px;">
            </div>
            <div id="TextBoxesGroup">
                @if(!empty($avaliabilities))
                @foreach($avaliabilities as $avaliability)
                <?php
                $fromTime = explode(":",$avaliability->from_time);
                $toTime = explode(":",$avaliability->to_time);
                ?>
                <div id="TextBoxDivDB{{$avaliability->id}}" class="col-md-11">
                    <div class="input-group col-md-12" style="padding-top: 5px;">
                        <label for="day" class="col-sm-1 control-label" style="padding-left: 0; font-weight:bold">Day</label>
                        <div class="col-sm-3 selectContainer ">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail[db][day][]" class="fonza custom-select1">
                                                    <option value="1" @if($avaliability->week_day==1) selected="selected" @endif>MON</option>
                                                    <option value="2" @if($avaliability->week_day==2) selected="selected" @endif>TUE</option>
                                                    <option value="3" @if($avaliability->week_day==3) selected="selected" @endif>WED</option>
                                                    <option value="4" @if($avaliability->week_day==4) selected="selected" @endif>THU</option>
                                                    <option value="5" @if($avaliability->week_day==5) selected="selected" @endif>FRI</option>
                                                    <option value="6" @if($avaliability->week_day==6) selected="selected" @endif>SAT</option>
                                                    <option value="7" @if($avaliability->week_day==7) selected="selected" @endif>SUN</option>
                                                </select>
                                                <input type="hidden" name="avail[db][id][]" value="{{ $avaliability->id }}" />
                                            </span>
                        </div>
                        <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;">From</label>
                        <div class="col-sm-3 selectContainer ">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail[db][from][]" class="fonza custom-select1" id="name" name="textboxfrom1" value="">
                                                    <option value="00" @if($fromTime[0]=='00') selected="selected" @endif>00</option>
                                                    <option value="01" @if($fromTime[0]=='01') selected="selected" @endif>01</option>
                                                    <option value="02" @if($fromTime[0]=='02') selected="selected" @endif>02</option>
                                                    <option value="03" @if($fromTime[0]=='03') selected="selected" @endif>03</option>
                                                    <option value="04" @if($fromTime[0]=='04') selected="selected" @endif>04</option>
                                                    <option value="05" @if($fromTime[0]=='05') selected="selected" @endif>05</option>
                                                    <option value="06" @if($fromTime[0]=='06') selected="selected" @endif>06</option>
                                                    <option value="07" @if($fromTime[0]=='07') selected="selected" @endif>07</option>
                                                    <option value="08" @if($fromTime[0]=='08') selected="selected" @endif>08</option>
                                                    <option value="09" @if($fromTime[0]=='09') selected="selected" @endif>09</option>
                                                    <option value="10" @if($fromTime[0]=='10') selected="selected" @endif>10</option>
                                                    <option value="11" @if($fromTime[0]=='11') selected="selected" @endif>11</option>
                                                    <option value="12" @if($fromTime[0]=='12') selected="selected" @endif>12</option>
                                                    <option value="13" @if($fromTime[0]=='13') selected="selected" @endif>13</option>
                                                    <option value="14" @if($fromTime[0]=='14') selected="selected" @endif>14</option>
                                                    <option value="15" @if($fromTime[0]=='15') selected="selected" @endif>15</option>
                                                    <option value="16" @if($fromTime[0]=='16') selected="selected" @endif>16</option>
                                                    <option value="17" @if($fromTime[0]=='17') selected="selected" @endif>17</option>
                                                    <option value="18" @if($fromTime[0]=='18') selected="selected" @endif>18</option>
                                                    <option value="19" @if($fromTime[0]=='19') selected="selected" @endif>19</option>
                                                    <option value="20" @if($fromTime[0]=='20') selected="selected" @endif>20</option>
                                                    <option value="21" @if($fromTime[0]=='21') selected="selected" @endif>21</option>
                                                    <option value="22" @if($fromTime[0]=='22') selected="selected" @endif>22</option>
                                                    <option value="23" @if($fromTime[0]=='23') selected="selected" @endif>23</option>
                                                    <option value="24" @if($fromTime[0]=='24') selected="selected" @endif>24</option>
                                                </select>
                                            </span>
                        </div>
                        <label for="Name" class="col-sm-1 control-label" style="text-align: left;">To</label>
                        <div class="col-sm-2 selectContainer " style="padding:0;">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail[db][to][]" class="fonza custom-select1" id="name" name="textboxto1" value="">
                                                    <option value="00" @if($toTime[0]=='00') selected="selected" @endif>00</option>
                                                    <option value="01" @if($toTime[0]=='01') selected="selected" @endif>01</option>
                                                    <option value="02" @if($toTime[0]=='02') selected="selected" @endif>02</option>
                                                    <option value="03" @if($toTime[0]=='03') selected="selected" @endif>03</option>
                                                    <option value="04" @if($toTime[0]=='04') selected="selected" @endif>04</option>
                                                    <option value="05" @if($toTime[0]=='05') selected="selected" @endif>05</option>
                                                    <option value="06" @if($toTime[0]=='06') selected="selected" @endif>06</option>
                                                    <option value="07" @if($toTime[0]=='07') selected="selected" @endif>07</option>
                                                    <option value="08" @if($toTime[0]=='08') selected="selected" @endif>08</option>
                                                    <option value="09" @if($toTime[0]=='09') selected="selected" @endif>09</option>
                                                    <option value="10" @if($toTime[0]==10) selected="selected" @endif>10</option>
                                                    <option value="11" @if($toTime[0]==11) selected="selected" @endif>11</option>
                                                    <option value="12" @if($toTime[0]==12) selected="selected" @endif>12</option>
                                                    <option value="13" @if($toTime[0]==13) selected="selected" @endif>13</option>
                                                    <option value="14" @if($toTime[0]==14) selected="selected" @endif>14</option>
                                                    <option value="15" @if($toTime[0]==15) selected="selected" @endif>15</option>
                                                    <option value="16" @if($toTime[0]==16) selected="selected" @endif>16</option>
                                                    <option value="17" @if($toTime[0]==17) selected="selected" @endif>17</option>
                                                    <option value="18" @if($toTime[0]==18) selected="selected" @endif>18</option>
                                                    <option value="19" @if($toTime[0]==19) selected="selected" @endif>19</option>
                                                    <option value="20" @if($toTime[0]==20) selected="selected" @endif>20</option>
                                                    <option value="21" @if($toTime[0]==21) selected="selected" @endif>21</option>
                                                    <option value="22" @if($toTime[0]==22) selected="selected" @endif>22</option>
                                                    <option value="23" @if($toTime[0]==23) selected="selected" @endif>23</option>
                                                    <option value="24" @if($toTime[0]==24) selected="selected" @endif>24</option>
                                                </select>
                                            </span>
                        </div>
                        <div class="col-md-1  pull-right" style="padding:0">
                            <input type="image" src="{{URL::asset('assets/registration/img/minus.png')}}" id="removeButton" style="width: 40px; float:right" onclick="deleteAvailability(event,'#TextBoxDivDB{{$avaliability->id}}',{{$avaliability->id}})">
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div id="TextBoxDiv0" class="col-md-11">
                    <div class="input-group col-md-12" style="padding-top: 5px;">
                        <label for="day" class="col-sm-1 control-label" style="padding-left: 0; font-weight:bold">Day</label>
                        <div class="col-sm-3 selectContainer ">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail_day[static][]" class="fonza custom-select1">
                                                    <option value="1" selected="selected">MON</option>
                                                    <option value="2">TUE</option>
                                                    <option value="3">WED</option>
                                                    <option value="4">THU</option>
                                                    <option value="5">FRI</option>
                                                    <option value="6">SAT</option>
                                                    <option value="7">SUN</option>
                                                </select>
                                            </span>
                        </div>
                        <label for="Name" class="col-sm-1 control-label" style="padding-left: 0;">From</label>
                        <div class="col-sm-3 selectContainer ">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail_from[static][]" class="fonza custom-select1" id="name" name="textboxfrom1" value="">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                </select>
                                            </span>
                        </div>
                        <label for="Name" class="col-sm-1 control-label" style="text-align: left;">To</label>
                        <div class="col-sm-2 selectContainer " style="padding:0;">
                                            <span class="select-wrapper1" name="textboxto1">
                                                <select name="avail_to[static][]" class="fonza custom-select1" id="name" name="textboxto1" value="">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                </select>
                                            </span>
                        </div>
                        <div class="col-md-1 pull-right" style="padding:0">
                            <input type="image" src="{{URL::asset('assets/registration/img/minus.png')}}" id="removeButton" style="width: 40px; float:right" onclick="deleteAvailability(event,'#TextBoxDiv0',null)">
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

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
<div class="row">
    <div class="col-md-7">
        <div class="pull-left" style="margin-top: 30px; margin-bottom: 50px;">
            <input type="image" src="{{URL::asset('assets/registration/img/save.png')}}" style="width: 100px;">
            <!--                    <input type="image" src="{{URL::asset('assets/registration/img/save-2.png')}}" style="width: 100px; margin-left: 20px;">-->
        </div> <!--Close of container-->
        {{ Form::close() }}
    </div>
</div>
</fieldset>
</div>
</div>

@include('footer.index')
@stop