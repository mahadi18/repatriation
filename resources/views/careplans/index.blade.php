@extends('layout')

@section('content')
    <div class="page-header">
        <h1>CarePlans</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{ route('careplans.create') }}">Create</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($careplans as $careplan)
                <tr>
                    <td>{{$careplan->id}}</td>
                    <td>{{$careplan->title}}</td>
                    <td>{{$careplan->description}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('careplans.show', $careplan->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('careplans.edit', $careplan->id) }}">Edit</a>
                        <!--<form action="{{ route('careplans.destroy', $careplan->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <div class="paginator"> <?php echo $careplans->render(); ?></div>
        </div>
    </div>


@endsection