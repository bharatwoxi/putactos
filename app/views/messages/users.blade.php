@if($userListingForMessages!=NULL)

    @foreach($userListingForMessages as $userList)
    <li onclick="getMessage({{Auth::user()->id}},{{$userList['serviceProviderId']}});">
        <a href="#a">
            <div>
                <div id="profile_img">
                    <img src="{{URL::asset($userList['profilePicture'])}}" style="height:80px;width:80px;">
                </div>
                <div id="profile_name">
                    {{$userList['name']}}<br/>
                    <span style="font-size:14px">{{$userList['message']}}</span>
                </div>
                <div id="last_date">
                    {{$userList['day']}}
                </div>
            </div>
        </a>
    </li>
    @endforeach
@endif
