@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Actpoints</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($actpoints as $actpoint)
                <tr>
                    <td>{{$actpoint->id}}</td>
                    <td>{{$actpoint->title}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('actpoints.show', $actpoint->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('actpoints.edit', $actpoint->id) }}">Edit</a>
                        <!--<form action="{{ route('actpoints.destroy', $actpoint->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('actpoints.create') }}">Create</a>
        </div>
    </div>


@endsection