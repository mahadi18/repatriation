@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> FormFields
            <a class="btn btn-success pull-right" href="{{ route('form_fields.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <?php
            //echo "<pre>";
            //print_r($form_fields);
            //echo "</pre>";
            //die();
            ?>
            @if($form_fields->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TITLE</th>
                        <th>TYPE</th>
                        <th>Form name</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($form_fields as $form_field)
                            <tr>
                                <td>{{$form_field->id}}</td>
                                <td>{{$form_field->title}}</td>
                                <td>{{$form_field->type}}</td>
                                <td>{{ $form_field->form['title'] }}<!-- Ripon fixed the bug --> </td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('form_fields.show', $form_field->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('form_fields.edit', $form_field->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('form_fields.destroy', $form_field->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $form_fields->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection