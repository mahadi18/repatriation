@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> FormFields / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('form_fields.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('title')) has-error @endif">
                       <label for="title-field">Title</label>
                    <input type="text" id="title-field" name="title" class="form-control" value="{{ old("title") }}"/>
                       @if($errors->has("title"))
                        <span class="help-block">{{ $errors->first("title") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('type')) has-error @endif">
                       <label for="type-field">Type</label>
                        <select id="type-field" name="type" class="form-control" >
                            <?php foreach ($inputs as $input) { ?>
                            <option value="{{$input['value']}}">{{$input['name']}}</option>
                            <?php } ?>
                        </select>
                       @if($errors->has("type"))
                        <span class="help-block">{{ $errors->first("type") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('form_id')) has-error @endif">
                       <label for="form_id-field">Form</label>
                        <select id="form_id-field" name="form_id" class="form-control" value="{{ old("form_id") }}" >
                            <?php foreach ($forms as $form) { ?>
                            <option value="{{$form->id}}">{{$form->title}}-{{country_name_from_id($form->country_id)}}</option>
                            <?php } ?>
                        </select>
                       @if($errors->has("form_id"))
                        <span class="help-block">{{ $errors->first("form_id") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('form_fields.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection