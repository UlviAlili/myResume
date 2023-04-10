@extends('layouts.admin')
@section('title','Create New Education')

@section('css')

@endsection
@section('content')
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <small class="text-danger mt-2 float-left">* &nbsp;indicates a required field.</small>
            <h6 class="m-0 font-weight-bold float-right text-primary">
                <a href="" class="btn btn-primary btn-sm">All Projects</a></h6>
        </div>
        <div class="card-body">

            <form method="post" id="FrmAddProject" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Project Name<span style="color: red">*</span></label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>

{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Project Status</label>--}}
{{--                            <select name="status" class="form-control">--}}
{{--                                <option value="1">Not Started</option>--}}
{{--                                <option value="2">In Progress</option>--}}
{{--                                <option value="3">Done</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="form-group">
                    <label>Project Team Members</label>
                    <select class="form-control selectpicker" multiple data-live-search="true" name="member[]">
                        <option value="0" disabled>Select Team Member</option>
{{--                        @foreach($users as $user)--}}
{{--                            <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>

                <div class="form-group">
                    <label>Project Description</label>
                    <textarea id="editor" name="contents" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="mySubmit">Create Project &nbsp;<span
                            class="myLoad"></span></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
