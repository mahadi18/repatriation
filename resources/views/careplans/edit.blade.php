@extends('layout')

@section('content')
    <div class="page-header">
        <h1>CarePlans / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('careplans.update', $careplan->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$careplan->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$careplan->title}}"/>
                </div>
                    <div class="form-group">
                     <label for="description">DESCRIPTION</label>
                     <textarea name="description" class="form-control" >{{$careplan->description}}</textarea>
                </div>



            <a class="btn btn-default" href="{{ route('careplans.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</button>
            </form>
        </div>
    </div>


@endsection