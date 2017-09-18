@extends('case-profile')
@section('content')
<div class="profile-menu">
    <ul>
        <li>
            <a class="detail" href="/cases/{{$litigation->id}}/dashboard"><i class="fa fa-bars"></i>Case Status</a>
        </li>
        <li><a href="/cases/{{$litigation->id}}/case-profile">Case Timeline</a></li>
        <li><a href="/cases/{{$litigation->id}}/full-profile">Full Profile</a></li>
        <li><a href="/cases/{{$litigation->id}}/take-over">Survivor Takenover</a></li>
        <li class="active"><a href="/cases/{{$litigation->id}}/document-archive">Document Archive</a></li>
        <li><a href="/cases/{{$litigation->id}}/change-log">Update Log</a></li>
    </ul>
</div>
<section class="panel">
    <div class="panel-body">
    <h2>Profile Photos</h2>
    <div class="profile_photos">
        <?php echo get_attachments_of_victim('Victim Personal Image', $litigation->id); ?>
    </div>
        <div class="clearfix"></div>

    <h2>Form Documents</h2>
    <div class="documents">
        <div class="row head">
            <div class="doc-type col-lg-5">
                <strong>Document</strong>
            </div>
            <div class="date-uploaded col-lg-2">
                <strong>Uploaded Date</strong>
            </div>
            <div class="file col-lg-5">
                <strong>File</strong>
            </div>
        </div>
        <?php
        foreach($litigation->form_files as $form_file) {
        ?>
            <div class="row">
                <div class="doc-type col-lg-5">
                    {{$form_file->title}}
                </div>
                <div class="date-uploaded col-lg-2">
                    {{ date('d F, Y', strtotime($form_file->file_updated_at)) }}
                </div>
                <div class="file col-lg-5">
                    <a data-toggle="modal"
                       data-target=".bs-example-modal-lg<?php echo $form_file->id; ?>"
                       href="javascript:void(0)"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/","",$form_file->file_path);?></a>

                    <div class="modal fade bs-example-modal-lg<?php echo $form_file->id; ?>"
                         tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"
                                        id="myModalLabel"><?php echo $form_file->title ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php if (strpos($form_file->file_path, '.pdf') == false) {

                                    ?>
                                    <img
                                        src="<?php echo $form_file->file_path; ?>"
                                        alt=""/>
                                    <?php } else {
?>
                                    <iframe src="<?php echo $form_file->file_path; ?>#page=1&zoom=80" width="1100" height="740"></iframe>
                                    <?php } ?>
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
            </div>
        <?php
        }
        ?>
    </div>
        <h2>Other Documents</h2>
        <div class="documents">
            <div class="row">
                <div class="doc-type col-lg-5">
                    <strong>Document</strong>
                </div>
                <div class="date-uploaded col-lg-2">
                    <strong>Uploaded Date</strong>
                </div>
                <div class="file col-lg-5">
                    <strong>File</strong>
                </div>
            </div>
            <?php
           //dd($litigation->attachments);
            foreach($litigation->attachments as $attachment) {
                ?>
                <div class="row">
                    <div class="doc-type col-lg-5">
                        {{$attachment->name}}
                    </div>
                    <div class="date-uploaded col-lg-2">
                        {{ date('d F, Y', strtotime($attachment->updated_at)) }}
                    </div>

                    <div class="file col-lg-5">
                        <a data-toggle="modal"
                           data-target=".bs-example-modal-lg-hir-<?php echo $attachment->id; ?>"
                           href="javascript:void(0)"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo str_replace("/uploads/","",$attachment->attachment);?></a>

                        <div class="modal fade bs-example-modal-lg-hir-<?php echo $attachment->id; ?>"
                             tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"
                                            id="myModalLabel"><?php echo $attachment->name ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (strpos($attachment->attachment, '.pdf') == false) {

                                            ?>
                                            <img
                                                src="<?php echo $attachment->attachment; ?>"
                                                alt=""/>
                                        <?php } else {
                                            ?>
                                            <iframe src="<?php echo $attachment->attachment; ?>#page=1&zoom=80" width="1100" height="740"></iframe>
                                        <?php } ?>
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
                </div>
            <?php
            }
            ?>
        </div>
</section>      </div>
</section>
@endsection
