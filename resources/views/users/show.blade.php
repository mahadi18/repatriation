@extends('layout')

@section('content')
    <div class="page-header">
        <h1>User / Details </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$user->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$user->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="description">DESCRIPTION</label>
                     <p class="form-control-static">{{$user->description}}</p>
                </div>
                    <div class="form-group">
                     <label for="address">ADDRESS</label>
                     <p class="form-control-static">{{$user->address}}</p>
                </div>
                    <div class="form-group">
                     <label for="country">COUNTRY</label>
                     <p class="form-control-static">{{country_from_user_id($user->id)}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('users.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">Edit</a>
            <!--<form action="#/{{$user->id}}" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>-->
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection