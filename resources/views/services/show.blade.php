@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Services / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$service->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <p class="form-control-static">{{$service->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <p class="form-control-static">{{$service->body}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('services.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('services.edit', $service->id) }}">Edit</a>
            <form action="#/$service->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection