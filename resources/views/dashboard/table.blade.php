@extends('layout')
@section('style')
    <style rel="stylesheet" type="text/css">
        .dashboard table {
            background: #fff;
        }

        .dashboard table tr {
            background: #fff;
            font-size: 15px;
        }

        .dashboard table th {
            text-align: center;
        }

        .total_cases table {
            background: #fff;
        }

        .total_cases table tr td {
            background: #fff;
            font-size: 15px;
            font-weight: 700;
        }

        .dashboard .panel-heading .nav > li > a {
            color: #797979;
            border-bottom: 0px;
            font-size: 15px;
            font-weight: 700;
        }

        .dashboard ul li {
            text-align: center;;
        }

        .rescued-by-age table tr td, .rescued-by-state table tr td, .rescued-by-country table tr td {
            padding: 5px 0px 5px 0px;
        }

        .rescued-by-age ul li, .rescued-by-state ul li, .rescued-by-country ul li {
            border-bottom: 1px solid #ddd;
            padding: 10px 10px;
        }

        .rescued-by-age ul li:last-child, .rescued-by-state ul li:last-child, .rescued-by-country ul li:last-child {
            border-bottom: 0px solid #ddd;
        }

        .dashboard .nav.nav-tab.nav-stacked.nav-justified > li {
            background: #ddd none repeat scroll 0 0;
            border-right: 5px solid #fff;
        }

        .dashboard .nav.nav-tab.nav-stacked.nav-justified > li:last-child {
            border-right: 0px solid #fff;
        }

        .total_cases .panel {
            background: transparent;
        }

        .pagination li {
            display: inline-block;
            padding: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h1>DashBoard</h1>
    </div>
    <div class="dashboard">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="min-height: 0px; ">
                <div class="total_cases">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center">
                                        Total Cases {{countTotalRescued()}} <br>
                                        @foreach(getCountryOfOrigin() as $key =>$country)
                                            <span>{{$country->country}} ({{$country->totalRescued}}
                                                cases){{$key == 0? ',': ''}}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    @foreach(getLitigationByStatus() as $row)
                                        <td>
                                            <span style="text-transform: uppercase">{{$row->status}} </span><span>{{$row->totalCases}}
                                                Cases</span>
                                        </td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="title-chart">
                    <div class="panel with-nav-tabs panel-default">
                        <div class="chart-tab">
                            <div class="panel-heading">
                                <ul class="nav nav-tab nav-stacked nav-justified">
                                    <li class="active"><a href="#gender" data-toggle="tab">Gender</a></li>
                                    <li><a href="#state" data-toggle="tab">State/District</a></li>
                                    <li><a href="#age" data-toggle="tab">Age</a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="gender">
                                        <div class="rescued-by-gender">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">Total Rescues: {{countTotalRescued()}}</th>
                                                </tr>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <th>{{$country->country}}<br> ({{$country->totalRescued}}
                                                            rescues)
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <td>
                                                            <span style="font-weight: 700"> Male: </span>{{countMaleRescuedOfACountry($country->country_id)}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <td>
                                                            <span style="font-weight: 700">Female: </span>{{countFemaleRescuedOfACountry($country->country_id)}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="state">
                                        <div class="rescued-by-state">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">Total Rescues: {{countTotalRescued()}}</th>
                                                </tr>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <th>{{$country->country}} <br>({{$country->totalRescued}}
                                                            rescues)
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <td>
                                                            <ul>
                                                                @foreach(countTotalRescuesByStateBelongsToACountry($country->country_id) as $row)
                                                                    <li>
                                                                        {{$row->state}}
                                                                        <br>{{$row->totalRescued}}
                                                                        (
                                                                        {{calculatePercentageOfRescues($row->totalRescued,$country->totalRescued)}}
                                                                        )
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="age">
                                        <div class="rescued-by-age">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">Total Rescues: {{countTotalRescued()}}</th>
                                                </tr>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <th>
                                                            {{$country->country}}
                                                            <br> ({{$country->totalRescued}}
                                                            rescues)
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    @foreach(getCountryOfOrigin() as $country)
                                                        <td>
                                                            <ul>
                                                                @foreach(groupTotalRescuesByAge($country->country_id) as $key => $value)
                                                                    <li><span style="font-weight: 700">{{$key}}</span>
                                                                        : {{$value}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="rescued-by-country">

                    <table id="country_data_table" class="table table-bordered">
                        <thead>
                        <tr>
                            @foreach($totalOrganizationsByCountry as $country)
                                <th width="33.33%">
                                    {{$country->country}}<br>
                                    <span>
                                       ({{$country->totalOrganizations}} Organizations)
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($totalOrganizationsByCountry as $country)
                                <td>
                                    <ul class="list">
                                        @foreach(countLitigationsOfAnOrganizationByCountry($country->country_id) as $item)
                                            <li class="item">
                                                {{$item->organization}}
                                                <br>( {{$item->litigaations}})
                                            </li>
                                        @endforeach
                                    </ul>

                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--<script async defer--}}
    {{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZFz_WsNdC-IiX9cYLAvxqvKyHU6Cy_2I&callback=initMap">--}}
    {{--</script>--}}
    <script>
        {{--@foreach($usersByCountry as $user)--}}
        {{--$('#{{$user->country}}').dataTable({--}}
        {{--"displayStart": 10,--}}
        {{--"bPaginate": true,--}}
        {{--"bFilter": false,--}}
        {{--"bInfo": false,--}}
        {{--"lengthChange": false,--}}
        {{--"ordering": false,--}}
        {{--"pagingType": "numbers"--}}
        {{--});--}}
        {{--@endforeach--}}
        {{--@foreach($totalOrganizationsByCountry as $country)--}}
        {{--new List('{{$country->country}}-list', {--}}
        {{--valueNames: ['item'],--}}
        {{--page: 4,--}}
        {{--searchClass: '{{$country->country}}-fuzzy-search',--}}
        {{--plugins: [ListPagination({})]--}}
        {{--});--}}
        {{--@endforeach--}}
        //        var monkeyList =  new List('Bangladesh-list', {
        //                    valueNames: ['item'],
        //                    plugins: [ ListFuzzySearch() ]
        //                });
    </script>
@endsection
