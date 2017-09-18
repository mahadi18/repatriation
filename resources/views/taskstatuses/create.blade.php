@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Create Task Status
                </header>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'taskstatuses.store', 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name of Task Status')); !!}
                        </div>
                    </div>

                    {!! Html::link(route('taskstatuses.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>

        </div>
    </div>


@endsection