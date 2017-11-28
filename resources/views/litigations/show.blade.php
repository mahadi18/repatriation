@extends('full-content')

@section('content')

<div class="case-links">
    <div class="row">
        <div class="col-lg-12">
            <a class="detail" href="/cases/{{$litigation->id}}/dashboard"><i class="fa fa-bars"></i> Case Status</a>
            <ul style="text-align: right">
                <li><a href="/cases/<?php echo $litigation->id?>/accessibility" style=" border-right: 1px solid #cccccc;">Contributor List</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">

<div class="case">
    <div class="case-banner-info">
        <div class="row">
            <div class="col-lg-5 name-country">
                <div class="thumb">
                    <a href="/cases/{{$litigation->id}}/case-profile"> <img style="" alt=""
                         src="{!! (!empty(get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'])) ? get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'] : '/uploads/-text.png' !!}"/></a>
                </div>
                <div style="margin-left: 75px;">
                <h4><a style="color: #333333" href="/cases/{{$litigation->id}}/case-profile">{{$litigation->name_during_rescue}}</a></h4>

                <p>Nationality: {{$litigation->country($litigation->nationality)}}</p>

                <p>Country: {{$litigation->country($litigation->country_of_origin)}}</p></div>
            </div>
            <div class="col-lg-3 case-id">
                Case ID: {{$litigation->case_id}}
            </div>
            <div class="col-lg-4 gender">
                <p>Gender: <?php echo ($litigation->sex) == 'M' ? 'Male' : 'Female';?></p>

                <p>Age: <?php
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
</div>
</div>
<div class="row">
    <div class="col-md-3 narrow <?php echo strtolower(country_name_from_id($litigation->country_of_origin)). ' created_by_'.strtolower(country_from_user_id($litigation->created_by_id).'_ngo'); ?>">
        <header class="tab-bg-dark-navy-green ">

            <ul class="nav nav-tabs cases">
                <?php
                foreach ($tasks as $key => $task) {
                    $icon = '';
                    $active_class = '';
                    $class = '';
                    if ($task->task_status_id == 1) {
                        $class = 'new';
                        $icon = '<i class="fa fa-circle-o" data-toggle="tooltip" data-placement="top" title="New"></i>';
                    }
                    if ($task->task_status_id == 2) {
                        $class = 'skip';
                        $icon = '<i class="fa fa-repeat" data-toggle="tooltip" data-placement="top" title="Skip"></i>';
                    }
                    if ($task->task_status_id == 3) {
                        $class = 'progress';
                        $icon = '<i class="fa fa-chain-broken" data-toggle="tooltip" data-placement="top" title="In Progress"></i>';
                    }
                    if ($task->task_status_id == 4) {
                        $class = 'complete';
                        $icon = '<i class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Complete"></i>';
                    }
                    ?>

                    <li class="<?php echo $parent_task_id == $task->id ? 'active' : '' ?> <?php echo $task->title ?>">
                        <?php echo $icon; ?><a
                            href="/cases/<?php echo $litigation->id; ?>?tid=<?php echo $task->id; ?>"><span><?php echo $task->title ?></span></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </header>
    </div>

    <div class="col-md-9 case-show <?php echo strtolower(country_name_from_id($litigation->country_of_origin)); ?>">

        <section class="panel">
            <?php if (count($sub_tasks) > 0) {

                $current_task = isset($_GET["sub_task"]) ? $_GET["sub_task"] : $sub_tasks[0]->id;

                ?>
                
            <?php } ?>
                <?php
                //dd($template_task);
                $class = strtolower(str_replace(".","",str_replace(" ", "-", $template_task->title)));

                //dd($class);
                ?>
            <div class="panel-body {{ $class }}">
                <div class="tab-content">
                    @if (Session::has('message'))
                    <div class="message success">
                        <div class="alert alert-success">
                            {{Session::get('message')}} 
                        </div>
                    </div>
                    @endif

                    @if (Session::has('error'))
                    <div class="message alert-success">
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- $template_task --}}

                    <?php
                    //dd($template_task);
                    $partial = 'litigations.partials.' . strtolower(str_replace(".","",str_replace(" ", "-", $template_task->title)));

                    //dd($partial);
                    ?>
                    @include($partial)
                </div>

            </div>
        </section>
    </div>

</div>

<script type="text/javascript">
    $( document ).ready(function() {
        //alert("ssss");
        $('.nepal .cbrms-tasks [id*="heading"] a  h2').click(function(){
            $( this ).toggleClass( "expanded" );
        })

        $('.ngo-hir .cbrms-tasks h3').click(function(){
            $( this ).toggleClass( "expanded" );
        })

        $( ".delete-file" ).on( "click", function() {
           var trigger_class = $(this).parent('.fileupload-new').prop('className');
            $(this).closest('.fileupload').children('.fileupload-new.thumbnail').css('display','none');
            $(this).css('display','none');
            $('input.flag').val(1);
        });

        $( ".toggler.btn" ).on( "click", function() {
            $('.tabuler-list').hide(function(){
                $('.add-form').show();
            })
        });

        $( ".cancel.btn" ).on( "click", function() {
            $('.tabuler-list').show(function(){
                $('.add-form').hide();
            })
        });






    });
</script>


@endsection

