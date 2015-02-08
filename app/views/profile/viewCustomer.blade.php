@extends('layouts.viewProfileCustomer')
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
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            <div class="row" style="font-family:Roboto Th; color:#fff; padding: 20px;">
                @include('header.userMenu')
                <div style="color:#fff;  font-size:36px; margin:5% 0 0">PROFILE </div>

            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>
<div class="container-fluid" style="background-image: url(../../../public/assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;padding-left:0">
    <div class="col-sm-3 col-md-10 col-lg-12" style="padding:0">
        <div class="container" style="padding-left:0">
            <div id="msg_search"  class="col-sm-3 col-md-10 col-lg-12">
                <div id="personal_detail" class="col-sm-12">
                    <div id="user_profile" class="col-sm-4 ">
                        <div class="col-md-12 col-xs-7 " id="profile_thumb">
                            <img src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($userData['systemUser']->id) }}/profile_image/{{ $userData['systemUser']->profile_image }}" class="img-responsive pull-left" style="margin:0 0 2%;height:220px;width:330px;">
                            <!--<img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left" style=" margin:0 1.5% 1% 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left"  style=" margin:0 1.5% 1% 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left" style=" margin:0 1.5% 0 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left">-->
                        </div>
                        <div id="profile_details" class="col-sm-10 col-xs-12">
                            <div id="profile_name">
                                {{ ucwords($userData['systemUser']->user_first_name) }} {{ ucwords($userData['systemUser']->user_last_name) }}
                            </div>

                            <div id="profile_description">
                                Gender - {{ Gender::find($userData['systemUser']->gender)->gender }}<br/>
                                Birthdate - {{$userData['systemUser']->birth_date}}<br/>
                                @if($userData['systemUser']->city!=null || !empty($userData['systemUser']->city))
                                Current Location - {{ $userData['systemUser']->city }}
                                @else
                                Preferred Location - N/A
                                @endif
                                <br/>
                                Looking For - {{ ucwords($userData['customer']->looking_for) }}<br/>
                                Age Range - {{ $userData['systemUser']->from_age }} to {{ $userData['systemUser']->to_age }}<br/>
                                Email - {{ $userData['systemUser']->email }}<br/>
                            </div>
                        </div>
                    </div>
                    <!--<div id="profile_decp" class="col-sm-6">
                        <div class="pull-left col-sm-6 col-md-12">
                            <span style="color:#fa4d51">About Davidthe king</span><br/>
                            <p>
                                Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                lorem ipsum lorem ipsum
                            </p>
                            <a href="#">
                                <p class="col-sm-3 col-xs-3 col-md-3" style="border:2px solid #fa4d51; padding:5px 6px; text-align:center;font-weight: bold;color: #fa4d51;border-radius: 5px;">RISE UP</p>
                            </a>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
@stop