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
                                <th>Orders</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>1</td>
                            <td>SDU</td>
                            <td>Computer Engineer</td>
                            <td>Bachelor</td>
                            <td>2018-2022</td>
                            <td>Computer Engineering</td>
                            <td>Active</td>
                            <td>2</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%"></div>
                                </div>
                            </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section("js")

@endsection
