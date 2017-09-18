@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Countries / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('countries.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">NAME</label>
                     <input type="text" name="name" class="form-control" value=""/>
                </div>
                    <div class="form-group">
                     <label for="code">CODE</label>
                     <input type="text" name="code" class="form-control" value=""/>
                </div>



            <a class="btn btn-default" href="{{ route('countries.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection