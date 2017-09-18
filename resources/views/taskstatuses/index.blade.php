@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Task Statuses
                </header>
                <div class="panel-body">

                    <div class="form-horizontal tasi-form">

                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th class="hidden-phone">Name</th>
                                <th class="text-right">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($taskstatuses as $taskstatus)
                                <tr>
                                    <td>{{$taskstatus->id}}</td>
                                    <td>{{$taskstatus->name}}</td>

                                    <td class="text-right">
                                        {!! Html::link(route('taskstatuses.show', $taskstatus->id), 'View', array('class' => 'btn btn-success')) !!}
                                        {!! Html::link(route('taskstatuses.edit', $taskstatus->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::open(array('route' => array('taskstatuses.destroy', $taskstatus->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! Html::link(route('taskstatuses.create'), 'Create', array('class' => 'btn btn-success')) !!}

                    </div>
                </div>

            </section>

            <?php echo $taskstatuses->render(); ?>

        </div>
    </div>


@endsection