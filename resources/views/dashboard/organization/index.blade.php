@extends('layout')
@section('style')
    {!! Html::style('assets/data-tables/DT_bootstrap.css') !!}
    {!! Html::style('css/dashboard.css') !!}
    <style rel="stylesheet" type="text/css">

    </style>
@endsection
@section('content')
    {{--<div class="page-header">--}}
    {{--<h1>DashBoard</h1>--}}
    {{--</div>--}}
    <div class="dashboard">
        <div class="row">
            <div class="col-md">
                <div class="google-map">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="heading-top">
                                <table class="table table-bordered total-statistics">
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center">
                                            Total Cases {{countTotalRescued()}} <br>
                                            @foreach(getCountryOfOrigin() as $key =>$country)
                                                <span>{{$country->country}}: {{$country->totalRescued}}
                                                    cases {{$key == 0? ',': ''}}</span>
                                            @endforeach
                                        </td>
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                        @foreach(getLitigationByStatus() as $row)
                                            <td>
                                                <span style="text-transform:capitalize">{{$row->status}} </span>
                                                <span> Cases {{$row->totalCases}}
                                                   </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="graph-representation">
                                <div class="map-tabs">
                                    <ul class="nav nav-pills nav-tabs nav-inline nav-justified">
                                        <li class="active">
                                            <a href="#caseInitiation" data-toggle="tab">Case Initiation</a>
                                        </li>
                                        <li>
                                            <a href="#organization" data-toggle="tab">Organizations</a>
                                        </li>
                                        <li>
                                            <a href="#rescue_location" data-toggle="tab">Rescue Location</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="caseInitiation">
                                    <div class="map_case_initiation" id="map_case_initiation">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="organization">
                                    <div class="map_organization" id="map_organization">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="rescue_location">
                                    <div id="map_rescue_location" class="map_rescue_location">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rescue Distribution accordng to state gender and age--}}
        <section class="rescue-distribution">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-left">
                        <div class="widget-title">
                            <h3 class="block-heading">Distribution of survivors who rescued in India</h3>
                        </div>
                        <div class="panel panel default">
                            <div class="panel-heading">
                                <div class="custom-tab">
                                    <ul class="nav nav-pills nav-tabs nav-inline">
                                        <li class="active">
                                            <a href="#gender" data-toggle="tab">Gender</a>
                                        </li>
                                        <li>
                                            <a href="#age" data-toggle="tab">Age</a>
                                        </li>
                                        <li>
                                            <a href="#year" data-toggle="tab">Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="gender">
                                        <div class="chart_gender" id="chart_gender"></div>
                                    </div>
                                    <div class="tab-pane fade" id="age">
                                        <div class="chart_age" id="chart_age"></div>
                                    </div>
                                    <div class="tab-pane fade" id="year">
                                        <div id="chart_year" class="chart-year"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-right">
                        <div class="widget-title">
                            <h3 class="block-heading">Rescue location of survivors</h3>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{--<h4>No of repatriation done(country wise)</h4>--}}
                                <div class="custom-tab">
                                    <ul class="nav nav-pills nav-tabs nav-inline">
                                        <li class="active">
                                            <a href="#bangladesh" data-toggle="tab">Bangladeshi</a>
                                        </li>
                                        <li>
                                            <a href="#nepal" data-toggle="tab">Nepalese</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="bangladesh">
                                        <div id="chart-bangladesh" class="chart-bangladesh">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nepal">
                                        <div id="chart-nepal" class="chart-nepal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="repatriate-distribution">
            {{--<h3 class="block-heading">Repatriation Statistics</h3>--}}
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-left">
                        <div class="widget-title">
                            <h3 class="block-heading">Distribution of survivors who repatriated from India</h3>
                        </div>
                        <div class="panel panel default">
                            <div class="panel-heading">
                                <div class="custom-tab">
                                    <ul class="nav nav-pills nav-tabs nav-inline">
                                        <li class="active">
                                            <a href="#gender-repatriate" data-toggle="tab">Gender</a>
                                        </li>
                                        <li>
                                            <a href="#age-repatriate" data-toggle="tab">Age</a>
                                        </li>
                                        <li>
                                            <a href="#year-repatriate" data-toggle="tab">Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="gender-repatriate">
                                        <div class="chart_gender-repatriate" id="chart_gender-repatriate"></div>
                                    </div>
                                    <div class="tab-pane fade" id="age-repatriate">
                                        <div class="chart_age_repatriate" id="chart_age_repatriate"></div>
                                    </div>
                                    <div class="tab-pane fade" id="year-repatriate">
                                        <div id="chart_year-repatriate" class="chart_age-repatriate"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-right">
                        <div class="widget-title">
                            <h3 class="block-heading">Repatriation accomplished from different state of India</h3>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{--<h4>No of repatriation done(country wise)</h4>--}}
                                <div class="custom-tab">
                                    <ul class="nav nav-pills nav-tabs nav-inline">
                                        <li class="active">
                                            <a href="#bangladesh-repatriate" data-toggle="tab">Bangladesh</a>
                                        </li>
                                        <li>
                                            <a href="#nepal-repatriate" data-toggle="tab">Nepal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="bangladesh-repatriate">
                                        <div id="chart-bangladesh-repatriate" class="chart-bangladesh-repatriate">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nepal-repatriate">
                                        <div id="chart-nepal-repatriate" class="chart-nepal-repatriate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End of Rescue distribution--}}
        <div class="row">
            <div class="initiation-contribution">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Cases with Incomplete NGO HIR</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="tabular-visualization">
                                <table id="without-ngohirs" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th colspan="4">Total Cases with incomplete NGO
                                            HIR: {{$totalCasesWithoutNgoHirs}}</th>
                                    </tr>
                                    <tr>
                                        <th>Case Id</th>
                                        <th>Rescues Name</th>
                                        <th>Case Status</th>
                                        <th>Country of Origin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($casesWithOutNgoHirs   as $case)
                                        <tr>
                                            <td>{{$case->case_id}}</td>
                                            <td>{{$case->name}}</td>
                                            <td>
                                                <span class="{{$case->status == 'open'? 'open': 'closed'}}">{{$case->status}}</span>
                                            </td>
                                            <td>{{$case->country}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="initiation-contribution">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Cases with Incomplete State HIR</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="tabular-visualization">
                                <table id="without-statehir" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th colspan="4">Cases with Incomplete State
                                            HIR: {{$totalCasesWithoutStateHir}}</th>
                                    </tr>
                                    <tr>
                                        <th>Case Id</th>
                                        <th>Rescue Name</th>
                                        <th>Country of Origin</th>
                                        <th>Case Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($litigationsWithIncompleteStateHir   as $case)
                                        <tr>
                                            <td>{{$case->case_id}}</td>
                                            <td>{{$case->name_during_rescue}}</td>
                                            <td>{{$case->country}}</td>
                                            {{--                                            <td>{{Carbon\Carbon::createFromTimestamp($case->created_at)  }}</td>--}}
                                            <td>{{Carbon\Carbon::createFromTimestamp(strtotime($case->created_at))->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZFz_WsNdC-IiX9cYLAvxqvKyHU6Cy_2I&?sensor=false">
    </script>
    {!! Html::script('js/dashboard/markerclusterer.js') !!}
    {{--    {!! Html::script('js/dashboard/googlemap-initialize.js') !!}--}}
    {!! Html::script('js/dashboard/googlemap-admin.js') !!}
    {!! Html::script('js/dashboard/google-chart-loader.js') !!}
    {{--{!! Html::script('js/dashboard/google-graph.js') !!}--}}
    {!! Html::script('js/dashboard/google-graph-rescues.js') !!}
    {!! Html::script('js/dashboard/google-graph-donut-chart.js') !!}

    {{-- old script--}}
    {{--{!! Html::script('js/markerclusterer.js') !!}--}}
    {{--{!! Html::script('js/googlemap-initialize.js') !!}--}}
    {{--{!! Html::script('js/google-chart-loader.js') !!}--}}
    {{--{!! Html::script('js/google-graph.js') !!}--}}

    <script>
        $('#without-ngohirs').DataTable({
            "searching": false,
            "ordering": false,
            "paging": false,
            "responsive": true,
            "bFilter": false,
            "bInfo": false,
            "bSort": true,
            "bLengthChange": false,
            "iDisplayLength": 6,
            "bScrollCollapse": true,
            "fnInitComplete": function () {
                this.css("visibility", "visible");
            },
        });
        $('#with-ngohirs').DataTable({
            "searching": false,
            "ordering": false,
            "paging": false,
            "responsive": true,
            "bFilter": false,
            "bInfo": false,
            "bSort": true,
            "bLengthChange": false,
            "iDisplayLength": 6,
            "bScrollCollapse": true,
            "fnInitComplete": function () {
                this.css("visibility", "visible");
            },
        });
        $('#with-time-duration').DataTable({
            "searching": false,
            "ordering": false,
            "paging": false,
            "responsive": true,
            "bFilter": false,
            "bSort": true,
            "bInfo": false,
            "bLengthChange": false,
            "iDisplayLength": 6,
            "bScrollCollapse": true,
            "fnInitComplete": function () {
                this.css("visibility", "visible");
            },
        });
        $('#achievable-task-matrix-table').DataTable({
            "searching": false,
            "ordering": false,
            "paging": false,
            "responsive": true,
            "bFilter": false,
            "bSort": true,
            "bInfo": false,
            "bLengthChange": false,
            "iDisplayLength": 6,
            "bScrollCollapse": true,
            "fnInitComplete": function () {
                this.css("visibility", "visible");
            },
        });

        $('#without-statehir').DataTable({
            "searching": false,
            "ordering": false,
            "paging": false,
            "responsive": true,
            "bFilter": false,
            "bSort": true,
            "bInfo": false,
            "bLengthChange": false,
            "iDisplayLength": 6,
            "bScrollCollapse": true,
            "fnInitComplete": function () {
                this.css("visibility", "visible");
            },
        });

    </script>
    {!! Html::script('js/dashboard/country-org-litigation.js') !!}
    {!! Html::script('js/dashboard/ngohir-completed-organization.js') !!}
@endsection