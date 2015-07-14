@extends('layouts.detailedMessage')
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

    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>

<div class="container-fluid" style="background-image: url(../../assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
    <div class="col-sm-12 col-md-10 col-lg-12">
        <div class="container">
            <div id="msg_search"  class="col-sm-3 col-md-8 col-lg-8">
<!--                <input type="text" class="txt" /><a href="#"><img src="img/search.png" class="search"/></a>-->
            </div>
            <div class="col-sm-4" >
                <a href="{{ URL::to('/messages-user-lists') }}" style="width:80px; padding:10px; background-color:#f74d4d; color:#fff; font-size:16px; border:none; outline:none; text-decoration:none;border-radius: 8px;  float: right;  text-align: center;  margin: 5% 0 0;">BACK</a>
            </div>
            <div class="row">
                <div id="detai_msg" class="col-sm-12 col-md-10 col-lg-12">
                    <div id="msg_name" class="col-sm-12 col-md-10 col-lg-12">
                        <a href="{{ URL::to('profile') }}/{{$showMessageForUser->username}}">{{$userFullName}}</a>
                    </div>
                    <div id="text_detail" class="col-sm-12 col-md-10 col-lg-12">
                        <textarea id="msg_area" placeholder="Write a reply"></textarea>
                        <div id="reply_msg">
                            <div class="fileUpload btn btn-primary">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;
<!--                                    <img src="img/atach.png">&nbsp;&nbsp;Add Ffile-->
                                </span><br/>
<!--                                <input type="file" class="upload">-->
                            </div>
                            <div class="fileUpload btn btn-primary">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;
<!--                                    <img src="img/cam.png">&nbsp;&nbsp;Add Photo-->
                                </span>
<!--                                <input type="file" class="upload">-->
                            </div>
                            <div id="reply">
                                <a href="javascript:void(0)" onclick="postNewMessage('{{$toUserId}}')"><img src="../../assets/registration/img/reply.png"></a>
                            </div>
                            <span style="color:#F74D4D;font-weight:800;" id="character-message"></span>
                        </div>
                    </div>
                    <span id="message-loader-up" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('assets/registration/img/message_ajax_loader.gif')}}"></span>
                    <div id="message-div">
                        @if($userMessage!=null)
                        @foreach($userMessage as $user)
                        @if($user['role']=='customer')
                        <?php $id = 'profile_name_inner';?>
                        @else
                        <?php $id = 'profile_name_inner_user';?>
                        @endif

                        <div id="msg_desc" >
                            <div id="msg_detail" class="col-sm-12">
                                <div id="profile_img" class="col-sm-1 col-xs-12">
                                    <img src="{{URL::asset($user['image'])}}" id="profile_image" height="80" width="80">
                                </div>
                                <div id="{{$id}}" class="col-sm-11 col-xs-12">
                                    {{$user['name']}}<br>
                                        <span style="font-size:18px; color:#000" >{{$user['message']}}
                                        </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <span id="message-loader-down" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('assets/registration/img/message_ajax_loader.gif')}}"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop