{{-- Intake Tab Start --}}

<div class="row">
    <div class="col-md-12 add-form">

        {!! Form::open(['route' => ['cases.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

        {!! Form::hidden('task_id', $parent_task_id) !!}
        {!! Form::hidden('sub_task', $current_task) !!}

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
                            {!! Form::label('date_of_birth', 'Age Information:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-1">
                                                <label for="">&nbsp;</label>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('age_select', 1, strlen($litigation->date_of_birth) > 0, ['id' => 'optionsRadios1']) !!}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 radio-dob">
                                                {!! Form::label('dob', 'Date of Birth') !!}
                                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                    {!! Form::text('dob', isset($litigation->date_of_birth) && strlen($litigation->date_of_birth) > 0 ? date('d-m-Y', strtotime($litigation->date_of_birth)) : '', ['size' => '16', 'class' => 'form-control', 'disabled' => '']) !!}
                                                    <span class="input-group-btn add-on">
                                                        {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success', 'disabled' => '']) !!}
                                                    </span>
                                                </div>
                                                <p class="help-block"><i>dd-mm-yyyy (example: 07-02-1999)</i></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label for="">&nbsp;</label>
                                                    <div class="form-group">
                                                        <div class="radio">
                                                            <label>
                                                                {!! Form::radio('age_select', 2, !(strlen($litigation->date_of_birth) > 0) && (strlen($litigation->age_year_part) > 0 || strlen($litigation->age_month_part) > 0), ['id' => 'optionsRadios2']) !!}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-11 radio-age">
                                                    {!! Form::label('age_year_part', 'Age') !!}
                                                    <div class="input-group m-bot15">
                                                        {!! Form::input('number', 'age_year_part', $litigation->age_year_part, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => 1, 'disabled' => '']) !!}
                                                        <span class="input-group-addon">Years</span>
                                                        {!! Form::input('number', 'age_month_part', $litigation->age_month_part, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 1, 'disabled' => '']) !!}
                                                        <span class="input-group-addon">Months</span>
                                                    </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sex', 'Gender:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-sm-8">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('sex', 'M', $litigation->sex == 'M', ['id' => 'optionsRadios1']) !!}
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('sex', 'F', isset($litigation->sex) ? $litigation->sex == 'F' : true, ['id' => 'optionsRadios2']) !!}
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('sex', 'O', $litigation->sex == 'O', ['id' => 'optionsRadios3']) !!}
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            {!! Form::label('nationality', 'Nationality:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::select('nationality', get_countries_list_except_india(), $litigation->country_of_origin, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            {!! Form::label('rescue_date', 'Rescue Date:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-lg-7">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                    {!! Form::text('rescue_date', strlen($litigation->rescue_date) > 0 ? $litigation->rescue_date->setTimezone(session('user_current_timezone'))->format('d-m-Y') : null, ['size' => '16', 'class' => 'form-control']) !!}
                                    <span class="input-group-btn add-on">
                                        {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">

                            {!! Form::label('rescue_time', 'Rescue Time:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-md-8">
                                <div class="input-group bootstrap-timepicker">
                                    {!! Form::text('rescue_time', strlen($litigation->rescue_time) > 0 ? Carbon\Carbon::createFromFormat('H:i:s', $litigation->rescue_time)->setTimezone(session('user_current_timezone'))->format('h:i A') : null, ['class' => 'form-control timepicker-default']) !!}
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
                                            <div id="rescue_address" class="form-group row">
                                                <div class="col-md-4">
                                                    {!! Form::label('rescued_from_country', 'Country') !!}
                                                    {!! Form::select('rescued_from_country', get_countries_list(), 2, ['class' => 'form-control', 'disabled' => true]) !!}
                                                </div>
<?php //dd($litigation->rescued_from_district);?>
                                                <div class="col-md-4 division">
                                                    {!! Form::label('rescued_from_state', 'State/ Division') !!}
                                                    {!! Form::select('rescued_from_state', states_of_country(2), $litigation->rescued_from_state, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-4 districts">
                                                    {!! Form::label('rescued_from_district', 'District') !!}
                                                    {!! Form::select('rescued_from_district', district_of_state($litigation->rescued_from_state), $litigation->rescued_from_district, ['class' => 'form-control']) !!}
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
                            {{--<div class="col-lg-2">
                                {!! Form::button('<i class="fa fa-plus-circle"></i>', ['data-toggle' => 'button', 'class' => 'btn btn-danger add_doc_type']) !!}
                            </div>--}}
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
                            {!! Form::label('concerned_police_station_of_gd', 'General Diary (GD) / Daily Diary (DD):', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('concerned_police_station_of_gd', 'Concerned Police Station of GD/DD') !!}
                                            {!! Form::text('concerned_police_station_of_gd', $litigation->concerned_police_station_of_gd, ['class' => 'form-control']) !!}
                                            <p class="help-block"><i>Name of the Police Station where GD/DD has been filed</i></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="rescue_address" class="form-group addresser">
                                                <div class="col-md-5">
                                                    {!! Form::label('gd_date', 'GD/DD Date') !!}
                                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                        {!! Form::text('gd_date', strlen($litigation->gd_date) > 0 ? $litigation->gd_date->setTimezone(session('user_current_timezone'))->format('d-m-Y') : null, ['size' => '16', 'class' => 'form-control']) !!}
                                                        <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-md-offset-1">
                                                    {!! Form::label('gd_number', 'GD/DD ID Number') !!}
                                                    {!! Form::text('gd_number', $litigation->gd_number, ['class' => 'form-control']) !!}
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
                            {!! Form::label('concerned_police_station_of_fir', 'First Information Report (FIR):', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                            <div class="col-sm-10">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('concerned_police_station_of_fir', 'Concerned Police Station of FIR') !!}
                                            {!! Form::text('concerned_police_station_of_fir', $litigation->concerned_police_station_of_fir, ['class' => 'form-control']) !!}
                                            <p class="help-block"><i>Name of the Police Station where FIR has been filed</i></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="rescue_address" class="form-group addresser">
                                                <div class="col-md-5">
                                                    {!! Form::label('fir_date', 'FIR Date') !!}
                                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                        {!! Form::text('fir_date', strlen($litigation->fir_date) > 0 ? $litigation->fir_date->setTimezone(session('user_current_timezone'))->format('d-m-Y') : null, ['size' => '16', 'class' => 'form-control']) !!}
                                                        <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-md-offset-1">
                                                    {!! Form::label('fir_number', 'FIR ID Number') !!}
                                                    {!! Form::text('fir_number', $litigation->fir_number, ['class' => 'form-control']) !!}
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
                            <div class="col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-success']) !!}--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        {!! Form::close() !!}
    </div>
</div>

{{-- Intake Tab End --}}