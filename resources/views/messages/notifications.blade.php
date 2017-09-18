@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Notifications</h1>
    </div>


    <div class="row all-notifications">
        <div class="col-md-12">
                @foreach($notifications as $notification)
            <?php $class = $notification->last_viewed_by > 0 ? 'viewed':'not-viewed';?>
                <div class="form-control <?php echo $class; ?>">
                    <a  class='see-notification' href="/notification/<?php echo $notification->id; ?>"> {!! $notification->subject !!}</a><span style="float: right"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans() ?></span>
                </div>
                @endforeach
        </div>
    </div>
<div class="paginator"> <?php echo $notifications->render(); ?></div>


@endsection