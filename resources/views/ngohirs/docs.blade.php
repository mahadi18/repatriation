<?php

//dd(count($information['files']));
?>
<div class="care-plans">
<div class="tabuler-list">
<div class="adv-table">
<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseHundred" aria-expanded="false" aria-controls="collapseHundred">
    <h3><?php if (count($information['files'])>0 ) {echo '<i class="fa fa-circle" aria-hidden="true"></i>'; }?>Survivor’s Indentity Document List</h3>
</a>
<div id="collapseHundred" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingHundred">

<a href="javascript:void(0)" class="btn btn-info toggler"><i class="fa fa-list-ul"></i> Add New</a>

<div style="width: 100%; float: left; margin: 10px 0px"></div>
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
       id="hidden-table-info">
<thead style="background: rgb(30,157,138); color: #fff">
<tr>
    <th class="hidden-phone" style="width: 200px">Date of Upload</th>
    <th class="hidden-phone" style="width: 450px">Identification Document Type</th>
    <th>Comments</th>
    <th style="display: none">Comments full</th>
    <th style="display: none">Notes and Details</th>
    <th style="display: none">Reference Number</th>
    <th style="display: none">file id</th>
    <th style="display: none">Attachment</th>
    <th style="display: none">Attachment type</th>
</tr>
</thead>
<tbody>
<?php
foreach ($information['files'] as $file) {
    ?>
    <tr class="gradeX hider">

        <td data-serial="2">
            <?php
            $date = new DateTime($file->date_of_upload);
            echo $date->format('j F \'y'); ?>
        </td>

        <td data-serial="3">
            <?php if ($file->docType()->get()->toArray())
                echo($file->docType()->get()[0]->name);
                $os = array(3, 4, 5, 6,7);
                if (in_array($file->doc_type_id, $os)) {
                    echo ", Document Number: ".$file->doc_no;
                }
            ?>


        </td>
        <td data-serial="4">
            <?php
            echo str_limit(($file->comments), 20, '...');
            ?>
        </td>
        <td data-serial="5" style="display: none"><?php
            echo $file->comments;
            ?>
        </td>
        <td data-serial="6" style="display: none"><?php
            echo $file->comments;
            ?>
        </td>
        <td data-serial="7" style="display: none">
            <?php echo str_replace("/uploads/", "", $file->attachment); ?>
        </td>
        <td data-serial="8" style="display: none"><?php
            echo $file->id;
            ?>
        </td>

        <td data-serial="9" style="display: none"><?php
            echo $file->attachment;
            ?>
        </td>
        <td data-serial="10" style="display: none">
            <?php if ($file->attachment) {
                if (strpos($file->attachment, '.pdf') == false) {
                    $mime = 'image';
                    echo 'image';
                } else {
                    $mime = 'pdf';
                    echo 'pdf';
                }
            } else {
                $mime = 'none';
                echo 'null';
            }
            ?>
        </td>
    </tr>

    <div id="bs-example-modal-lg<?php echo $file->id ?>" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php if ($file->docType()->get()->toArray())
                            echo($file->docType()->get()[0]->name);
                        ?></h4>
                </div>
                <div class="modal-body">
                    <?php if ($mime == 'image') { ?>
                        <img
                            src="<?php echo $file->attachment; ?>"
                            alt=""/>
                    <?php } else { ?>

                        <iframe src="<?php echo $file->attachment; ?>#page=1&zoom=80" width="1100"
                                height="740"></iframe>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-bs-example-modal-lg<?php echo $file->id ?>" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog semi-large" role="document" style="width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Document</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ngohirfiles.update', $file->id) }}" method="POST" style="padding-left: 50px;
    padding-right: 50px; margin-top: 30px" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Identification Document Type</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php
                                        $docType_selected = 0;
                                        if ($file->docType()->get()->toArray()) {
                                            $docType_selected = $file->docType()->get()[0]->id;
                                        } ?>

                                        <select name="doc_type" class="form-control doc_type">
                                            <?php foreach ($information['doc_types'] as $doc_types) { ?>
                                                <option <?php if ($docType_selected == $doc_types->id) echo "selected='selected'"; ?>
                                                    value="<?php echo $doc_types->id; ?>"><?php echo $doc_types->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php

                                if (in_array($docType_selected, array(3,4,5,6,7))) {
                                    $display = 'block';
                                }

                                else {
                                    $display = 'none';
                                }

                                ?>

                                <div class="row doc_no" style="display: '.$display.'">
                                    <div class="col-lg-6">
                                        <label>Source Doc No</label>
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::text('doc_no', $file->doc_no, ['class' => 'form-control']) !!}
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
                                                                src="<?php echo $file->attachment ?>"
                                                                alt=""/></a>

                                                    </div>


                                                <?php
                                                } else {
                                                    ?>
                                                    <div class="fileupload-new thumbnail"
                                                         style="width: 200px; height: 25px; margin-top: 10px">
                                                        <a href="javascript:void(0)"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/", "", $file->attachment); ?>
                                                        </a>


                                                    </div>
                                                <?php } ?>
                                                <div class="fileupload-preview fileupload-exists thumbnail"
                                                     style="width: 100%; margin-top: 20px"></div>


                                                <div style="margin-bottom: 20px; margin-top: 20px">
                                                    <!--<a href="javascript:void(0)" class="delete-file">Delete</a>-->
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
                                <label>Notes</label>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::textarea('notes', $file->comments, ['class' => 'form-control notes ckeditor'])
                                !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 buttons">
                                <input type="submit" class="btn btn-success" value="Save">
                                <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
                                <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                <input type="hidden" name="task_id" value="9">
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
</div>

<div class="add-form" style="display: none">
    <div class="form-group">
        <h3>Survivor’s Indentity Document List</h3>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('ngohirfiles.store') }}" method="POST" style="margin-top: 30px"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Identification Document Type</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="doc_type" class="form-control doc_type">
                                        <option value="1" selected="selected">Please Select</option>
                                        <?php foreach ($information['doc_types'] as $doc_types) { ?>
                                            <option
                                                value="<?php echo $doc_types->id; ?>"><?php echo $doc_types->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row doc_no" style="display: none">
                                <div class="col-lg-6">
                                    <label>Source Doc No</label>
                                </div>
                                <div class="col-lg-6">
                                    {!! Form::text('doc_no', '', ['class' => 'form-control']) !!}
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-5">
                            <div class="attachment">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="attachment">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-5"></div>
                                                        <div class="col-lg-7">

                                                            <div class="not attached">
                                                                <div class="attachment-box">
                                                                    <h5>Attachment:Report</h5>

                                                                    <div class="upload-wrapper">
                                                                        <div class="fileupload fileupload-new"
                                                                             data-provides="fileupload">
                                                                            <div
                                                                                class="fileupload-preview fileupload-exists thumbnail"
                                                                                style=""></div>

                                                                                <span class="btn btn-info btn-file">
                                                                                    <span class="fileupload-new"><i
                                                                                            class="fa fa-cloud-upload"></i> Upload</span>
                                                                                    <span
                                                                                        class="fileupload-exists"></span>
                                                                                    {!! Form::file('form_attachment', null, ['class' => 'form-control default']) !!}

                                                                                </span>
                                                                            <a href="javascript:void(0)"
                                                                               class="fileupload-exists"
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
                            <label>Comments</label>
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
                                            <?php /*foreach ($information['care_plans'] as $file_plan) { */ ?>
                                                <option
                                                    value="<?php /*echo $file_plan->id; */ ?>"><?php /*echo $file_plan->title; */ ?></option>
                                            <?php /*} */ ?>
                                        </select>
                                    </div>
                                </div>
                            </div>-->

                    </div>
                    <div class="row">
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-9 buttons">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
                            <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
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

            var data_target = '#bs-example-modal-lg' + aData[7];
            var edit_url = '#edit-bs-example-modal-lg' + aData[7];
            var delete_url = "/ngohirfiles/" + aData[7];
            var submit_confirmation = "if(confirm('Delete? Are you sure?')) { return true } else {return false }"
            var file_icon = aData[10] == 'pdf' ? '<i class="fa fa-file-pdf-o"></i>' : '<i class="fa fa-file-image-o"></i>';

            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>&nbsp;</td><td><p style="width: 650px"> ' + aData[4] + '</p></td><td><div class="actions" style="position: relative; right: 0; top: 0">' +
                '<button type="button" class="" data-toggle="modal" data-target="' + edit_url + '">' +
                'Edit</button>' +
                '<form  onsubmit="' + submit_confirmation + '" method="post" action="' + delete_url + '">' +
                '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '<button type="submit" value="delete">Delete</button>' +
                '</from></div></td></tr>';
            sOut += '<tr class="references" style="border-top: #CDCDCD 1px solid"><td>&nbsp;</td>' +
                '<td>' + file_icon + '<a href="javascript:void(0)"  data-toggle="modal" data-target="' + data_target + '">  ' + aData[6] + ' </a></td>' +
                '' +
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

        $(document).on("click", "#hidden-table-info tbody td img", function () {
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


        $('select.treatment_type').on('change', function () {
            // alert(this.value);
            $.ajax({
                url: "/docs/list/" + this.value,
                cache: false,
                success: function (responses) {
                    console.log(responses);

                    var options = '';
                    $.each(responses, function (key, res) {
                        console.log(res);
                        options = options + '<option value="' + res.id + '">' + res.title + '</option>';
                        //options = options+'<option value='+responses.id+'>responses.name</option>';
                    });


                    $('select.doc_type').find('option')
                        .remove()
                        .end()
                        .append(options)
                }
            });
        })


            $('.doc_type').change(function(){
                $('.doc_no input').val('');
                var array = ['3','4','5','6','7'];
                if(array.indexOf($(this).val()) > -1){
                    $('.doc_no').css('display','block');
                }
                else {
                    $('.doc_no').css('display','none');
                }
            })


    });


</script>