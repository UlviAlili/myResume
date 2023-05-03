@extends('layouts.front')
@section("title",$portfolio->title)

@section("css")
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
@endsection

@section("content")
    <section class="portfolio-section">
        <h2 class="section-title mb-1">{{$portfolio->title}}</h2>
        <small>{{$portfolio->tags}}</small>
        <hr>

        @if($portfolio->about)
            {!! $portfolio->about !!}
            <hr>
        @endif
        @if($portfolio->website)
            Website: <a href="{{$portfolio->website}}" target="_blank">{{$portfolio->website}}</a>
            <hr>
        @endif
        @if($portfolio->keywords)
            Keywords: {{$portfolio->keywords}}
                <hr>
        @endif
        @if($portfolio->description)
            Description:<br>
                {{$portfolio->description}}
                <hr>
        @endif
        <div class="portfolio-wrapper">
            @foreach($portfolio->images as $item)
                <figure style="cursor: pointer;" class="portfolio-item hover-box" href="{{asset("storage/".$item->image)}}">
                    <img src="{{asset("storage/".$item->image)}}"
                         alt="{{$portfolio->title}}" class="portfolio-item-img">
                </figure>
            @endforeach
        </div>

    </section>
@endsection

@section("js")
    <script src="{{asset("assets/vendors/entry/jq.entry.min.js")}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.portfolio-item').magnificPopup({
                gallery: {
                    enabled: true
                },
                type: 'image' // this is default type
            });
        });
    </script>
@endsection
