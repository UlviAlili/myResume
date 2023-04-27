@extends('layouts.front')
@section("title","Portfolio")

@section("css")

@endsection

@section("content")
    <section class="portfolio-section">
        <h2 class="section-title">PORTFOLIO</h2>

        <div class="portfolio-wrapper">
            @foreach($portfolios as $portfolio)
                <figure class="portfolio-item hover-box">
                    <a href="{{route('portfolio.details',['id'=>$portfolio->id])}}">
                        <img src="{{asset("storage/".$portfolio->featuredImage?->image)}}" alt="{{$portfolio->title}}" class="portfolio-item-img">
                    </a>
                    <figcaption class="portfolio-item-details overlay">
                        <h5 class="portfolio-item-title">{{$portfolio->title}}</h5>
                        <p class="portfolio-item-description">{{$portfolio->tags}}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>

    </section>
@endsection

@section("js")
    <script src="{{asset("assets/vendors/entry/jq.entry.min.js")}}"></script>
@endsection
