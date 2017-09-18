@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Ngohirs</h1>
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

                @foreach($ngohirs as $ngohir)
                <tr>
                    <td>{{$ngohir->id}}</td>
                    <td>{{$ngohir->name}}</td>
                    <td>{{$ngohir->code}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('ngohirs.show', $ngohir->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('ngohirs.edit', $ngohir->id) }}">Edit</a>
                        <form action="{{ route('ngohirs.destroy', $ngohir->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('ngohirs.create') }}">Create</a>
        </div>
    </div>


@endsection