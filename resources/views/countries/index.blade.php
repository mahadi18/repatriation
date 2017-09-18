@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Countries</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>CODE</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($countries as $country)
                <tr>
                    <td>{{$country->id}}</td>
                    <td>{{$country->name}}</td>
                    <td>{{$country->code}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('countries.show', $country->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('countries.edit', $country->id) }}">Edit</a>
                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('countries.create') }}">Create</a>
        </div>
    </div>


@endsection