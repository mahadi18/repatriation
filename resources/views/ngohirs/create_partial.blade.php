<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel" id="accordion" role="tablist" aria-multiselectable="true">

                    <header class="panel-heading" role="tab" id="headingOne">
                        <h1>NGO HIR Form</h1>
                    </header>
                    {!! Form::open(['route' => ['ngohirs.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h3>Interview Information</h3>
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
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
                                    {!! Form::label('place_of_interview', 'Place of Interview:', ['class' => 'col-sm-4 col-lg-4 control-label', 'required']) !!}
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
                                    <span id="required-star">*</span><br>
                                    <div class="col-sm-7">
                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}}" class="input-append date dpYears" style="width: 235px">
                                            {!! Form::text('date_of_interview','', ['size' => '16', 'class' => 'form-control', 'style' => 'width: 235px']) !!}
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('survivor_informer_relation', 'Informer - Survivor Relation:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('survivor_informer_relation','', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('done_over_phone', 'HIR Done over Phone:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::checkbox('done_over_phone') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                <div class="form-group">
                                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                    {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                                </div>
                            </div>
                            <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                            <input type="hidden" name="interview_info" value="1">
                        </div>
                    </div>
                    </div>
                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['ngohirs.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <h3>
                        Survivor’s Basic Information
                    </h3>
                    </a>

                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('name_of_the_survivor_at_source', 'Name of the Survivor:', ['class' => 'col-md-3 col-lg-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('name_of_the_survivor_at_source', strlen($litigation->full_name) > 0 ? $litigation->full_name : $litigation->name_during_rescue, ['class' => 'form-control', 'disabled' => '']) !!}
                                        <p class="help-block"><i>(as recorded in {{ $litigation->country($litigation->rescued_from_country) }})</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('name_of_the_survivor_at_destination', 'Name of the Survivor:', ['class' => 'col-md-3 col-lg-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('name_of_the_survivor_at_destination', '', ['class' => 'form-control']) !!}
                                        <p class="help-block"><i>(as found in {{ $litigation->country($litigation->country_of_origin) }} During Investigation)</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row case_filed_by_parents">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            {!! Form::label('case_filed_by_parents', 'Case Filed By Parents:', ['class' => 'col-sm-3 col-lg-6 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::checkbox('case_filed_by_parents', 1, null, ['class' => 'case_filed']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="case_doc_number">
                                                {!! Form::label('case_file_number', 'Document Number', ['class' => 'col-sm-3 col-lg-5 control-label']) !!}
                                                <div class="col-sm-7 ">
                                                    {!! Form::text('case_file_number', '', ['class' => ' form-control']) !!}
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
                                                                    {!! Form::radio('age_select', 1, '', ['id' => 'optionsRadios1']) !!}
                                                                    {{--Male--}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 radio-dob">
                                                        {!! Form::label('dob', 'Date of Birth') !!}
                                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                            {!! Form::text('dob', '', ['size' => '16', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
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
                                                                        {!! Form::radio('age_select', 2, '', ['id' => 'optionsRadios2']) !!}
                                                                        {{--Male--}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 radio-age">
                                                            {!! Form::label('age_year_part', 'Age') !!}
                                                            <div class="input-group m-bot15">
                                                                {!! Form::input('number', 'age_year_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => 1, 'disabled' => '']) !!}
                                                                <span class="input-group-addon">Years</span>
                                                                {!! Form::input('number', 'age_month_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 1, 'disabled' => '']) !!}
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
                                    {!! Form::label('father_name', 'Father’s Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('father_name', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mother_name', 'Mother’s Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('mother_name', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row guardian">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('guardian_occupation', 'Guardian’s Occupation:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('guardian_occupation', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('guardian_monthly_income', 'Guardian’s Monthly Income:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('guardian_monthly_income', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('marital_status', 'Marital Status:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                    <div class="col-sm-10">
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
                                                        Widow / Widower
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('spouse_name', 'Spouse Name:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('spouse_name', '', ['class' => 'form-control']) !!}
                                        <p class="help-block"><i>In case of multiple spouses, write spouse name separated by comma (,). Latest one come as first.</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('sex', 'Gender:', ['class' => 'col-md-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('sex', 'M', '', ['id' => 'optionsRadios1','class' => 'male']) !!}
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('sex', 'F', true, ['id' => 'optionsRadios2','class' => 'female']) !!}
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('sex', 'O', '', ['id' => 'optionsRadios3','class' => 'third-gender']) !!}
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('nationality', 'Nationality:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('nationality', get_countries_list_except_india(), null, ['class' => 'form-control']) !!}
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

                        <div class="row">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                <div class="form-group">
                                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                    {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                                </div>
                            </div>
                            <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                            <input type="hidden" name="basic_info" value="1">
                        </div>
                    </div>
                    </div>

                    {!! Form::close() !!}



                    {!! Form::open(['route' => ['ngohirs.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <h3>Address(s) at {{ $litigation->country($litigation->country_of_origin) }} (Source Country)</h3>
                    </a>

                    <div id="collapseThree" class="panel-collapse collapse addresse" role="tabpanel" aria-labelledby="headingThree">


                    <div class="panel-body">
                        <div class="well present">
                            <legend>Present Address</legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_care_of[]', '', ['class' => 'form-control field1']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                            {!! Form::text('relation_with_survivor[]', '', ['class' => 'form-control field2']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="survivor_present_address" class="row addresser">
                                        <div class="col-md-3 countries">
                                            {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), '$address->country', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 states">
                                            {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_state[]', ['-- Please select State --'], '$address->state', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 districts">
                                            {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_district[]', ['-- Please select District --'], '$address->district', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                            {!! Form::input('number', 'survivor_address_postal_code[]', '', ['class' => 'form-control field6']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_1[]', '', ['class' => 'form-control field3']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_2[]', '', ['class' => 'form-control field4']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_contact_number[]', '', ['class' => 'form-control field5']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="well native">
                            <legend>Native Address</legend>
                            <input type="checkbox" name="same_address" class="copier"> <label>Same as Present Address</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_care_of[]', '', ['class' => 'form-control field1']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                            {!! Form::text('relation_with_survivor[]', '', ['class' => 'form-control field2']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="survivor_native_address" class="row addresser">
                                        <div class="col-md-3 countries">
                                            {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), '$address->country', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 states">
                                            {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_state[]', ['-- Please select State --'], '$address->state', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 districts">
                                            {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_district[]', ['-- Please select District --'], '$address->district', ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                            {!! Form::input('number', 'survivor_address_postal_code[]', '', ['class' => 'form-control field6']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_1[]', '', ['class' => 'form-control field3']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_2[]', '', ['class' => 'form-control field4']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_contact_number[]', '', ['class' => 'form-control field5']) !!}
                                        </div>
                                    </div>
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

                        <div class="row">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                <div class="form-group">
                                    <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                    <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                    <input type="hidden" name="address_at_source" value="1">
                                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                    {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                                </div>
                            </div>


                        </div>
                    </div>
                    </div>

                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['ngohirs.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}



                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <h3>Survivor’s Physical Description</h3>
                    </a>

                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('other_language', 'Height:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="input-group m-bot15">
                                            {!! Form::input('number', 'height_ft_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 7, 'step' => 1]) !!}
                                            <span class="input-group-addon">ft.</span>
                                            {!! Form::input('number', 'height_in_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 0.5]) !!}
                                            <span class="input-group-addon">in.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('birth_mark', 'Distinguished Features:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        <div class="well">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('birth_mark', 'Birth Mark', ['class' => 'control-label']) !!}
                                                    {!! Form::text('birth_mark', '', ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('complexion', 'Complexion', ['class' => 'control-label']) !!}
                                                    {!! Form::text('complexion', '', ['class' => 'form-control','placeholder'=>'Fair/Dark']) !!}
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('eye_color', 'Eye Color', ['class' => 'control-label']) !!}
                                                    {!! Form::text('eye_color', '', ['class' => 'form-control','placeholder'=>'Brown/Black/Blue']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('hair_color', 'Hair Color', ['class' => 'control-label']) !!}
                                                    {!! Form::text('hair_color', '', ['class' => 'form-control','placeholder'=>'Black/Brown']) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('identification_mark', 'Identification Mark', ['class' => 'control-label']) !!}
                                                    {!! Form::text('identification_mark', '', ['class' => 'form-control','placeholder'=>'Mole on Cheek/Forehead etc']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('deformities', 'Deformities', ['class' => 'control-label']) !!}
                                                    {!! Form::text('deformities', '', ['class' => 'form-control','placeholder'=>'Blind/Deaf/Handicap']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row for-female-only">
                            <div class="col-md-6">
                                @if( $litigation->sex == 'F')
                                <div class="form-group gender-{{$litigation->sex}}">
                                    {!! Form::label('pregnancy', 'Pregnant:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {{--$litigation->sex--}}
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
                                @endif
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

                        <div class="row">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                <div class="form-group">
                                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                    {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                                </div>
                            </div>
                            <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                            <input type="hidden" name="physical_desc" value="1">
                        </div>
                    </div>
</div>
                    {!! Form::close() !!}

                </section>

            </div>
        </div>



    </div>
</div>

{{-- NGO HIR Tab End --}}

{{-- New Address Create Modal Start --}}

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Address(s) at {{ $litigation->country($litigation->country_of_origin) }} (Source Country)</h4>
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
                        <div id="survivor_new_address" class="row addresser">
                            <div class="col-md-3 countries">
                                {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                {!! Form::select('survivor_address_country', get_countries_list_except_india(), null, ['class' => 'form-control m-bot15']) !!}
                            </div>

                            <div class="col-md-3 states">
                                {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                {!! Form::select('survivor_address_state', ['-- Please select State --'], null, ['class' => 'form-control m-bot15']) !!}
                            </div>

                            <div class="col-md-3 districts">
                                {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                {!! Form::select('survivor_address_district', ['-- Please select District --'], null, ['class' => 'form-control m-bot15']) !!}
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                {!! Form::input('number', 'survivor_address_postal_code', '', ['class' => 'form-control']) !!}
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
