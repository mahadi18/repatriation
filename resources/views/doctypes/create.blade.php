@extends('layout')

@section('content')
    <div class="page-header">
        <h1>DocTypes / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('doctypes.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value=""/>
                </div>



            <a class="btn btn-default" href="{{ route('doctypes.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection