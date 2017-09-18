@extends('layout')

@section('content')

    {{-- Personal Information Tab Start --}}

    <div class="row">
        <div class="col-md-12">

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
                                                @if(get_victim_attachment('Victim Personal Image', $litigation->id))
                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="{!! get_victim_attachment('Victim Personal Image', $litigation->id)->file_path !!}" alt="text=no+image" />
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
                        <div class="col-md-2 col-md-offset-1 col-lg-offset-1">
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
                                                            <div class="col-md-3">
                                                                {!! Form::label('victim_child_sex', 'Gender:', ['class' => 'control-label']) !!}
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <div class="radio">
                                                                        <label>
                                                                            {!! Form::radio('victim_child_sex-'.$child->id, 'M', $child->sex == 'M') !!}
                                                                            Male
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <div class="radio">
                                                                        <label>
                                                                            {!! Form::radio('victim_child_sex-'.$child->id, 'F', isset($child->sex) ? $child->sex == 'F' : true) !!}
                                                                            Female
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <div class="radio">
                                                                        <label>
                                                                            {!! Form::radio('victim_child_sex-'.$child->id, 'T', $child->sex == 'T') !!}
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
                                                                    {!! Form::text('victim_child_date_of_birth[]', isset($child->date_of_birth) ? date('d-m-Y', strtotime($child->date_of_birth)) : date('d-m-Y'), ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}
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
                                                                        {!! Form::checkbox('accompanying_with_survivor[]', $child->id, isset($child->accompanying_with_survivor) && $child->accompanying_with_survivor == '1' ? 1 : 0) !!}
                                                                        Accompanying with <strong>{!! $litigation->full_name or $litigation->name_during_rescue !!}</strong>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                {!! Form::label('victim_child_case_id', 'Child\'s Case ID', ['class' => 'control-label']) !!}
                                                                {!! Form::text('victim_child_case_id[]', $child->child_litigation_id, ['class' => 'form-control']) !!}
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
                        <div class="col-md-2 col-md-offset-3 col-lg-offset-3">
                            <div class="form-group">
                                {{--{!! Form::button('<i class="fa fa-list-ul"></i> Add New', ['class' => 'btn btn-info']) !!}--}}
                                <a href="#myModal-1" data-toggle="modal" class="btn btn-info">
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
                <div class="col-sm-10 col-md-offset-2 col-lg-offset-2">
                    {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                    {{--{!! Html::link(route('cases.update'), 'Save', ['class' => 'btn btn-info disabled']) !!}--}}
                    {!! Html::link(route('cases.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
                </div>
            </div>

            {!! Form::close() !!}

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
                                {{--<button id="editable-sample_new" class="btn green">
                                    Add New <i class="fa fa-plus"></i>
                                </button>--}}

                                <a href="#myModal-2" data-toggle="modal" class="btn btn-info">
                                    <i class="fa fa-list-ul"></i> Add New
                                </a>

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
                                @if(count($litigation->family_members))
                                    {{-- The line below is not a comment. That line is important!. Added by Robaiatul Islam Shaon --}}
                                    {{--*/ $i = 1 /*--}}
                                    @foreach($litigation->family_members as $family_member)
                                        <tr class="">
                                            <td>{!! $i++ !!}.</td>
                                            <td>{!! $family_member->full_name !!}</td>
                                            <td>{!! $family_member->relation_with_survivor !!}</td>
                                            <td class="center">{!! $family_member->age !!} yrs</td>
                                            <td>{!! $family_member->occupation !!}</td>
                                            <td><a class="edit" href="javascript:;">Edit</a></td>
                                            <td><a class="delete" href="javascript:;">Delete</a></td>
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
                    <h4 class="modal-title">Address(s) at Bangladehs (Source Country)</h4>
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

    {{-- New Child Create Modal Start --}}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
        <div class="modal-dialog">
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

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('victim_child_sex', 'Gender:', ['class' => 'control-label']) !!}
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'M', '', ['id' => 'optionsRadios1']) !!}
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'F', true, ['id' => 'optionsRadios2']) !!}
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('victim_child_sex', 'T', '', ['id' => 'optionsRadios3']) !!}
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
                                            {!! Form::checkbox('accompanying_with_survivor', 'value') !!}
                                            Accompanying with <strong>{!! $litigation->full_name or $litigation->name_during_rescue !!}</strong>
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
                                                    {!! Form::hidden('doc_type_id', get_doc_type_id('Victim Child Personal Image')) !!}
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
                                    {!! Form::text('age', '', ['class' => 'form-control']) !!}
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

    {{-- New Famliy Member Create Modal End --}}

@endsection
