<div class="mini_nav pull-right" style="color:#ffff;padding: 10px 0px; height: 110px;">
    @if(Auth::user()->user_role_id==1)
    <a href="{{ URL::to('/user/editprofile') }}" style="padding-right:20px;">{{ trans('peopleNearBy.MYPROFILE') }}</a>
    @else
    <a href="{{ URL::to('/service-provider/editprofile') }}" style="padding-right:20px;">{{ trans('peopleNearBy.MYPROFILE') }}</a>
    @endif

    <a href="{{ URL::to('/messages') }}" style="padding-right:20px;"><strong>{{ trans('peopleNearBy.INBOX') }}</strong></a>
    <a href="{{ URL::to('/logout') }}" style=""><strong>{{ trans('peopleNearBy.SIGNOUT') }}</strong></a>
    <br>
    <br>
    <span style="padding-right:20px; color:#fff">{{ trans('peopleNearBy.SelectLanguage') }}</span>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <a class="lan_nav" style="padding-right:20px; color:#fff;" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">{{{ $properties['native'] }}}</a>
    @endforeach
</div>