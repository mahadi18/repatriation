@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    File Upload
                </header>
                <div class="panel-body">

                    {!! Form::open(array('route' => 'attachments.store', 'method' => 'post', 'class' => 'form-horizontal tasi-form', 'files' => true)) !!}

                    <div class="form-group">
                        {!! Form::label('official_reference_id', 'Attachment Reference Id', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('official_reference_id', '', array('class' => 'form-control', 'placeholder' => 'Official Reference Id')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('organizational_reference_id', 'Organization Reference Id', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::text('organizational_reference_id', '', array('class' => 'form-control', 'placeholder' => 'Organizational Reference Id')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('attachment', 'Attachment', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::file('attachment', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 victims">
                            <table id="available_victims_for_attachment" class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    {{--<th class="numeric">Price</th>--}}
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($victims)
                                    @foreach($victims as $victim)
                                        <tr>
                                            <td><input type="checkbox" value=""></td>
                                            <td>{!! $victim->id !!}</td>
                                            <td>{!! $victim->name_during_rescue !!}</td>
                                            {{--<td class="numeric">$1.38</td>--}}
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan=3>No victim found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                            <button type="button" class="btn btn-primary select_victim_for_attachment">Add</button>

                        </div>

                        <div class="col-md-4">
                            <table id="selected_victims_for_attachment" class="table table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="display: none;">Comment</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center" colspan=3>No victim selected.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('doc_type_id', 'Doc Type', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::select('doc_type_id', $doc_types, null, array('class' => 'form-control m-bot15')) !!}
                        </div>
                        <div class="col-lg-2">
                            <button data-toggle="button" class="btn btn-danger add_doc_type">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    {!! Html::link(route('attachments.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}

                </div>
            </section>

        </div>
    </div>

@endsection
