@if($users)
@foreach($users as $user)
<li class="customMessage">
    <div class="row">
        <div class="col-md-2 col-sm-2" style="text-align: right">
    @if($user['userdataFrom']['user_role_id'] == 1)
        <img class="avatar" height="45" width="45" alt="" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($user['userdataFrom']['id']) }}/profile_image/{{ $user['userdataFrom']['profile_image'] }}"/>
    @else
        <img class="avatar" height="45" width="45"  alt="" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($user['userdataFrom']['id']) }}/profile_image/{{ $user['userdataFrom']['profile_image'] }}"/>
    @endif
        </div>
    <div class="mainmessage col-md-8 col-sm-8">
    <span class="arrowin">
    </span>
    <a href="#" class="name">
    {{ ucwords($user['userdataFrom']['user_first_name']) }} {{ ucwords($user['userdataFrom']['user_last_name']) }} </a>
        to
     <a href="#" class="name">
            {{ ucwords($user['userdataTo']['user_first_name']) }} {{ ucwords($user['userdataTo']['user_last_name']) }} </a>
    <span class="datetime">
    on {{ date("d M Y H:i:s",strtotime($user['messages']['sent_time'])) }} </span>
    <span class="body">
    {{ $user['messages']['message'] }}</span>
        <span class="arrowout">
    </span>
    </div>
        <div class="col-md-2 col-sm-2">
    @if($user['userdataTo']['user_role_id'] == 1)
    <img class="avatar" height="45" width="45" alt="" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($user['userdataTo']['id']) }}/profile_image/{{ $user['userdataTo']['profile_image'] }}"/>
    @else
    <img class="avatar" height="45" width="45"  alt="" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($user['userdataTo']['id']) }}/profile_image/{{ $user['userdataTo']['profile_image'] }}"/>
    @endif
        </div>
    </div>
</li>
@endforeach
@else
No results to show
@endif