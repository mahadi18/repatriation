<div class="case-studies">
    <div class="row">
        <div class="col-lg-12">
            <?php
            //dd($information);
            foreach ($information['case_studies'] as $case_study) {
            ?>
            <div class="panel form-group <?php if($case_study->deletable!=1) { echo "sticky"; } ?>">
                <div class="head">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                {{$case_study->title}}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="actions">
                                <a href="javascript:void(0)" class="pull-right" data-toggle="modal" data-target="#edit-myModal<?php echo $case_study->id; ?>">Edit History</a>
                                <div class="modal fade" id="edit-myModal<?php echo $case_study->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog semi-large" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit History of {{$case_study->title}} </h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $revisions = editHistoryOfCaseStory($case_study->id);
                                                foreach($revisions as $revision){
                                                    ?>
                                                    <div class="story-separator">
                                                        <div class="date"><?php echo $revision->created_at->format('d M, Y'); ?></div>
                                                        <?php echo '<strong>'.$revision->userResponsible()->organization()->get()[0]->name.'</strong>'.' Changed case story to '.$revision->new_value; ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($case_study->deletable==1) { ?>
                                    <form action="{{ route('casestudies.destroy', $case_study->id) }}" class="pull-right" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                        <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                        <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
                                        <button class="pull-right" type="submit"> Delete</button>
                                    </form>
                                <?php } ?>
                                <a href="javascript:void(0)" class="pull-right" data-toggle="modal" data-target="#myModal<?php echo $case_study->id; ?>"><?php if($case_study->description=='') { echo 'Add'; } else {echo 'Edit'; } ?></a>
                            <div class="modal fade" id="myModal<?php echo $case_study->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">




                                <form action="{{ route('casestudies.update', $case_study->id) }}" method="POST" class="location-log-form">

                                    <input type="hidden" name="_method" value="PUT">





                                <div class="modal-dialog semi-large" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Edit {{$case_study->title}} </h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('casestudies.update', $case_study->id) }}" method="POST" style="clear: both">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="head">
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h4>
                                                                    Title of study:
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <input type="text" value="{{$case_study->title}}" name="title" class="form-control" <?php if($case_study->deletable==0) { ?> readonly <?php } ?> />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="description">
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <label>Description</label>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <textarea name="description" class="form-control ckeditor">{{$case_study->description}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 20px">
                                                            <div class="col-lg-2">
                                                                <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                                                <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                                                <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <input type="submit" value="Save" class="btn btn-success">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>






                            <p>
                            {!! $case_study->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 add-form" style="display: block">
                <form action="{{ route('casestudies.store') }}" method="POST">
                    <div class="panel form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="head">
                            <div class="row">
                                <div class="col-lg-3">
                                    <h4>
                                        Title of study:
                                    </h4>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="description">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Description</label>
                                </div>
                                <div class="col-lg-9">
                                    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor']) !!}
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-lg-3">
                                    <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                    <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                    <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
                                </div>
                                <div class="col-lg-9 buttons">
                                    <input type="submit" value="Create" class="btn btn-success">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
