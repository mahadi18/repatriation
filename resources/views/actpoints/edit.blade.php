@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Actpoints / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('actpoints.update', $actpoint->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$actpoint->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$actpoint->title}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('actpoints.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</a>
            </form>
        </div>
    </div>


@endsection