<div class="mini_nav pull-right" style="color:#ffff;padding: 10px 0px; height: 110px;">
    <?php $username = Auth::user()->username; ?>
    <a href="{{ URL::to('profile/'.$username) }}" style="padding-right:20px;">{{ trans('peopleNearBy.MYPROFILE') }}</a>
    @if(Auth::user()->user_role_id==1)
        <a href="{{ URL::to('/search/login=true') }}" style="padding-right:20px;">{{ trans('peopleNearBy.SEARCH') }}</a>
    @endif
    <a href="{{ URL::to('/messages-user-lists') }}" style="padding-right:20px;">{{ trans('peopleNearBy.INBOX') }}</a>
    <a href="{{ URL::to('/logout') }}" style="">{{ trans('peopleNearBy.SIGNOUT') }}</a>
    <br>
    <br>
    <span style="padding-right:20px; color:#fff">{{ trans('peopleNearBy.SelectLanguage') }}</span>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <a class="lan_nav" style="padding-right:20px; color:#fff;" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">{{{ $properties['native'] }}}</a>
    @endforeach
</div>