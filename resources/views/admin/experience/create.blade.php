@extends('layouts.admin')
@php
    $experienceText = $experience ? 'Edit Experience' : "Create New Experience";
@endphp
@section('title')
    {{$experienceText}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$experienceText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.experience.index')}}">Experience</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$experienceText}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.experience.store')}}" id="createExperienceForm">
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
                        @if($experience)
                            <input type="hidden" name="experienceId" value="{{$experience->id}}">
                        @endif
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" name="company" id="company"
                                   placeholder="Company" value="{{$experience ? $experience->company : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position"
                                   placeholder="Position" value="{{$experience ? $experience->position : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="experience_date">Experience Date</label>
                            <input type="text" class="form-control" id="experience_date" name="experience_date"
                                   placeholder="Example: 2014-2018" value="{{$experience ? $experience->experience_date : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description">{{$experience ? $experience->description : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$experience ? $experience->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($experience?->status) checked @endif> Status </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary col-12" id="createButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        let createButton = $('#createButton');
        createButton.click(function () {
            if ($('#company').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Company can't be empty",
                })
            } else if ($('#position').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Position can't be empty",
                })
            } else if ($('#experience_date').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Experience Date can't be empty",
                })
            } else {
                $('#createExperienceForm').submit();
            }
        });

    </script>
@endsection
