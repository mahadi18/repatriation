<?php

//dd($information);
?>
<div class="care-plans">
    <div class="tabuler-list">
        <div class="adv-table">
            <h3>History of Service Taken</h3>
            <a href="javascript:void(0)" class="btn btn-info toggler"><i class="fa fa-list-ul"></i> Add New</a>
            <div style="width: 100%; float: left; margin: 10px 0px"></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                   id="hidden-table-info">
            <thead style="background: rgb(30,157,138); color: #fff">
            <tr>
                <th class="hidden-phone">Care Type</th>
                <th style="width: 180px">Date</th>
                <th class="hidden-phone" style="width: 150px">Service Type</th>
                <th>Action Summary</th>
                <th style="display: none">Action Summary</th>
                <th style="display: none">Notes and Details</th>
                <th style="display: none">Reference Number</th>
                <th style="display: none">care id</th>
                <th style="display: none">Attachment</th>
                <th style="display: none">Attachment type</th>
            </tr>
            </thead>
                <tbody>
                <?php
                foreach ($information['cares'] as $care) {
                    ?>
                    <tr class="gradeX hider">
                        <td data-serial="1">
                            <?php if ($care->service()->get()->toArray()) {
                                echo ($care->service()->get()[0]->care_plan()->get()[0]->title);
                            } ?>
                        </td>
                        <td data-serial="2">
                            <?php
                            $date = new DateTime($care->date);
                            echo $date->format('j F \'y'); ?>
                        </td>

                        <td data-serial="3">
                            <?php if($care->service()->get()->toArray())
                                echo ($care->service()->get()[0]->title);
                             ?>
                        </td>
                        <td data-serial="4">
                            <?php
                                echo $care->reference_id;
                             ?>
                        </td>
                        <td data-serial="5" style="display: none"><?php
                                echo $care->action_summary;
                             ?>
                        </td>
                        <td data-serial="6" style="display: none"><?php
                                echo $care->notes;
                             ?>
                        </td>
                        <td data-serial="7" style="display: none">
                            <?php echo str_replace("/uploads/","",$care->attachment); ?>
                        </td>
                        <td data-serial="8" style="display: none"><?php
                            echo $care->id;
                            ?>
                        </td>

                        <td data-serial="9" style="display: none"><?php
                            echo $care->attachment;
                            ?>
                        </td>
                        <td data-serial="9" style="display: none">
                            <?php if($care->attachment){
                               if (strpos($care->attachment,'.pdf') == false) {
                                   $mime = 'image';
                                        echo 'image';
                                    }
                                    else {
                                        $mime = 'pdf';
                                        echo 'pdf';
                                    }
                            }
                            else {
                                $mime = 'none';
                                echo 'null';
                            }
                            ?>
                        </td>
                    </tr>

                    <div id="bs-example-modal-lg<?php echo $care->id ?>" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Movement</h4>
                                </div>
                                <div class="modal-body">
                                    <?php  if ($mime == 'image') { ?>
                                        <img
                                            src="<?php echo $care->attachment; ?>"
                                            alt=""/>
                                    <?php } else { ?>

                                        <iframe src="<?php echo $care->attachment; ?>#page=1&zoom=80" width="1100" height="740"></iframe>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="edit-bs-example-modal-lg<?php echo $care->id ?>" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" style="display: none;">
                        <div class="modal-dialog semi-large" role="document" style="width: 1000px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Service</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cares.update', $care->id) }}" method="POST"  style="padding-left: 50px;
    padding-right: 50px; margin-top: 30px" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>Care Type</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <?php
                                                        $care_type_id= 0;
                                                        if ($care->service()->get()->toArray()) {
                                                            $care_type_id =  $care->service()->get()[0]->care_plan()->get()[0]->id;
                                                        } ?>
                                                        <select name="treatment_type" class="form-control treatment_type">
                                                            <?php foreach ($information['care_plans'] as $care_plan) { ?>
                                                                <option
                                                                    value="<?php echo $care_plan->id; ?>" <?php if($care_type_id==$care_plan->id) echo "selected = 'selected'"?>><?php echo $care_plan->title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>Service Type</label>
                                                    </div>
                                                    <div class="col-lg-8">

                                                        <?php
                                                        $service_selected= 0;
                                                        if ($care->service()->get()->toArray()) {
                                                            $service_selected =  $care->service()->get()[0]->id;
                                                        } ?>

                                                        <select name="service_type" class="form-control service_type">
                                                            <?php foreach ($information['service_types'] as $service_types) { ?>
                                                                <option <?php if($service_selected==$service_types->id) echo "selected='selected'"; ?>
                                                                    value="<?php echo $service_types->id; ?>"><?php echo $service_types->title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>Date</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div data-date-viewmode="years" style="width: 220px" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}" class="input-append date dpYears">
                                                            {!! Form::text('date', strlen($care->date) ? date('d-m-Y', strtotime($care->date)) : '', ['size' => '16', 'class' => 'form-control']) !!}
                                                            <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>Reference No.</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="<?php echo $care->reference_id; ?>" name="reference_no" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="attached">
                                                    <div class="attachment-box" style="margin-left: 100px">
                                                        <h5>Attachment:Report</h5>

                                                        <div class="upload-wrapper">
                                                            <div class="fileupload fileupload-new"
                                                                 data-provides="fileupload">
                                                                <?php if ($mime == 'image') { ?>
                                                                    <div class="fileupload-new thumbnail"
                                                                         style="width: auto; height: 150px">
                                                                        <a class="img-wrapper"
                                                                           href="javascript:void(0)"> <img
                                                                                src="<?php echo $care->attachment ?>"
                                                                                alt=""/></a>

                                                                    </div>


                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="fileupload-new thumbnail"
                                                                         style="width: 200px; height: 25px; margin-top: 10px">
                                                                        <a href="javascript:void(0)"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/","",$care->attachment);?></a>


                                                                    </div>
                                                                <?php } ?>
                                                                <div class="fileupload-preview fileupload-exists thumbnail"
                                                                     style="width: 100%; margin-top: 20px"></div>


                                                                <div style="margin-bottom: 20px; margin-top: 20px">
                                                                    <a href="javascript:void(0)" class="delete-file">Delete</a>
                                                                    <input type="hidden" class="flag" name="deleted"
                                                                           value="0">
                                                                            <span class="btn btn-info btn-file">
                                                                                <span class="fileupload-new"><i
                                                                                        class="fa fa-cloud-upload"></i> Upload</span>
                                                                                <span class="fileupload-exists"><i
                                                                                        class="fa fa-undo"></i> Change</span>
                                                                                {!! Form::file('form_attachment', null, ['class' => 'form-control default']) !!}

                                                                            </span>
                                                                    <a href="javascript:void(0)" class="fileupload-exists"
                                                                       data-dismiss="fileupload">
                                                                        Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-12">
                                                <label>Action Summary</label>
                                            </div>
                                            <div class="col-lg-12">
                                                {!! Form::textarea('action_summary', $care->action_summary, ['class' => 'form-control action_summary ckeditor']) !!}
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <label>Notes</label>
                                            </div>
                                            <div class="col-lg-12">
                                                {!! Form::textarea('notes', $care->notes, ['class' => 'form-control notes ckeditor']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-9 buttons">
                                                <input type="submit" class="btn btn-success" value="Save">
                                                <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
                                                <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                                <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                                <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>

    <div class="add-form">
        <div class="form-group">
            <h3>Services Availed</h3>

            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('cares.store') }}" method="POST"  style="padding-left: 50px;
    padding-right: 50px; margin-top: 30px" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Care Type</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="treatment_type" class="form-control treatment_type">
                                            <option value="1" selected="selected">Please Select</option>
                                            <?php foreach ($information['care_plans'] as $care_plan) { ?>
                                                <option
                                                    value="<?php echo $care_plan->id; ?>"><?php echo $care_plan->title; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Service Type</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="service_type" class="form-control service_type">
                                            <option value="1" selected="selected">Please Select</option>
                                            <?php foreach ($information['service_types'] as $service_types) { ?>
                                                <option
                                                    value="<?php echo $service_types->id; ?>"><?php echo $service_types->title; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div data-date-viewmode="years" style="width: 220px" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}" class="input-append date dpYears">
                                            {!! Form::text('date', '', ['size' => '16', 'class' => 'form-control']) !!}
                                            <span class="input-group-btn add-on">
                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                            </span>
                                        </div>
                                        <p class="help-block"><i>date of service taken</i></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Reference No.</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="reference_no" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="attachment">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="attachment">
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                        <div class="row">
                                                            <div class="col-lg-5"></div>
                                                            <div class="col-lg-7">

                                                                    <div class="not attached">
                                                                        <div class="attachment-box">
                                                                            <h5>Attachment:Report</h5>

                                                                            <div class="upload-wrapper">
                                                                                <div class="fileupload fileupload-new"
                                                                                     data-provides="fileupload">
                                                                                    <div class="fileupload-preview fileupload-exists thumbnail"
                                                                                         style=""></div>

                                                                                <span class="btn btn-info btn-file">
                                                                                    <span class="fileupload-new"><i
                                                                                            class="fa fa-cloud-upload"></i> Upload</span>
                                                                                    <span
                                                                                        class="fileupload-exists"></span>
                                                                                    {!! Form::file('form_attachment', null, ['class' => 'form-control default']) !!}

                                                                                </span>
                                                                                    <a href="javascript:void(0)" class="fileupload-exists"
                                                                                       data-dismiss="fileupload">Remove</a>

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

                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <label>Action Summary</label>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::textarea('action_summary', null, ['class' => 'form-control action_summary ckeditor']) !!}
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                                <label>Notes</label>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::textarea('notes', null, ['class' => 'form-control notes ckeditor']) !!}
                            </div>
                        </div>
                        <div class="row">
                           <!-- <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Care Plan</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="care_plan" class="form-control treatment_type">
                                            <option value="1" selected="selected">Please Select</option>
                                            <?php /*foreach ($information['care_plans'] as $care_plan) { */?>
                                                <option
                                                    value="<?php /*echo $care_plan->id; */?>"><?php /*echo $care_plan->title; */?></option>
                                            <?php /*} */?>
                                        </select>
                                    </div>
                                </div>
                            </div>-->

                        </div>
                        <div class="row">
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-9 buttons">
                                <input type="submit" class="btn btn-success" value="Create">
                                <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
                                <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function ($) {

        /* Formating function for row details */
        function fnFormatDetails(oTable, nTr) {
            var aData = oTable.fnGetData(nTr);

            var data_target = '#bs-example-modal-lg' + aData[8];
            var edit_url = '#edit-bs-example-modal-lg' + aData[8];
            var delete_url = "/cares/" + aData[8];
            var submit_confirmation = "if(confirm('Delete? Are you sure?')) { return true } else {return false }"
            var file_icon = aData[10]=='pdf'?'<i class="fa fa-file-pdf-o"></i>':'<i class="fa fa-file-image-o"></i>';

            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; position: relative">';
            sOut += '<tr><td>&nbsp;</td><td><label>Action Summary</label></td></tr>';
            sOut += '<tr><td>&nbsp;</td><td>'+aData[5]+'</td></tr>';
            sOut += '<tr><td>&nbsp;</td><td><label>Notes and Details</label></td></tr>';
            sOut += '<tr><td>&nbsp;</td><td>'+aData[6]+'</td></tr>';
            sOut += '<tr class="references" style="border-top: #CDCDCD 1px solid"><td>&nbsp;</td>' +
                '<td>'+file_icon+' Reference Number: '+aData[4]+'</td>' +
                '<td><a href="javascript:void(0)"  data-toggle="modal" data-target="'+ data_target + '">'+aData[7]+' </a><div class="actions">' +
                '<button type="button" class="" data-toggle="modal" data-target="' + edit_url + '">' +
                'Edit</button>' +
                '<form  onsubmit="' + submit_confirmation + '" method="post" action="' + delete_url + '">' +
                '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '<button type="submit" value="delete">Delete</button>' +
                '</from></div></td>' +
                '</tr>';
            sOut += '</table>';

            return sOut;
        }


        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<img src="/assets/advanced-datatable/examples/examples_support/details_open.png">';
        nCloneTd.className = "center";

        $('#hidden-table-info thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        $('#hidden-table-info tbody tr').each(function () {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#hidden-table-info').dataTable({
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [
                [1, 'asc']
            ]
        });

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */

        $(document).on("click","#hidden-table-info tbody td img",function() {
            // $('#hidden-table-info tbody td').on('click', function () {
            var nTr = $(this).parents('tr')[0];
            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it */
                this.src = "/assets/advanced-datatable/examples/examples_support/details_open.png";
                oTable.fnClose(nTr);
            }
            else {
                /* Open this row */
                this.src = "/assets/advanced-datatable/examples/examples_support/details_close.png";
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
            }
        });


        $('select.treatment_type').on('change', function() {
            // alert(this.value);
            $.ajax({
                url: "/services/list/"+this.value,
                cache: false,
                success: function(responses){
                    console.log(responses);

                        var options = '';
                        $.each( responses, function( key, res ) {
                            console.log(res);
                            options = options+'<option value="'+res.id+'">'+res.title+'</option>';
                            //options = options+'<option value='+responses.id+'>responses.name</option>';
                        });



                    $('select.service_type').find('option')
                        .remove()
                        .end()
                        .append(options)
                }
            });
        })





    });


</script>