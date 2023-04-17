@extends('layouts.admin')
@section('title','Experience')

@section("css")

@endsection

@section("content")
    <div class="page-header">
        <h3 class="page-title">Experience Information</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Experience</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold float-right">
                        <a href="{{route('admin.experience.create')}}" class="btn btn-primary btn-block btn-lg">Add Experience</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Experience Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Orders</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($experiences as $experience)
                                <tr id="{{$experience->id}}">
                                    <td>{{$experience->id}}</td>
                                    <td>{{$experience->company}}</td>
                                    <td>{{$experience->position}}</td>
                                    <td>{{$experience->experience_date}}</td>
                                    <td>{{$experience->description}}</td>
                                    <td>
                                        @if($experience->status)
                                            <a data-id="{{$experience->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Active</a>
                                        @else
                                            <a data-id="{{$experience->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Passive</a>
                                        @endif
                                    </td>
                                    <td>{{$experience->order}}</td>
                                    <td>{{\Carbon\Carbon::parse($experience->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.experience.create',['experienceId'=>$experience->id])}}" class="btn btn-warning editExperience"><i class="fa fa-pen"></i></a>
                                        <a data-id="{{$experience->id}}" href="javascript:void(0)" class="btn btn-danger deleteExperience"><i class="fa fa-trash"></i></a>
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
            let experienceId = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.experience.status') }}",
                type: "POST",
                async: false,
                data: {
                    experienceId: experienceId
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

        $('.deleteExperience').click(function () {
            let experienceId = $(this).attr('data-id');

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
                        url: "{{ route('admin.experience.delete') }}",
                        type: "POST",
                        async: false,
                        data: {
                            experienceId: experienceId
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Successful",
                                text: "Experience deleted"
                            });

                            $("tr#" + experienceId).remove();
                        },
                        error: function () {

                        }
                    });
                }
            })


        });
    </script>
@endsection
