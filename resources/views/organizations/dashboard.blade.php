@extends('full-content')

@section('content')
<div class="legends">
    Task Status Key:
    <span class="lbl-complete"><i class="fa fa-check-square-o"></i> Completed Task</span>
    <span class="lbl-progress"><i class="fa fa-repeat"></i> In Progress Task</span>
    <span class="lbl-skip"><i class="fa fa-chain-broken"></i> Skipped Task</span>
    <span class="lbl-new"><i class="fa fa-circle"></i> New Task</span>

    <ul class="pull-right" style="text-align: right; margin-bottom: 3px">

        <li class="create-an-intake">
            <a href="/cases/create"><i class="fa fa-plus"></i>Create Intake</a>
        </li>
        <li class="to-landing">
            <a href="/dashboard">Dashboard<span class="label label-warning">New</span></a>
        </li>
    </ul>
</div>
<div class="case-links">
    <div class="row">
        <div class="col-lg-3 col-sm-5 col-xs-12">
            <div class="page-header" style="display: inline">
                <h1 style=" color: #333;font-size: 19px;font-weight: 500; margin-left: 41px; margin-top: 12px;">
                    {{ $status=='open' ? 'Active' : 'Closed' }} Cases (<?php echo $litigations->total(); ?> in Total)
                </h1>
            </div>
        </div>
        <div class="col-lg-9">


            <form method="get" action="" class="pull-right">
                <select class="pull-right" name="items_per_page" onchange="this.form.submit()">
                    <option <?php if ($items_per_page == 3) {
                        echo "selected";
                    } ?> value="3">3
                    </option>
                    <option <?php if ($items_per_page == 5) {
                        echo "selected";
                    } ?> value="5">5
                    </option>
                    <option <?php if ($items_per_page == 10) {
                        echo "selected";
                    } ?> value="10">10
                    </option>
                </select>
                <label>Items Per Page</label>
                <select class="pull-right" name="status" onchange="this.form.submit()">
                    <option <?php if ($status == 'open') {
                        echo "selected";
                    } ?> value="open">Active
                    </option>
                    <option <?php if ($status == 'closed') {
                        echo "selected";
                    } ?> value="closed">Closed
                    </option>
                </select>
                <label>Case Status</label>
                <?php if(Auth::user()->roles[0]->name=='owner' ||Auth::user()->roles[0]->name=='admin' || get_organization_country(Auth::user()->organization_id)==2){?>

                <select class="pull-right" name="country_of_origin" onchange="this.form.submit()">
                    <option <?php if ($country_of_origin == 0) {
                        echo "selected";
                    } ?> value="0">Please Select
                    </option>
                    <option <?php if ($country_of_origin == 1) {
                        echo "selected";
                    } ?> value="1">Bangladesh
                    </option>

                    <option <?php if ($country_of_origin == 3) {
                        echo "selected";
                    } ?> value="3">Nepal
                    </option>
                </select>
                <label>Source Country</label>
                <?php } ?>

            </form>
        </div>
    </div>
</div>
</div>

