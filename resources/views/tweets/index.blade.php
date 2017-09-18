@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Test Image Upload
                </header>
                <div class="panel-body">

                    <div class="form-horizontal tasi-form">

                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product SKU</th>
                                <th>Image</th>
                                <th class="text-right">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tweets as $tweet)
                                <tr>
                                    <td>{{$tweet->id}}</td>
                                    <td>{{$tweet->name}}</td>
                                    <td>{{$tweet->sku}}</td>
                                    {{--<td>{!! Html::image($tweet->image) !!}</td>--}}
                                    <td><img width="50px" height="50px" alt="product image file" src="{!! asset("$tweet->image") !!}"></td>

                                    <td class="text-right">
                                        {!! Html::link(route('tweets.show', $tweet->id), 'View', array('class' => 'btn btn-success')) !!}
                                        {!! Html::link(route('tweets.edit', $tweet->id), 'Edit', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::open(array('route' => array('tweets.destroy', $tweet->id), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => "if(confirm('Delete? Are you sure?')) { return true } else {return false }")) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! Html::link(route('tweets.create'), 'Create', array('class' => 'btn btn-success')) !!}
                        {!! Form::button('Detect Timezone', array('class' => 'btn btn-success', 'id' => 'detect_timezone')) !!}

                    </div>
                </div>

            </section>

        </div>
    </div>

@endsection
