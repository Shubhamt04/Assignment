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
    
    <form action="{{ route('persons.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Name<span class="text-danger">*</span>:</strong>
                <input type="text" name="name" class="form-control" placeholder="Person Name" required>
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Email<span class="text-danger">*</span>:</strong>
                <input type="email" name="email" class="form-control" placeholder="Person Email" required>
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Phone Number<span class="text-danger">*</span>:</strong>
                <input type="tel" name="phone_number" class="form-control" placeholder="Person Phone Number" required>
                @error('phone_number')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Country<span class="text-danger">*</span>:</strong>
                <input type="text" name="country" class="form-control" placeholder="Country" required>
                @error('country')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Person Profile Picture:</strong>
                <input type="file" name="profile_image" class="form-control" accept=".png,.gif,.jpeg,.jpg">
                @error('profile_image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
            <a class="btn btn-primary" href="{{ route('persons.index') }}">Back</a>
        </div>
    </form>
</div>
@endsection