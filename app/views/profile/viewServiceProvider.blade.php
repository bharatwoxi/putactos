@extends('layouts.viewProfileServiceProvider')
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
<div class="container-fluid" style="background-image: url(../../../public/assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;padding-left:0">
    <div class="col-sm-3 col-md-10 col-lg-12" style="padding:0">
        <div class="container" style="padding-left:0">

            <div id="msg_search"  class="col-sm-3 col-md-10 col-lg-12">
                <div id="personal_detail" class="col-sm-12">
                    <div id="user_profile" class="col-sm-4 ">
                        <div class="col-md-12 col-xs-7 " id="profile_thumb">
                            <img src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($userData['userData']->id) }}/profile_image/{{ $userData['userData']->profile_image }}" class="img-responsive pull-left" style="margin:0 0 2%;height:220px;width:330px;">
                            <!--<img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left" style=" margin:0 1.5% 1% 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left"  style=" margin:0 1.5% 1% 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left" style=" margin:0 1.5% 0 0">
                            <img src="{{URL::asset('public/assets/registration/img/user_profile.jpg')}}" class="img-responsive pull-left">-->
                        </div>
                        <div id="star_rating" class="pull-left col-xs-12" >
                            <input id="input-2b" value="{{ $userData['averageHeartRating'] }}" readonly="true" type="number" class="rating form-control hide original_star" min="0" max="5" step="0.5" data-size="xs" data-symbol="" data-default-caption="{rating} hearts" data-star-captions="{}">
                        </div>
                        <div id="msg" class="pull-left col-xs-5 col-md-8">
                            <a href="#login-box" class="login-window">
                                <p  style="border:2px solid #fa4d51; padding:2px 6px; text-align:center;font-weight: bold;color: #fa4d51;border-radius: 5px; float:left; margin:0 10px 10px 0; font-size:12px">SEND MESSAGE</p></a>

                            <div id="login-box" class="login-popup">
                                <a href="#" class="close"><img src="{{URL::asset('public/assets/registration/img/close_pop.png')}}" class="btn_close" title="Close Window" alt="Close" /></a>
                                <form method="post" class="signin" action="#">
                                    <div id="text_detail">
                                        <p class="new_msg"><b>Send New Message</b></p>
                                        <?php /*&nbsp;&nbsp;To:<input type="text" placeholder="Name" class="to_name"/><br/> */ ?>
                                        <textarea id="msg_area" onfocus="this.value=''; setbg('#fff');" onblur="setbg('white')" required="required" maxlength="150"></textarea>
                                        <div id="reply_msg">
                                            <?php /*
                                            <div class="fileUpload btn btn-primary">
                                                <span><img src="img/atach.png">&nbsp;&nbsp;Add Ffile</span>
                                                <input type="file" class="upload">
                                            </div>

                                            <div class="fileUpload btn btn-primary">
                                                <span><img src="img/cam.png">&nbsp;&nbsp;Add Photo</span>
                                                <input type="file" class="upload">
                                            </div>
                                            */ ?>
                                            <div id="reply">
                                                <a href="#"><img src="{{URL::asset('public/assets/registration/img/send.png')}}"></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
