@extends('layouts.admin')
@php
    $languagetext = $language ? 'Edit Language' : "Create New Language";
@endphp
@section('title')
    {{$languagetext}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$languagetext}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.language.index')}}">Languages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$languagetext}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.language.store')}}">
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
                        @if($language)
                            <input type="hidden" name="languageId" value="{{$language->id}}">
                        @endif
                        <div class=" form-group">
                            <label for="language">Language</label>
                            <select id="language" name="language" class="form-control">
                                <option class="form-control" value="Azerbaijani" @if($language?->language === "Azerbaijani") selected @endif>Azerbaijani</option>
                                <option class="form-control" value="Turkish" @if($language?->language === "Turkish") selected @endif>Turkish</option>
                                <option class="form-control" value="English" @if($language?->language === "English") selected @endif>English</option>
                                <option class="form-control" value="Russian" @if($language?->language === "Russian") selected @endif>Russian</option>
                                <option class="form-control" value="German" @if($language?->language === "German") selected @endif>German</option>
                                <option class="form-control" value="Spanish" @if($language?->language === "Spanish") selected @endif>Spanish</option>
                                <option class="form-control" value="Portuguese" @if($language?->language === "Portuguese") selected @endif>Portuguese</option>
                                <option class="form-control" value="Italian" @if($language?->language === "Italian") selected @endif>Italian</option>
                                <option class="form-control" value="French" @if($language?->language === "French") selected @endif>French</option>
                                <option class="form-control" value="Arabic" @if($language?->language === "Arabic") selected @endif>Arabic</option>
                                <option class="form-control" value="Chinese" @if($language?->language === "Chinese") selected @endif>Chinese</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select id="level" name="level" class="form-control">
                                <option class="form-control" value="Elementary" @if($language?->level === "Elementary") selected @endif>Elementary</option>
                                <option class="form-control" value="Beginner" @if($language?->level === "Beginner") selected @endif>Beginner</option>
                                <option class="form-control" value="Intermediate" @if($language?->level === "Intermediate") selected @endif>Intermediate</option>
                                <option class="form-control" value="Advanced" @if($language?->level === "Advanced") selected @endif>Advanced</option>
                                <option class="form-control" value="Fluent" @if($language?->level === "Fluent") selected @endif>Fluent</option>
                                <option class="form-control" value="Native" @if($language?->level === "Native") selected @endif>Native</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$language ? $language->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($language?->status) checked @endif> Status </label>
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
