@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Services</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>BODY</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($services as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->title}}</td>
                    <td>{{$service->body}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('services.show', $service->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('services.edit', $service->id) }}">Edit</a>
                        <!--<form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('services.create') }}">Create</a>
        </div>
    </div>


@endsection