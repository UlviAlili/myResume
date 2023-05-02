@extends('layouts.admin')
@section('title',"Edit Profile")
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Edit Profile</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="main_title">Main Title</label>
                            <input type="text" class="form-control" name="main_title" id="main_title"
                                   placeholder="Main Title" value="{{$information?->main_title}}">
                        </div>
                        <div class="form-group">
                            <label for="about_text">About Text</label>
                            <textarea class="form-control" rows="6" name="about_text" id="about_text" placeholder="About Text">{!! $information?->about_text !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="btn_contact_text">Contact Button Text</label>
                            <input type="text" class="form-control" name="btn_contact_text" id="btn_contact_text"
                                   placeholder="Contact Button Text" value="{{$information?->btn_contact_text}}">
                        </div>
                        <div class="form-group">
                            <label for="small_title_left">Small title over Education text</label>
                            <input type="text" class="form-control" name="small_title_left" id="small_title_left"
                                   placeholder="Small title over Education text" value="{{$information?->small_title_left}}">
                        </div>
                        <div class="form-group">
                            <label for="small_title_right">Small title over Experience text</label>
                            <input type="text" class="form-control" name="small_title_right" id="small_title_right"
                                   placeholder="Small title over Experience text" value="{{$information?->small_title_right}}">
                        </div>
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                   placeholder="Full Name" value="{{$information?->full_name}}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-md-6">
                                    <img width="30%" src="{{ asset($information?->image ? 'storage/'. $information?->image : 'assets/images/faces/avatar.jpg')}}" alt="Profile Image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_name">Job Name</label>
                            <input type="text" class="form-control" name="job_name" id="job_name"
                                   placeholder="Job Name" value="{{$information?->job_name}}">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" id="website"
                                   placeholder="Website" value="{{$information?->website}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="Phone" value="{{$information?->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="text" class="form-control" name="mail" id="mail"
                                   placeholder="Mail" value="{{$information?->mail}}">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" id="location"
                                   placeholder="Location" value="{{$information?->location}}">
                        </div>
                        <div class="form-group">
                            <label for="cv">CV</label>
                            <input type="file" class="form-control" name="cv" id="cv">
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
