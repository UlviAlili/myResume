@extends('layouts.admin')
@php
    $portfolioText = $portfolio ? 'Edit Portfolio' : "Create New Portfolio";
@endphp
@section('title')
    {{$portfolioText}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$portfolioText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.portfolio.index')}}">Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$portfolioText}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post"
                          action="{{$portfolio ? route('admin.portfolio.update',['portfolio' => request('portfolio')]) : route('admin.portfolio.store')}}"
                          id="createPortfolioForm" enctype="multipart/form-data">
                        @csrf
                        @if($portfolio)
                            @method('PUT')
                        @endif
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
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Title" value="{{$portfolio ? $portfolio->title : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags"
                                   placeholder="Tags" value="{{$portfolio ? $portfolio->tags : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea class="form-control" id="about" name="about" placeholder="About">{{$portfolio ? $portfolio->about : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website"
                                   placeholder="Website" value="{{$portfolio ? $portfolio->website : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords"
                                   placeholder="Keywords" value="{{$portfolio ? $portfolio->keywords : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description">{{$portfolio ? $portfolio->description : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image ( png, jpg, jpeg )</label>
                            <input type="file" class="form-control" name="image[]" id="image" multiple>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="order">Order</label>--}}
                        {{--                            <input type="text" class="form-control" id="order" name="order"--}}
                        {{--                                   placeholder="Order" value="{{$experience ? $experience->order : ''}}">--}}
                        {{--                        </div>--}}
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" {{$portfolio ? ($portfolio->status ? "checked" : ""): ""}}> Status </label>
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
        $("#image").change(function () {
            let image = $(this);
            checkImage(image);
        });

        function checkImage(image) {
            let length = image[0].files.length;
            let files = image[0].files;
            let checkImages = ['jpg', 'png', 'jpeg'];

            for (let i = 0; i < length; i++) {
                let type = files[i].type.split('/').pop();
                let size = files[i].size;
                if ($.inArray(type, checkImages) == '-1') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning!',
                        text: "The file format is invalid.",
                    });
                    image.val('');
                    return false;
                }
                if (size > 2048000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning!',
                        text: "Maximum upload file size: 2MB.",
                    });
                    image.val('');
                    return false;
                }
            }
            return true;
        }

        let createButton = $('#createButton');
        createButton.click(function () {
            let image = $('#image');
            let checkImageStatus = checkImage(image);
            if (!checkImageStatus) {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning!',
                    text: "Image file is incorrect",
                });
            }

            if ($('#title').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Title can't be empty",
                })
            } else if ($('#tags').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Tags can't be empty",
                })
            } else {
                $('#createPortfolioForm').submit();
            }
        });

    </script>
@endsection
