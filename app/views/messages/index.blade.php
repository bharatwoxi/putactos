@extends('layouts.messages')
@section('content')
<div class="container-fluid"> <!--Header start-->
    <div class="container">
        <div class="col-sm-3 col-md-5 col-lg-12" >
            <div>
                <a href="{{ URL::to('/') }}" class="navbar-static pull-left" style="margin:0"><img src="{{URL::asset('public/assets/registration/img/Puktatos 3 b.png')}}" class="img-responsive" width="150"  /></a>
            </div>
        </div><!-- navbar navbar-inverse navbar-static-top close-->
    </div> <!--Container close-->
</div> <!--container fluid close-->
<div class="clearfix"></div> <!--Header ends-->






<div class="container-fluid" style="background-color:#f74d4d;">
    <div class="col-sm-3 col-md-10 col-lg-12">
        <div class="container">
            <div class="row" style="font-family:Roboto Th; color:#fff; padding: 20px;">
                        <span style="color:#fff;  font-size:36px">MESSAGE 
                			<div id="inbox" style="font-size:16px;"><b>INBOX</b></div></span>

            </div>
        </div>
    </div>
</div><!-- End of Container Fluid-->
<div class="clearfix"></div>

<div class="container-fluid" style="background-image: url(../../../public/assets/registration/img/background1.png); background-repeat: repeat; padding-top:30px; font-family:Calibri;">
<div class="col-sm-3 col-md-10 col-lg-12">
<div class="container">
<div id="msg_search"  class="col-sm-3 col-md-10 col-lg-12">
    <input type="text" class="txt" /><a href="#"><img src="{{URL::asset('public/assets/registration/img/search.png')}}" class="search"/></a>
</div>

<div id="tabs">
    <div id="users">
        <ul id="user_list">

        </ul>
    </div>
<div id="details" class="col-sm-3 col-md-10 col-lg-12">
<div id="a">
    <div id="detai_msg">
        <span id="message_data">

        </span>
    </div>
</div>
</div>
</div>




</div>
</div>
</div>
@stop