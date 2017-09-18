@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Shelter Home / Care Plan Status </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Care Plan</th>
                    <th>Victim Name</th>
                    <th class="text-right">Status</th>
                </tr>
                </thead>

                <tbody>

                @foreach($shelter_home_care_litigations as $shelter_home_care_litigation)
                <tr>
                    <td>{{$shelter_home_care_litigation->title}}</td>
                    <td>{{$shelter_home_care_litigation->name_during_rescue}}</td>
                    <td>{{$shelter_home_care_litigation->status}}</td>

                </tr>

                @endforeach

                </tbody>
            </table>



        </div>
    </div>


@endsection