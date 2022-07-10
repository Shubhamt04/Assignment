@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Add Person</h2>
            </div>
        </div>
    </div>
    
    <form action="{{ route('persons.update', $person->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Person Name" value="{{$person->name}}">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Person Email" value="{{$person->email}}">
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Phone Number:</strong>
                <input type="tel" name="phone_number" class="form-control" placeholder="Person Phone Number" value="{{$person->phone_number}}">
                @error('phone_number')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Country:</strong>
                <input type="text" name="country" class="form-control" placeholder="Country" value="{{$person->country}}">
                @error('country')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Remove and upload new image:</strong>
                <input type="file" name="profile_image" class="form-control" accept=".png, .gif, .jpeg">
                @error('profile_image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <img src="{{URL::asset('/uploads/'. $person->profile_image)}}" alt="profile Pic" height="100" width="100">
            <div class="float-right">
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                <a class="btn btn-primary" href="{{ route('persons.index') }}">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection