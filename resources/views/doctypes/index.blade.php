@extends('layout')

@section('content')
    <div class="page-header">
        <h1>DocTypes</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th class="text-right">Options</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($doctypes as $doctype)
                <tr>
                    <td>{{$doctype->id}}</td>
                    <td>{{$doctype->name}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('doctypes.show', $doctype->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('doctypes.edit', $doctype->id) }}">Edit</a>
                        <!--<form action="{{ route('doctypes.destroy', $doctype->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('doctypes.create') }}">Create</a>
        </div>
    </div>


@endsection