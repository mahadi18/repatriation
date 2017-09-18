@extends('layout')

@section('content')

            <section class="panel">
                <header class="panel-heading">
                    Shelter Home Details
                </header>
                <div class="panel-body">

                    {!! Form::open(array('url' => "#", 'method' => 'post', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name', 'Name', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->name}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('location', 'Location', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->location}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('country', 'Country', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->country}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('capacity', 'Capacity', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->capacity}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('services', 'Services', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$shelterhome->services}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {{--<div class="col-lg-offset-2 col-lg-10">--}}
                        {{--<button class="btn btn-danger" type="submit">Save</button>--}}
                        {{--<button class="btn btn-default" type="button">Cancel</button>--}}
                        {{--</div>--}}
                    </div>

                    {!! Form::close() !!}

                    {!! Html::link(route('shelterhomes.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Html::link(route('shelterhomes.edit', $shelterhome->id), 'Edit', array('class' => 'btn btn-primary')) !!}
                    <a href="intake/<?php echo $shelterhome->id; ?>">Intake</a>
                    {!! Form::open(array('route' => array('shelterhomes.destroy', $shelterhome->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </section>


        </div>
    </div>


@endsection