@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('persons.index')}}"><h3 class="btn btn-secondary">Person's list</h3></a>
        </div>
    </div>
    <div class="input-group mb-3 mt-3">
        <div class="input-group-append">
            <a class="btn btn-outline-primary" href="{{route('persons.create')}}">Add New Person</a>
        </div>
    </div>
    <hr>
    <form action="{{route('persons.search')}}" method="GET">
        <div class="input-group mb-3 mt-3 w-25">
            <input type="text" class="form-control " name="search" placeholder="Search area" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
            </div>
        </div>
    </form>
    <hr>
    <br>
    <div class="container">
        <table class="table table-bordered table-striped">

            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @if (isset($persons))
                
                @foreach ($persons as $person)
                    <tr>
                        <td style="width: 15%"><img src="{{URL::asset('/uploads/'. $person->profile_image)}}" alt="profile Pic" height="50" width="50"></td>
                        <td style="width: 15%">{{$person->name}}</td>
                        <td style="width: 15%">{{$person->email}}</td>
                        <td style="width: 15%">{{$person->phone_number}}</td>
                        <td style="width: 15%">{{$person->country}}</td>
                        <td style="width: 5%">
                            <a href="{{route('persons.edit',$person->id)}}" class="btn btn-warning">Edit</button>
                        </td>
                        <td style="width: 5%">
                                <form action="{{route('persons.destroy',$person->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"  title="Delete" class="btn btn-danger btn-sm float-right">Delete</button>
                            </form>
                        </td>
                    </tr>                            
                @endforeach
            @else
                <tr><td>No result found!</td></tr>
            @endif
        </table>
        <div class="pagination-block"> 
            {{$persons->links() }}
        </div>
    </div>
@endsection
