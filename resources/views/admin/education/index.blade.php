@extends('layouts.admin')
@section('title','Education')

@section("css")

@endsection

@section("content")
    <div class="page-header">
        <h3 class="page-title">Education Information</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Education</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold float-right">
                        <a href="{{route('admin.education.create')}}" class="btn btn-primary btn-block btn-lg">Add Education</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>University</th>
                                <th>Faculty</th>
                                <th>Education Type</th>
                                <th>Education Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($educations as $education)
                                <tr id="{{$education?->id}}">
                                    <td>{{$education?->id}}</td>
                                    <td>{{$education?->university}}</td>
                                    <td>{{$education?->faculty}}</td>
                                    <td>
                                        @if($education?->education_type === 0)
                                            Bachelor
                                        @elseif($education?->education_type === 1)
                                            Master
                                        @else
                                            None
                                        @endif
                                    </td>
                                    <td>{{$education?->education_date}}</td>
                                    <td>{{$education?->description}}</td>
                                    <td>
                                        @if($education?->status)
                                            <a data-id="{{$education?->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Active</a>
                                        @else
                                            <a data-id="{{$education?->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Passive</a>
                                        @endif
                                    </td>
                                    <td>{{$education?->order}}</td>
                                    <td>{{\Carbon\Carbon::parse($education?->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.education.create',['educationId'=>$education?->id])}}" class="btn btn-warning editEducation"><i class="fa fa-pen"></i></a>
                                        <a data-id="{{$education?->id}}" href="javascript:void(0)" class="btn btn-danger deleteEducation"><i class="fa fa-trash"></i></a>
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
            let educationId = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.education.status') }}",
                type: "POST",
                async: false,
                data: {
                    educationId: educationId
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

        $('.deleteEducation').click(function () {
            let educationId = $(this).attr('data-id');

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
                        url: "{{ route('admin.education.delete') }}",
                        type: "POST",
                        async: false,
                        data: {
                            educationId: educationId
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Successful",
                                text: "Education deleted"
                            });

                            $("tr#" + educationId).remove();
                        },
                        error: function () {

                        }
                    });
                }
            })


        });
    </script>
@endsection
