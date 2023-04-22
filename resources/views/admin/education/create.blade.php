@extends('layouts.admin')
@php
    $educationtext = $education ? 'Edit Education' : "Create New Education";
@endphp
@section('title')
    {{$educationtext}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$educationtext}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.education.index')}}">Education</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$educationtext}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.education.store')}}" id="createEducationForm">
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
                        @if($education)
                            <input type="hidden" name="educationId" value="{{$education->id}}">
                        @endif
                        <div class="form-group">
                            <label for="university">University</label>
                            <input type="text" class="form-control" name="university" id="university"
                                   placeholder="University" value="{{$education ? $education->university : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="faculty">Faculty</label>
                            <input type="text" class="form-control" id="faculty" name="faculty"
                                   placeholder="Faculty" value="{{$education ? $education->faculty : ''}}">
                        </div>
                        <div class=" form-group">
                            <label for="education_type">Education Type</label>
                            <select id="education_type" name="education_type" class="form-control">
                                <option class="form-control" value="2" @if($education?->education_type === 2) selected @endif>NONE</option>
                                <option class="form-control" value="0" @if($education?->education_type === 0) selected @endif>Bachelor</option>
                                <option class="form-control" value="1" @if($education?->education_type === 1) selected @endif>Master</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="education_date">Education Date</label>
                            <input type="text" class="form-control" id="education_date" name="education_date"
                                   placeholder="Example: 2014-2018" value="{{$education ? $education->education_date : ''}}">
                        </div>
                        <div class=" form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description">{{$education ? $education->description : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$education ? $education->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($education?->status) checked @endif> Status </label>
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
            if ($('#university').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "University can't be empty",
                })
            } else if ($('#faculty').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Faculty can't be empty",
                })
            } else if ($('#education_date').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Education Date can't be empty",
                })
            } else {
                $('#createEducationForm').submit();
            }
        });

    </script>
@endsection
