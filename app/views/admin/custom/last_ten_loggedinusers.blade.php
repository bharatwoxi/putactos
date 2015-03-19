@if($users!=null || !empty($users))
{{$i = 0}}
@foreach($users as $user)
<tr>
    <td class="fit">
        @if($user->user_role_id == 1)
        <img class="user-pic" height="30" width="30" alt="img" src="{{URL::to('public/uploads/userdata/customer')}}/{{ sha1($user->id) }}/profile_image/{{ $user->profile_image }}"/>
        @else
        <img class="user-pic" height="30" width="30"  alt="img" src="{{URL::to('public/uploads/userdata/service_provider')}}/{{ sha1($user->id) }}/profile_image/{{ $user->profile_image }}"/>
        @endif
    </td>
    <td>
        <a href="#" class="primary-link">{{ ucwords($user->user_first_name) }} {{ ucwords($user->user_last_name) }}</a>
    </td>
    <td>
        <?php $role = UserRole::find($user->user_role_id) ?>
        {{ $role->role }}
    </td>
    <td>
        @if($user->gender!=null || !empty($user->gender))
            <?php $gender = Gender::find($user->gender) ?>
            {{ $gender->gender }}
        @else
            N/A
        @endif
    </td>
    <td>
        <span class="bold theme-font">{{ date('d M H:i:s',strtotime($login_time[$i])) }}</span>
    </td>
</tr>
{{$i++}}
@endforeach
@else
Sorry No Data Found!!!
@endif