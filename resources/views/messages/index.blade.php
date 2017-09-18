@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Messages</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SENDER</th>
                        <th>SUBJECT</th>
                        <th>TIME</th>
                        <th>BODY</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($messages as $message)
                <?php
             //  dd($messages);
                ?>
                <tr class="<?php if($message->last_viewed_by==0) { echo 'not-viewed'; }?>">
                    <td>{{organization_name_from_user_id($message->sender)}}</td>
                    <td>{{$message->subject}}</td>
                    <td>{{ Carbon\Carbon::parse($message->created_at)->format('d M Y') }}</td>
                    <td>{{$message->body}}</td>
                   <!-- <td>{{$message->parent_message}}</td>-->
                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('messages.showMessage', $message->id) }}">View</a>

                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('messages.create') }}">Create</a>
        </div>
    </div>


@endsection