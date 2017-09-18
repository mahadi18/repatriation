<div class="panel-body">

<div class="tabuler-list">
<h3>
    Movement Log
</h3>

<div class="adv-table">
<a href="javascript:void(0)" class="btn btn-info toggler"><i class="fa fa-list-ul"></i> Add New</a>
<?php if (!empty($information['movements'])) { ?>
    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
    <thead>
    <tr>
        <th style="width: 100px">Date Of Transfer</th>
        <th style="width: 150px">Destination Location</th>
        <th style="width: 500px" class="hidden-phone">Occupation</th>
        <th style="display: none" class="hidden-phone">movement-id</th>
    </tr>

    </thead>
    <tbody>
    <?php
    //dd($information);

    foreach ($information['movements'] as $movement) {
         //dd($movement);
        ?>
        <tr class="gradeX hider">
            <td class="entry-date">
                <?php
                if($movement->transfer_date != null && strlen($movement->transfer_date) > 0) {
                    $date = new DateTime($movement->transfer_date);
                    echo $date->format('j F \'y');
                }else {
                    echo $date = null;
                }
                 ?>
            </td>

            <td class="dest-location">
                <?php if ($movement->organization()->get()->toArray()) { ?>{{$movement->organization()->get()[0]->name}}
                    <span>, {{$movement->organization()->get()[0]->address}}</span>

                <?php } ?>
            </td>

            <td class="occupation">
                {{$movement->handed_to}}<span>,{{$movement->designation}},{{$movement->phone}},{{$movement->email}}</span>
            </td>

            <td class="occupation" style="display: none">
                {{$movement->id}}
            </td>
        </tr>
        <div id="myModal<?php echo $movement->id ?>" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="display: none;">
            <div class="modal-dialog semi-large" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detail of Movement</h4>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('movements.update', $movement->id) }}" method="POST" class="location-log-form">

                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Destination Type</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="organization_type" class="form-control destination-type">

                                                    <?php $dest_type = $information['destination_types'][0]  ?>
                                                    <option value="<?php echo $dest_type['id']; ?>" <?php if($movement->destination_type==$dest_type['id']){echo "selected";}?>><?php echo $dest_type['name']; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Destination Name</label>
                                        </div>
                                        <div class="col-lg-8">

                                            <?php
                                            //$selected_organization = 0;
                                            if($movement->organization()->get()->toArray()) {
                                                //print_r($movement->organization()->get()[0]);

                                            $selected_organization = $movement->organization()->get()[0];
                                                //dd($selected_organization);
                                            } ?>
                                            <select name="organization" class="form-control destination-name">

                                                    <?php foreach($information['shelter_homes'] as $shelter_home) { ?>
                                                        <option <?php if($selected_organization->id==$shelter_home->id)  {echo'selected="selected"'; } ?> value="<?php echo $shelter_home->id; ?>"><?php echo $shelter_home->name; ?></option>
                                                    <?php } ?>
                                                <option class="other" value="0">Other (Add New)</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Date of Order</label>
                                        </div>
                                        <div class="col-lg-8">


                                            <div data-date-viewmode="years" style="width: 238px" data-date-format="dd-mm-yyyy"
                                                 data-date="{{ date('d-m-Y') }}"
                                                 class="input-append date dpYears">

                                                {!! Form::text('entry_date', isset($movement->entry_date) ? date('d-m-Y', strtotime($movement->entry_date)) : '', ['size' => '16', 'class' => 'form-control']) !!}

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
                                            <label>Date of Transfer</label>
                                        </div>
                                        <div class="col-lg-8">


                                            <div data-date-viewmode="years" style="width: 238px" data-date-format="dd-mm-yyyy"
                                                 data-date="{{ date('d-m-Y') }}"
                                                 class="input-append date dpYears">

                                                {!! Form::text('transfer_date', isset($movement->transfer_date) ? date('d-m-Y', strtotime($movement->transfer_date)) : '', ['size' => '16', 'class' => 'form-control']) !!}

                                                            <span class="input-group-btn add-on">
                                                                {!! Form::button('<i class="fa fa-calendar-plus-o"></i>', ['class' => 'btn btn-success']) !!}
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="addresser" id="addr<?php echo $movement->id?>">

                                <div class="row form-group">
                                </div>
                            </div>
                            <div class="row form-group districts">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <textarea class="form-control address ckeditor" name="address"> <?php if($movement->organization()->get()->toArray()) { echo $movement->organization->get()[0]->address; } ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Phone</label>
                                        </div>

                                        <div class="col-lg-8">
                                            <input readonly type="text" name="phone" value="<?php echo $selected_organization->phone;?>" class="phone form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input readonly type="text" name="email" value="<?php echo $selected_organization->email;?>" class="email form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Handover to</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="handed_to" value="<?php echo $movement->handed_to ?>" class="handed_to form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Designation</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="designation" value="<?php echo $movement->designation ?>" class="designation form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Notes</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <textarea class="form-control address ckeditor" name="notes"><?php echo $movement->notes ?></textarea>
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
                                            <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
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
    <?php
    }

    ?>
    </tbody>
    </table>

<?php
} else {
    echo "No Records Found";
}
?>
</div>


