@extends('case-profile')
@section('content')
<div class="profile-menu">
    <ul>
        <li>
            <a class="detail" href="/cases/{{$litigation->id}}/dashboard"><i class="fa fa-bars"></i>Case Status</a>
        </li>
        <li><a href="/cases/{{$litigation->id}}/case-profile">Case Timeline</a></li>
        <li><a href="/cases/{{$litigation->id}}/full-profile">Full Profile</a></li>
        <li class="active"><a href="/cases/{{$litigation->id}}/take-over">Survivor Takenover</a></li>
        <li><a href="/cases/{{$litigation->id}}/document-archive">Document Archive</a></li>
        <li><a href="/cases/{{$litigation->id}}/change-log">Update Log</a></li>
    </ul>
</div>
<section class="panel takeover">
    <div class="panel-body">
        <form action="/cases/{{$litigation->id}}/save-take-over" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="well">
                        <h3>List of documents Received</h3>
                        <ul>
                            <?php foreach ($desired_doc_type_ids as $key => $value) { ?>
                                <li><input type="checkbox" id="doc{{$key}}" name="doc[{{$key}}]"
                                           value="<?php echo $value ?>" <?php
                                    if (in_array($value, $received_docs)) {
                                        echo "checked";
                                    }
                                    ?> /> <label
                                        for="doc{{$key}}"> <?php echo get_doc_type_from_id($value) ?> </label></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="well">
                        <h3>Physical Handover of the Survivor Completed?</h3>
                        <ul class="handover">
                            <li><input type="radio" name="complete" id="yes" <?php if($complete==1) echo 'checked="checked"';?> value="1"/> <label for="yes"> Yes </label>
                            </li>
                            <li><input type="radio" name="complete" id="no" <?php if($complete==0) echo 'checked="checked"';?> value="0"/> <label for="no"> No </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div style="text-align:center">
                <button type="submit" class="btn btn-success">Save</button>
            </div>

        </form>

    </div>
</section>

@endsection