<div class="row organization dashboard">
    <div class="col-md-12">
        <table class="table table-striped">
            <tbody>
            @if (Session::has('message'))
            <div class="message success">
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            </div>
            @endif
            @foreach($litigations as $litigation)
            <tr class="<?php echo strtolower(country_name_from_id($litigation->nationality)).' created_by_'.strtolower(country_from_user_id($litigation->created_by_id).'_ngo');?> ">
                <td>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="dropdown">
                                        <a id="dLabel" role="button" data-toggle="dropdown" data-target="#"
                                           class="detail" href="#"><i class="fa fa-bars"></i>&nbsp;</a>
                                        <ul class="dropdown-menu multi-level" role="menu"
                                            aria-labelledby="dropdownMenu">
                                            <div class="log-arrow-up"></div>
                                            <li><a href="/cases/<?php echo $litigation->id; ?>/dashboard">Case
                                                    Status</a></li>
                                            <?php if (!empty($litigation->continious_tasks)) { ?>
                                                <li class="dropdown-submenu">
                                                    <a tabindex="-1" href="#">Case Information</a>
                                                    <ul class="dropdown-menu">
                                                        <?php foreach ($litigation->continious_tasks as $task) { ?>
                                                            <li>
                                                                <a href="/cases/<?php echo $litigation->id; ?>?tid=<?php echo $task->parent_id; ?>&sub_task=<?php echo $task->id; ?>">{{$task->title}}</a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                            <li><a href="/cases/<?php echo $litigation->id; ?>/accessibility">Contributors</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="/cases/<?php echo $litigation->id; ?>/case-profile">
                                        <img style="width: 115px; max-height: 150px" alt=""
                                             src="{!! (!empty(get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'])) ? get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'] : '/uploads/-text.png' !!}"/>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <a href="/cases/<?php echo $litigation->id; ?>/case-profile"><h4>
                                            {{$litigation->name_during_rescue}}</h4></a>

                                    <p>{{$litigation->case_id}}</p>
                                    <p>Country: {{$litigation->country}}</p>
                                    <p>Rescued: <?php
                                                $date = new DateTime($litigation->rescue_date);
                                                echo $date->format('jS M \'y'); ?></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-9">
                            <div class="tasks">
                                <div class="task repatriation-option">
                                    <ul>
                            {!! Form::open(['route' => ['save.repatriation', $litigation->id], 'method' => 'post', 'class' => '']) !!}

                                {!! Form::label('rep', 'Repatriation Option', ['class' => 'control-label']) !!}
                                    <li class="<?php if($litigation->repatriation_option==1) echo "checked" ?>"><input type="radio" id="family-{{$litigation->id}}" onchange="this.form.submit()"  name="repatriation-option" value="1"> <label for="family-{{$litigation->id}}"><div class="circle"></div> Through Family </label></li>
                                    <li class="<?php if($litigation->repatriation_option==2) echo "checked" ?>"><input type="radio" id="letter-{{$litigation->id}}" onchange="this.form.submit()" name="repatriation-option" value="2">  <label for="letter-{{$litigation->id}}"><div class="circle"></div> Through NGO/GO </label></li>

                            {!! Form::close() !!}
                                    </ul>

                                </div>
                                <?php
                                foreach ($litigation->tasks as $task) {
                                    ?>
                                    <div class="task <?php echo $task->title ?>">


                                        <?php
                                        $icon = '';
                                        $active_class = '';
                                        if ($task->status == 'New') {
                                            $icon = '';
                                        }
                                        if ($task->status == 'In Progress') {
                                            $icon = '<i class="fa fa-repeat"></i>';
                                        }
                                        if ($task->status == 'Skip') {
                                            $icon = '<i class="fa fa-chain-broken"></i>';
                                        }
                                        if ($task->status == 'Complete') {
                                            $icon = '<i class="fa fa-check-square-o"></i>';
                                        }
                                        //$active_class = ($task->task_status_id==$task_status->id) ? 'active' : '';
                                        //echo $task->id;
                                        ?>
                                        <div
                                            class="status <?php echo strtolower($task->status) . ' ' . $active_class ?>">
                                            <p><?php
                                                $date = new DateTime($task->updated_at);
                                                echo $date->format('jS M \'y'); ?></p>

                                            <p class="t_title"><a
                                                    href="<?php echo '/cases/' . $litigation->id . '?tid=' . $task->id; ?>"><?php echo $task->title; ?></a>
                                            </p>

                                            <p><?php echo $task->updator_organization; ?></p>


                                            <?php echo $icon; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
        <div class="paginator">
            <?php
            $appends = array();

            if($status!='open') {
                $appends['open'] = $status;
            }

            if($items_per_page!=10) {
                $appends['items_per_page'] = $items_per_page;
            }
            if(isset($country_of_origin)) {
                $appends['country_of_origin'] = $country_of_origin;
            }

            ?>
            <?php echo $litigations->appends($appends)->render(); ?>
            <?php /*echo $litigations->appends(['status' => $status, 'items_per_page' => $items_per_page])->render(); */?>
        </div>

    </div>

</div>


@endsection