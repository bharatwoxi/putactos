@if($userMessage!=NULL)
    <?php sort($userMessage); $i=1;?>
    @if($isScroll==0)
        <div id="msg_name">
            <a href="{{ URL::to('profile/'.$showMessageForUser->username) }}">{{$userFullName}}</a>
        </div>
        <div id="msg_desc">
        @foreach($userMessage as $message)
            @if($i==1)
            <?php $className = 'xyz'.rand(1,10000000); ?>
            <span id="messageLoaderUp" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('public/assets/registration/img/message_ajax_loader.gif')}}"></span>
            <div id="msg_detail" class="{{$className}}">
                <input type="hidden" id="newClassName" value="{{$className}}" />
            @else
            <div id="msg_detail">
            @endif
                <div id="profile_img">
                    <img src="{{URL::asset($message['image'])}}" style="height:50px;width:50px;">
                </div>
                <div id="profile_name_inner">
                    {{$message['name']}}<br/>
                    <p style="font-size:14px; color:#000; float:left; width:100% " >{{$message['message']}}</div>
                </p>
            </div>
            <?php $i++;?>
        @endforeach
        <span id="messageLoaderDown" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('public/assets/registration/img/message_ajax_loader.gif')}}"></span>
        </div>
        <div id="text_detail">
            <textarea id="msg_area" placeholder="Write a reply"></textarea>
            <div id="reply_msg">
                <!--<div class="fileUpload btn btn-primary">
                    <span><img src="{{URL::asset('public/assets/registration/img/atach.png')}}">&nbsp;&nbsp;Add Ffile</span>
                    <input type="file" class="upload" />
                </div>
                <div class="fileUpload btn btn-primary">
                    <!--<span><img src="{{URL::asset('public/assets/registration/img/cam.png')}}">&nbsp;&nbsp;Add Photo</span>
                    <input type="file" class="upload" />
                </div>-->
                <div id="reply">
                    <img style="padding-bottom:10px;cursor:pointer;" onclick="postNewMessage('{{ $sendMessageUserId }}')" src="{{URL::asset('public/assets/registration/img/reply.png')}}">
                </div>
                <span style="color:#F74D4D;font-weight:800;" id="character-message"></span>
            </div>
        </div>
    @else
        @foreach($userMessage as $message)
            @if($i==1)
            <?php $className = 'xyz'.rand(1,10000000); ?>
            <span id="messageLoaderUp" style="display:none;"><img style="display:block;margin: auto auto;" src="{{URL::asset('public/assets/registration/img/message_ajax_loader.gif')}}"></span>
            <div id="msg_detail" class="{{$className}}">
            <input type="hidden" id="newClassName" value="{{$className}}" />
            @else
            <div id="msg_detail">
            @endif
            <div id="profile_img">
                <img src="{{URL::asset($message['image'])}}" style="height:50px;width:50px;">
            </div>
            <div id="profile_name_inner">
                {{$message['name']}}<br/>
                <span style="font-size:14px; color:#000">{{$message['message']}}</span>
            </div>
        </div>
        <?php $i++;?>
        @endforeach
    @endif
@endif