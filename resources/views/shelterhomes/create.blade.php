@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    Create Shelter Home
                </header>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'shelterhomes.store', 'method' => 'post', 'class' => 'form-horizontal')) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('shelterhome_name', 'Shelter Home Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('shelterhome_name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('parent_organization', 'is creating under ' . \App\Organization::find(auth()->user()->organization_id)->name, ['class' => 'col-sm-12 col-lg-12 control-label']) !!}
                            </div>
                        </div>
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
                                                        {!! Form::label('shelterhome_address', 'Address', ['class' => 'control-label']) !!}
                                                        {!! Form::text('shelterhome_address', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="survivor_native_address" class="row addresser">
                                                    <div class="col-md-4 countries">
                                                        {!! Form::label('shelterhome_country', 'Country', ['class' => 'control-label']) !!}
                                                        {!! Form::select('shelterhome_country', get_countries_list(), \App\Organization::find(auth()->user()->organization_id)->country, ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-4 states">
                                                        {!! Form::label('shelterhome_state', 'State/Division/Zone', ['class' => 'control-label']) !!}
                                                        {!! Form::select('shelterhome_state', ['-- Please select State --'], '$address->state', ['class' => 'form-control m-bot15']) !!}
                                                    </div>

                                                    <div class="col-md-4 districts">
                                                        {!! Form::label('shelterhome_district', 'District', ['class' => 'control-label']) !!}
                                                        {!! Form::select('shelterhome_district', ['-- Please select District --'], '$address->district', ['class' => 'form-control m-bot15']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('contact_number', 'Phone Number', ['class' => 'control-label']) !!}
                                                        {!! Form::text('contact_number', '', ['class' => 'form-control']) !!}
                                                        <p class="help-block"><i>including country code</i></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('email', 'Email Address', ['class' => 'control-label']) !!}
                                                        {!! Form::text('email', '', ['class' => 'form-control']) !!}
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
                                                        {!! Form::text('contact_person', '', ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        {!! Form::label('designation', 'Designation', ['class' => 'control-label']) !!}
                                                        {!! Form::text('designation', '', ['class' => 'form-control']) !!}
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
                                                        <textarea class="form-control ckeditor" name="description" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Html::link(route('shelterhomes.index'), 'Back', array('class' => 'btn btn-default')) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </section>


        </div>
    </div>


@endsection