<!--                            <a href="#">-->
<!--                                <p style="border:2px solid #fa4d51; padding:2px 6px; text-align:center;font-weight: bold;color: #fa4d51;border-radius: 5px; float:left; font-size:12px;">SHOW INTEREST</p>-->
<!--                            </a>-->
                        </div>

                        <div id="profile_details" class="col-sm-10 col-xs-12">
                            <div id="profile_name">
                                {{ ucwords($userData['userData']->user_first_name) }} {{ ucwords($userData['userData']->user_last_name) }}
                            </div>

                            <div id="profile_description">
                                Prefered Location - {{ $userData['userData']->city }} {{ $userData['userData']->country }}<br/>
                                Birthdate - @if($userData['userData']->birth_date!=null) {{ $userData['userData']->birth_date }} @else N/A @endif <br/>
                                @if($userData['userData']->from_age!=null && $userData['userData']->to_age!=null)
                                Age Range : {{ $userData['userData']->from_age }} - {{ $userData['userData']->to_age }}
                                @else
                                Age Range - N/A
                                @endif
                                <br/>
                                @if($userData['userData']->gender!=null || !empty($userData['userData']->gender))
                                Gender - {{ Gender::find($userData['userData']->gender)->gender }}
                                @else
                                Gender - N/A
                                @endif
                                <br/>
                                @if($userData['serviceProviderData']->ethnicity!=null || !empty($userData['serviceProviderData']->ethnicity))
                                    Ethinicity - {{ Ethnicity::find($userData['serviceProviderData']->ethnicity)->ethnicity }}
                                @else
                                    Ethinicity - N/A
                                @endif
                                <br/>
                                @if($userData['serviceProviderData']->hair_color!=null || !empty($userData['serviceProviderData']->hair_color))
                                    Hair Color - {{ HairColor::find($userData['serviceProviderData']->hair_color)->hair_color }}
                                @else
                                    Hair Color - N/A
                                @endif
                                <br/>
                                @if($userData['serviceProviderData']->eye_color!=null || !empty($userData['serviceProviderData']->eye_color))
                                    Eye Color - {{ EyeColor::find($userData['serviceProviderData']->eye_color)->eye_color }}
                                @else
                                    Eye Color - N/A
                                @endif
                                <br/>
                                Height - @if($userData['serviceProviderData']->height!=null){{$userData['serviceProviderData']->height}} CM @else N/A @endif<br/>
                                Weight - @if($userData['serviceProviderData']->weight!=null){{$userData['serviceProviderData']->weight}} KG @else N/A @endif<br/>

                                @if($userData['userData']->gender==1)
                                    Penis Size - @if($userData['serviceProviderData']->penis_size!=null){{$userData['serviceProviderData']->penis_size}} CM @else N/A @endif<br/>
                                @else
                                    Bust - @if($userData['serviceProviderData']->bust!=null){{$userData['serviceProviderData']->bust}} CM @else N/A @endif<br/>
                                    Waist - @if($userData['serviceProviderData']->waist!=null){{$userData['serviceProviderData']->waist}} CM @else N/A @endif<br/>
                                    Hip - @if($userData['serviceProviderData']->hips!=null){{$userData['serviceProviderData']->hips}} CM @else N/A @endif<br/>
                                    @if($userData['serviceProviderData']->cup_size!=null || !empty($userData['serviceProviderData']->cup_size))
                                        Cup Size - {{ CupSize::find($userData['serviceProviderData']->cup_size)->cup_size }}
                                    @else
                                        Cup Size - N/A
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>


                    <div id="profile_decp" class="col-sm-6">
                        <div class="pull-left col-sm-6 col-md-12">
                            <span style="color:#fa4d51">Turns Me On</span><br/>
                            <p>
                                @if($userData['serviceProviderData']->turns_me_on!=null || !empty($userData['serviceProviderData']->turns_me_on))
                                    {{ $userData['serviceProviderData']->turns_me_on }}
                                @else
                                    Not Available!!
                                @endif
                            </p>
                            @if(Auth::user()->user_role_id==2 && $spIsSameAsLoggedInUser==1)
                            {{ Form::open(array('url' => 'sp/risemeup','class'=>'form-horizontal','role'=>'form','id'=>'risemeUp')) }}
                                @if($userData['serviceProviderData']->riseme_up==1)
                                    <input name="submit" id="submit" disabled="disabled" class="btn btn-small btn-danger btn-inverse" style="width: 100px" type="submit" value="Rise Up">
                                @else
                                    <input name="submit" id="submit" class="btn btn-small btn-danger btn-inverse" style="width: 100px" type="submit" value="Rise Up">
                                @endif
                            {{ Form::close() }}
                            @endif
                        </div><br/><br/><br/><br/><br/><br/><br/><br/>
                        <!--<div id="availability" class="col-sm-12">
                            <h2 id="time_head" >Availibility</h2>
                            <table id="profile_time">
                                <tr>
                                    <td><div id="day">Mon</div></td>
                                    <td><div id="days">Tue</div></td>
                                    <td><div id="day">Wed</div></td>
                                    <td><div id="days">Thu</div></td>
                                    <td><div id="day">Fri</div></td>
                                    <td><div id="days">Sat</div></td>
                                    <td><div id="day">Sun</div></td>
                                </tr>
                            </table>
                            <table id="time">
                                <tr>
                                    <td id="time_head"><h3>Time</h3></td>
                                    <td><h2>9am to 9pm</h2></td>
                                </tr>
                            </table>
                        </div>-->
                        @if($userData['feedbackData']!=NULL || !empty($userData['feedbackData']))
                        <div id="customer_feedback" class="col-sm-12">
                            @foreach($userData['feedbackData'] as $feedback)
                            <div id="feedback_customer" class="col-sm-12">
                                <h3>Customer Feedback</h3>
                                <div id="feedback_detail">
                                    <div id="feed_img">
                                        <?php $customer = User::find($feedback['customer_id']) ?>
                                        <img height="54" width="62" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($customer->id) }}/profile_image/{{ $customer->profile_image }}">
                                    </div>
                                    <div id="feed_detail">
                                        <p><b>{{ ucwords($customer->user_first_name) }} {{ ucwords($customer->user_last_name) }}</b></p>
                                        <p>{{$feedback->feedback}}</p>
                                    </div>
                                    <div id="feed_rate" class="feed_rate">
                                        <p><b>I Rate</b></p>
                                        <input id="input-2b" value="{{ $feedback['rating'] }}" readonly="true" type="number" class="rating form-control hide original_star" min="0" max="5" step="0.5" data-size="xs" data-symbol="" data-default-caption="{rating} hearts" data-star-captions="{}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <span id="feedback_loader" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('public/assets/registration/img/message_ajax_loader.gif')}}"></span>
                        </div>
                        @else
                        <div id="customer_feedback" class="col-sm-12">
                            <div class="col-sm-12">
                                <h3>Customer Feedback</h3>
                                No Feedbacks Received
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->user_role_id!=2)
                        <div id="feedback_customer_txt" class="col-sm-12">
                            {{ Form::open(array('url' => 'save/feedback','class'=>'form-horizontal','role'=>'form','files'=>true,'id'=>'saveFeedback')) }}
                            <h3>Leave Feedback</h3>
                            <div id="feedback_detail">
                                <div id="feed_detail_txt">
                                    {{ Form::textarea('feedback_text',Input::old('feedback_text'),array("required"=>"required")) }}
                                </div>
                            </div>
                            <div>
                                <input type="hidden" value="0" id="star_rating_original" name="heart_rating" />
                                <input id="input-2b" class="original_star" type="number" class="rating form-control hide original_star" min="0" max="5" step="0.5" data-size="xs" data-symbol="" data-default-caption="{rating} hearts" data-star-captions="{}">
                            </div>
                            <div id="feed_rating" class="col-md-12 col-xs-8">
                                <a href="#">
                                    <div id="submit_feedback" style="width:175px;height:32px;font-size:18px;">SUBMIT FEEDBACK</div>
                                </a>
                            </div>
                            {{ Form::close() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop