@extends('layout')

@section('content')


    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Shelter Homes
                </header>
                <div class="panel-body">
                    <div class="form-horizontal tasi-form">

                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Country</th>
                                <th>Capacity</th>
                                <th>Services</th>
                                <th>Care Plans</th>
                                <th class="text-right">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($shelterhomes as $shelterhome)
                                <tr>
                                    <td>{{$shelterhome->id}}</td>
                                    <td>{{$shelterhome->name}}</td>
                                    <td>{{$shelterhome->location}}</td>
                                    <td>{{$shelterhome->country_name($shelterhome->country)}}</td>
                                    <td>{{$shelterhome->capacity}}</td>
                                    <td>
                                        <?php
                                        $service_ids = explode(',', $shelterhome->services);
                                        foreach ($service_ids as &$id) {
                                           echo $shelterhome->service($id).'<br><br>';
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        @if($shelterhome->carePlans)
                                            @foreach($shelterhome->carePlans as $careplan)
                                            {{$careplan->title}}<br/>
                                            @endforeach
                                        @endif

                                    </td>

                                    <td class="text-right">
                                        {!! Html::link(route('shelterhomes.show', $shelterhome->id), 'View', array('class' => 'btn btn-success')) !!}
                                        {!! Html::link(route('shelterhomes.edit', $shelterhome->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::open(array('route' => array('shelterhomes.destroy', $shelterhome->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! Html::link(route('shelterhomes.create'), 'Create', array('class' => 'btn btn-success')) !!}

                    </div>
                </div>

            </section>

            <div class="paginator"> <?php echo $shelterhomes->render(); ?></div>
        </div>
    </div>


@endsection