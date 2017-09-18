@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Activity Details
                </header>
                <div class="panel-body">

                    {!! Form::open(array('url' => "#", 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}
                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$activity->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$activity->title}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {{--<div class="col-lg-offset-2 col-lg-10">--}}
                        {{--<button class="btn btn-danger" type="submit">Save</button>--}}
                        {{--<button class="btn btn-default" type="button">Cancel</button>--}}
                        {{--</div>--}}
                    </div>

                    {!! Form::close() !!}

                    {!! Html::link(route('activities.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Html::link(route('activities.edit', $activity->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                    {!! Form::open(array('route' => array('activities.destroy', $activity->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>

@endsection