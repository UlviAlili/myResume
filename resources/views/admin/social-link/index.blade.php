@extends('layouts.admin')
@section('title','Social Link')

@section("css")

@endsection

@section("content")
    <div class="page-header">
        <h3 class="page-title">Social Link</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Social Link</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold float-right">
                        <a href="{{route('admin.social.create')}}" class="btn btn-primary btn-block btn-lg">Add Social Link</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($socials as $social)
                                <tr id="{{$social?->id}}">
                                    <td>{{$social?->id}}</td>
                                    <td>{{$social?->name}}</td>
                                    <td>{{$social?->slug}}</td>
                                    <td>{{$social?->link}}</td>
                                    <td>
                                        @if($social?->status)
                                            <a data-id="{{$social?->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Active</a>
                                        @else
                                            <a data-id="{{$social?->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Passive</a>
                                        @endif
                                    </td>
                                    <td>{{$social?->order}}</td>
                                    <td>{{\Carbon\Carbon::parse($social?->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.social.create',['socialId'=>$social?->id])}}" class="btn btn-warning editSocial"><i class="fa fa-pen"></i></a>
                                        <a data-id="{{$social?->id}}" href="javascript:void(0)" class="btn btn-danger deleteSocial"><i class="fa fa-trash"></i></a>
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
@endsection

@section("js")
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            }
        });

        $('.changeStatus').click(function () {
            let socialId = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.social.status') }}",
                type: "POST",
                async: false,
                data: {
                    socialId: socialId
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Successful",
                        text: "Status change"
                    });
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

        $('.deleteSocial').click(function () {
            let socialId = $(this).attr('data-id');

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
                    $.ajax({
                        url: "{{ route('admin.social.delete') }}",
                        type: "POST",
                        async: false,
                        data: {
                            socialId: socialId
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Successful",
                                text: "Social Link deleted"
                            });

                            $("tr#" + socialId).remove();
                        },
                        error: function () {

                        }
                    });
                }
            })


        });
    </script>
@endsection
