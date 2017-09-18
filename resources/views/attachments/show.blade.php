@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Attachments / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$attachment->id}}</p>
                </div>
                <div class="form-group">
                     <label for="file_name">FILE_NAME</label>
                     <p class="form-control-static">{{$attachment->file_name}}</p>
                </div>
                    <div class="form-group">
                     <label for="file_size">FILE_SIZE</label>
                     <p class="form-control-static">{{$attachment->file_size}}</p>
                </div>
                    <div class="form-group">
                     <label for="content_type">CONTENT_TYPE</label>
                     <p class="form-control-static">{{$attachment->content_type}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('attachments.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('attachments.edit', $attachment->id) }}">Edit</a>
            <form action="#/$attachment->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection