@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Notification / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <!-- <label for="subject">SUBJECT</label>-->
                     <p class="form-control-static">{{$message->subject}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('messages.index') }}">Back</a>
           <!-- <a class="btn btn-warning" href="{{ route('messages.edit', $message->id) }}">Edit</a>
            <form action="#/$message->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>-->
        </div>
    </div>


@endsection