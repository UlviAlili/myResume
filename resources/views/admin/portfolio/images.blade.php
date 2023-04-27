@extends('layouts.admin')
@section('title','Portfolio Images')

@section("css")
    <style>
        .table th img, .jsgrid .jsgrid-table th img, .table td img, .jsgrid .jsgrid-table td img {
            width: 100px;
            height: unset !important;
            border-radius: unset !important;
        }
    </style>
@endsection

@section("content")
    <div class="page-header">
        <h3 class="page-title">Portfolio Images Information</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route("admin.portfolio.index")}}">Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolio Images</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold float-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#exampleModal">Add Portfolio Images</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Featured</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr id="{{$image?->id}}">
                                    <td>{{$image?->id}}</td>
                                    <td>
                                        <img src="{{asset('storage/'.$image?->image)}}" width="50" alt="">
                                    </td>
                                    <td>
                                        <a data-id="{{$image?->id}}" href="javascript:void(0)"
                                           class=" {{ $image->featured === 1 ? "btn btn-success featuredImage" : "btn btn-primary featureImage" }} ">
                                            {{ $image->featured ? 'Featured Image' : 'Feature Image'}}
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($image?->status)
                                            <a data-id="{{$image?->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Active</a>
                                        @else
                                            <a data-id="{{$image?->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Passive</a>
                                        @endif
                                    </td>
                                    {{--                                    <td>{{$portfolio?->order}}</td>--}}
                                    <td>{{\Carbon\Carbon::parse($image?->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <a data-id="{{$image?->id}}" href="javascript:void(0)" class="btn btn-danger deletePortfolioImage"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="" method="post" enctype="multipart/form-data" id="AddImages">
                            @csrf
                            <label for="image">Image ( png, jpg, jpeg )</label>
                            <input type="file" class="form-control" name="image[]" id="image" multiple>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="saveImages" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            }
        });

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

        $('#saveImages').click(function () {
            let image = $('#image');
            let checkImageStatus = checkImage(image);
            if (!checkImageStatus) {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning!',
                    text: "Image file is incorrect",
                });
            }
            if (image[0].files.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning!',
                    text: "Image file is empty",
                });
            } else {
                $('#AddImages').submit();
            }
        });

        $('.changeStatus').click(function () {
            let portfolioId = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.portfolio.status-images') }}",
                type: "POST",
                async: false,
                data: {
                    portfolioId: portfolioId
                },
                success: function (response) {
                    if (response.status !== "") {
                        Swal.fire({
                            icon: "success",
                            title: "Successful",
                            text: "Status change"
                        });
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: "This is Featured Image"
                        });

                    }
                    if (response.status === 1) {
                        self[0].innerHTML = 'Active';
                        self.removeClass('btn-danger');
                        self.addClass('btn-success');
                    } else if (response.status === 0) {
                        self[0].innerHTML = "Passive";
                        self.removeClass('btn-success');
                        self.addClass('btn-danger');
                    }
                },
                error: function () {

                }
            });
        });

        $(document).on('click', '.featureImage', function () {

            let portfolioId = $(this).attr('data-id');
            let self = $(this);
            let featured = $(".featuredImage");
            $.ajax({
                url: "{{ route('admin.portfolio.feature-images') }}",
                type: "POST",
                async: false,
                data: {
                    portfolioId: portfolioId
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Successful",
                        text: "Portfolio Image change featured"
                    });

                    featured.removeClass('btn-success');
                    featured.addClass('btn-primary');
                    featured.removeClass('featuredImage');
                    featured.addClass('featureImage');
                    featured[0].innerHTML = 'Feature Image <i class="fa fa-eye"></i>';

                    self[0].innerHTML = 'Featured Image <i class="fa fa-eye"></i>';
                    self.removeClass('featureImage');
                    self.addClass('featuredImage');
                    self.removeClass('btn-primary');
                    self.addClass('btn-success');

                    // if (response.status === 1) {
                    //     self[0].innerHTML = 'Active';
                    //     self.removeClass('btn-danger');
                    //     self.addClass('btn-success');
                    // } else if (response.status === 0) {
                    //     self[0].innerHTML = "Passive";
                    //     self.removeClass('btn-success');
                    //     self.addClass('btn-danger');
                    // }
                },
                error: function () {

                }
            });
        });


        $('.deletePortfolioImage').click(function () {
            let portfolioId = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = '{{route('admin.portfolio.delete-images',["id" => 'deletePortfolio'])}}';
                    let route = url.replace('deletePortfolio', portfolioId);

                    $.ajax({
                        url: route,
                        type: "POST",
                        async: false,
                        data: {
                            '_method': 'DELETE'
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Successful",
                                text: "Portfolio Image deleted"
                            });

                            $("tr#" + portfolioId).remove();
                        },
                        error: function () {

                        }
                    });
                }
            })
        });

        {{--$(".featureImage").click(function () {--}}
        {{--    let portfolioId = $(this).attr('data-id');--}}
        {{--    let self = $(this);--}}

        {{--    Swal.fire({--}}
        {{--        title: 'Are you sure?',--}}
        {{--        text: "You change Featured Image",--}}
        {{--        icon: 'warning',--}}
        {{--        showCancelButton: true,--}}
        {{--        confirmButtonColor: '#3085d6',--}}
        {{--        cancelButtonColor: '#d33',--}}
        {{--        confirmButtonText: 'Yes, change it!'--}}
        {{--    }).then((result) => {--}}
        {{--        if (result.isConfirmed) {--}}
        {{--            let url = '{{route('admin.portfolio.feature-images')}}';--}}
        {{--            // let route = url.replace('featurePortfolio', portfolioId);--}}

        {{--            $.ajax({--}}
        {{--                url: url,--}}
        {{--                type: "POST",--}}
        {{--                async: false,--}}
        {{--                data: {--}}
        {{--                    portfolioId: portfolioId--}}
        {{--                },--}}
        {{--                success: function (response) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "success",--}}
        {{--                        title: "Successful",--}}
        {{--                        text: "Portfolio Image change featured"--}}
        {{--                    });--}}

        {{--                    $('.featuredImage').removeClass('btn-success');--}}
        {{--                    $('.featuredImage').addClass('btn-primary');--}}
        {{--                    $('.featuredImage').removeClass('featuredImage');--}}
        {{--                    $('.featuredImage').addClass('featureImage');--}}
        {{--                    $('.featuredImage').innerHTML('Feature Image');--}}
        {{--                    self.addClass('featuredImage');--}}
        {{--                    self.addClass('btn-success');--}}
        {{--                    self[0].innerHTML("Featured Image");--}}
        {{--                },--}}
        {{--                error: function () {--}}

        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}
    </script>
@endsection
