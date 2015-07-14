@extends('layouts.new_message')
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






<div class="container-fluid" style="background-color:#f74d4d; padding-bottom: 30px;"> <!--Sub Header Start-->
    <div class="container" >
        <div class="col-md-12" style="font-family:Calibri">
            <h1 style="color:#fff;  font-size:36px; margin-top:5%; float:left;font-family: Roboto Th;">INBOX</h1>
            @include('header.userMenu')
        </div> <!--End of col-md-12-->

    </div><!-- End of Container Fluid-->
   </div>
<div class="clearfix"></div>

<div class="container-fluid" style="background-image: url(../../../assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
<div class="col-sm-3 col-md-10 col-lg-12">
<div class="container">

<div class="container-fluid" style="background-image: url(img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
<div class="col-sm-12 col-md-10 col-lg-12">
<div class="container">
@if($userListingForMessages!=null)
<div class="row">
    @if(isset($userListingForMessages[0]) && $userListingForMessages[0]!=null)
    <div id="tabs" class="col-sm-5">
    <ul>
        @foreach($userListingForMessages[0] as $user)
        <li>
            <a href="{{ URL::to('messages/'.$user['username']) }}">
                <div>
                    <div id="profile_img">
                        <img src="{{URL::asset($user['profilePicture'])}}" id="profile_image" height="70" width="70">
                    </div>
                    <div id="profile_name">
                        {{ $user['name'] }}<br/>
                        <span style="font-size:14px">{{ $user['message'] }}</span>
<!--                        <span style="color:#00CC00;margin-right:-100px;">{{$user['totalNewMessages']}}</span>-->
                    </div>

                </div>
            </a>
        </li>
        @endforeach
    </ul>
    </div>
    @endif
    <div class="col-sm-1"></div>
    @if(isset($userListingForMessages[1]) && $userListingForMessages[1]!=null)
    <div id="tabs" class="col-sm-5">
    <ul>
        @foreach($userListingForMessages[1] as $user)
        <li>
            <a href="{{ URL::to('messages/'.$user['username']) }}">
                <div>
                    <div id="profile_img">
                        <img src="{{URL::asset($user['profilePicture'])}}" id="profile_image" height="70" width="70">
                    </div>
                    <div id="profile_name">
                        {{ $user['name'] }}<br/>
                        <span style="font-size:14px">{{ $user['message'] }}</span>
                    </div>

                </div>
            </a>
        </li>
        @endforeach
    </ul>
    </div>
    @endif
</div>
@else
no records found!!!
@endif


</div>
</div>
</div>
@stop