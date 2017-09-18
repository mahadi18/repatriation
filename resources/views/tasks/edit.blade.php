@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">

        <section class="panel">
            <header class="panel-heading">
                Edit Task
            </header>
            <div class="panel-body">

                {!! Form::open(array('route' => array('tasks.update', $task->id), 'method' => 'put', 'class' =>
                'form-horizontal tasi-form')) !!}

                <div class="form-group">
                    {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-sm-6">
                        <p class="form-control-static">{{$task->id}}</p>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('title', $task->title, array('class' => 'form-control')) !!}
                    </div>
                </div>

                <?php
                $current_country_ids = array();
                $current_country_ids = $task->defaultCountries($task->id);
?>

                <div class="form-group">
                    {!! Form::label('country', 'Eligible Countries', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-md-10">
                        {!! Form::select('country[]', $countries, $current_country_ids, array('class' => 'multi-select', 'multiple' => 'multiple', 'id' => 'my_multi_select3')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Parent', 'Parent', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-md-10">
                        <?php ($tasks[0]='None'); ?>
                        {!! Form::select('parent_id', $tasks, $task->parent_id, array('class' => 'multi-select')) !!}

                    </div>
                </div>



                {!! Html::link(route('tasks.index'), 'Back', array('class' => 'btn btn-default')) !!}
                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
            </div>
        </section>

    </div>
</div>

@endsection
