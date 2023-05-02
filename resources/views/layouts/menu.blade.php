<header>
    <button type="button" data-toggle="modal" data-target="#shareModal" class="btn btn-white btn-share ml-auto mr-3 ml-md-0 mr-md-auto">
        <img src="{{asset("assets/images/share.svg")}}" alt="share" class="btn-img">
        SHARE
    </button>
    @include('layouts.share')
    {{--    <a href="#share" data-toggle="modal" data-native-share="true" class="button button--bordered button--icon ml-1 flex-grow-1 flex-sm-grow-0">--}}
    {{--        <span class="button__label d-block d-sm-none">Share</span>--}}
    {{--    </a>--}}
    <nav class="collapsible-nav" id="collapsible-nav">
        <a href="{{route('home')}}" class="nav-link {{ Route::is("home") ? "active" : "" }}">HOME</a>
        {{--        <a href="{{route('resume')}}" class="nav-link {{ Route::is("resume") ? "active" : "" }}">RESUME</a>--}}
        <a href="{{route('skills')}}" class="nav-link {{ Route::is("skills") ? "active" : "" }}">SKILLS</a>
        <a href="{{route('portfolio')}}" class="nav-link {{ Route::is("portfolio") ? "active" : "" }} {{ Route::is("portfolio.details") ? "active" : "" }}">PORTFOLIO</a>
        <a href="{{route('contact')}}" class="nav-link {{ Route::is("contact") ? "active" : "" }}">CONTACT</a>
    </nav>
    <button class="btn btn-menu-toggle btn-white rounded-circle" data-toggle="collapsible-nav"
            data-target="collapsible-nav">
        <img src="{{asset("assets/images/hamburger.svg")}}" alt="hamburger">
    </button>
</header>
