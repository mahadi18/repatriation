@extends('layout')

@section('content')

    {{-- Intake Tab Start --}}

    <div class="row">
        <div class="col-md-12">

            {!! Form::open(['route' => ['cases.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
            {{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
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
                                                        {!! Form::select('rescued_from_country', get_countries_list(), $litigation->rescued_from_country, ['class' => 'form-control']) !!}
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
                                    <p class="help-block"><i>LEA Name: Police Station, DIB, BSF, Railpolice, CID etc</i></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('concerned_police_station', 'Concerned Police Station:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('concerned_police_station', $litigation->concerned_police_station, ['class' => 'form-control']) !!}
                                    <p class="help-block"><i>Name of the Police Station who participated in the Rescue Operation or Where Victim has be submitted</i></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('concerned_organization', 'Concerned NGO:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::select('concerned_organization', get_organizations_list(), $litigation->concerned_organization, ['class' => 'form-control m-bot15']) !!}
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
                                {!! Form::label('nature_of_complaint', 'Nature of Complaiant:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
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
                    General Diary (GD)/ Daily Diary (DD)
                <span class="tools pull-right">
                    <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
                </span>
                </header>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('gd_number', 'GD/ DD ID Number:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('gd_number', $litigation->gd_number, ['class' => 'form-control']) !!}
                                </div>

                                {!! Form::label('gd_date', 'GD/ DD Date:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
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

                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    First Infromation Report (FIR)
                <span class="tools pull-right">
                    <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
                </span>
                </header>

                <div class="panel-body">

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
                                {!! Form::label('nationality', 'Nationality:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('nationality', get_countries_list(), $litigation->nationality, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <div class="form-group">
                <div class="col-sm-10 col-md-offset-2 col-lg-offset-2">
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                    {!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}
                    {!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    {{-- Intake Tab End --}}

    {{-- Personal Information Tab Start --}}

    <div class="row">
        <div class="col-md-12">

            {{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
            {!! Form::open(['route' => ['personal.information.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
            {{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
            <section class="panel">
                <div class="panel-body">

                    {!! Form::hidden('created_by', Auth::user()->id) !!}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('case_id', 'Case ID:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    <p class="help-block"><strong>IN201505-####.BD201507-####</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('full_name', 'Full Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('full_name', $litigation->full_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('nick_name', 'Nick Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('nick_name', $litigation->nick_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('father_name', 'Father\'s Name (Biological):', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('father_name', $litigation->father_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('mother_name', 'Mother\'s Name (Biological):', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('mother_name', $litigation->mother_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('date_of_birth', 'Date of Birth:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-7">
                                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}}" class="input-append date dpYears">
                                                {!! Form::text('date_of_birth', isset($litigation->date_of_birth) ? date('d-m-Y', strtotime($litigation->date_of_birth)) : date('d-m-Y'), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
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
                                        {!! Form::label('victim_age', 'Name During Rescue:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            <p class="help-block">14 Years</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-md-offset-2 col-lg-offset-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">&nbsp;</label>
                                        <div class="col-md-12">
                                            <div>Attachment: Picture</div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Upload</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        {!! Form::file('victim_image_attachment', null, ['class' => 'form-control default']) !!}
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
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
                                {!! Form::label('mother_tongue', 'Mother Tongue:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('mother_tongue', $litigation->mother_tongue, ['class' => 'form-control']) !!}
                                    <p class="help-block"><i>e.g. Bangla, Hindi, Marathi, Nepalees, Telegu etc.</i></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('other_language', 'Other Language:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('other_language', $litigation->other_language, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('education', 'Education:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('education', $litigation->education, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Address(s) at Bangladehs (Source Country)
                <span class="tools pull-right">
                    <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
                </span>
                </header>

                <div class="panel-body">
                    <div class="well">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_title', '', ['class' => 'form-control', 'placeholder' => 'Address 01']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_care_of', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                        {!! Form::text('relation_with_survivor', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                        {!! Form::select('survivor_address_country', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                        {!! Form::select('survivor_address_state', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                        {!! Form::select('survivor_address_district', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_postal_code', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_line_1', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_line_2', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                        {!! Form::text('survivor_address_contact_number', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 col-lg-offset-1">
                            <div class="form-group">
                                {{--{!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}--}}
                                <a href="#myModal" data-toggle="modal" class="btn btn-info">
                                    <i class="fa fa-list-ul"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Address(s) at Bangladehs (Source Country)</h4>
                                </div>
                                <div class="modal-body">

                                    {!! Form::open(['route' => ['cases.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_title', '', ['class' => 'form-control', 'placeholder' => 'Address 01']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_care_of', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('relation_with_survivor', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_country', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_state', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_district', ['Option 1', 'Option 2', 'Option 3'], null, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_postal_code', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_line_1', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_line_2', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_contact_number', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('sex', 'Gender:', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('sex', 'M', $litigation->sex == 'M', ['id' => 'optionsRadios1']) !!}
                                        Male
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('sex', 'F', isset($litigation->sex) ? $litigation->sex == 'F' : true, ['id' => 'optionsRadios2']) !!}
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('sex', 'T', $litigation->sex == 'T', ['id' => 'optionsRadios3']) !!}
                                        Trans Gender
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('marital_status', 'Marital Status:', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('marital_status', 'S', isset($litigation->marital_status) ? $litigation->marital_status == 'S' : true, ['id' => 'optionsRadios1']) !!}
                                        Single
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('marital_status', 'M', $litigation->marital_status == 'M', ['id' => 'optionsRadios2']) !!}
                                        Married
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('marital_status', 'D', $litigation->marital_status == 'D', ['id' => 'optionsRadios3']) !!}
                                        Divorced
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('spouse_name', 'Spouse Name:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('spouse_name', $litigation->spouse_name, ['class' => 'form-control']) !!}
                                    <p class="help-block"><i>In case of multiple spouses, write spouse name seperated by commaa (,). Latest one come as first.</i></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('pregnancy', 'Pregnant:', ['class' => 'control-label']) !!}
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('pregnancy', '1', $litigation->pregnancy == '1', ['id' => 'optionsRadios1']) !!}
                                        Yes
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('pregnancy', '0', isset($litigation->pregnancy) ? $litigation->pregnancy == '0' : true, ['id' => 'optionsRadios2']) !!}
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('victim_child_name', 'Child:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::label('victim_child_name', 'Name', ['class' => 'control-label']) !!}
                                                {!! Form::text('victim_child_name', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {!! Form::label('victim_child_sex', 'Gender:', ['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="radio">
                                                                <label>
                                                                    {!! Form::radio('victim_child_sex', 'male', '', ['id' => 'optionsRadios1']) !!}
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="radio">
                                                                <label>
                                                                    {!! Form::radio('victim_child_sex', 'female', true, ['id' => 'optionsRadios2']) !!}
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="radio">
                                                                <label>
                                                                    {!! Form::radio('victim_child_sex', 'trans_gender', '', ['id' => 'optionsRadios3']) !!}
                                                                    Trans Gender
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        {!! Form::label('name_during_rescue', 'Date of Birth', ['class' => 'control-label']) !!}
                                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}}"
                                                             class="input-append date dpYears">
                                                            {!! Form::text('victim_child_date_of_birth', date('d-m-Y'), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
                                                            <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {!! Form::label('victim_child_age', 'Age:', ['class' => 'col-sm-3 col-lg-3 control-label']) !!}
                                                    <div class="col-sm-9">
                                                        <p class="help-block">05 Years</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                            <label>
                                                                {!! Form::checkbox('name', 'value') !!}
                                                                Accompanying with <strong>Bilkis Devi Mahajai</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        {!! Form::label('victim_child_case_id', 'Child\'s Case ID', ['class' => 'control-label']) !!}
                                                        {!! Form::text('victim_child_case_id', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">&nbsp;</label>
                                                            <div class="col-md-12">
                                                                <div>Attachment: Picture</div>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                    <div>
                                                                        <span class="btn btn-info btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Upload</span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                            {!! Form::file('victim_child_image_attachment', null, ['class' => 'form-control default']) !!}
                                                                        </span>
                                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-10 col-lg-offset-10">
                            <div class="form-group">
                                {!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Family Info
                <span class="tools pull-right">
                    <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
                </span>
                </header>

                <div class="panel-body">

                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="btn-group">
                                <button id="editable-sample_new" class="btn green">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Relationship</th>
                                <th>Age</th>
                                <th>Occupation</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="">
                                <td>02.</td>
                                <td>Maksud Alam</td>
                                <td>Father</td>
                                <td class="center">45 yr</td>
                                <td>Bananna Seller</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>01.</td>
                                <td>Sahana Sukltana</td>
                                <td>Sister</td>
                                <td class="center">23 yr</td>
                                <td>Student</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Sumon</td>
                                <td> Sumon Ahmed</td>
                                <td> Sumon Ahmed</td>
                                <td>232</td>
                                <td class="center">super user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>vectorlab</td>
                                <td>dk mosa</td>
                                <td>dk mosa</td>
                                <td>132</td>
                                <td class="center">elite user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Admin</td>
                                <td> Flat Lab</td>
                                <td> Flat Lab</td>
                                <td>462</td>
                                <td class="center">new user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Rafiqul</td>
                                <td>Rafiqul dulal</td>
                                <td>Rafiqul dulal</td>
                                <td>62</td>
                                <td class="center">new user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Jhon Doe</td>
                                <td>Jhon Doe </td>
                                <td>Jhon Doe </td>
                                <td>1234</td>
                                <td class="center">super user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Dulal</td>
                                <td>Jonathan Smith</td>
                                <td>Jonathan Smith</td>
                                <td>434</td>
                                <td class="center">new user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Sumon</td>
                                <td> Sumon Ahmed</td>
                                <td> Sumon Ahmed</td>
                                <td>232</td>
                                <td class="center">super user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>vectorlab</td>
                                <td>vectorlab</td>
                                <td>dk mosa</td>
                                <td>132</td>
                                <td class="center">elite user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Admin</td>
                                <td> Flat Lab</td>
                                <td> Flat Lab</td>
                                <td>462</td>
                                <td class="center">new user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            <tr class="">
                                <td>Rafiqul</td>
                                <td>Rafiqul dulal</td>
                                <td>Rafiqul dulal</td>
                                <td>62</td>
                                <td class="center">new user</td>
                                <td><a class="edit" href="javascript:;">Edit</a></td>
                                <td><a class="delete" href="javascript:;">Delete</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

            <div class="form-group">
                <div class="col-sm-10 col-md-offset-2 col-lg-offset-2">
                    {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                    {!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    {{-- Personal Information Tab End --}}

@endsection
