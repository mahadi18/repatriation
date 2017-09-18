@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Ngohirs / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$ngohir->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$ngohir->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="code">CODE</label>
                     <p class="form-control-static">{{$ngohir->code}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('ngohirs.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('ngohirs.edit', $ngohir->id) }}">Edit</a>
            <form action="#/$ngohir->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection