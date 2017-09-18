
<div class="form-group">
<div class="col-md-12 add-form">

{{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
{!! Form::open(['route' => ['personal.information.update', $litigation->id], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) !!}
{{--{!! Form::open(['route' => 'cases.store', 'method' => 'post', 'class' => 'form-horizontal ', 'files' => true]) !!}--}}
<section class="panel">
    <div class="panel-body">

        {!! Form::hidden('created_by', Auth::user()->id) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('case_id', 'Case ID:', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}
                    <div class="col-sm-10">
                        <p class="help-block"><strong>{!! $litigation->case_id !!}</strong></p>
                        {{--<p class="help-block"><strong>IN201505-####.BD201507-####</strong></p>--}}
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
                                {!! Form::text('full_name', $litigation->full_name, ['class' => 'form-control']) !!}<span class="mandatory">*</span>
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
                            {!! Form::label('father_name', 'Father\'s Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('father_name', $litigation->father_name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('mother_name', 'Mother\'s Name:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('mother_name', $litigation->mother_name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-md-offset-2 col-lg-offset-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="attachment">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="attached">
                                            <div class="attachment-box">
                                                <h5>Rescue Picture</h5>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    @if(get_victim_attachment('Victim Personal Image', $litigation->id))
                                                        <div class="fileupload-new thumbnail" style="">
                                                            <img src="{!! get_victim_attachment('Victim Personal Image', $litigation->id)->file_path !!}" alt="text=no+image" />
                                                        </div>
                                                    @else
                                                        <div class="fileupload-new thumbnail" style="">
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                        </div>
                                                    @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                       <span class="btn btn-info btn-file">
                                                           <span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Upload</span>
                                                           <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                           {!! Form::file('victim_personal_image_attachment', null, ['class' => 'form-control default']) !!}
                                                       </span>
                                                        {!! Form::hidden('doc_type_id', get_doc_type_id('Victim Personal Image')) !!}
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
                                            {!! Form::text('dob', isset($litigation->date_of_birth) ? date('d-m-Y', strtotime($litigation->date_of_birth)) : '', ['size' => '16', 'class' => 'form-control', 'disabled' => '']) !!}
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
                    {!! Form::label('mother_tongue', 'Mother Tongue:', ['class' => 'col-sm-4 col-lg-4 control-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('mother_tongue', $litigation->mother_tongue, ['class' => 'form-control']) !!}
                        <p class="help-block"><i>e.g. Bangla, Hindi, Marathi, Nepalese, Telugu etc.</i></p>
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
    Address(s) at {!! $litigation->country($litigation->country_of_origin) !!} (Source Country)
    <!--<span class="tools pull-right">
        <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
    </span>-->
</header>

<div class="panel-body">

@if(count($information['personal_info_addresses']))
@for( $i=0; $i < count($information['personal_info_addresses']); $i++)
<div class="well">
    {!! Form::hidden('address_id[]', $information['personal_info_addresses'][$i]->id) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label('survivor_address_title', 'Address Title:', ['class' => 'control-label']) !!}
                    {!! Form::text('survivor_address_title[]', $information['personal_info_addresses'][$i]->title, ['class' => 'form-control', 'placeholder' => 'Address 01']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label('survivor_address_care_of', 'C/O:', ['class' => 'control-label']) !!}
                    {!! Form::text('survivor_address_care_of[]', $information['personal_info_addresses'][$i]->care_of, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                    {!! Form::text('relation_with_survivor[]', $information['personal_info_addresses'][$i]->relation_with_survivor, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="rescue_address_{!! $information['personal_info_addresses'][$i]->id !!}" class="row addresser-edit">
                <div class="col-md-3 countries">
                    {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                    {!! Form::select('survivor_address_country[]', get_countries_list_except_india(), $litigation->country_of_origin, ['class' => 'form-control m-bot15 country','disabled' => 'true']) !!}
                </div>

                <div class="col-md-3 states">

                    {!! Form::label('survivor_address_state', 'State/Division/Zone:', ['class' => 'control-label']) !!}
                    {!! Form::select('survivor_address_state[]', states_of_country($litigation->country_of_origin), $information['personal_info_addresses'][$i]->state, ['class' => 'form-control m-bot15']) !!}
                </div>

                <div class="col-md-3 districts">
                    {!! Form::label('survivor_address_district', 'District:', ['class' => 'control-label']) !!}
                    {!! Form::select('survivor_address_district[]', district_of_state($information['personal_info_addresses'][$i]->state), $information['personal_info_addresses'][$i]->district, ['class' => 'form-control m-bot15']) !!}
                </div>

                <div class="col-md-3">
                    {!! Form::label('survivor_address_postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
                    {!! Form::input('number', 'survivor_address_postal_code[]', $information['personal_info_addresses'][$i]->postal_code, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label('survivor_address_line_1', 'Address Line 1:', ['class' => 'control-label']) !!}
                    {!! Form::text('survivor_address_line_1[]', $information['personal_info_addresses'][$i]->address_line_1, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label('survivor_address_line_2', 'Address Line 2:', ['class' => 'control-label']) !!}
                    {!! Form::text('survivor_address_line_2[]', $information['personal_info_addresses'][$i]->address_line_2, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6">
                    {!! Form::label('survivor_address_contact_number', 'Contact Number:', ['class' => 'control-label']) !!}
                    {!! Form::text('survivor_address_contact_number[]', $information['personal_info_addresses'][$i]->contact_number, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endfor
@else
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{--{!! Form::label('case_id', 'Nothing found', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}--}}
            <div class="col-sm-10">
                <p class="help-block"><strong>-#### Nothing found ####-</strong></p>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-2 col-md-offset-1 col-lg-offset-2">
        <div class="form-group">
            {{--{!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}--}}
            <a href="#myModal" data-toggle="modal" class="btn btn-info">
                <i class="fa fa-list-ul"></i> Add New
            </a>
        </div>
    </div>
</div>

{{--cut from here--}}

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
                    {!! Form::radio('sex', 'O', $litigation->sex == 'O', ['id' => 'optionsRadios3']) !!}
                    Other
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
    <div class="col-md-2">
        <div class="form-group">
            <div class="radio">
                <label>
                    {!! Form::radio('marital_status', 'W', $litigation->marital_status == 'W', ['id' => 'optionsRadios4']) !!}
                    Widow / Widower
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
                {!! Form::text('spouse_name', $litigation->spouse_name, ['class' => 'form-control']) !!}
                <p class="help-block"><i>In case of multiple spouses, write spouse name separated by comma (,). Latest one come as first.</i></p>
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
                @if(count($litigation->children))
                @foreach($litigation->children as $child)
                <div class="well">
                    {!! Form::hidden('victim_child_id[]', $child->id) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('victim_child_name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('victim_child_name[]', $child->full_name, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::label('victim_child_sex', 'Gender:', ['class' => 'control-label']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('victim_child_sex', 'M', isset($child->sex) && strlen($child->sex) > 0 ? $child->sex == 'M' : false, ['id' => 'optionsRadios1']) !!}
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('victim_child_sex', 'F', isset($child->sex) && strlen($child->sex) > 0 ? $child->sex == 'F' : true, ['id' => 'optionsRadios2']) !!}
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio('victim_child_sex', 'O', isset($child->sex) && strlen($child->sex) > 0 ? $child->sex == 'O' : false, ['id' => 'optionsRadios3']) !!}
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::label('date_of_birth', 'Age Information:', ['class' => 'control-label']) !!}
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <label for="">&nbsp;</label>
                                                    <div class="form-group">
                                                        <div class="radio">
                                                            <label>
                                                                {!! Form::radio('child_age_select_'. $child->id, 1, strlen($child->date_of_birth) > 0, ['id' => 'optionsRadios1']) !!}
                                                                {{--Male--}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 radio-child-dob">
                                                    {!! Form::label('dob', 'Date of Birth') !!}
                                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                        {!! Form::text('child_dob', isset($child->date_of_birth) && strlen($child->date_of_birth) > 0 ? date('d-m-Y', strtotime($child->date_of_birth)) : '', ['size' => '16', 'class' => 'form-control', 'disabled' => '']) !!}
                                                        <span class="input-group-btn add-on">
                                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success', 'disabled' => '']) !!}
                                                        </span>
                                                    </div>
                                                    <p class="help-block"><i>dd-mm-yyyy (example: 07-02-1999)</i></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <label for="">&nbsp;</label>
                                                    <div class="form-group">
                                                        <div class="radio">
                                                            <label>
                                                                {!! Form::radio('child_age_select_'.$child->id, 2, !(strlen($child->date_of_birth) > 0) && (strlen($child->age_year_part) > 0 || strlen($child->age_month_part) > 0), ['id' => 'optionsRadios2']) !!}
                                                                {{--Male--}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 radio-child-age">
                                                    {!! Form::label('age_year_part', 'Age') !!}
                                                    <div class="input-group m-bot15">
                                                        {!! Form::input('number', 'child_age_year_part', $child->age_year_part, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => 1, 'disabled' => '']) !!}
                                                        <span class="input-group-addon">Years</span>
                                                        {!! Form::input('number', 'child_age_month_part', $child->age_month_part, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 1, 'disabled' => '']) !!}
                                                        <span class="input-group-addon">Months</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('accompanying_with_survivor[]', $child->id, isset($child->accompanying_with_survivor) && $child->accompanying_with_survivor == '1' ? 1 : 0) !!}
                                            Accompanying with <strong>{!! $litigation->full_name or $litigation->name_during_rescue !!}</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    {!! Form::label('victim_child_case_id', 'Child\'s Case ID', ['class' => 'control-label']) !!}
                                    {!! Form::text('victim_child_case_id[]', $child->child_litigation_id, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">&nbsp;</label>
                                        <div class="col-md-12">
                                            <div>Attachment: Picture</div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                @if(get_victim_child_image_attachment($child->id))
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{!! get_victim_child_image_attachment($child->id) !!}" alt="text=no+image" />
                                                </div>
                                                @else
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                </div>
                                                @endif
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                                        <span class="btn btn-info btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Upload</span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                            {!! Form::file('victim_child_image_attachment', null, ['class' => 'form-control default']) !!}
                                                                        </span>
                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{--{!! Form::label('case_id', 'Nothing found', ['class' => 'col-sm-2 col-lg-2 control-label']) !!}--}}
                            <div class="col-sm-10">
                                <p class="help-block"><strong>-#### Nothing found ####-</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2 col-md-offset-3 col-lg-offset-2">
        <div class="form-group">
            {{--{!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}--}}
            <a href="#survivor-child-Modal" data-toggle="modal" class="btn btn-info">
                <i class="fa fa-list-ul"></i> Add New
            </a>
        </div>
    </div>
</div>

{{-- cut from here child create modal --}}

{{--<div class="row">
    <div class="col-md-2 col-md-offset-3 col-lg-offset-3">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}
        </div>
    </div>
</div>--}}

</div>
</section>

<div class="form-group">
    <div class="col-lg-4 col-md-offset-2 col-lg-offset-5 buttons">
        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
    </div>
</div>

{!! Form::close() !!}

<section class="panel">
    <header class="panel-heading">
        Family Info
        <!--<span class="tools pull-right">
            <a href="javascript:void(0)" class="fa fa-chevron-down"></a>
        </span>-->
    </header>

    <div class="panel-body">
        <div class="adv-table editable-table ">
            <div class="clearfix">
                <div class="btn-group">
                    {{--<button id="editable-sample_new" class="btn green">
                        Add New <i class="fa fa-plus"></i>
                    </button>--}}

                    <a href="#myModal-2" data-toggle="modal" class="btn btn-info">
                        <i class="fa fa-list-ul"></i> Add New
                    </a>

                </div>
            </div>
            <div class="spacer-top"></div>
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
                @if(count($litigation->family_members))
                {{-- The line below is not a comment. That line is important!. Added by Robaiatul Islam Shaon --}}
                {{--*/ $i = 1 /*--}}
                @foreach($litigation->family_members as $family_member)
                <tr class="family-member-options">
                    <td>{!! $i++ !!}.</td>
                    <td>{!! $family_member->full_name !!}</td>
                    <td>{!! $family_member->relation_with_survivor !!}</td>
                    <td class="center">{!! $family_member->age !!} yrs</td>
                    <td>{!! $family_member->occupation !!}</td>
                    <td>
                        <a class="edit"  data-toggle="modal" data-target="#editModal<?php echo $i;?>" href="javascript:;">Edit</a>
                        <div class="modal fade" id="editModal<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Family Member</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-horizontal">
                                            <form action="{{ route('personal.information.family.member.update', $family_member->id) }}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="family_member_name" class="control-label">Name:</label>
                                                                <input class="form-control" placeholder="Full Name" name="family_member_name" type="text" value="{{$family_member->full_name}}" id="family_member_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="relation_with_survivor" class="control-label">Relation with Survivor:</label>
                                                                <input class="form-control" name="relation_with_survivor" type="text" value="{{$family_member->relation_with_survivor}}" id="relation_with_survivor">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="age" class="control-label">Age:</label>
                                                                <input class="form-control" name="age" type="number" value="{{$family_member->age}}" id="age">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <label for="occupation" class="control-label">Occupation:</label>
                                                                <input class="form-control" name="occupation" type="text" value="{{$family_member->occupation}}" id="occupation">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-lg-4 col-lg-offset-5">
                                                                <input class="btn btn-info" type="submit" value="Update">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td>
                        <form action="{{ route('personal.information.family.member.delete', $family_member->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="" type="submit">Delete</button></form>
                    </td>

                </tr>

                @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>
</section>

</div>
</div>

{{-- Personal Information Tab End --}}

{{-- New Address Create Modal Start --}}

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Address(s) at {!! $litigation->country($litigation->country_of_origin) !!} (Source Country)</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => ['personal.information.address.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                <input type="hidden" name="task_id" value="{!! $current_task !!}">

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
                        <div id="rescue_address" class="row addresser">
                            <div class="col-md-3 countries">
                                {!! Form::label('survivor_address_country', 'Country:', ['class' => 'control-label']) !!}
                                {!! Form::select('survivor_address_country', get_countries_list_except_india(), $litigation->country_of_origin, ['class' => 'form-control m-bot15', 'disabled' => true]) !!}
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
                            <div class="col-lg-4 col-lg-offset-5">
                                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
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

{{-- New Child Create Modal Start --}}

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="survivor-child-Modal" class="modal fade">
    <div class="modal-dialog semi-large">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Survivor's Child</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => ['personal.information.child.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('victim_child_name', 'Name', ['class' => 'control-label']) !!}
                        {!! Form::text('victim_child_name', '', ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::label('victim_child_sex', 'Gender:', ['class' => 'control-label']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'M', '', ['id' => 'optionsRadios1']) !!}
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'F', true, ['id' => 'optionsRadios2']) !!}
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'O', '', ['id' => 'optionsRadios3']) !!}
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::label('date_of_birth', 'Age Information:', ['class' => 'control-label']) !!}
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <label for="">&nbsp;</label>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('child_age_select', 1, '', ['id' => 'optionsRadios1']) !!}
                                                            {{--Male--}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 radio-child-dob">
                                                {!! Form::label('dob', 'Date of Birth') !!}
                                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{!! date('d-m-Y') !!}" class="input-append date dpYears">
                                                    {!! Form::text('child_dob', '', ['size' => '16', 'class' => 'form-control', 'disabled' => '']) !!}
                                                    <span class="input-group-btn add-on">
                                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success', 'disabled' => '']) !!}
                                                        </span>
                                                </div>
                                                <p class="help-block"><i>dd-mm-yyyy (example: 07-02-1999)</i></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <label for="">&nbsp;</label>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            {!! Form::radio('child_age_select', 2, '', ['id' => 'optionsRadios2']) !!}
                                                            {{--Male--}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10 radio-child-age">
                                                {!! Form::label('age_year_part', 'Age') !!}
                                                <div class="input-group m-bot15">
                                                    {!! Form::input('number', 'child_age_year_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => 1, 'disabled' => '']) !!}
                                                    <span class="input-group-addon">Years</span>
                                                    {!! Form::input('number', 'child_age_month_part', null, ['class' => 'form-control', 'min' => 0, 'max' => 11, 'step' => 1, 'disabled' => '']) !!}
                                                    <span class="input-group-addon">Months</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('accompanying_with_survivor', 'value') !!}
                                        Accompanying with <strong>{!! $litigation->full_name or $litigation->name_during_rescue !!}</strong>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                {!! Form::label('victim_child_case_id', 'Child\'s Case ID', ['class' => 'control-label']) !!}
                                {!! Form::text('victim_child_case_id', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="attachment">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="attached">
                                        <div class="attachment-box">
                                            <h5>Child Picture</h5>

                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="buttons-wrapper">
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Upload</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        {!! Form::file('victim_child_image_attachment', null, ['class' => 'form-control default']) !!}
                                                    </span>
                                                    {!! Form::hidden('doc_type_id', get_doc_type_id('Victim Child Personal Image')) !!}
                                                    <a href="#" class="fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row spacer-top">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-5">
                                {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

{{-- New Child Create Modal End --}}

{{-- New Famliy Member Create Modal Start --}}

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Family Member</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => ['personal.information.family.member.store', $litigation->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('family_member_name', 'Name:', ['class' => 'control-label']) !!}
                                {!! Form::text('family_member_name', '', ['class' => 'form-control', 'placeholder' => 'Full Name']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('relation_with_survivor', 'Relation with Survivor:', ['class' => 'control-label']) !!}
                                {!! Form::text('relation_with_survivor', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('age', 'Age:', ['class' => 'control-label']) !!}
                                {!! Form::input('number','age', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6">
                                {!! Form::label('occupation', 'Occupation:', ['class' => 'control-label']) !!}
                                {!! Form::text('occupation', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-5">
                                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

{{-- New Famliy Member Create Modal End --}}

<script type="text/javascript">

    $(document).ready(function ($) {
        $( ".dpYears" ).on( "focusout", function() {
            // alert($(this).data( "date" ));
        })
    });
</script>