@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Messages / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('messages.update', $message->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$message->id}}</p>
                </div>
                <div class="form-group">
                     <label for="subject">SUBJECT</label>
                     <input type="text" name="subject" class="form-control" value="{{$message->subject}}"/>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <input type="text" name="body" class="form-control" value="{{$message->body}}"/>
                </div>
                    <div class="form-group">
                     <label for="sender">SENDER</label>
                     <input type="text" name="sender" class="form-control" value="{{$message->sender}}"/>
                </div>
                    <div class="form-group">
                     <label for="receiver">RECEIVER</label>
                     <input type="text" name="receiver" class="form-control" value="{{$message->receiver}}"/>
                </div>
                    <div class="form-group">
                     <label for="parent_message">PARENT_MESSAGE</label>
                     <input type="text" name="parent_message" class="form-control" value="{{$message->parent_message}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('messages.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</a>
            </form>
        </div>
    </div>


@endsection