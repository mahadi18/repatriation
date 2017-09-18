@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Edit Test Image Upload
                </header>

                <div class="panel-body">

                    {!! Form::open(array('route' => array('tweets.update', $tweet->id), 'method' => 'put', 'class' => 'form-horizontal tasi-form', 'files' => true)) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$tweet->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name', 'Product Name', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::text('name', $tweet->name, array('class' => 'form-control', 'placeholder' => 'Chess Board')) !!}
                            {{--<input class=" form-control" id="cname" name="name" minlength="2" type="text" required />--}}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('sku', 'Product SKU', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('sku', $tweet->sku, ['class' => 'form-control', 'placeholder' => '1234']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Product Image', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <img width="150px" height="150px" alt="product image file" src="{!! asset("$tweet->image") !!}">
                            {!! Form::file('image', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10">
                            {!! Html::link(route('tweets.index'), 'Back', array('class' => 'btn btn-default')) !!}
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>

@endsection
