@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Edit Activity
                </header>

                <div class="panel-body">

                    {!! Form::open(array('route' => array('activities.update', $activity->id), 'method' => 'put', 'class' => 'form-horizontal tasi-form')) !!}

                    <div class="form-group ">
                        {!! Form::label('id', 'Id', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$activity->id}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::label('title', 'Title', array('class' => 'col-sm-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::text('title', $activity->title, array('class' => 'form-control')) !!}
                            {{--<input class=" form-control" id="cname" name="name" minlength="2" type="text" required />--}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10">
                            {!! Html::link(route('activities.index'), 'Back', array('class' => 'btn btn-default')) !!}
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>

@endsection