@extends('layout')

@section('content')

    {{-- NGO HIR Tab Start --}}

    <div class="row">
        <div class="col-md-12">

            {{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
            {!! Form::open(['route' => ['ngohirs.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
            {{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">

                        <header class="panel-heading">
                            Interview Information
                        </header>

                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name_of_interviewer', 'Name of Interviewer:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('name_of_interviewer', '', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('place_of_interview', 'Place of Interview:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('place_of_interview', '', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('date_of_interview', 'Date of Interview:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-7">
                                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}}" class="input-append date dpYears">
                                                {!! Form::text('date_of_interview', isset($litigation->date_of_birth) ? date('d-m-Y', strtotime($litigation->date_of_birth)) : date('d-m-Y'), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
                                                <span class="input-group-btn add-on">
                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name_of_informer', 'Name of Informer:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('name_of_informer', '', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <header class="panel-heading">
                                Survivor’s Basic Information
                            </header>

                        <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('name_of_the_survivor_at_source', 'Name of the Survivor: (as recorded in India)', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('name_of_the_survivor_at_source', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('name_of_the_survivor_at_destination', 'Name of the Survivor: (as found in Bangladesh During Investigation)', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('name_of_the_survivor_at_destination', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('father_name', 'Father’s Name: (Biological)', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('father_name', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('mother_name', 'Mother’s Name: (Biological)', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('mother_name', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {!! Form::label('marital_status', 'Marital Status:', ['class' => 'control-label']) !!}
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('marital_status', 'S', true, ['id' => 'optionsRadios1']) !!}
                                                    Single
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('marital_status', 'M', '', ['id' => 'optionsRadios2']) !!}
                                                    Married
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('marital_status', 'D', '', ['id' => 'optionsRadios3']) !!}
                                                    Divorced
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('marital_status', 'W', '', ['id' => 'optionsRadios4']) !!}
                                                    Widower
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('spouse_name', 'Spouse Name:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('spouse_name', '', ['class' => 'form-control']) !!}
                                                <p class="help-block"><i>In case of multiple spouses, write spouse name seperated by commaa (,). Latest one come as first.</i></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('nationality', 'Nationality:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('nationality', get_countries_list(), null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('religion', 'Religion:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('religion', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('education', 'Educational Qualification:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('education', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <header class="panel-heading">
                            Address(es) at Bangladesh (Source Country)
                        </header>

                        <div class="panel-body">

                            <div class="well">
                                <legend>Present Address</legend>
                                {{--<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_title[]', '', ['class' => 'form-control', 'placeholder' => 'Present Address']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_care_of[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                                {!! Form::text('relation_with_survivor[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_country[]', ['Option 1', 'Option 2', 'Option 3'], '$address->country', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_state[]', ['Option 1', 'Option 2', 'Option 3'], '$address->state', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_district[]', ['Option 1', 'Option 2', 'Option 3'], '$address->district', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_postal_code[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_line_1[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_line_2[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_contact_number[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="well">
                                <legend>Native Address</legend>
                                {{--<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_title[]', '', ['class' => 'form-control', 'placeholder' => 'Native Address']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_care_of[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                                {!! Form::text('relation_with_survivor[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_country[]', ['Option 1', 'Option 2', 'Option 3'], '$address->country', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_state[]', ['Option 1', 'Option 2', 'Option 3'], '$address->state', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                                {!! Form::select('survivor_address_district[]', ['Option 1', 'Option 2', 'Option 3'], '$address->district', ['class' => 'form-control m-bot15']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_postal_code[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_line_1[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_line_2[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                                {!! Form::text('survivor_address_contact_number[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if(count($litigation->addresses))
                                @foreach($litigation->addresses as $address)
                                    <div class="well">
                                        {!! Form::hidden('address_id[]', $address->id) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_title[]', $address->title, ['class' => 'form-control', 'placeholder' => 'Address 01']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_care_of[]', $address->care_of, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('relation_with_survivor[]', $address->relation_with_survivor, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_country[]', ['Option 1', 'Option 2', 'Option 3'], $address->country, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_state[]', ['Option 1', 'Option 2', 'Option 3'], $address->state, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                                        {!! Form::select('survivor_address_district[]', ['Option 1', 'Option 2', 'Option 3'], $address->district, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_postal_code[]', $address->postal_code, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_line_1[]', $address->address_line_1, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_line_2[]', $address->address_line_2, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                                        {!! Form::text('survivor_address_contact_number[]', $address->contact_number, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label col-sm-12">History of Previous Stay in Shelter Home or Safe Custody:</label>
                                        <div class="col-sm-12">
                                            <br />
                                            <textarea class="form-control ckeditor" name="history_of_previous_stay" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <header class="panel-heading">
                            Survivor’s Physical Description
                        </header>

                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('mother_tongue', 'Age:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            <p class="help-block">14 years</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('other_language', 'Height:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            <div class="input-group m-bot15">
                                                {!! Form::input('number', 'height_ft_part', null, ['class' => 'form-control', 'min' => 1, 'max' => 7, 'step' => 1]) !!}
                                                <span class="input-group-addon">ft.</span>
                                                {!! Form::input('number', 'height_in_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 0.5]) !!}
                                                <span class="input-group-addon">in.</span>
                                            </div>
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
                                                {!! Form::radio('sex', 'M', '', ['id' => 'optionsRadios1']) !!}
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('sex', 'F', true, ['id' => 'optionsRadios2']) !!}
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('sex', 'T', '', ['id' => 'optionsRadios3']) !!}
                                                Trans Gender
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('birth_mark', 'Distinguished Features:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            <div class="well">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! Form::label('birth_mark', 'Birth Mark', ['class' => 'control-label']) !!}
                                                        {!! Form::text('birth_mark', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! Form::label('complexion', 'Complexion', ['class' => 'control-label']) !!}
                                                        {!! Form::text('complexion', '', ['class' => 'form-control']) !!}
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
                                        {!! Form::label('pregnancy', 'Pregnant:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('pregnancy', '1', '', ['id' => 'optionsRadios1']) !!}
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('pregnancy', '0', true, ['id' => 'optionsRadios2']) !!}
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-md-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('accompanying_with_survivor', '1') !!}
                                            Accompanying with <strong>{!! $litigation->full_name or $litigation->name_during_rescue !!}</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('abuse', 'Substance Abuse:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('abuse', '1', '', ['id' => 'optionsRadios1']) !!}
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('abuse', '0', true, ['id' => 'optionsRadios2']) !!}
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('if_yes_type', 'If Yes, Type:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('if_yes_type', '', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>

                </div>
            </div>

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

    {{-- NGO HIR Tab End --}}

    {{-- New Address Create Modal Start --}}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Address(s) at Bangladesh (Source Country)</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => ['personal.information.address.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

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
                                <div class="col-md-6"> {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                    {!! Form::text('survivor_address_contact_number', '', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12 col-md-offset-8 col-lg-offset-8">
                                    {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
                                    {!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- New Address Create Modal End --}}

@endsection
