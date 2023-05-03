@extends('layouts.admin')
@section('title','Portfolio')

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
        <h3 class="page-title">Portfolio Information</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold float-right">
                        <a href="{{route('admin.portfolio.create')}}" class="btn btn-primary btn-block btn-lg">Add Portfolio</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Featured Image</th>
                                <th>Title</th>
                                <th>Tags</th>
                                <th>About</th>
                                <th>Website</th>
                                <th>Keywords</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($portfolios as $portfolio)
                                <tr id="{{$portfolio?->id}}">
                                    <td>{{$portfolio?->id}}</td>
                                    <td>
                                        <a href="{{route('admin.portfolio.images',['id' => $portfolio->id])}}">
                                            <img src="{{asset('storage/'.$portfolio->featuredImage?->image)}}" width="50" alt="">
                                        </a>
                                    </td>
                                    <td>{{$portfolio?->title}}</td>
                                    <td>{{$portfolio?->tags}}</td>
                                    <td title="{{strip_tags($portfolio?->about)}}">{{strip_tags(substr($portfolio?->about, 0, 10)) }}</td>
                                    <td>{{$portfolio?->website}}</td>
                                    <td>{{$portfolio?->keywords}}</td>
                                    <td>{{$portfolio?->description}}</td>
                                    <td>
                                        @if($portfolio?->status)
                                            <a data-id="{{$portfolio?->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Active</a>
                                        @else
                                            <a data-id="{{$portfolio?->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Passive</a>
                                        @endif
                                    </td>
                                    <td>{{$portfolio?->order}}</td>
                                    <td>{{\Carbon\Carbon::parse($portfolio?->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.portfolio.edit',['portfolio'=>$portfolio?->id])}}" class="btn btn-warning editPortfolio"><i class="fa fa-pen"></i></a>
                                        <a data-id="{{$portfolio?->id}}" href="javascript:void(0)" class="btn btn-danger deletePortfolio"><i class="fa fa-trash"></i></a>
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
            let portfolioId = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.portfolio.status') }}",
                type: "POST",
                async: false,
                data: {
                    portfolioId: portfolioId
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

        $('.deletePortfolio').click(function () {
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
                    let url = '{{route('admin.portfolio.destroy',["portfolio" => 'deletePortfolio'])}}';
                    let route = url.replace('deletePortfolio', portfolioId);

                    $.ajax({
                        url: route,
                        type: "POST",
                        async: false,
                        data: {
                            portfolio: portfolioId,
                            '_method': 'DELETE'
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Successful",
                                text: "Portfolio deleted"
                            });

                            $("tr#" + portfolioId).remove();
                        },
                        error: function () {

                        }
                    });
                }
            })


        });
    </script>
@endsection
