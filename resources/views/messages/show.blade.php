@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Messages / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">

                <div class="form-group">
                     <label for="subject">SUBJECT</label>
                     <p class="form-control-static">{{$message->subject}}</p>
                </div>
                    <div class="form-group">
                     <label for="body">Content</label>
                     <p class="form-control-static">{{$message->body}}</p>
                </div>
                    <div class="form-group">
                     <label for="sender">SENDER</label>
                     <p class="form-control-static">{{organization_name_from_user_id($message->sender)}}</p>
                </div>
                    <div class="form-group">
                     <label for="receiver">RECEIVER</label>
                     <p class="form-control-static">{{message_receiver($message->id)}}</p>
                </div>

            </form>



            <a class="btn btn-default" href="{{ route('messages.index') }}">Inbox</a>
            <a class="btn btn-warning reply" href="javascript:void(0)">Reply</a>

            <div class="reply-block <?php if(count($errors) > 0) { echo "force-show"; }?>">
                <div class="row">
                    <div class="col-md-12">

                        <form action="{{ route('messages.store') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="parent_message" value="{{ $message->id }}">

                            <div class="form-group">
                                <label for="subject">SUBJECT</label>
                                <input type="text" name="subject" class="form-control" value=" Re {{$message->subject}}"/>
                            </div>
                            <div class="form-group">
                                <label for="body">BODY</label>
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <!--<label for="sender">SENDER</label>-->
                                <input type="hidden"  name="sender" class="form-control" value="{{ Auth::user()->id }}"/>
                                <input type="hidden"  name="organization[]" class="form-control" value="{{ organization_id_from_user_id($message->sender) }}"/>

                            </div>
                            <!--<div class="form-group">
                             <label for="receiver">Recipient</label>
                             <input type="text" name="receiver" class="form-control" value=""/>
                        </div>-->


                            <div class="form-group">
                                <!--<label for="parent_message">PARENT_MESSAGE</label>-->
                                <input type="hidden" name="parent_message" class="form-control" value=""/>
                            </div>



                            <a class="btn btn-default" href="{{ route('messages.index') }}">Back</a>
                            <button class="btn btn-primary" type="submit" >Send</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
