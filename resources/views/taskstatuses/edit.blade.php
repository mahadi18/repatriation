@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Edit Task Status
                </header>

                <div class="panel-body">

                    {!! Form::open(array('route' => array('taskstatuses.update', $taskstatus->id), 'method' => 'put', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$taskstatus->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name', 'Name', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::text('name', $taskstatus->name, array('class' => 'form-control', 'placeholder' => 'Name of Task Status')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Html::link(route('taskstatuses.index'), 'Back', array('class' => 'btn btn-default')) !!}
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>


@endsection