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
    @yield('css')
</head>
<body>
@include('layouts.menu')
<div class="content-wrapper">
    <aside>
        <div class="profile-img-wrapper">
            <img src="{{asset("assets/images/faces/Ulvi.jpg")}}" alt="profile">
        </div>
        <h1 class="profile-name">Ulvi Alili</h1>
        <div class="text-center">
            <span class="badge badge-white badge-pill profile-designation">Laravel Developer</span>
        </div>
        <nav class="social-links">
            <a href="https://www.linkedin.com/in/ulvi-alili-1b2022188/" class="social-link"><i class="fab fa-linkedin"></i></a>
            <a href="https://github.com/UlviAlili" class="social-link"><i class="fab fa-github"></i></a>
        </nav>
        <div class="widget">
            <h5 class="widget-title">personal information</h5>
            <div class="widget-content">
                <p>WEBSITE : alili-resume.store</p>
                <p>PHONE : +994 50 412 19 07</p>
                <p>MAIL : Ulvi96alili@gmail.com</p>
                <p>Location : Sumqayit, Azerbaijan</p>
                <button class="btn btn-download-cv btn-primary rounded-pill">
                    <img src="assets/images/download.svg" alt="download" class="btn-img">DOWNLOAD CV
                </button>
            </div>
        </div>
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">LANGUAGES</h5>
                    <p>English : intermediate</p>
                    <p>Azerbaijani : fluent</p>
                    <p>Turkish : fluent</p>
                </div>
            </div>
        </div>
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">INTERESTS</h5>
                    <p>Video games</p>
                    <p>Technology</p>
                    <p>Football</p>
                    <p>Chess</p>
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
@yield('js')
</body>

</html>
