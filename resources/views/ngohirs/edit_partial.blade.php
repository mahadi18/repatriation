<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h1>NGO HIR Form</h1>
                    </header>

                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseInterview" aria-expanded="true" aria-controls="collapseInterview">
                        <h3><?php if (($information['ngohir']->interview_info) > 0 ) {echo '<i class="fa fa-circle" aria-hidden="true"></i>'; }?>Interview Information</h3>
                    </a>

                    <div id="collapseInterview" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingInterview">
                    {!! Form::open(['route' => ['ngohirs.update', $information['ngohir']->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <div class="panel-body">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name_of_interviewer', 'Name of Interviewer:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('name_of_interviewer', $information['ngohir']->name_of_interviewer, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('place_of_interview', 'Place of Interview:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('place_of_interview', $information['ngohir']->place_of_interview, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('date_of_interview', 'Date of Interview:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}}" class="input-append date dpYears" style="width: 235px">
                                            {!! Form::text('date_of_interview', strlen($information['ngohir']->date_of_interview) ? date('d-m-Y', strtotime($information['ngohir']->date_of_interview)) : '', ['size' => '16', 'class' => 'form-control', 'style' => 'width: 235px']) !!}
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
                                        {!! Form::text('name_of_informer', $information['ngohir']->name_of_informer, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('survivor_informer_relation', 'Informer - Survivor Relation:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('survivor_informer_relation', $information['ngohir']->survivor_informer_relation, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('done_over_phone', 'HIR Done over Phone:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::checkbox('done_over_phone', '1', isset($information['ngohir']->done_over_phone) && $information['ngohir']->done_over_phone == '1' ? 1 : 0) !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                            </div>
                        </div>
                        <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                        <input type="hidden" name="interview_info" value="1">
                    </div>
                        {!! Form::close() !!}
                    </div>


                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseBasicInfo" aria-expanded="true" aria-controls="collapseBasicInfo">
                        <h3><?php if (($information['ngohir']->basic_info) > 0 ) {echo '<i class="fa fa-circle" aria-hidden="true"></i>'; }?>Survivor’s Basic Information</h3>
                    </a>

                    <div id="collapseBasicInfo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingBasicInfo">
                    {!! Form::open(['route' => ['ngohirs.update', $information['ngohir']->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

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
                                        {!! Form::text('name_of_the_survivor_at_destination', $information['ngohir']->name_of_the_survivor_at_destination, ['class' => 'form-control']) !!}
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
                                            {!! Form::label('case_filed_by_parents', 'Case Filed by Parents:', ['class' => 'col-sm-3 col-lg-6 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::checkbox('case_filed_by_parents', '1', isset($information['ngohir']->case_filed_by_parents) && $information['ngohir']->case_filed_by_parents == '1' ? 1 : 0, ['class' => 'case_filed']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="case_doc_number" <?php if(isset($information['ngohir']->case_filed_by_parents) && $information['ngohir']->case_filed_by_parents == '1') {echo "style='display:block'"; }?>>
                                                {!! Form::label('case_file_number', 'Document Number', ['class' => 'col-sm-3 col-lg-5 control-label']) !!}
                                                <div class="col-sm-7 ">
                                                    {!! Form::text('case_file_number', $information['ngohir']->case_filed_no, ['class' => 'form-control']) !!}
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
                                                                    {!! Form::radio('age_select', 1, strlen($information['ngohir']->date_of_birth) > 0, ['id' => 'optionsRadios1']) !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 radio-dob">
                                                        {!! Form::label('dob', 'Date of Birth') !!}
                                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                            {!! Form::text('dob', isset($information['ngohir']->date_of_birth) && strlen($information['ngohir']->date_of_birth) > 0 ? date('d-m-Y', strtotime($information['ngohir']->date_of_birth)) : '', ['size' => '16', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                                            <span class="input-group-btn add-on">
                                                        {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success', 'disabled' => 'disabled']) !!}
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
                                                                        {!! Form::radio('age_select', 2, !(strlen($information['ngohir']->date_of_birth) > 0) && (strlen($information['ngohir']->age_year_part) > 0 || strlen($information['ngohir']->age_month_part) > 0), ['id' => 'optionsRadios2']) !!}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 radio-age">
                                                            {!! Form::label('age_year_part', 'Age') !!}
                                                            <div class="input-group m-bot15">
                                                                {!! Form::input('number', 'age_year_part', $information['ngohir']->age_year_part, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => 1, 'disabled' => '']) !!}
                                                                <span class="input-group-addon">Years</span>
                                                                {!! Form::input('number', 'age_month_part', $information['ngohir']->age_month_part, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 1, 'disabled' => '']) !!}
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
                                        {!! Form::text('father_name', $information['ngohir']->father_name, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mother_name', 'Mother’s Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('mother_name', $information['ngohir']->mother_name, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row guardian">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('guardian_occupation', 'Guardian’s Occupation:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('guardian_occupation', $information['ngohir']->guardian_occupation, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('guardian_monthly_income', 'Guardian’s Monthly Income:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('guardian_monthly_income', $information['ngohir']->guardian_monthly_income, ['class' => 'form-control']) !!}
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
                                                        {!! Form::radio('marital_status', 'S', isset($information['ngohir']->marital_status) ? $information['ngohir']->marital_status == 'S' : true, ['id' => 'optionsRadios1']) !!}
                                                        Single
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('marital_status', 'M', $information['ngohir']->marital_status == 'M', ['id' => 'optionsRadios2']) !!}
                                                        Married
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('marital_status', 'D', $information['ngohir']->marital_status == 'D', ['id' => 'optionsRadios3']) !!}
                                                        Divorced
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('marital_status', 'W', $information['ngohir']->marital_status == 'W', ['id' => 'optionsRadios4']) !!}
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
                                        {!! Form::text('spouse_name', $information['ngohir']->spouse_name, ['class' => 'form-control']) !!}
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
                                                        {!! Form::radio('sex', 'M', $information['ngohir']->sex == 'M', ['id' => 'optionsRadios1','class' => 'male']) !!}
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('sex', 'F', isset($information['ngohir']->sex) ? $information['ngohir']->sex == 'F' : true, ['id' => 'optionsRadios2','class' => 'female']) !!}
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('sex', 'O', $information['ngohir']->sex == 'O', ['id' => 'optionsRadios3','class' => 'third-gender']) !!}
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
                                        {!! Form::select('nationality', get_countries_list_except_india(), $information['ngohir']->nationality, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('religion', 'Religion:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('religion', $information['ngohir']->religion, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('education', 'Educational Qualification:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('education', $information['ngohir']->education, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                            </div>
                        </div>
                        <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                        <input type="hidden" name="basic_info" value="1">
                    </div>
                    {!! Form::close() !!}
                </div>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
                        <h3><?php if (($information['ngohir']->address_at_source) > 0 ) {echo '<i class="fa fa-circle" aria-hidden="true"></i>'; }?>Address(s) at {{ $litigation->country($litigation->country_of_origin) }} (Source Country)</h3>
                    </a>

                    <div id="collapseAddress" class="panel-collapse collapse addresse" role="tabpanel" aria-labelledby="headingAddress">

                    {!! Form::open(['route' => ['ngohirs.update', $information['ngohir']->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <div class="panel-body">



                        <div class="well present">
                            <legend>Present Address</legend>

                            {!! Form::hidden('address_id[]', $information['ngohir_addresses'][0]->id) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_care_of[]', $information['ngohir_addresses'][0]->care_of, ['class' => 'form-control field1']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                            {!! Form::text('relation_with_survivor[]', $information['ngohir_addresses'][0]->relation_with_survivor, ['class' => 'form-control field2']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="survivor_present_address" class="row addresser-edit ">
                                        <div class="col-md-3 countries">
                                            {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), $information['ngohir_addresses'][0]->country, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 states">
                                            {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_state[]', states_of_country($information['ngohir_addresses'][0]->country), $information['ngohir_addresses'][0]->state, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 districts">
                                            {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_district[]',district_of_state($information['ngohir_addresses'][0]->state), $information['ngohir_addresses'][0]->district, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                            {!! Form::input('number', 'survivor_address_postal_code[]', $information['ngohir_addresses'][0]->postal_code, ['class' => 'form-control field6']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_1[]', $information['ngohir_addresses'][0]->address_line_1, ['class' => 'form-control  field3']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_2[]', $information['ngohir_addresses'][0]->address_line_2, ['class' => 'form-control  field4']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_contact_number[]', $information['ngohir_addresses'][0]->contact_number, ['class' => 'form-control  field5']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="well native">
                            <legend>Native Address</legend>
                            <input type="checkbox" name="same_address" class="copier"> <label>Same as Present Address</label>
                            {!! Form::hidden('address_id[]', $information['ngohir_addresses'][1]->id) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_care_of[]', $information['ngohir_addresses'][1]->care_of, ['class' => 'form-control field1']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                            {!! Form::text('relation_with_survivor[]', $information['ngohir_addresses'][1]->relation_with_survivor, ['class' => 'form-control field2']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="survivor_native_address" class="row row addresser-edit">
                                        <div class="col-md-3 countries">
                                            {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), $information['ngohir_addresses'][1]->country, ['class' => 'form-control m-bot15 ']) !!}
                                        </div>

                                        <div class="col-md-3 states">
                                            {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_state[]', states_of_country($information['ngohir_addresses'][1]->country), $information['ngohir_addresses'][1]->state, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 districts">
                                            {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_district[]', district_of_state($information['ngohir_addresses'][1]->state), $information['ngohir_addresses'][1]->district, ['class' => 'form-control m-bot15 ']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                            {!! Form::input('number', 'survivor_address_postal_code[]', $information['ngohir_addresses'][1]->postal_code, ['class' => 'form-control  field6']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_1[]', $information['ngohir_addresses'][1]->address_line_1, ['class' => 'form-control field3']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_2[]', $information['ngohir_addresses'][1]->address_line_2, ['class' => 'form-control  field4']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_contact_number[]', $information['ngohir_addresses'][1]->contact_number, ['class' => 'form-control  field5']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if(count($information['ngohir_addresses']) > 2)
                        @for( $i=2; $i < count($information['ngohir_addresses']); $i++)
                        <div class="well">
                            {!! Form::hidden('address_id[]', $information['ngohir_addresses'][$i]->id) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_title['.$i.']', $information['ngohir_addresses'][$i]->title, ['class' => 'form-control', 'placeholder' => 'Address 01']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_care_of[]', $information['ngohir_addresses'][$i]->care_of, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                            {!! Form::text('relation_with_survivor[]', $information['ngohir_addresses'][$i]->relation_with_survivor, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="survivor_native_address_{{ $information['ngohir_addresses'][$i]->id }}" class="row addresser-edit">
                                        <div class="col-md-3 countries">
                                            {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), $information['ngohir_addresses'][$i]->country, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 states">
                                            {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_state[]', states_of_country($information['ngohir_addresses'][$i]->country), $information['ngohir_addresses'][$i]->state, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3 districts">
                                            {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                                            {!! Form::select('survivor_address_district[]', district_of_state($information['ngohir_addresses'][$i]->state), $information['ngohir_addresses'][$i]->district, ['class' => 'form-control m-bot15']) !!}
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                                            {!! Form::input('number', 'survivor_address_postal_code[]', $information['ngohir_addresses'][$i]->postal_code, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_1[]', $information['ngohir_addresses'][$i]->address_line_1, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_line_2[]', $information['ngohir_addresses'][$i]->address_line_2, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                                            {!! Form::text('survivor_address_contact_number[]', $information['ngohir_addresses'][$i]->contact_number, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endfor
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
                                        <textarea class="form-control ckeditor" name="history_of_previous_stay" rows="6">{!! $information['ngohir']->history_of_previous_stay !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                            </div>
                        </div>
                        <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                        <input type="hidden" name="address_at_source" value="1">
                    </div>
                    {!! Form::close() !!}
                    </div>

                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePhysical" aria-expanded="true" aria-controls="collapsePhysical">
                        <h3><?php if (($information['ngohir']->physical_desc) > 0 ) {echo '<i class="fa fa-circle" aria-hidden="true"></i>'; }?>Survivor’s Physical Description</h3>
                    </a>

                    <div id="collapsePhysical" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPhysical">


                    {!! Form::open(['route' => ['ngohirs.update', $information['ngohir']->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <div class="panel-body">
                        <div class="row">
                            {{--<div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mother_tongue', 'Age:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <p class="help-block">14 years</p>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('other_language', 'Height:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="input-group m-bot15">
                                            {!! Form::input('number', 'height_ft_part', $information['ngohir']->height_ft_part, ['class' => 'form-control', 'min' => 0, 'max' => 7, 'step' => 1]) !!}
                                            <span class="input-group-addon">ft.</span>
                                            {!! Form::input('number', 'height_in_part', $information['ngohir']->height_in_part, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 0.5]) !!}
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
                                                    {!! Form::text('birth_mark', $information['ngohir']->birth_mark, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('complexion', 'Complexion', ['class' => 'control-label']) !!}
                                                    {!! Form::text('complexion', $information['ngohir']->complexion, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('eye_color', 'Eye Color', ['class' => 'control-label']) !!}
                                                    {!! Form::text('eye_color', $information['ngohir']->eye_color, ['class' => 'form-control','placeholder'=>'Brown/Black/Blue']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('hair_color', 'Hair Color', ['class' => 'control-label']) !!}
                                                    {!! Form::text('hair_color', $information['ngohir']->hair_color, ['class' => 'form-control','placeholder'=>'Black/Brown']) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('identification_mark', 'Identification Mark', ['class' => 'control-label']) !!}
                                                    {!! Form::text('identification_mark', $information['ngohir']->identification_mark, ['class' => 'form-control','placeholder'=>'Mole on Cheek/Forehead etc']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('deformities', 'Deformities', ['class' => 'control-label']) !!}
                                                    {!! Form::text('deformities', $information['ngohir']->deformities, ['class' => 'form-control','placeholder'=>'Blind/Deaf/Handicap']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row for-female-only">
                            <div class="col-md-6">
                                <div class="form-group  gender-{{$information['ngohir']->sex}}">
                                    {!! Form::label('pregnancy', 'Pregnant:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('pregnancy', '1', $information['ngohir']->pregnancy == '1', ['id' => 'optionsRadios1']) !!}
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('pregnancy', '0', isset($information['ngohir']->pregnancy) ? $information['ngohir']->pregnancy == '0' : true, ['id' => 'optionsRadios2']) !!}
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
                                        {{--{!! Form::checkbox('accompanying_with_survivor', '1') !!}--}}
                                        {!! Form::checkbox('accompanying_with_survivor', '1', isset($information['ngohir']->accompanying_with_survivor) && $information['ngohir']->accompanying_with_survivor == '1' ? 1 : 0) !!}
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
                                                        {!! Form::radio('abuse', '1', $information['ngohir']->abuse == '1', ['id' => 'optionsRadios1']) !!}
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        {!! Form::radio('abuse', '0', isset($information['ngohir']->abuse) ? $information['ngohir']->abuse == '0' : true, ['id' => 'optionsRadios2']) !!}
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
                                        {!! Form::text('if_yes_type', $information['ngohir']->if_yes_type, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7 col-md-offset-5 col-lg-offset-5 buttons">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                                {{--{!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}--}}
                            </div>
                        </div>
                        <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                        <input type="hidden" name="physical_desc" value="1">

                    </div>

                    {!! Form::close() !!}
                        </div>
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

                <input type="hidden" name="task_id" value="{!! $parent_task_id !!}">

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
                            <div class="col-sm-12 col-md-offset-8 col-lg-offset-8">
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
