<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 15/12/14
 * Time: 11:45 AM
 */
?>
@extends('layouts.search')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-lg-12" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
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

<div class="container-fluid" style="background-color:#f74d4d; padding-bottom: 30px;"> <!--Sub Header Start-->
    <div class="container">
        <div class="col-md-12" style="font-family:Calibri">
            @include('header.userMenu')
        </div> <!--End of col-md-12-->
    </div> <!--End of Container-->
    <div class="container">

        <div class="row" style="font-family:Roboto Th; color:#fff;">
            <div class="col-md-7	">
                <h1 style="color:#fff;  font-size:60px">{{ trans('peopleNearBy.PEOPLENEARBY') }}</h1>
            </div>

            <div class="col-md-5">

                <p style="padding:20px 15px 0;font-size: 13px; font-family:Calibri Light;">{{ trans('peopleNearBy.Yourlocationissetautomaticallyto') }} <strong><span id="selectedLocation"> </span></strong><br>
                    {{ trans('peopleNearBy.Ifyouthinkwehavegotiswrongpleaseselect') }}
                </p>

                    {{ Form::open(array('class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'setNewLocation')) }}
                    <div class="form-group">
                        <div class="col-sm-3">
                            {{ Form::text('currentLocation',NULL,array('class'=>'form-control', 'style'=>'width:285px','id'=>'currentLocation','placeholder'=>'set new location')) }}
                        </div>
                    </div>
                    {{ Form::close() }}

            </div><!-- End of row-->
        </div>
    </div><!-- End of row-->
    <div style="border-bottom:1px solid #dbdbdb;padding: 5px 0px;"></div>

</div> <!--End of Container-->
</div> <!--Sub Header Ends-->



<div class="container-fluid" style="background-image:url(../../public/assets/registration/img/background1.png); background-repeat:repeat;"> <!--Content start-->
<div class="container">
    <div class="">
        <div class="panel-heading" style="color: #333;padding: 5px 0px;outline: none;" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" id="accordian" data-toggle="collapse" style="color: #fff;" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h3 style="margin-top: -31px; color: white; font-family:Calibri;">{{ trans('peopleNearBy.ADVANCEDSEARCH') }}</h3>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body" style="background-image:url(../../public/assets/registration/img/background1.png); background-repeat:repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                {{ Form::open(array('url' => 'advance/search/login=true','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'advanceSearch')) }}
                                    <div class="form-group">
                                        <label class="col-sm-5" style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.DistanceRange') }}</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="distanceRange" style="font-family:Calibri Light; font-weight:bold;">
                                                <option value="0-5">0-5 Km</option>
                                                <option value="5-10">5-10 Km</option>
                                                <option value="10-15">10-15 Km</option>
                                                <option value="15-20">15-20 Km</option>
                                                <option value="20-25">20-25 Km</option>
                                                <option value="25-30">25-30 Km</option>
                                                <option value="30-35">30-35 Km</option>
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.Gender') }}</label>
                                        <div class="col-sm-6">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default"  style="font-family:Calibri Light; font-weight:bold;">
                                                    <input type="radio" name="gender" value="1" /> {{ trans('peopleNearBy.Male') }}
                                                </label>
                                                <label class="btn btn-default" style="font-family:Calibri Light; font-weight:bold;">
                                                    <input type="radio" name="gender" value="2" / > {{ trans('peopleNearBy.Female') }}
                                                </label>
                                                <label class="btn btn-default active" style="font-family:Calibri Light; font-weight:bold;">
                                                    <input type="radio" name="gender" value="0" checked/ > {{ trans('peopleNearBy.Both') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>


                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.HairColor') }}</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="hairColor" style="font-family:Calibri Light; font-weight:bold;">
                                               <?php $hairColorCount = count($hairColor); ?>
                                                @for($i=0;$i<$hairColorCount;$i++)
                                                    <option value="{{ $hairColor[$i]->id }}">{{ $hairColor[$i]->hair_color }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">Eye Color</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="eyeColor" style="font-family:Calibri Light; font-weight:bold;">
                                                <?php $eyeColorCount = count($eyeColor); ?>
                                                @for($i=0;$i<$eyeColorCount;$i++)
                                                <option value="{{ $eyeColor[$i]->id }}">{{ $eyeColor[$i]->eye_color }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.Ethnicity') }}</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="ethnicity" style="font-family:Calibri Light; font-weight:bold;">
                                                <?php $ethnicityColorCount = count($ethnicity); ?>
                                                @for($i=0;$i<$ethnicityColorCount;$i++)
                                                <option value="{{ $ethnicity[$i]->id }}">{{ $ethnicity[$i]->ethnicity }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.LanguageSpoken') }}</label>
                                        <div class="col-sm-6 selectContainer">
                                            <select class="form-control" name="languages" style="font-family:Calibri Light; font-weight:bold;">
                                                @foreach($knownLanguages as $knownLanguage)
                                                    <option value="{{ $knownLanguage->id }}">{{$knownLanguage->language_name}}</option>
                                                @endforeach
                                                <option value="0">BOTH</option>
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label class="col-sm-5" control-label style="font-family: calibri; font-size: 20px;">{{ trans('peopleNearBy.Availability') }}</label>
                                        <div class="col-sm-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default fonza">
                                                    <input type="checkbox" name="availability" value="1" / > {{ trans('peopleNearBy.AvailableNow') }}
                                                </label>
                                                <span style="font-family:Calibri; font-size:10.02px; color:#f74d4d">&nbsp;({{ trans('peopleNearBy.Availableatthistime') }})</span>
                                            </div>
                                        </div>
                                    </div>

                            </div><!-- /.col-lg-6 -->

                            <div class="col-xs-12 col-md-3 center-block" style="background-color:#f74d4d">
                                <h4 style="color:#FFF; font-family:Calibri">{{ trans('peopleNearBy.PUBICHAIR') }}</h4>

                                <div class="btn-group" data-toggle="buttons" style="padding-left: 60px;">
                                    <label class="btn btn-default btn-lg fonza">
                                        <input type="radio" name="pubicHair" value="1" /> {{ trans('peopleNearBy.Yes') }}
                                    </label>
                                    <label class="btn btn-default btn-lg fonza active">
                                        <input type="radio" name="pubicHair" value="0" checked/ > {{ trans('peopleNearBy.No') }}
                                    </label>
                                </div>

                                <div class=" col-xs-offset-1">
                                    <h6 style="color:#FFF">{{ trans('peopleNearBy.HIPS') }}</h6>
                                    <input class="slider" name="hips" id="hips" data-slider-max="80" data-slider-min="20" data-slider-orientation="horizontal" data-slider-value="20" type="text">
                                    <h6 style="color:#FFF">{{ trans('peopleNearBy.BUST') }}</h6>
                                    <input class="slider" name="bust" id="bust" data-slider-max="80" data-slider-min="20" data-slider-orientation="horizontal" data-slider-value="20" type="text">
                                    <h6 style="color:#FFF">{{ trans('peopleNearBy.WAIST') }}</h6>
                                    <input class="slider" name="waist" id="waist" data-slider-max="80" data-slider-min="20" data-slider-orientation="horizontal" data-slider-value="20" type="text">
                                    <h6 style="color:#FFF">{{ trans('peopleNearBy.CUPSIZE') }}</h6>
                                    <input class="slider" name="cup" id="cup" data-slider-max="80" data-slider-min="20" data-slider-orientation="horizontal" data-slider-value="20" type="text">
                                </div>
                            </div>

                            <div class="col-md-3" style="padding-top: 20px; margin-left: 30px;">
                                <p style="background:#FFF; padding:5px; font-family: Calibri; font-size: 20px;"> USE OUR ADVANCED SEARCH FILTERS TO GET THE PRECISE RESULTS YOU ARE LOOKING FOR. HAPPY HUNTING!!</p>
                                <br>
                                <input type="image" src="{{URL::asset('public/assets/registration/img/Cancel.png')}}" style="width: 110px;">
                                <input id="search-button" type="image" src="{{URL::asset('public/assets/registration/img/Search.png')}}" style="width: 110px; margin-left: 20px;">
                                {{ Form::close() }}
                                <input type="hidden" name="isFilter" id="isFilter" value="0" />
                            </div>
                        </div>
                    </div> <!--End of row-->
                </div><!-- end of container-->

            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container" id="container">
    <input type="hidden" id="skip" value="4" />
    <input type="hidden" id="take" value="4" />
    <input type="hidden" id="isDataAvailable" value="1"/>
</div>
<div id="loaderImage" class="row text-center" style="display:none;"><img style="margin: 0 auto;" src="{{ URL::to('/public/assets/images/loader/heart.GIF') }}"></div>

</div> <!--Content ends-->



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