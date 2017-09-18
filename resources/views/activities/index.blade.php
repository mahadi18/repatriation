@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Activities
                </header>
                <div class="panel-body">

                    <div class="form-horizontal tasi-form">

                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th class="hidden-phone">Title</th>
                                <th class="text-right">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{$activity->id}}</td>
                                    <td>{{$activity->title}}</td>

                                    <td class="text-right">
                                        {!! Html::link(route('activities.show', $activity->id), 'View', array('class' => 'btn btn-success')) !!}
                                        {!! Html::link(route('activities.edit', $activity->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::open(array('route' => array('activities.destroy', $activity->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                                        <!--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}-->
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! Html::link(route('activities.create'), 'Create', array('class' => 'btn btn-success')) !!}

                    </div>
                </div>

            </section>

            <?php echo $activities->render(); ?>
        </div>
    </div>

@stop
