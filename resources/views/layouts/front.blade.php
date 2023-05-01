<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Mukta:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/vendors/@fortawesome/fontawesome-free/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/live-resume.css")}}">
    <link rel="stylesheet" href="{{asset('assets/sweet-alert/sweetalert2.min.css')}}">
    @yield('css')
</head>
<body>
@include('layouts.menu')
<div class="content-wrapper">
    <aside>
        <div class="profile-img-wrapper">
            <img src="{{asset("storage/$profile?->image")}}" alt="profile">
        </div>
        <h1 class="profile-name">{{$profile?->full_name}}</h1>
        <div class="text-center">
            <span class="badge badge-white badge-pill profile-designation">{{$profile?->job_name}}</span>
        </div>
        <nav class="social-links">
            @foreach($socials as $social)
                <a href="{{$social?->link}}" target="_blank" class="social-link" data-toggle="tooltip" title="{{$social?->name}}"><i class="fab fa-{{$social?->slug}}"></i></a>
            @endforeach
        </nav>
        <div class="widget">
            <h5 class="widget-title">personal information</h5>
            <div class="widget-content">
                @if($profile->website)
                    <p>WEBSITE : {{$profile?->website}}</p>
                @endif
                @if($profile->phone)
                    <p>PHONE : {{$profile?->phone}}</p>
                @endif
                @if($profile->mail)
                    <p>MAIL : {{$profile?->mail}}</p>
                @endif
                @if($profile->location)
                    <p>LOCATION : {{$profile?->location}}</p>
                @endif
                <a href="{{asset("storage/$profile?->cv")}}" class="btn btn-download-cv btn-primary rounded-pill" target="_blank">DOWNLOAD CV</a>
            </div>
        </div>
        {{--        <div class="widget card">--}}
        {{--            <div class="card-body">--}}
        {{--                <div class="widget-content">--}}
        {{--                    <h5 class="widget-title card-title">SKILLS</h5>--}}
        {{--                    <p> PHP--}}
        {{--                    <div class="progress inline-flex">--}}
        {{--                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>--}}
        {{--                    </div>--}}
        {{--                    </p>--}}
        {{--                    <hr>--}}
        {{--                    <p>Laravel framework</p>--}}
        {{--                    <div class="progress inline-flex">--}}
        {{--                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%"></div>--}}
        {{--                    </div>--}}
        {{--                    <hr>--}}
        {{--                    <p>HTML</p>--}}
        {{--                    <div class="progress inline-flex">--}}
        {{--                        <div class="progress-bar bg-success" role="progressbar" style="width: 90%"></div>--}}
        {{--                    </div>--}}
        {{--                    <hr>--}}
        {{--                    <p>CSS</p>--}}
        {{--                    <div class="progress inline-flex">--}}
        {{--                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%"></div>--}}
        {{--                    </div>--}}
        {{--                    <hr>--}}
        {{--                    <p>Javascript</p>--}}
        {{--                    <div class="progress inline-flex">--}}
        {{--                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%"></div>--}}
        {{--                    </div>--}}
        {{--                    <hr>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">LANGUAGES</h5>
                    @foreach($languages as $language)
                        <p>{{$language?->language}} : {{$language?->level}}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">INTERESTS</h5>
                    @foreach($interests as $interest)
                        <p>{{$interest?->name}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </aside>
    <main>

        @yield('content')

        <footer><a href="https://www.github.com/UlviAlili" target="_blank" rel="noopener noreferrer">Ulvi Alili</a>. All Rights Reserved {{date('Y')}}</footer>
    </main>
</div>
<script src="{{asset("assets/vendors/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("assets/vendors/@popperjs/core/dist/umd/popper-base.min.js")}}"></script>
<script src="{{asset("assets/vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/js/live-resume.js")}}"></script>
<script src="{{asset("assets/sweet-alert/sweetalert2.all.min.js")}}"></script>
@include('sweetalert::alert')
@yield('js')
</body>

</html>
