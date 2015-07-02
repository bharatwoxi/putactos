@if(isset($userMessage) && $userMessage!=null)
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
            <span style="font-size:18px; color:#000" >{{$user['message']}}</span>
        </div>
    </div>
</div>
@endforeach
@endif

@if(isset($user) && $user!=null)
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
            <span style="font-size:18px; color:#000" >{{$user['message']}}</span>
        </div>
    </div>
</div>
@endif