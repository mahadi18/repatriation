@extends('layout')
@section('style')
    {!! Html::style('assets/data-tables/DT_bootstrap.css') !!}
    {!! Html::style('css/dashboard.css') !!}
    <style rel="stylesheet" type="text/css">

    </style>
@endsection
@section('content')
    <div class="page-header">
        <h1>Admin DashBoard</h1>
    </div>
    <div class="dashboard">
        <div class="row">
            <div class="col-md">
                <div class="dashboard">
                    <div class="panel panel-default option-map">
                        <div class="panel-heading">
                            <form class="form" id="filter_form" action="" method="">
                                {{--                                {{ csrf_field() }}--}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sel1">Choose Filter</label>
                                        <select class="form-control" id="options" name="options">
                                            {{--<option value="-1">--- Select an Option ---</option>--}}
                                            <option value="1">Cases Initiated By Country</option>
                                            <option value="2">Cases Opened By Country</option>
                                            <option value="3">Cases Closed By Country</option>
                                            <option value="4">Organization By Country</option>
                                            <option value="5">Most Frequent Rescue Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="group-hide">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date_from">Date From</label>
                                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                                 data-date="{!! date('d-m-Y') !!}"
                                                 class="input-append date dpYears">
                                                <input name="date_from" type="text" value="" id="date_from" size="12"
                                                       class="form-control" placeholder="Select date" readonly>
                                                <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                            class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date_to">Date To</label>
                                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                                 data-date="{!! date('d-m-Y') !!}"
                                                 class="input-append date dpYears">
                                                <input name="date_to" id="date_to" type="text" value="" size="12"
                                                       class="form-control" placeholder="Select date" readonly>
                                                <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                            class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-map-button">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" id="filter"
                                                class="btn btn-default btn-primary btn-filter">Filter
                                        </button>
                                        <button type="reset" id="reset_filter"
                                                class="btn btn-default btn-default btn-filter">Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-body">
                            <div id="map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-">
                <div class="graph-representation">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{--<div class="heading-top">--}}
                            {{--<h3 style="text-align: center"> Graph Representation</h3>--}}
                            {{--</div>--}}
                            <ul class="nav nav-tabs nav-pills nav-justified">
                                <li class="active"><a href="#age" data-toggle="tab">Rescues by Age</a></li>
                                <li><a href="#gender" data-toggle="tab">Rescues by Gender</a></li>
                                <li><a href="#org" data-toggle="tab">Cases Initiated by Organization</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active " id="age">
                                    <div class="graph-age">
                                        <div id="chart_age" class="chart_age"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade  " id="gender">
                                    <div class="graph-gender">
                                        <div class="chart_gender" id="chart_gender"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="org">
                                    <div class="country">
                                        <div id="organization" class="organization">
                                            <table id="organization-cases" class="table table-bordeard"
                                                   style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">
                                                        Select Country</br>
                                                        <select name="country" id="country" class="form-control">
                                                            @foreach($totalOrganizationsByCountry as $country)
                                                                <option value="{{$country->country}} ">{{$country->country}}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Organization</th>
                                                    <th>Total Initiated cases</th>
                                                </tr>
                                                </thead>
                                                <tbody>
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
        </div>
        <div class="row">
            <div class="initiation-contribution">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Time taken to close cases</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="tabular-visualization">
                                <table id="with-time-duration" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th colspan="5">Total closed Cases: {{countClosedCases()}}</th>
                                    </tr>
                                    <tr>
                                        <th>Case Id</th>
                                        <th>Victims Name</th>
                                        <th>Nationality</th>
                                        <th>Total Time</th>
                                        <th>Contributors</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($litigationWithTimeDuration   as $case)
                                        <tr>
                                            <td>{{$case->case_id}}</td>
                                            <td><a href="/cases/{{$case->id}}/case-profile">{{$case->victims}}</a></td>
                                            <td>{{$case->nationality}}</td>
                                            <td>
                                                {{(getDateDifference($case->updated_at, $case->created_at))}}
                                            </td>
                                            <td>
                                                <ul class="contributor-list">
                                                    @foreach(getContributorsListByCase($case->id) as $contributor)
                                                        <li>
                                                            <a href="organization/dashboard/{{$contributor->id}}">{{$contributor->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </td>
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
                        <h3>Cases without NGO HIR</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="tabular-visualization">
                                <table id="without-ngohirs" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th colspan="4">Total Cases Without NGO HIRS: {{$totalCasesWithoutNgoHirs}}</th>
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
                        <h3>Cases Done with NGO HIR but opened at Destination Country</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="tabular-visualization">
                                <table id="with-ngohirs" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th colspan="4">Total Cases With NGO HIRS but still open in destination
                                            country: {{$toalCasesWithNgoHirsButOpened}}</th>
                                    </tr>
                                    <tr>
                                        <th>Case Id</th>
                                        <th>Rescues Name</th>
                                        <th>Case Status</th>
                                        <th>Destination Country</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($casesWithNgoHirsButOpened   as $case)
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Organization's Completed NGO HIR</h3></br>
                    <select name="country_id" id="country_id">
                        @foreach(getCountryOfOrigin() as $country)
                            <option value="{{$country->country_id}} ">{{$country->country}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="panel-body">
                    <div id="ngohr-time-duration" class="ngohr-time-duration">
                        <table id="ngohr-time-duration-table" class="table table-bordered table-responsive"
                               style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Organization</th>
                                <th>Total Completed NGO HIR</th>
                                <th>Nationality of the Victims</th>
                                <th>Min time</th>
                                <th>Max time</th>
                                <th>Average time</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Achievable tasks matrix of completed cases with time duration</h3></br>
                </div>
                <div class="panel-body">
                    <div id="achievable-task-matrix" class="achievable-task-matrix">
                        <table id="achievable-task-matrix-table" class="table table-bordered table-responsive"
                               style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Task Title</th>
                                <th>Total Tasks</th>
                                <th>Min Time</th>
                                <th>Max Time</th>
                                <th>Average Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($taskMatrix as $task)
                                <tr>
                                    <td>{{$task['task']}}</td>
                                    <td>{{$task['totalTasks']}}</td>
                                    <td>{{$task['mintime']}}</td>
                                    <td>{{$task['maxtime']}}</td>
                                    <td>{{$task['avgtime']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    {!! Html::script('js/markerclusterer.js') !!}
    {!! Html::script('js/googlemap-initialize.js') !!}
    {!! Html::script('js/google-chart-loader.js') !!}
    {!! Html::script('js/google-graph.js') !!}

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

    </script>
    {!! Html::script('js/country-org-litigation.js') !!}
    {!! Html::script('js/ngohir-completed-organization.js') !!}
@endsection