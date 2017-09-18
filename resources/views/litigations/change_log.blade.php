@extends('case-profile')
@section('content')
<div class="profile-menu">
    <ul>
        <li>
            <a class="detail" href="/cases/{{$litigation->id}}/dashboard"><i class="fa fa-bars"></i>Case Status</a>
        </li>
        <li><a href="/cases/{{$litigation->id}}/case-profile">Case Timeline</a></li>
        <li><a href="/cases/{{$litigation->id}}/full-profile">Full Profile</a></li>
        <li><a href="/cases/{{$litigation->id}}/take-over">Survivor Takenover</a></li>
        <li><a href="/cases/{{$litigation->id}}/document-archive">Document Archive</a></li>
        <li class="active"><a href="/cases/{{$litigation->id}}/change-log">Update Log</a></li>
    </ul>
</div>
<section class="panel">
    <div class="panel-body">
@if(!empty($histories))
    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
        <thead>
        <tr>
            <th>Date</th>
            <th>Day and Time</th>
            <th class="hidden-phone">Change Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //dd($information);
        foreach ($histories as $history) {
            //  dd($movement);
            ?>
            <tr class="gradeX hider">
                <td>{{$history->created_at->format('M jS Y')}}</td>
                <td>{{$history->created_at->format('H:i A')}} | {{$history->created_at->format('D')}}</td>
                <td>{{$litigation->verbalizeHistory($history)}} </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
@endif
        </div>
    </section>

@endsection

