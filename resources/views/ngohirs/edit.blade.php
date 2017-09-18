@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Ngohirs / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('ngohirs.update', $ngohir->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$ngohir->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <input type="text" name="name" class="form-control" value="{{$ngohir->name}}"/>
                </div>
                    <div class="form-group">
                     <label for="code">CODE</label>
                     <input type="text" name="code" class="form-control" value="{{$ngohir->code}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('ngohirs.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</button>
            </form>
        </div>
    </div>


@endsection