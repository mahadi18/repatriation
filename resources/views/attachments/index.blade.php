@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Attachments</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FILE_NAME</th>
                        <th>FILE_SIZE</th>
                        <th>CONTENT_TYPE</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($attachments as $attachment)
                <tr>
                    <td>{{$attachment->id}}</td>
                    <td>{{$attachment->file_name}}</td>
                    <td>{{$attachment->file_size}}</td>
                    <td>{{$attachment->content_type}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('attachments.show', $attachment->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('attachments.edit', $attachment->id) }}">Edit</a>
                        <form action="{{ route('attachments.destroy', $attachment->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('attachments.create') }}">Create</a>
        </div>
    </div>


@endsection