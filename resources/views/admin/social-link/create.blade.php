@extends('layouts.admin')
@php
    $socialtext = $social ? 'Edit Social Link' : "Create New Social Link";
@endphp
@section('title')
    {{$socialtext}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$socialtext}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.social.index')}}">Social Link</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$socialtext}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.social.store')}}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($social)
                            <input type="hidden" name="socialId" value="{{$social->id}}">
                        @endif
                        <div class=" form-group">
                            <label for="name">Name</label>
                            <select id="name" name="name" class="form-control">
                                <option class="form-control" value="Facebook" @if($social?->name === "Facebook") selected @endif>Facebook</option>
                                <option class="form-control" value="Instagram" @if($social?->name === "Instagram") selected @endif>Instagram</option>
                                <option class="form-control" value="Twitter" @if($social?->name === "Twitter") selected @endif>Twitter</option>
                                <option class="form-control" value="Youtube" @if($social?->name === "Youtube") selected @endif>Youtube</option>
                                <option class="form-control" value="Github" @if($social?->name === "Github") selected @endif>Github</option>
                                <option class="form-control" value="Gitlab" @if($social?->name === "Gitlab") selected @endif>Gitlab</option>
                                <option class="form-control" value="Bitbucket" @if($social?->name === "Bitbucket") selected @endif>Bitbucket</option>
                                <option class="form-control" value="Linkedin" @if($social?->name === "Linkedin") selected @endif>Linkedin</option>
                                <option class="form-control" value="Google" @if($social?->name === "Google") selected @endif>Google</option>
                                <option class="form-control" value="Google Play" @if($social?->name === "Google Play") selected @endif>Google Play</option>
                                <option class="form-control" value="App Store" @if($social?->name === "App Store") selected @endif>App Store</option>
                                <option class="form-control" value="Itch io" @if($social?->name === "Itch io") selected @endif>Itch io</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link"
                                   placeholder="Social Link" value="{{$social ? $social->link : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$social ? $social->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($social?->status) checked @endif> Status </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
