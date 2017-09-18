
<div class="cbrms-tasks">

<header class="panel-heading">
    <h1>Repatriation order at Source Country</h1>
    <?php if($information['current_task_status']!='Complete') { ?>
        <div class="completer">
            <form class="form-horizontal" action="/cases/{{$litigation->id }}/task/13" method="POST">
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

    if ($form->generic == 1) {
        ?>
        <div class="task well form-<?php echo $form->id; ?>">
        <h2><?php echo $form->title ?></h2>

        <div class="details">
        <div class="row">
        <div class="col-lg-3">
            <div class="completion <?php if ($form->status) {
                echo "done";
            } ?>">
                <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
            </div>
        </div>
        <div class="col-lg-9">


        {!! Form::open(['route' => ['case.form.update',$form->id], 'method' => 'post', 'class' =>
        'form-horizontal', 'files' => true]) !!}

        <div class="row">
            <div class="col-lg-3">
                <input name="status" id="status-<?php echo $form->id ?>"
                       type="checkbox" <?php echo $form->status ? 'checked' : ''; ?>> <label
                    for="status-<?php echo $form->id ?>">Completed</label>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-5">
                        <label>Date of action</label>
                    </div>
                    <div class="col-lg-7">
                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                             data-date="{{ date('d-m-Y') }}" class="input-append date dpYears">
                            <input name="date_of_action" type="text"
                                   value="<?php echo $form->date_of_action ? $form->date_of_action : ''; ?>"
                                   size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                        class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-5">
                        <label>Date of acknowledgement</label>
                    </div>
                    <div class="col-lg-7">
                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}" class="input-append date dpYears">
                            <input name="date_of_acknowledgement" type="text"
                                   value="<?php echo $form->date_of_acknowledgement ? $form->date_of_acknowledgement : ''; ?>"
                                   size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                        class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="attachment">
                <div class="col-lg-9 col-lg-offset-3">
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <?php if (!$form->attachment) { ?>
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

                            <?php
                            } else {
                                ?>
                                <div class="attached">
                                    <div class="attachment-box">
                                        <h5>Attachment:Report</h5>

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

                                                    <div class="modal fade bs-example-modal-lg<?php echo $form->id; ?>"
                                                         tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span></button>
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
                                                           href="javascript:void(0)"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/","",$form->attachment);?></a>

                                                        <div class="modal fade bs-example-modal-lg<?php echo $form->id; ?>"
                                                             tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title"
                                                                            id="myModalLabel"><?php echo $form->title ?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <iframe src="<?php echo $form->attachment; ?>#page=1&zoom=80" width="1100" height="740"></iframe>
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
        <div class="row">
            <div class="attachment">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-9">
                    <input type="submit" class="btn btn-success" value="Save">
                    <input type="hidden" name="litigation_id"
                           value="<?php echo $litigation->id; ?>">
                    <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
        </div>
        </div>
        </div>
    <?php
    } else {
        ?>
        <div class="task well form-<?php echo $form->id; ?>">
        <h2>{{$form->title}}</h2>

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
        <div class="col-lg-7">
            <div class="row hidden">
                <div class="col-lg-5">
                    <label>Date of action</label>
                </div>
                <div class="col-lg-7">
                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}"
                         class="input-append date dpYears">
                        <input name="date_of_action" type="text"
                               value="<?php echo $form->date_of_action ? $form->date_of_action : ''; ?>" size="16"
                               class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                        class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                    </div>
                </div>
            </div>
            <div class="row hidden">
                <div class="col-lg-5">
                    <label>Date of acknowledgement</label>
                </div>
                <div class="col-lg-7">
                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}"
                         class="input-append date dpYears">
                        <input name="date_of_acknowledgement" type="text"
                               value="<?php echo $form->date_of_acknowledgement ? $form->date_of_acknowledgement : ''; ?>"
                               size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i
                                                        class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                    </div>
                </div>
            </div>
            <?php foreach ($form->fields as $field) {
                if ($field->type != 'rte') {
                    ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <label>{{$field->title}}</label>
                        </div>
                        <div class="col-lg-7">
                            {{get_dynamic_field($field->id,$field->type,$field->value)}}
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        <div class="col-lg-5">
            <div class="attachment">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7">
                            <?php if (!$form->attachment) { ?>
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

                            <?php
                            } else {
                                ?>
                                <div class="attached">
                                    <div class="attachment-box">
                                        <h5>Attachment:Report</h5>

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
        <?php foreach ($form->fields as $field) {
            if ($field->type == 'rte') {
                ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px">
                        <label>{{$field->title}}</label>
                    </div>
                    <div class="col-lg-12">
                        {{get_dynamic_field($field->id,$field->type,$field->value)}}
                    </div>
                </div>
            <?php
            }
        }
        ?>


        <div class="row">

            <div class="attachment">

                <div class="col-lg-5 col-lg-offset-3">
                    <input type="submit" class="btn btn-success" value="Save">
                    <input type="hidden" name="litigation_id"
                           value="<?php echo $litigation->id; ?>">
                    <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                    <input type="hidden" name="generic" value="<?php echo $form->generic; ?>">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
        </div>
        </div>
        </div>
    <?php
    }
}?>
</div>