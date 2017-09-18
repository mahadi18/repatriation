@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Task Details
                </header>
                <div class="panel-body">

                    {!! Form::open(array('url' => "#", 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$task->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$task->title}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('previous', 'Previous', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$task->previous}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('next', 'Next', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$task->next}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('activity_id', 'Activity Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$task->activity_id}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {{--<div class="col-lg-offset-2 col-lg-10">--}}
                        {{--<button class="btn btn-danger" type="submit">Save</button>--}}
                        {{--<button class="btn btn-default" type="button">Cancel</button>--}}
                        {{--</div>--}}
                    </div>

                    {!! Form::close() !!}

                    {!! Html::link(route('tasks.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Html::link(route('tasks.edit', $task->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                    {!! Form::open(array('route' => array('tasks.destroy', $task->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>


@endsection