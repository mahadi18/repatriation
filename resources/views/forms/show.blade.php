@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Forms / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$form->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <p class="form-control-static">{{$form->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <p class="form-control-static">{{$form->body}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('forms.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('forms.edit', $form->id) }}">Edit</a>
            <form action="#/$form->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>
<h3>Form Fields</h3>
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('save.field.order', $form->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>Type</th>
                    <th>Order</th>
                </tr>
                </thead>

                <tbody>

                @foreach($fields as $field)
                <tr>
                    <td>{{$field->id}}</td>
                    <td>{{$field->title}}</td>
                    <td>{{$field->type}}</td>
                    <td>
                        <input type="hidden" value="{{$field->id}}" name="fields[]">
                        <input type="text" value="{{$field->order}}" name="orders[]">
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>
            <button class="btn btn-primary" type="submit" >Save</button>
        </form>
    </div>
</div>


@endsection