@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Create Test Image Upload
                </header>
                <div class="panel-body">
                    {!! Form::open(['route' => 'tweets.store', 'method' => 'post', 'class' => 'form-horizontal tasi-form', 'files' => true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Product Name', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Chess Board']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('sku', 'Product SKU', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => '1234']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Product Image', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::file('image', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    {!! Html::link(route('tweets.index'), 'Back', ['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>

        </div>
    </div>

@endsection