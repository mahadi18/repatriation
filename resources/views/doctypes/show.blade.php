@extends('layout')

@section('content')
    <div class="page-header">
        <h1>DocTypes / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">Id</label>
                    <p class="form-control-static">{{$doctype->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">Name</label>
                     <p class="form-control-static">{{$doctype->name}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('doctypes.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('doctypes.edit', $doctype->id) }}">Edit</a>
            <form action="#/$doctype->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection