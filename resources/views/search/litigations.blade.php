
@extends('layout')

@section('content')
<div class="page-header">
    <h1>Cases</h1>
</div>

<section class="">
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-success" href="{{ route('cases.create') }}">Create</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Case ID</th>
                <th>Victim Name</th>
                <th>Other Names</th>
                <th>Alias</th>
                <th>Age</th>
                <th>Birth Date</th>
                <th>Gender</th>

                <th class="text-right">Options</th>
            </tr>
            </thead>

            <tbody>

            @foreach($litigations as $litigation)
            <tr>
                <td>{{$litigation->case_id}}</td>
                <td>{{$litigation->name_during_rescue}}</td>
                <td>{{$litigation->other_names}}</td>
                <td>{{$litigation->alias}}</td>
                <td>{{$litigation->age}}</td>
                <td>{{$litigation->dob}}</td>
                <td>{{$litigation->gender}}</td>


                <td class="text-right">
                    <a class="btn btn-primary" href="{{ route('cases.show', $litigation->id) }}">View</a>
                    <!--<a class="btn btn-warning " href="{{ route('cases.edit', $litigation->id) }}">Edit</a>-->
                    <a class="btn btn-success" href="/cases/{{$litigation->id}}/dashboard">Dashboard</a>
                    <!--<form action="{{ route('cases.destroy', $litigation->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->

                </td>
            </tr>

            @endforeach

            </tbody>

        </table>
        <!--<div class="paginator"> <?php /*echo $litigations->render(); */?></div>-->
    </div>

</div>
</section>
<script type="text/javascript">
    var q = "<?php echo $query; ?>"
</script>
@endsection

