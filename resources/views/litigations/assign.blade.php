@extends('layout')

@section('content')
<div class="page-header">
    <h1>Case Assignment</h1>
</div>

<div class="row">
    <div class="col-md-12 case-dashboard">
        <div class="row">
            <div class="col-md-2 task-name">
                Task
            </div>
            <div class="col-md-2 status">

            </div>
            <div class="col-md-2 status">

            </div>
            <div class="col-md-2 status">

            </div>
            <div class="col-md-2 status">

            </div>
            <div class="details col-md-2">

            </div>
        </div>
        @foreach ($tasks as $task)
        <?php
        $current_status_id = 0;
        $current_country_ids = array();
        $current_status_id = $task->status($litigation->id, $task->id);
        $current_country_ids = $task->country($litigation->id, $task->id);
        //echo (count($current_country_ids));

        ?>
        <div class="row">
            <div class="col-md-2 task-name">
                <strong>{{$task->title}}</strong>
            </div>
            <form class="col-md-10 assign" action="/cases/{{$litigation->id }}/assign" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="task_id" value="{{$task->id}}">
                <input type="hidden" name="message_id" value="0">

                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <select name="status_id" style="height: auto">
                                @foreach ($task_statuses as $task_status)
                                <option value="{{$task_status->id}}" <?php if ($current_status_id == $task_status->id) {
                                    echo "selected";
                                } ?>>{{$task_status->name}}
                                </option>
                                @endforeach
                            </select>
                            <textarea name="message" class="message-box" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row"><label>Country</label></div>
                        <div class="row">
                            <select class="country" name="country_ids[]" multiple>
                                @foreach ($countries as $key => $country)
                                <?php
                                $selected = "";
                                foreach ($current_country_ids as $current_country_id) {
                                    if ($current_country_id->assigned_country == $country['id']) {
                                        $selected = "selected";
                                    }
                                }
                                ?>
                                <option value="{{$country['id']}}"<?php echo $selected; ?>>{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row spacer-top">
                    <div class="col-lg-5">

                    </div>
                    <div class="col-lg-5">
                        <div class="row">
                            <button type="submit">Assign</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        @endforeach
    </div>
</div>


@endsection