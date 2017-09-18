@extends('layout')

@section('content')

    <div class="row <?php echo strtolower(country_name_from_id($litigation->nationality));?>">

        <div class="case">
            <div class="case-banner-info">
                <div class="row">
                    <div class="col-lg-5 name-country">
                        <div class="thumb">
                            <a  href="/cases/{{$litigation->id}}/case-profile"> <img style="" alt="" src="{!! (!empty(get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'])) ? get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'] : '/uploads/-text.png' !!}"/></a>
                        </div>
                        <h4><a style="color: #333333" href="/cases/{{$litigation->id}}/case-profile">{{$litigation->name_during_rescue}}</a></h4>

                        <p>Nationality: {{$litigation->country($litigation->nationality)}}</p>

                        <p>Country: {{$litigation->country($litigation->country_of_origin)}}</p>
                    </div>
                    <div class="col-lg-3 case-id">
                        Case ID: {{$litigation->case_id}}
                    </div>
                    <div class="col-lg-4 gender">
                        <p>Gender: <?php echo ($litigation->sex) == 'M' ? 'Male' : 'Female';?></p>

                        <p>Age:  <?php
                            if(isset($litigation->date_of_birth)) {
                                list($year, $month) = calculate_age($litigation->date_of_birth);
                                echo $year . ' years, ' . $month . ' months';
                            }
                            elseif(isset($litigation->age_year_part)) {
                                echo $litigation->age_year_part. ' years, ' . $litigation->age_month_part . ' months';;
                            }
                            else {
                                echo "Not Determined";
                            }

                            ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail"><h4 class=""><i class="fa fa-bars"></i> Case Status</h4></div>
        <div class="case-dashboard">

            @foreach ($tasks as $task)
                @if ($task->id != 1)
                    <div class="row <?php echo $task->title ?>">
                        <div class="col-md-3 task-name">
                            <span>{{$task->title}}</span>
                        </div>
                        @foreach ($task_statuses as $task_status)
                            <?php
                            $icon = '';
                            $active_class = '';
                            if ($task_status->name == 'New') {
                                $icon = '<i class="fa fa-circle-o"></i>';
                            }
                            if ($task_status->name == 'In Progress') {
                                $icon = '<i class="fa fa-repeat"></i>';
                            }
                            if ($task_status->name == 'Skip') {
                                $icon = '<i class="fa fa-chain-broken"></i>';
                            }
                            if ($task_status->name == 'Complete') {
                                $icon = '<i class="fa fa-check-square-o"></i>';
                            }
                            $active_class = ($task->task_status_id == $task_status->id) ? 'active' : '';
                            //echo $task->id;
                            ?>
                            <?php   if ($task_status->name != 'Skip') {?>
                            <div class="col-md-2 status <?php echo strtolower($task_status->name) . ' ' . $active_class ?>">
                                <div class="form-horizontal">
                                    <span class="btn btn-success">
                                        <?php echo $icon; ?> {{$task_status->name}}
                                    </span>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-2 status <?php echo strtolower($task_status->name) . ' ' . $active_class ?>">
                    <span>
                        <?php if($task->task_status_id == $task_status->id){
                        //dd($task);
                        ?>

                        <button type="button" class="btn btn-success" data-container="body" data-toggle="popover"
                                title="<?php organization_name_from_user_id($task->updated_by)?>, <?php
                                $date = new DateTime($task->updated_at);
                                echo $date->format('jS M \'y'); ?>" data-placement="bottom"
                                data-content="<?php echo $task->message_id; ?>">
                            Skip <i class="fa fa-commenting-o"></i>
                        </button>

                        <?php } else { ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#myModal<?php echo $task->id; ?>">
                            Skip
                        </button>

                            <div class="modal fade" id="myModal<?php echo $task->id; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" style="text-align: left">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button style="width: auto" type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Reason</h4>
                                        </div>
                                        <form style="display: block" class="assign"
                                              action="/cases/{{$litigation->id }}/assign" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="task_id" value="{{$task->id}}">

                                            <div class="modal-body" style="margin-bottom: 30px">
                                                <textarea style="width: 100%; height: 100%; margin-bottom: 20px"
                                                          rows="4" name="message_id"
                                                          placeholder="Write the reason(s), why you are skipping this?"></textarea>
                                                <input name="status_id" type="hidden" value="{{$task_status->id}}">
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </span>
                            </div>
                            <?php } ?>

                        @endforeach
                        <div class="details col-md-3">
                <span><a href="/cases/<?php echo $litigation->id; ?>?tid=<?php echo $task->id ?>" class="btn btn-info">Details
                        &#187;</a></span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!--show additional tasks from the country with  no users in the assigned organizations-->
    <?php if (!empty($additional_country)) { ?>

    <div class="row spacer-top">
        <div class="case col-lg-12">

            <div class="row">
                <div class="col-md-7 task-name">
                    <h3>Tasks from {{$additional_country}}
                </div>
                <div class="col-md-2 status">

                </div>
            </div>
            <div class="row">
            <div class="case-dashboard">
                @foreach ($additional_tasks as $task)
                @if ($task->id != 1)
                <div class="row">
                    <div class="col-md-3 task-name">
                        <span>{{$task->title}}</span>
                    </div>
                    @foreach ($task_statuses as $task_status)
                    <?php
                    $icon = '';
                    $active_class = '';
                    if ($task_status->name == 'New') {
                        $icon = '<i class="fa fa-circle-o"></i>';
                    }
                    if ($task_status->name == 'In Progress') {
                        $icon = '<i class="fa fa-repeat"></i>';
                    }
                    if ($task_status->name == 'Skip') {
                        $icon = '<i class="fa fa-chain-broken"></i>';
                    }
                    if ($task_status->name == 'Complete') {
                        $icon = '<i class="fa fa-check-square-o"></i>';
                    }
                    $active_class = ($task->task_status_id == $task_status->id) ? 'active' : '';
                    //echo $task->id;
                    ?>
                    <?php   if ($task_status->name != 'Skip') {?>
                        <div class="col-md-2 status <?php echo strtolower($task_status->name) . ' ' . $active_class ?>">
                            <div class="form-horizontal">
                    <span class="btn btn-success">
                        <?php echo $icon; ?> {{$task_status->name}}
                    </span>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="col-md-2 status <?php echo strtolower($task_status->name) . ' ' . $active_class ?>">
                    <span>
                        <?php if($task->task_status_id == $task_status->id){
                            //dd($task);
                            ?>

                            <button type="button" class="btn btn-success" data-container="body" data-toggle="popover"
                                    title="<?php organization_name_from_user_id($task->updated_by)?>, <?php
                                    $date = new DateTime($task->updated_at);
                                    echo $date->format('jS M \'y'); ?>" data-placement="bottom"
                                    data-content="<?php echo $task->message_id; ?>">
                                Skip <i class="fa fa-commenting-o"></i>
                            </button>

                        <?php } else { ?>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#myModal<?php echo $task->id; ?>">
                                Skip
                            </button>

                            <div class="modal fade" id="myModal<?php echo $task->id; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" style="text-align: left">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button style="width: auto" type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Reason</h4>
                                        </div>
                                        <form style="display: block" class="assign"
                                              action="/cases/{{$litigation->id }}/assign" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="task_id" value="{{$task->id}}">

                                            <div class="modal-body" style="margin-bottom: 30px">
                                                <textarea style="width: 100%; height: 100%; margin-bottom: 20px"
                                                          rows="4" name="message_id"
                                                          placeholder="Write the reason(s), why you are skipping this?"></textarea>
                                                <input name="status_id" type="hidden" value="{{$task_status->id}}">
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </span>
                        </div>
                    <?php } ?>

                    @endforeach
                    <div class="details col-md-3">
                <span><a href="/cases/<?php echo $litigation->id; ?>?tid=<?php echo $task->id ?>" class="btn btn-info">Details
                        &#187;</a></span>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
                </div>
        </div>
    </div>

    </div>
    <?php } ?>
@endsection