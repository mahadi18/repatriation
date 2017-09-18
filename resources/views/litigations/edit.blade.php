@extends('layout')

@section('content')

    {{-- Intake Tab Start --}}

<div class="row">
    <div class="col-md-12">

        {!! Form::open(['route' => ['cases.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

        <section class="panel">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name_during_rescue', 'Name During Rescue:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('name_during_rescue', $litigation->name_during_rescue, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                            {!! Form::label('rescue_date', 'Rescue Date:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-lg-3">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                    {!! Form::text('rescue_date', isset($litigation->rescued_at) ? date('d-m-Y', strtotime(explode(" ",$litigation->rescued_at)[0])) : date('d-m-Y'), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
                                    <span class="input-group-btn add-on">
                                        {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                    </span>
                                </div>
                            </div>

                            {!! Form::label('rescue_time', 'Rescue Time:', ['class' => 'col-sm-2 col-lg-2 col-md-offset-2 col-lg-offset-2 control-label']) !!}
                            <div class="col-md-3">
                                <div class="input-group bootstrap-timepicker">
                                    {!! Form::text('rescue_time', isset($litigation->rescued_at) ? date('h:i A', strtotime(explode(" ",$litigation->rescued_at)[1])) : date('h:i A'), ['class' => 'form-control timepicker-default']) !!}
                                    <span class="input-group-btn">
                                        {!! Form::button('<i class="fa fa-clock-o"></i>', ['class' => 'btn btn-default']) !!}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('rescued_from_address', 'Rescued from:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('rescued_from_address', 'Address Line') !!}
                                            {!! Form::text('rescued_from_address', $litigation->rescued_from_address, ['class' => 'form-control']) !!}
                                            <p class="help-block"><i>Address of Place of Exploitation</i></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="rescue_address" class="form-group addresser">
                                                <div class="col-md-4 countries">
                                                    {!! Form::label('rescued_from_country', 'Country') !!}
                                                    {!! Form::select('rescued_from_country', get_countries_list(), 2, ['class' => 'form-control', 'disabled' => true]) !!}
                                                </div>

                                                <div class="col-md-4 states">
                                                    {!! Form::label('rescued_from_state', 'State/ Division') !!}
                                                    {!! Form::select('rescued_from_state', ['-- Please select Country --'], $litigation->rescued_from_state, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-4 districts">
                                                    {!! Form::label('rescued_from_district', 'District') !!}
                                                    {!! Form::select('rescued_from_district', ['-- Please select State --'], $litigation->rescued_from_district, ['class' => 'form-control']) !!}
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
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('rescued_by', 'Rescued by:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('rescued_by', $litigation->rescued_by, ['class' => 'form-control']) !!}
                                <p class="help-block"><i>Actors involved in rescue operation. i.e. LEAs, NGOs, Civil Society etc.</i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('concerned_organization', 'Concerned NGO:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('concerned_organization', get_organizations_list(), $litigation->concerned_organization, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-lg-2">
                                {!! Form::button('<i class="fa fa-plus-circle"></i>', ['data-toggle' => 'button', 'class' => 'btn btn-danger add_doc_type']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nature_of_complaint', 'Nature of Complaint:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('nature_of_complaint', $litigation->nature_of_complaint, ['class' => 'form-control']) !!}
                                <p class="help-block"><i>Complain- based on which FIR has been created (Missing Child, Case of trafficking etc)</i></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                General Diary (GD) / Daily Diary (DD) / First Information Report (FIR)
            </header>

            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('gd_number', 'GD/DD ID Number:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('gd_number', $litigation->gd_number, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::label('gd_date', 'GD/DD Date:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-lg-3">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                    {!! Form::text('gd_date', date('d-m-Y', strtotime($litigation->gd_date)), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
                                    <span class="input-group-btn add-on">
                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('concerned_police_station_of_gd', 'Concerned Police Station of GD/DD:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('concerned_police_station_of_gd', $litigation->concerned_police_station_of_gd, ['class' => 'form-control']) !!}
                                <p class="help-block"><i>Name of the Police Station where GD/DD has been filed</i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('fir_number', 'FIR ID Number:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('fir_number', $litigation->fir_number, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::label('fir_date', 'FIR Date:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-lg-3">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                    {!! Form::text('fir_date', date('d-m-Y', strtotime($litigation->fir_date)), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
                                    <span class="input-group-btn add-on">
                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('concerned_police_station_of_fir', 'Concerned Police Station of FIR:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('concerned_police_station_of_fir', $litigation->concerned_police_station_of_fir, ['class' => 'form-control']) !!}
                                <p class="help-block"><i>Name of the Police Station where FIR has been filed</i></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                Nationality Identification
            </header>

            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nationality', 'Nationality:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('nationality', get_countries_list(), $litigation->nationality, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="form-group">
            <div class="col-sm-10 col-md-offset-2 col-lg-offset-2">
                {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                {!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

    {{-- Intake Tab End --}}

@endsection
