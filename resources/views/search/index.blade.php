@extends('layout')

@section('content')
<div class="page-header">
    <h1>Cases</h1>
</div>


<div class="row">
    <div class="col-md-12">
        <a class="btn btn-success" href="{{ route('cases.create') }}">Create</a>
        <table class="table table-striped">


            @foreach($new_collections as $litigation)
            <tr>
                <td>{{$litigation->id}}</td>
                <td>{{$litigation->name}}</td>
                <td>{{$litigation->name_during_rescue}}</td>


                <td class="text-right">
                    <a class="btn btn-primary" href="{{ route('cases.show', $litigation->id) }}">View</a>
                    <!--<a class="btn btn-warning " href="{{ route('cases.edit', $litigation->id) }}">Edit</a>-->
                    <!--<form action="{{ route('cases.destroy', $litigation->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->

                </td>
            </tr>

            @endforeach

            </tbody>

        </table>
    </div>

</div>


@endsection