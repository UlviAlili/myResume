<header>
    <button type="button" data-toggle="modal" data-target="#shareModal" class="btn btn-white btn-share ml-auto mr-3 ml-md-0 mr-md-auto btn-hide-on-mobile">
        <img src="{{asset("assets/images/share.svg")}}" alt="share" class="btn-img">
        SHARE
    </button>
    @include('layouts.share')
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
