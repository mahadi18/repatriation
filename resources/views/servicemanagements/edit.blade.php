@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Edit Service
                </header>

                <div class="panel-body">

                    {!! Form::open(array('route' => array('servicemanagements.update', $servicemanagement->id), 'method' => 'put', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            <p class="form-control-static">{{$servicemanagement->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::text('title', $servicemanagement->title, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('description', 'Description', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::textarea('description', $servicemanagement->description, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10">
                            {!! Html::link(route('servicemanagements.index'), 'Back', array('class' => 'btn btn-default')) !!}
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>


@endsection