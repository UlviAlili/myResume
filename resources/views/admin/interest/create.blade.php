@extends('layouts.admin')
@php
    $interesttext = $interest ? 'Edit Interest' : "Create New Interest";
@endphp
@section('title')
    {{$interesttext}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$interesttext}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.interest.index')}}">Interests</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$interesttext}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="Post" action="{{route('admin.interest.store')}}">
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
                        @if($interest)
                            <input type="hidden" name="interestId" value="{{$interest->id}}">
                        @endif
                        <div class=" form-group">
                            <label for="name">Interest</label>
                            <input title="text" class="form-control" name="name" id="name" value="{{$interest ? $interest->name : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" class="form-control" id="order" name="order"
                                   placeholder="Order" value="{{$interest ? $interest->order : ''}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label" for="status">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if($interest?->status) checked @endif> Status </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
