
<nav class="navbar" role="navigation">
    <?php $username = Auth::user()->username; ?>
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav mini_nav pull-right">
            <li class="active"><a href="{{ URL::to('profile/'.$username) }}" style="padding-right:20px;">{{ trans('peopleNearBy.MYPROFILE') }}</a></li>
            @if(Auth::user()->user_role_id==1)
            <li><a href="{{ URL::to('/search/login=true') }}" style="padding-right:20px;">{{ trans('peopleNearBy.SEARCH') }}</a></li>
            @endif
            <li><a href="{{ URL::to('/messages-user-lists') }}" style="padding-right:20px;">{{ trans('peopleNearBy.INBOX') }}</a></li>
            <li><a href="{{ URL::to('/logout') }}" style="">{{ trans('peopleNearBy.SIGNOUT') }}</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{ trans('peopleNearBy.SelectLanguage') }}
                </a>
                <ul class="dropdown-menu">@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li><a class="lan_nav" style="padding-right:20px; color:#fff;" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">{{{ $properties['native'] }}}</a></li>
                @endforeach
                </ul>
            </li>
        </ul>
    </div>
</nav>