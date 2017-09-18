@extends('layout')

@section('content')

        <section class="panel">
            <header class="panel-heading">
                File Upload
            </header>
            <div class="panel-body">

                {{--{!! Form::open(['route' => ['attachments.update', $attachment->id], 'method' => 'put', 'class' => 'form-horizontal tasi-form', 'files' => true]) !!}--}}
                {!! Form::open(['route' => ['attachments.update', $attachment->id], 'method' => 'put', 'class' => 'form-horizontal tasi-form']) !!}

                <div class="form-group">
                    {!! Form::label('attachment', 'Attachment', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-sm-6">
                        <img width="150px" height="150px" alt="product image file" src="{!! asset("$attachment->file_path") !!}">
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('case_id', 'Victim Name', array('class' => 'col-sm-2 col-lg-2 control-label')) !!}
                    <div class="col-md-10">
                        {!! Form::select('case_id[]', $victims, $selected_case_id, array('class' => 'multi-select', 'multiple' => 'multiple', 'id' => 'my_multi_select3')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('task_id', 'Task Id', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('task_id', $tasks, $attachment->task_id, array('class' => 'form-control m-bot15')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('doc_type_id', 'Doc Type', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('doc_type_id', $doc_types, $attachment->doc_type_id, array('class' => 'form-control m-bot15')) !!}
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


@endsection
