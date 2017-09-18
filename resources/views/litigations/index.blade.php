@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Cases</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{ route('cases.create') }}">Create</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Other Names</th>
                        <th>Rescued At</th>
                        <th>District Rescued</th>
                        <th>Dathe of Birth</th>
                        <th>Gender</th>
                        <th>Country</th>

                        <th class="text-right">Options</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($litigations as $litigation)
                <tr>
                    <td>{{$litigation->case_id}}</td>
                    <td>{{$litigation->name_during_rescue}}</td>
                    <td>{{$litigation->rescued_at}}</td>

                    <td>{{$litigation->district_name}}</td>
                    <td>{{$litigation->date_of_birth}}</td>
                    <td>{{$litigation->sex}}</td>
                    <td>{{$litigation->country_name}}</td>


                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('cases.show', $litigation->id) }}">View</a>
                        <a class="btn btn-success" href="/cases/{{$litigation->id}}/dashboard">Dashboard</a>

                    </td>
                </tr>

                @endforeach

                </tbody>

            </table>
            <div class="paginator"> <?php echo $litigations->render(); ?></div>
        </div>

    </div>


@endsection