@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Create Task
                </header>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'tasks.store', 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}
                    {{--<form action="#" class="form-horizontal tasi-form">--}}

                    <div class="form-group">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'Title of the task')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('country', 'Eligible Countries', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::select('country[]', $countries, null, array('class' => 'multi-select', 'multiple' => 'multiple', 'id' => 'my_multi_select3')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Parent', 'Parent', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-md-10">

                            {!! Form::select('parent_id', $tasks, null, array('class' => 'multi-select')) !!}

                        </div>
                    </div>



                    {!! Html::link(route('tasks.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>

        </div>
    </div>

@stop
