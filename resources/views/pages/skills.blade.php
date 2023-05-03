@extends('layouts.front')
@section("title","Blog")

@section("css")

@endsection

@section("content")
    <section class="blog-section">
        <h2 class="section-title">SKILLS</h2>

        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    @foreach($skills as $skill)
                        <p>{{$skill->skills}}</p>
                        <div class="progress inline-flex">
                            <div class="progress-bar progress-bar-striped progress-bar-animated @if($skill->order % 2 !== 0) bg-success @else bg-primary @endif" role="progressbar"
                                 style="width: {{$skill->progress}}%">{{$skill->progress}}%
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>

        {{--                <div class="blog-posts-wrapper">--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_1.jpg")}}" alt="news 1" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}

        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_2.jpg")}}" alt="news 2" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}
        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_3.jpg")}}" alt="news 3" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}
        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_4.jpg")}}" alt="news 4" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}
        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_5.jpg")}}" alt="news 5" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}
        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                    <article class="blog-post">--}}
        {{--                        <a href="#!" class="blog-post-link">--}}
        {{--                            <img src="{{asset("assets/images/News_6.jpg")}}" alt="news 6" class="blog-post-thumbnail">--}}
        {{--                            <h5 class="blog-post-title">Design Conferences in 2019</h5>--}}
        {{--                        </a>--}}
        {{--                        <p class="blog-post-meta">--}}
        {{--                            <span class="post-published-date">28 DEC 2019</span>--}}
        {{--                            <a href="#!" class="post-comments">3 COMMENTS</a>--}}
        {{--                        </p>--}}
        {{--                    </article>--}}
        {{--                </div>--}}
    </section>
@endsection

@section("js")
    <script src="{{asset("assets/vendors/entry/jq.entry.min.js")}}"></script>
@endsection
