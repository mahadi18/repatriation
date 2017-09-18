@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Services / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('services.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value=""/>
                </div>

                <div class="form-group">
                     <label for="title">Care Type</label>
                    <select name="care_type" class="form-control" >
                    <?php foreach($care_types as $care_type) { ?>
                        <option value="{{$care_type->id}}">{{$care_type->title}}</option>
                    <?php } ?>
                    </select>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <input type="text" name="body" class="form-control" value=""/>
                </div>



            <a class="btn btn-default" href="{{ route('services.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection