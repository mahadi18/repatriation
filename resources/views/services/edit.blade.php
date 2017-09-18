@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Services / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('services.update', $service->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$service->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$service->title}}"/>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <input type="text" name="body" class="form-control" value="{{$service->body}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('services.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</button>
            </form>
        </div>
    </div>


@endsection