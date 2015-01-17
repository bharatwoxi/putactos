<div id="msg_detail">
    <div id="profile_img">
        <img src="{{URL::asset($user['image'])}}" style="height:50px;width:50px;">
    </div>
    <div id="profile_name_inner">
        {{$user['name']}}<br/>
        <span style="font-size:14px; color:#000">{{$message['message']}}</span>
    </div>
</div>