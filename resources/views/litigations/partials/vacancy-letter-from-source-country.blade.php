<div class="cbrms-tasks">
<header class="panel-heading">
    <h1>Repatriation Letter at Destination Country</h1>
    <?php if ($information['current_task_status'] != 'Complete') { ?>
        <div class="completer">
            <form class="form-horizontal" action="/cases/{{$litigation->id }}/task/18" method="POST">
                <!--<form class="form-horizontal" action="javascript:void(0)" method="POST">-->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="status_id" type="hidden" value="4">
                <button class="btn btn-success" type="submit">
                    Mark as Complete
                </button>
            </form>
        </div>
    <?php } ?>
</header>
<?php foreach ($information['forms'] as $form) {
        ?>
        <div class="" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="">
        <div class="task well form-<?php echo $form->id; ?>">
        <div class="" role="tab" id="heading<?php echo $form->id; ?>"><a class="" role="button" data-toggle="collapse" data-parent="#accordion"
                                                                         href="#collapse<?php echo $form->id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $form->id; ?>"><h2><?php if ($form->status) {
                        echo '<i class="fa fa-circle" aria-hidden="true"></i>';
                    } ?>{{$form->title}}</h2></a></div>

        <div id="collapse<?php echo $form->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $form->id; ?>">
        <div class="details">
        <?php
        /*echo '<pre>';
        print_r($form);
        echo '</pre>';*/
        ?>
        <div class="row">
        <div class="col-lg-12">
        {!! Form::open(['route' => ['case.form.update',$form->id], 'method' => 'post', 'class' => 'form-horizontal',
        'files' => true]) !!}

        <div class="row">
        <!--<div class="col-lg-3">
                <input name="status" id="status-<?php /*echo $form->id*/ ?>" type="checkbox" <?php /*echo $form->status ? 'checked': ''; */ ?>> <label for="status-<?php /*echo $form->id*/ ?>">Completed</label>
            </div>-->
        <div class="col-lg-6">
            <h2>Issuer Information</h2>

            <div class="row">
                <?php $field = $form->fields[0]; ?>
                <div class="col-lg-5">
                    <label>Name</label>
                </div>
                <div class="col-lg-7">
                    <input type="text" name="field-17" value="{{$field->value}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <?php $field = $form->fields[2]; ?>
                <div class="col-lg-5">
                    <label>Organization</label>
                </div>
                <div class="col-lg-7">
                    <input type="text" name="field-19" value="{{$field->value}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <?php $field = $form->fields[4]; ?>
                <div class="col-lg-5">
                    <label>Date</label>
                </div>
                <div class="col-lg-7">
                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php date('d-m-Y') ?>"  class="input-append date dpYears">
                        <input name="field-21" type="text" value="<?php echo $field->value; ?>" size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <label>Attachment</label>
                </div>
                <div class="col-lg-7">
                <div class="attachment">
                <div class="col-lg-12">
                    <div class="row">

                            <?php if (!$form->attachment) { ?>
                                <div class="not attached">
                                    <div class="attachment-box">
                                        <h2>Attachment:Report</h2>

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

                            <?php
                            } else {
                                ?>
                                <div class="attached">
                                    <div class="attachment-box">


                                        <div class="upload-wrapper">
                                            <div class="fileupload fileupload-new"
                                                 data-provides="fileupload">
                                                <?php if ($form->type == 'image') { ?>
                                                    <div class="fileupload-new thumbnail"
                                                         style="width: auto; height: 150px">
                                                        <a class="img-wrapper" data-toggle="modal"
                                                           data-target=".bs-example-modal-lg<?php echo $form->id; ?>"
                                                           href="javascript:void(0)"> <img
                                                                src="<?php echo $form->attachment ?>"
                                                                alt=""/></a>

                                                    </div>

                                                    <div
                                                        class="modal fade bs-example-modal-lg<?php echo $form->id; ?>"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="myLargeModalLabel">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title"
                                                                        id="myModalLabel"><?php echo $form->title ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img
                                                                        src="<?php echo $form->attachment; ?>"
                                                                        alt=""/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    ?>
                                                    <div class="fileupload-new thumbnail"
                                                         style="width: 200px; height: 25px; margin-top: 10px">
                                                        <a data-toggle="modal"
                                                           data-target=".bs-example-modal-lg<?php echo $form->id; ?>"
                                                           href="javascript:void(0)"><i
                                                                class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/", "", $form->attachment); ?>
                                                        </a>

                                                        <div
                                                            class="modal fade bs-example-modal-lg<?php echo $form->id; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="myLargeModalLabel">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title"
                                                                            id="myModalLabel"><?php echo $form->title ?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <iframe
                                                                            src="<?php echo $form->attachment; ?>#page=1&zoom=80"
                                                                            width="1100" height="740"></iframe>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-success"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="fileupload-preview fileupload-exists thumbnail"
                                                     style="width: 100%; margin-top: 20px"></div>
                                                <div style="margin-bottom: 20px; margin-top: 20px">
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


                            <?php } ?>

                    </div>
                </div>
            </div>

        </div>

        </div>


        </div>
        <div class="col-lg-6">
            <h2>Receiver Information</h2>
            <div class="row">
                <?php $field = $form->fields[1]; ?>
                <div class="col-lg-5">
                    <label>Name</label>
                </div>
                <div class="col-lg-7">
                    <input type="text" name="field-18" value="{{$field->value}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <?php $field = $form->fields[3]; ?>
                <div class="col-lg-5">
                    <label>Organization</label>
                </div>
                <div class="col-lg-7">
                    <input type="text" name="field-20" value="{{$field->value}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <?php $field = $form->fields[5]; ?>
                <div class="col-lg-5">
                    <label>Date</label>
                </div>
                <div class="col-lg-7">
                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php date('d-m-Y') ?>"  class="input-append date dpYears">
                        <input name="field-22" type="text" value="<?php echo $field->value; ?>" size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $field = $form->fields[6]; ?>
                <div class="col-lg-5">
                    <label>Status</label>
                </div>
                <div class="col-lg-7">
                    <input type="radio" name="field-23" id="approved" <?php if($field->value=='Approved') {echo "checked='checked'";}?> value="Approved"> <label for="approved">Approved</label><br>
                    <input type="radio" name="field-23" id="pending" <?php if($field->value=='Pending') {echo "checked='checked'";}?> value="Pending"> <label for="pending">Pending</label><br>
                    <input type="radio" name="field-23" id="rejected" <?php if($field->value=='Rejected') {echo "checked='checked'";}?> value="Rejected"> <label for="rejected">Rejected</label><br>
                </div>
            </div>
        </div>




        </div>
        <div class="row">
            <div class="col-lg-5">
                &nbsp;
            </div>
            <div class="col-lg-6">
                <input type="submit" class="btn btn-success" value="Save">
                <input type="hidden" name="litigation_id"
                       value="<?php echo $litigation->id; ?>">
                <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                <input type="hidden" name="generic" value="<?php echo $form->generic; ?>">
            </div>
        </div>
        {!! Form::close() !!}
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    <?php

}?>
</div>