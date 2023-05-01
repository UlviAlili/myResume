@extends('layouts.admin')
@php
    $skillText = $skills ? 'Edit Skill' : "Create New Skill";
@endphp
@section('title')
    {{$skillText}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$skillText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.skills.index')}}">Skills</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$skillText}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.skills.store')}}" id="createSkillForm">
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
                        @if($skills)
                            <input type="hidden" name="skillId" value="{{$skills->id}}">
                        @endif
                        <div class="form-group">
                            <label for="skills">Skill</label>
                            <input type="text" class="form-control" name="skills" id="skills"
                                   placeholder="Skill" value="{{$skills ? $skills->skills : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label>
                            <input type="number" class="form-control" id="progress" name="progress"
                                   placeholder="Progress" value="{{$skills ? $skills->progress : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$skills ? $skills->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($skills?->status) checked @endif> Status </label>
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
            if ($('#skills').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Skill can't be empty",
                })
            } else if ($('#progress').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Progress can't be empty",
                })
            } else if ($('#progress').val().trim() < 0 || $('#progress').val().trim() > 100) {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Progress greater than 0 and less than 100",
                })
            } else {
                $('#createSkillForm').submit();
            }
        });

    </script>
@endsection
