@extends('case-profile')
@section('content')



<div class="profile-menu">
    <ul>
        <li>
            <?php if($litigation->status=='open') { ?>
            <a class="detail" href="/cases/{{$litigation->id}}/dashboard"><i class="fa fa-bars"></i>Case Status</a>
            <?php }
            else {
            ?>
                <form action="/cases/{{$litigation->id}}/change_status" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="open">
                    <button type="submit" class="detail">Activate Case</button>
                </form>
            <?php } ?>
        </li>
        <li class="active"><a href="#">Case Timeline</a></li>
        <li><a href="/cases/{{$litigation->id}}/full-profile">Full Profile</a></li>
        <li><a href="/cases/{{$litigation->id}}/take-over">Survivor Takenover</a></li>
        <li><a href="/cases/{{$litigation->id}}/document-archive">Document Archive</a></li>
        <li><a href="/cases/{{$litigation->id}}/change-log">Update Log</a></li>
    </ul>
</div>
<section class="panel">
    <div class="panel-body">
        <div class="text-center mbot30">
            <h3 class="timeline-title">Timeline</h3>

            <p class="t-info">Case Created by {{ organization_name_from_user_id($litigation->created_by_id) }} on {{$litigation->created_at->setTimezone(session('user_current_timezone'))->format('M jS Y,H:i A D')}}</p>
            <?php if($litigation->status=='open') { ?>
                <form action="/cases/{{$litigation->id}}/change_status" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="closed">
                    <button type="submit" class="btn btn-success">Close this case</button>
                </form>
            <?php } else { ?>
                <p class="t-info" style="font-style: italic">Case closed on {{$litigation->updated_at->setTimezone(session('user_current_timezone'))->format('M jS Y,H:i A D')}}</p>
            <?php } ?>
        </div>

        {{-- @if (Session::has('message')) --}}
        <!-- <div class="message success">
            <div class="alert alert-success"> -->
                {{-- Session::get('message')  --}}
            <!-- </div>
        </div> -->
        {{-- @endif --}}

        @if(!empty($histories))

        <div class="timeline">
            <?php $count = 1; ?>
            @foreach($histories as $history)
            <article class="timeline-item <?php if ($count % 2 == 0) {
                echo 'alt';
            } ?>">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="panel-body">
                                            <span class="arrow<?php if ($count % 2 == 0) {
                                                echo '-alt';
                                            } ?>"></span>
                                            <span
                                                class="timeline-icon <?php echo strtolower($history->fieldName()); ?>"></span>
                                            <span
                                                class="timeline-date">{{$history->created_at->setTimezone(session('user_current_timezone'))->format('M jS Y')}}</span>

                            <h1 class="red">{{$history->created_at->setTimezone(session('user_current_timezone'))->format('H:i A')}} |
                                {{$history->created_at->setTimezone(session('user_current_timezone'))->format('D')}}</h1>

                            <p>{{$litigation->verbalizeHistory($history)}}</p>
                        </div>
                    </div>
                </div>
            </article>
            <?php $count++; ?>
            @endforeach
        </div>
        @endif
        <div class="clearfix">&nbsp;</div>
    </div>
</section>

@endsection
