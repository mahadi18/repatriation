@extends('layout')

@section('content')
    <div class="page-header">
        <h1>CarePlans / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('careplans.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{old('title')}}"/>
                </div>
                    <div class="form-group">
                     <label for="description">DESCRIPTION</label>
                     <textarea type="text" name="description" class="form-control"/>{{old('description')}}</textarea>
                </div>



            <a class="btn btn-default" href="{{ route('careplans.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection