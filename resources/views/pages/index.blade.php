@extends('layouts.front')
@section('title',"Home")

@section('css')

@endsection
@section('content')

    <section class="intro-section">
        <h2 class="section-title">{{$profile?->main_title}}</h2>
        <p>
            {!!$profile?->about_text!!}
        </p>
        <a href="{{route('contact')}}" class="btn btn-primary btn-hire-me">{{$profile?->btn_contact_text}}</a>
    </section>
    <section class="resume-section">
        <div class="row">
            <div class="col-lg-6">
                <h6 class="section-subtitle">{{$profile?->small_title_left}}</h6>
                <h2 class="section-title">EDUCATION</h2>
                <ul class="time-line">
                    @foreach($educationList as $education)
                        <li class="time-line-item">
                            <span class="badge badge-primary" style="font-size: 12px;">{{$education?->education_date}}</span>
                            <h6 class="time-line-item-title" style="font-size: 16px;">{{$education?->faculty}}</h6>
                            <p class="time-line-item-subtitle" style="font-size: 14px;">@if($education?->education_type === 0)
                                    Bachelor ,
                                @elseif($education?->education_type === 1)
                                    Master ,
                                @endif {{$education?->university}}</p>
                            <p class="time-line-item-content" style="font-size: 13px;">{{$education?->description}}</p>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-lg-6">
                <h6 class="section-subtitle">{{$profile?->small_title_right}}</h6>
                <h2 class="section-title">Experience</h2>
                <ul class="time-line">
                    @foreach($experienceList as $experience)
                        <li class="time-line-item">
                            <span class="badge badge-primary" style="font-size: 12px;">{{$experience?->experience_date}}</span>
                            <h6 class="time-line-item-title" style="font-size: 16px;">{{$experience?->position}}</h6>
                            <p class="time-line-item-subtitle" style="font-size: 14px;">{{$experience?->company}}</p>
                            <p class="time-line-item-content" style="font-size: 13px;">{{$experience?->description}}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <section class="services-section">
        <h6 class="section-subtitle">WHAT I DO</h6>
        <h2 class="section-title">SERVICES</h2>
        <div class="row">
            <div class="media service-card col-lg-6">
                <div class="service-icon">
                    <img src="{{asset("assets/images/001-target.svg")}}" alt="target">
                </div>
                <div class="media-body">
                    <h5 class="service-title">Deployment</h5>
                    <p class="service-description">Deploying and Managing Web Applications on Servers</p>
                </div>
            </div>
            <div class="media service-card col-lg-6">
                <div class="service-icon">
                    <img src="{{asset("assets/images/database-svgrepo.svg")}}" alt="bulb">
                </div>
                <div class="media-body">
                    <h5 class="service-title">Database</h5>
                    <p class="service-description">Designing, optimizing, and managing databases.
                    </p>
                </div>
            </div>
            <div class="media service-card col-lg-6">
                <div class="service-icon">
                    <img src="{{asset("assets/images/002-development.svg")}}" alt="development">
                </div>
                <div class="media-body">
                    <h5 class="service-title">Development</h5>
                    <p class="service-description">Developing customized applications using Laravel framework technology.
                    </p>
                </div>
            </div>
            <div class="media service-card col-lg-6">
                <div class="service-icon">
                    <img src="{{asset("assets/images/team.svg")}}" alt="smartphone">
                </div>
                <div class="media-body">
                    <h5 class="service-title">Others</h5>
                    <p class="service-description">Teamwork and project management skills.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{--    <section class="testimonial-section">--}}
    {{--        <div id="testimonialCarousel" class="testimonial-carousel carousel slide" data-ride="carousel">--}}
    {{--            <div class="carousel-inner">--}}
    {{--                <div class="carousel-item active">--}}
    {{--                    <p class="testimonial-content">Mauris magna sapien, pharetra consectetur fringilla vitae,--}}
    {{--                                                   interdum sed tortor.</p>--}}
    {{--                    <img src="assets/images/Profile.png" alt="profile" class="testimonial-img">--}}
    {{--                    <p class="testimonial-name">Nout Golstein</p>--}}
    {{--                </div>--}}
    {{--                <div class="carousel-item">--}}
    {{--                    <p class="testimonial-content">Mauris magna sapien, pharetra consectetur fringilla vitae,--}}
    {{--                                                   interdum sed tortor.</p>--}}
    {{--                    <img src="assets/images/Profile.png" alt="profile" class="testimonial-img">--}}
    {{--                    <p class="testimonial-name">Nout Golstein</p>--}}
    {{--                </div>--}}
    {{--                <div class="carousel-item">--}}
    {{--                    <p class="testimonial-content">Mauris magna sapien, pharetra consectetur fringilla vitae,--}}
    {{--                                                   interdum sed tortor.</p>--}}
    {{--                    <img src="assets/images/Profile.png" alt="profile" class="testimonial-img">--}}
    {{--                    <p class="testimonial-name">Nout Golstein</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <ol class="carousel-indicators">--}}
    {{--                <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>--}}
    {{--                <li data-target="#testimonialCarousel" data-slide-to="1"></li>--}}
    {{--                <li data-target="#testimonialCarousel" data-slide-to="2"></li>--}}
    {{--            </ol>--}}
    {{--        </div>--}}
    {{--    </section>--}}
@endsection

@section('js')

@endsection
