@foreach($users as $user)
<li class="in">
    @if($user['userdata']['user_role_id'] == 1)
        <img class="avatar" height="45" width="45" alt="" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($user['userdata']['id']) }}/profile_image/{{ $user['userdata']['profile_image'] }}"/>
    @else
        <img class="avatar" height="45" width="45"  alt="" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($user['userdata']['id']) }}/profile_image/{{ $user['userdata']['profile_image'] }}"/>
    @endif
    <div class="message">
    <span class="arrow">
    </span>
    <a href="#" class="name">
    {{ ucwords($user['userdata']['user_first_name']) }} {{ ucwords($user['userdata']['user_last_name']) }} </a>
    <span class="datetime">
    at {{ date("H:i",strtotime($user['messages']['sent_time'])) }} </span>
    <span class="body">
    {{ $user['messages']['message'] }}</span>
    </div>
</li>
@endforeach