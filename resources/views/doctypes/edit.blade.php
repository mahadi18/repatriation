@extends('layout')

@section('content')
    <div class="page-header">
        <h1>DocTypes / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('doctypes.update', $doctype->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">Id</label>
                    <p class="form-control-static">{{$doctype->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">Name</label>
                     <input type="text" name="title" class="form-control" value="{{$doctype->name}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('doctypes.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</button>
            </form>
        </div>
    </div>


@endsection