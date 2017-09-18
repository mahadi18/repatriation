@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Messages / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('messages.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="subject">SUBJECT</label>
                     <input type="text" name="subject" class="form-control" value=""/>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                        <textarea name="body" class="form-control"></textarea>
                </div>
                    <div class="form-group">
                     <!--<label for="sender">SENDER</label>-->
                     <input type="hidden"  name="sender" class="form-control" value="{{ Auth::user()->id }}"/>
                </div>
                    <!--<div class="form-group">
                     <label for="receiver">Recipient</label>
                     <input type="text" name="receiver" class="form-control" value=""/>
                </div>-->

                <div class="form-group">
                    <div class="row">
                    {!! Form::label('organizations', 'Recipient Organizations', array('class' => 'col-sm-12 col-lg-12 control-label')) !!}
                    <div class="col-md-12">

                    <select name="organization[]" class="multi-select" multiple="" id="my_multi_select3" >
                        @foreach($organizations as $organization)
                        <option value="{{$organization->id}}">{{$organization->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
                </div>

                    <div class="form-group">
                     <!--<label for="parent_message">PARENT_MESSAGE</label>-->
                     <input type="hidden" name="parent_message" class="form-control" value=""/>
                </div>



            <a class="btn btn-default" href="{{ route('messages.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Send</button>
            </form>
        </div>
    </div>


@endsection