</div>
<div class="add-form">
    <div class="form-group">
        <h3>Detail of Movement</h3>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('movements.store') }}" method="POST" class="location-log-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Date of Order</label>
                                </div>
                                <div class="col-lg-8">
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                         data-date="{{ date('d-m-Y') }}"
                                         class="input-append date dpYears" style="width: 255px">
                                        {!! Form::text('entry_date', '', ['size' =>
                                        '16',
                                        'class' =>
                                        'form-control']) !!}
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
                                    <label>Destination Name</label>
                                </div>
                                <div class="col-lg-8">
                                    <select name="organization" class="form-control destination-name">
                                        <?php foreach($information['shelter_homes'] as $shelter_home) { ?>
                                        <option value="<?php echo $shelter_home->id; ?>"><?php echo $shelter_home->name; ?></option>
                                        <?php } ?>
                                        <option class="other" value="0">Other (Add New)</option>
                                    </select>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Date of Transfer</label>
                                </div>
                                <div class="col-lg-8">
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy"
                                         data-date="{{ date('d-m-Y') }}"
                                         class="input-append date dpYears" style="width: 255px">
                                        {!! Form::text('transfer_date', '', ['size' =>
                                        '16',
                                        'class' =>
                                        'form-control']) !!}
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
                                    <label>Destination Type</label>
                                </div>
                                <div class="col-lg-8">
                                    <!--todo add other destination tyopes here-->
                                    <!--<select name="organization_type" class="form-control destination-type">
                                        <?php /*foreach ($information['destination_types'] as $dest_type) { */?>
                                            <option
                                                value="<?php /*echo $dest_type['id']; */?>"><?php /*echo $dest_type['name']; */?></option>
                                        <?php /*} */?>
                                    </select>-->


                                    <select name="organization_type" class="form-control destination-type">

                                        <?php $dest_type = $information['destination_types'][0]  ?>
                                        <option
                                            value="<?php echo $dest_type['id']; ?>"><?php echo $dest_type['name']; ?></option>

                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 20px" class="addresser" id="addr2">
                        <div class="row form-group">

                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Country</label>
                                    </div>
                                    <div class="col-lg-6 countries">
                                        <!--<input type="text" name="country" class="country form-control"/>-->
                                        <select name="country" class="form-control">
                                            <option value="0">Please Select</option>                                            <?php
                                            foreach ($information['countries'] as $country) {
                                                ?>
                                                <option
                                                    value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 states" style="text-align:right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>State</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="state" class="form-control">
                                            <option value="0">Please Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 districts" style="text-align:right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>District</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="district" class="form-control">
                                            <option value="0">Please Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group districts">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Address</label>
                                </div>
                                <div class="col-lg-10">
                                    <textarea class="form-control address ckeditor" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Phone</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="phone" class="phone form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="email" class="email form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Handover to</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="handed_to" class="handed_to form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Designation</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="designation" class="designation form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Notes</label>
                                </div>
                                <div class="col-lg-10">
                                    <textarea class="form-control address ckeditor" name="notes"></textarea>
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
                                    <a href="javascript:void(0)" class="btn btn-success cancel">Cancel</a>
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

            var delete_url = "/movements/" + aData[4];
            var data_target = "#myModal" + aData[4];
            var submit_confirmation = "if(confirm('Delete? Are you sure?')) { return true } else {return false }"

            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr>' +
                '<td style="width: 38px">&nbsp;</td><td class="entry-date" style="width: 185px">&nbsp;</td>';
            sOut += '<td class="dest-location" style="width: 285px">' + aData[2] + ' ' + '' + '</td>';
            sOut += '<td class="occupation" style="width: 270px;position: relative; padding-right: 50px">' + aData[3] + ' ' + '' + '<div class="actions" style="right: -115px">' +
                '<button type="button" class="" data-toggle="modal" data-target="' + data_target + '">' +
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


        $('select.destination-type').on('change', function () {
            //alert(this.value);
            //element_id = '#'+$(this).parents('.addresser').attr('id');
            $.ajax({
                url: "/organizations/type/" + this.value,
                cache: false,
                success: function (responses) {
                    //console.log(responses);
                    $options = generate_select_options(responses);
                    $('select.destination-name').find('option')
                        .remove()
                        .end()
                        .append($options)


                    $.ajax({
                        url: "/organizations/info/" + responses[0].id,
                        cache: false,
                        success: function (response) {
                            $('input.country').val(response.country);
                            $('input.state').val(response.state);
                            $('input.district').val(response.district);
                            $('textarea.address').val(response.address);
                            $('input.phone').val(response.phone);
                            $('input.email').val(response.email);
                            //alert(response.country);
                        }
                    });
                }
            });
        })

        $('select.destination-name').on('change', function () {
            //alert(this.value);
            //element_id = '#'+$(this).parents('.addresser').attr('id');
            $.ajax({
                url: "/organizations/info/" + this.value,
                cache: false,
                success: function (response) {
                    $('input.country').val(response.country);
                    $('input.state').val(response.state);
                    $('input.district').val(response.district);
                    $('textarea.address').val(response.address);
                    $('input.phone').val(response.phone);
                    $('input.email').val(response.email);
                    //alert(response.country);
                }
            });

            if($( this ).val()==0) {
                window.location = '/shelterhomes/create'
            }

        })




    });


    function generate_select_options(responses) {
        options = '';
        $.each(responses, function (key, res) {
            //console.log(res);
            options = options + '<option value="' + res.id + '">' + res.name + '</option>';
            //options = options+'<option value='+responses.id+'>responses.name</option>';
        });

        return options;
    }

</script>

