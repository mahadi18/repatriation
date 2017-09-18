@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Service Managements
                </header>
                <div class="panel-body">

                    <div class="form-horizontal tasi-form">

                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th class="hidden-phone">Title</th>
                                <th class="hidden-phone">Description</th>
                                <th class="text-right">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($servicemanagements as $servicemanagement)
                                <tr>
                                    <td>{{$servicemanagement->id}}</td>
                                    <td>{{$servicemanagement->title}}</td>
                                    <td>{{$servicemanagement->description}}</td>

                                    <td class="text-right">
                                        {!! Html::link(route('servicemanagements.show', $servicemanagement->id), 'View', array('class' => 'btn btn-success')) !!}
                                        {!! Html::link(route('servicemanagements.edit', $servicemanagement->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::open(array('route' => array('servicemanagements.destroy', $servicemanagement->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! Html::link(route('servicemanagements.create'), 'Create', array('class' => 'btn btn-success')) !!}

                    </div>
                </div>

            </section>

            <?php echo $servicemanagements->render(); ?>
        </div>
    </div>


@endsection