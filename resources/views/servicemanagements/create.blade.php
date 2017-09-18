@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Create Service
                </header>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'servicemanagements.store', 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'Title of service')); !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::textarea('description', '', array('class' => 'form-control', 'placeholder' => 'Title of service')); !!}
                        </div>
                    </div>

                    {!! Html::link(route('servicemanagements.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>

        </div>
    </div>


@endsection