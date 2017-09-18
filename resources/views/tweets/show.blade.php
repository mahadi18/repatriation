@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Test Image Upload Details
                </header>
                <div class="panel-body">

                    {!! Form::open(array('url' => "#", 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}
                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$tweet->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name', 'Product Name', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$tweet->name}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('sku', 'Product SKU', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$tweet->sku}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('image', 'Product Image', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <img width="150px" height="150px" alt="product image file" src="{!! asset("$tweet->image") !!}">
                        </div>
                    </div>

                    <div class="form-group">
                    </div>

                    {!! Form::close() !!}

                    {!! Html::link(route('tweets.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Html::link(route('tweets.edit', $tweet->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                    {!! Form::open(array('route' => array('tweets.destroy', $tweet->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>

@endsection
