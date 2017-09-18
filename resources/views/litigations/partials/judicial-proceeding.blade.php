<div class="panel-body">
<div class="form-group">
<div class="tabuler-list">
<h3>
    Court History of Judicial Proceeding
</h3>

<div class="adv-table">
<a href="javascript:void(0)" class="btn btn-info toggler"><i class="fa fa-list-ul"></i> Add New</a>
<?php
if (!empty($information['proceedings'])) {
?>
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
<thead>
<tr>
    <th style="width: 180px">Date Of Order</th>
    <th style="width: 160px">Order From</th>
    <th class="hidden-phone">Booked Under Act</th>
    <th class="hidden-phone">Document Type</th>
    <!--<th class="hidden-phone">Action Points</th>-->
    <th class="hidden-phone" style="display: none">Action Pointse</th>
    <th class="hidden-phone" style="display: none">Proceeding ID</th>
</tr>
</thead>
<tbody>
<?php
foreach ($information['proceedings'] as $proceeding) {
// dd($proceeding);
?>
<tr class="gradeX hider <?php echo 'proceeding' . $proceeding->id ?>">
    <td><?php
        $date = new DateTime($proceeding->date_of_order);
        echo $date->format('j F \'y'); ?></td>
    <td>{{$proceeding->order_from}}</td>
    <td>{{$proceeding->act}}</td>
    <td>{{$proceeding->document_type}}</td>
    <td style="display: none">
                                <span>

                                    <ul>
                                        <?php foreach ($proceeding->attached_action_points as $action_point) { ?>
                                            <li style="list-style: disc">
                                                <?php echo $action_point['title'] ?>
                                            </li>
                                        <?php
                                        }

                                        if ($proceeding->notes) {
                                            ?>
                                            <li style="list-style: disc; border-top: 1px solid #ddd; margin-top: 5px; padding-top: 5px">
                                                {!! $proceeding->notes !!}
                                            </li>
                                        <?php } ?>
                                    </ul>

                                </span>
    </td>
    <td style="display: none">{{$proceeding->id}}</td>
</tr>

<div id="myModal<?php echo $proceeding->id ?>" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog semi-large" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Proceeding</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('proceedings.update', $proceeding->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Date of Order</label>
                                </div>
                                <div class="col-lg-8">
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                         data-date="12-02-2012"
                                         class="input-append date dpYears">

                                        {!! Form::text('date_of_order', isset($proceeding->date_of_order) ?
                                        date('d-m-Y', strtotime($proceeding->date_of_order)) : date('d-m-Y'),
                                        ['readonly' => '', 'size' => '16', 'class' => 'form-control']) !!}

                                                            <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-lg-offset-1">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Booked under which Act?</label>
                                </div>
                                <div class="col-lg-8">
                                    <!--<select name="act" class="form-control act">
                                                    <option value="0" selected="selected">Please Select</option>
                                                    <?php /*foreach ($information['acts'] as $act) { */ ?>
                                                        <option
                                                            value="<?php /*echo $act['name']; */ ?>" <?php /*if ($proceeding->act == $act['name']) {
                                                            echo "selected='selected'";
                                                        } */
                                    ?>><?php /*echo $act['name']; */ ?></option>
                                                    <?php /*} */ ?>
                                                </select>-->


                                    <input type="text" name="act" class="form-control"
                                           value="<?php echo $proceeding->act; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Order From</label>
                                </div>
                                <div class="col-lg-8">
                                    <select name="order_from" class="form-control order_from">
                                        <option value="0" selected="selected">Please Select</option>
                                        <?php foreach ($information['order_sources'] as $order_source) { ?>
                                            <option
                                                value="<?php echo $order_source['name']; ?>" <?php if ($proceeding->order_from == $order_source['name']) {
                                                echo "selected='selected'";
                                            } ?>><?php echo $order_source['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-lg-offset-1">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Document Type</label>
                                </div>
                                <div class="col-lg-8">
                                    <select name="document_type" class="form-control document_type">
                                                    <option value="0">Please Select</option>
                                                    <?php foreach ($information['document_types'] as $document_type) {  ?>
                                                        <option
                                                            value="<?php echo $document_type['name'];  ?>"<?php if ($proceeding->document_type == $document_type['name']) {
                                                            echo "selected='selected'";
                                                        }
                                    ?>><?php echo $document_type['name'];  ?></option>
                                                    <?php }  ?>
                                                    <option value="<?php echo $proceeding->document_type; ?>" selected="selected"><?php echo $proceeding->document_type; ?></option>
                                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Action Points</label>
                                </div>
                                <div class="col-lg-10">
                                    <?php foreach ($information['action_points'] as $key => $action_point) {
                                        $selected = '';
                                        ?>
                                        <?php foreach ($proceeding->attached_action_points as $selected_action_point) {
                                            if ($selected_action_point['id'] == $action_point['id']) {
                                                $selected = "checked";
                                                break;

                                            } else {
                                                $selected = "";

                                            }

                                        }?>

                                        <div><input type="checkbox" <?php echo $selected; ?>
                                                    name="action_points[<?php echo $action_point['id']; ?>]"> <?php echo $action_point['title'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Other Action Points</label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea class="form-control address ckeditor"
                                              name="notes">{{$proceeding->notes}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">

                                </div>
                                <div class="col-lg-9 buttons">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                                <input type="hidden" name="litigation_id"
                                       value="<?php echo $litigation->id; ?>">
                                <input type="hidden" name="task_id"
                                       value="<?php echo $parent_task_id; ?>">
                                <input type="hidden" name="sub_task"
                                       value="<?php echo $current_task; ?>">
                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<?php
}

?>
</tbody>
</table>

<?php
}
else {
    echo "No Records Found";
}
?>
</div>


<div class="clearfix"></div>
</div>
<div class="add-form">
    <h3>Order Sheet</h3>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('proceedings.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row form-group">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Date of Order</label>
                            </div>
                            <div class="col-lg-7">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                     data-date="{{ date('d-m-Y') }}"
                                     class="input-append date dpYears">
                                    {!! Form::text('date_of_order', '', ['size' => '16', 'class' => 'form-control']) !!}
                                <span class="input-group-btn add-on">
                                    {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                {!! Form::label('act', 'Booked under which Act?', ['class' => 'control-label']) !!}
                                {{--<label>Booked under which Act?</label>--}}
                            </div>
                            <div class="col-lg-8">
                                <!--<select name="act" class="form-control act">
                                <option value="0" selected="selected">Please Select</option>
                                <?php /*foreach ($information['acts'] as $act) { */ ?>
                                    <option
                                        value="<?php /*echo $act['name']; */ ?>"><?php /*echo $act['name']; */ ?></option>
                                <?php /*} */ ?>
                            </select>-->

                                <input name="act" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Order From</label>
                            </div>
                            <div class="col-lg-8">
                                <select name="order_from" class="form-control order_from">
                                    <option value="0" selected="selected">Please Select</option>
                                    <?php foreach ($information['order_sources'] as $order_source) { ?>
                                        <option
                                            value="<?php echo $order_source['name']; ?>"><?php echo $order_source['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Document Type</label>
                            </div>
                            <div class="col-lg-8">
                                <select name="document_type" class="form-control document_type">
                                <option value="0" selected="selected">Please Select</option>
                                <?php foreach ($information['document_types'] as $document_type) {  ?>
                                    <option
                                        value="<?php echo $document_type['name']; ?>"><?php echo $document_type['name']; ?></option>
                                <?php }  ?>
                                    <option value="-1" >Other</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Action Points</label>
                            </div>
                            <div class="col-lg-10">
                                @foreach($information['action_points'] as $key => $action_point)
                                <div>
                                    <input type="checkbox"
                                           name="action_points[<?php echo $action_point['id']; ?>]"> <?php echo $action_point['title'] ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Other Action Points</label>
                            </div>
                            <div class="col-lg-9">
                                {!! Form::textarea('notes', null, ['class' => 'form-control address ckeditor']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-9 buttons">
                                <input type="submit" class="btn btn-success" value="Create">
                                <a type="submit" class="btn btn-success cancel">Cancel</a>
                                <input type="hidden" name="litigation_id" value="<?php echo $litigation->id; ?>">
                                <input type="hidden" name="task_id" value="<?php echo $parent_task_id; ?>">
                                <input type="hidden" name="sub_task" value="<?php echo $current_task; ?>">
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


<script type="text/javascript">

    $(document).ready(function ($) {


        /* Formating function for row details */
        function fnFormatDetails(oTable, nTr) {
            var aData = oTable.fnGetData(nTr);
            var delete_url = "/proceedings/" + aData[6];
            var data_target = "#myModal" + aData[6];
            var submit_confirmation = "if(confirm('Delete? Are you sure?')) { return true } else {return false }"
            //alert(del_url);
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; position: relative">';
            sOut += '<tr><td style="width: 128px; padding-left: 20px; padding-right: 20px">Action Points</td><td colspan="2" style="width: 600px">' + aData[5] + ' ' + '' + '<div class="actions">' +
                '<button type="button" class="" data-toggle="modal" data-target="' + data_target + '">' +
                'Edit</button>' +
                '<form  onsubmit="' + submit_confirmation + '" method="post" action="' + delete_url + '">' +
                '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '<button type="submit" value="delete">Delete</button>' +
                '</from></div> </td></tr>';
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

        $('.document_type').change(function(){
            if($(this).val() == '-1'){ // or this.value == 'volvo'
                $('<input name="document_type" class="form-control" value="">').insertAfter($(this));
            }
        });


    });


</script>

