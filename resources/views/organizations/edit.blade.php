@extends('layout')

@section('content')

    <div class="row organization">

        <div class="col-md-12">
            <div class="page-header">
                <h1>{{$organization->name}}'s Profile</h1>
            </div>
        </div>
        <div class="title edit profile">
            Edit Information
        </div>

        <div class="col-md-12">

            <section class="panel">
                {{--<header class="panel-heading">
                    Edit Shelter Home
                </header>--}}
                <div class="panel-body">
                    {!! Form::open(['route' => ['organizations.update', $organization->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Organization Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', $organization->name, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('organization_type', 'Organization Type:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('organization_type', $org_types, $organization->org_type, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                        </div>

                        {{--<div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('parent_organization', 'is created under ' . \App\Organization::find(auth()->user()->organization_id)->name, ['class' => 'col-sm-12 col-lg-12 control-label']) !!}
                            </div>
                        </div>--}}
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('address', 'Address:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                <div class="col-sm-10">
                                    <div class="well">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                                        {!! Form::text('address', $organization->address, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="survivor_native_address" class="row addresser-edit">
                                                    <div class="col-md-4 countries">
                                                        {!! Form::label('organization_country', 'Country', ['class' => 'control-label']) !!}
                                                        {!! Form::select('organization_country', get_countries_list(), $organization->country, ['class' => 'form-control m-bot15']) !!}
                                                    </div>
                                                    <div class="col-md-4 states">
                                                        {!! Form::label('organization_state', 'State/Division/Zone', ['class' => 'control-label']) !!}
                                                        {!! Form::select('organization_state', states_of_country($organization->country), get_organization_state_from_district($organization->district_id), ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-4 districts">
                                                        {!! Form::label('organization_district', 'District', ['class' => 'control-label']) !!}
                                                        {!! Form::select('organization_district', district_of_state(get_organization_state_from_district($organization->district_id)), $organization->district_id, ['class' => 'form-control m-bot15']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('phone', 'Phone Number', ['class' => 'control-label']) !!}
                                                        {!! Form::text('phone', $organization->phone, ['class' => 'form-control']) !!}
                                                        <p class="help-block"><i>including country code</i></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('email', 'Email Address', ['class' => 'control-label']) !!}
                                                        {!! Form::text('email', $organization->email, ['class' => 'form-control']) !!}
                                                        <p class="help-block"><i>organization email address</i></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('contact_person', 'Point of Contact', ['class' => 'control-label']) !!}
                                                        {!! Form::text('contact_person', $organization->contact_person, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('contact_designation', 'Designation', ['class' => 'control-label']) !!}
                                                        {!! Form::text('contact_designation', $organization->contact_designation, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label col-sm-12">Organization Background <i>(Years of Formation, Registration No, No. of Employees, Specific Area fo Work etc.)</i></label>
                                                    <div class="col-sm-12">
                                                        <br />
                                                        <textarea class="form-control ckeditor" name="description" rows="6">{!! $organization->description !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Html::link(route('organizations.show', $organization->id ), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>

        </div>
    </div>

@endsection
