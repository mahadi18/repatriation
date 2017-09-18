/**
 * Created by bazlur on 6/7/15.
 */


$( document ).ready(function() {

    var dp = $("#date_of_birth");

    dp.datepicker({
        format : 'yyyy-mm-dd'
    });

    dp.on('changeDate', function(ev){
        //dp.val(ev.target.value);
        /*alert($("#dp1").data('date') );*/
       //alert(dp.val());
    });

    // todo Highlight search pattern on result page
    //$(".table.table-striped tbody").highlight(q);
    $(".highlight").css({ backgroundColor: "#FFFF88" });

    function addRow(case_id, name_during_rescue, comment) {
        // Get a reference to the table
        var selected_victims_for_attachment = document.getElementById('selected_victims_for_attachment');

        // Insert a row in the table at row index 1
        //var newRow = selected_victims_for_attachment.insertRow(selected_victims_for_attachment.rows.length);
        //alert(selected_victims_for_attachment.getElementsByTagName("tbody")[0].rows.length);
         var newRow = selected_victims_for_attachment.getElementsByTagName("tbody")[0].insertRow(0);


        // Insert a cell in the row at indexes
        var newCell1 = newRow.insertCell(0);
        var newCell2 = newRow.insertCell(1);
        var newCell3 = newRow.insertCell(2);
        var newCell4 = newRow.insertCell(3);

        newCell3.style.display = 'none';
        newCell4.className = 'text-center';

        // Append a text node to cell 1 & 2
        var newText1 = document.createTextNode(case_id);
        var newText2 = document.createTextNode(name_during_rescue);

        // Append case_id to the cell 1 as hidden input
        var caseIdInput = document.createElement('input');
        caseIdInput.setAttribute('name', 'case_id[]');
        caseIdInput.setAttribute('type', 'hidden');
        caseIdInput.value = case_id;


        // Append comment to the cell 3 as hidden input
        var commentInput = document.createElement('input');
        commentInput.setAttribute('name', 'comment[]');
        commentInput.setAttribute('type', 'hidden');
        commentInput.value = comment;


        // Append icon to the remove button of cell 4
        var removeButtonIcon = document.createElement('i');
        removeButtonIcon.className = 'fa fa-times';
        // Append remove button to the cell 4
        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger btn-xs remove_selected_victim';
        removeButton.setAttribute('type', 'button');
        removeButton.appendChild(removeButtonIcon);


        newCell1.appendChild(newText1);
        newCell1.appendChild(caseIdInput);
        newCell2.appendChild(newText2);
        newCell3.appendChild(commentInput);
        newCell4.appendChild(removeButton);
    }

    function no_victim_select() {
        var selected_victims_for_attachment = document.getElementById('selected_victims_for_attachment');
        var newRow = selected_victims_for_attachment.getElementsByTagName("tbody")[0].insertRow(0);

        // Insert a cell in the row at index 0
        var newCell = newRow.insertCell(0);

        // Append attributes to the cell
        newCell.className = 'text-center';
        newCell.setAttribute('colspan', '3');
        // Append a text node to the cell
        var newText = document.createTextNode('No victim selected.');

        newCell.appendChild(newText);
    }

    $( document ).on('click', '.select_victim_for_attachment', function () {

        // Empty destination table body
        $('#selected_victims_for_attachment').find('tbody').html('');

        // Declare table variable
        var available_victims_for_attachment = $('#available_victims_for_attachment');

        if (available_victims_for_attachment.find('input:checkbox:checked').length > 0) {

            available_victims_for_attachment.find('input:checkbox:checked').each(function(){
                addRow($(this).closest('tr').find('td').eq(1).html(), $(this).closest('tr').find('td').eq(2).html(), $(this).closest('tr').find('td').eq(3).find('input:text').val());
                //console.log($(this).closest('tr').find('td').eq(2).html());
            });

        }else {
            no_victim_select();
        }

    });

    $( document).on('click', '.remove_selected_victim', function(){

        var case_id = $(this).closest('tr').find('td').eq(0).html();

        // Declare table variable
        var available_victims_for_attachment = $('#available_victims_for_attachment');

        if (available_victims_for_attachment.find('input:checkbox:checked').length > 0) {

            available_victims_for_attachment.find('input:checkbox:checked').each(function(){
                if ($(this).closest('tr').find('td').eq(1).html() == case_id) {
                    $(this).removeAttr('checked');
                    if (available_victims_for_attachment.find('input:checkbox:checked').length < 1) {
                        $('#selected_victims_for_attachment').find('tbody').html('')
                        no_victim_select();
                    }
                }
            });

        }else {
            if (available_victims_for_attachment.find('input:checkbox:checked').length < 1) {
                $('#selected_victims_for_attachment').find('tbody').html('')
                no_victim_select();
            }
        }

        $(this).closest('tr').remove();

    });

    //load_notifications();
    function load_notifications(){
        $.ajax({
            url: "/notifications",
            cache: false,
            success: function(responses){
                //$("#results").append(html);
                $('.dropdown-menu.notification li').remove()
                $('div.notify-arrow.notify-arrow-yellow').remove()
                $('.dropdown-menu.notification').append(
                    "<div class='notify-arrow notify-arrow-yellow'></div>"+
                        "<li>"+
                        "<p class='yellow'>You have <span class='your-notifications'>"+responses.length+"</span> new notifications</p>"+
                        "</li>"
                )

                $.each( responses, function( i, notification ) {

                    if(i>4) {return false}

                    url = notification.url
                    notf_id = notification.id
                    $('.notification .badge').html(responses.length);
                    if(responses.length>0){
                        $('.your-notifications').html(responses.length);
                    }

                    $('.dropdown-menu.notification').append(
                        "<li>" +
                            "<a class='see-notification' href='javascript:void(0)' onclick='propagate_to_notification(url,notf_id)'>"+
                            "<span class='label label-warning'><i class='fa fa-bell'></i></span> "+
                            "<span>"+notification.subject+"</span>"+
                            " <div class='small italic'>"+notification.created_at+"</div>"+
                            "</a>"+
                            "</li>"
                    );

                });

                $('.dropdown-menu.notification').append(
                    "<li>"+
                        "<a href='/notifications/all'>See all notifications</a>"+
                        "</li>"
                )
            }
        });
    }


    //setInterval(function() {
        load_notifications();
    //}, 1000 * 1);


    $('.addresser').each(function(){
        get_state_and_district('#'+$(this).attr('id'));
    })



    $('.countries select').on('change', function() {
       // alert('ssssss');
        get_state_and_district('#'+$(this).parents('.addresser').attr('id'));
        get_state_and_district('#'+$(this).parents('.addresser-edit').attr('id'));
    })

    function get_state_and_district(element_id){
        //alert($(element_id+' .countries select').val());
        $.ajax({
            url: "/state/list/"+$(element_id+' .countries select').val(),
            cache: false,
            success: function(responses){
                $options = generate_select_options(responses);
                $(element_id+' .states select').find('option')
                    .remove()
                    .end()
                    .append($options);
                $.ajax({
                    url: "/district/list/"+responses[0].id,
                    cache: false,
                    success: function(responses){
                        //console.log(responses);
                        $options = generate_select_options(responses);
                        $(element_id+' .districts select').find('option')
                            .remove()
                            .end()
                            .append($options)
                    }
                });
            }
        });
    }

    $('.states select').on('change', function() {
     // alert(this.value);
        element_id = '#'+$(this).parents('.row').attr('id');
        if(element_id=='#undefined') {
            element_id = '#'+$(this).parents('div[id^="addr"]').attr('id');
            //alert(element_id);
        }

        $.ajax({
            url: "/district/list/"+this.value,
            cache: false,
            success: function(responses){
                //console.log(responses);
                $options = generate_select_options(responses);
                $(element_id+' .districts select').find('option')
                    .remove()
                    .end()
                    .append($options)
            }
        });
    })

    $('.division select').on('change', function() {
       //alert(this.value);
        element_id = '#'+$(this).parents('.row').attr('id');
        $.ajax({
            url: "/district/list/"+this.value,
            cache: false,
            success: function(responses){
                //console.log(responses);
                $options = generate_select_options(responses);
                $(element_id+' .districts select').find('option')
                    .remove()
                    .end()
                    .append($options)
            }
        });
    })




    $(function () {
        $('[data-toggle="popover"]').popover();
    });

    $('[data-toggle="tooltip"]').tooltip();

    if($('.radio-dob').length){
        if(($(".radio-dob input[name='dob']").val()).length > 0 && (($(".radio-age input[name='age_year_part']").val()).length > 0 || ($(".radio-age input[name='age_month_part']").val()).length > 0)) {
            // disable all input fileds related to age
            $(".radio-dob button").attr('disabled', false);
            $(".radio-dob input[name='dob']").attr('disabled', false);
        } else if(($(".radio-age input[name='age_year_part']").val()).length > 0 || ($(".radio-age input[name='age_month_part']").val()).length > 0) {
            // disable all input fileds related to birthday
            $(".radio-age input[name='age_year_part']").attr('disabled', false);
            $(".radio-age input[name='age_month_part']").attr('disabled', false);
        }
        /*else {
            // disable all input fileds related to age information
            $(".radio-dob button").attr('disabled', true);
            $(".radio-dob input[name='dob']").attr('disabled', true);
            $(".radio-age input[name='age_year_part']").attr('disabled', true);
            $(".radio-age input[name='age_month_part']").attr('disabled', true);
        }*/
    }

    // function after selecting the age radio button
    $("input[name='age_select']").on('click', function(){
        if ($("input[name='age_select']:checked").val() == 1) {
            //disable
            $(".radio-age input[name='age_year_part']").val('').attr('disabled', true);
            $(".radio-age input[name='age_month_part']").val('').attr('disabled', true);
            //enable
            $(".radio-dob button").attr('disabled', false);
            $(".radio-dob input[name='dob']").attr('disabled', false);
        }
        else {
            // disable
            $(".radio-dob button").attr('disabled', true);
            $(".radio-dob input[name='dob']").attr('disabled', true).val('');
            // enable
            $(".radio-age input[name='age_year_part']").attr('disabled', false);
            $(".radio-age input[name='age_month_part']").attr('disabled', false);
        }
    });

    if($('.radio-child-dob').length){
        if(($(".radio-child-dob input[name='child_dob']").val()).length > 0 && (($(".radio-child-age input[name='child_age_year_part']").val()).length > 0 || ($(".radio-child-age input[name='child_age_month_part']").val()).length > 0)) {
            // disable all input fileds related to age
            $(".radio-child-dob button").attr('disabled', false);
            $(".radio-child-dob input[name='child_dob']").attr('disabled', false);
        } else if(($(".radio-child-age input[name='child_age_year_part']").val()).length > 0 || ($(".radio-child-age input[name='child_age_month_part']").val()).length > 0) {
            // disable all input fileds related to birthday
            $(".radio-child-age input[name='child_age_year_part']").attr('disabled', false);
            $(".radio-child-age input[name='child_age_month_part']").attr('disabled', false);
        }
    }

    // function after selecting the age radio button
    $("input[name='child_age_select']").on('click', function(){
        if ($("input[name='child_age_select']:checked").val() == 1) {
            //disable
            $(".radio-child-age input[name='child_age_year_part']").val('').attr('disabled', true);
            $(".radio-child-age input[name='child_age_month_part']").val('').attr('disabled', true);
            //enable
            $(".radio-child-dob button").attr('disabled', false);
            $(".radio-child-dob input[name='child_dob']").attr('disabled', false);
        }
        else {
            // disable
            $(".radio-child-dob button").attr('disabled', true);
            $(".radio-child-dob input[name='child_dob']").attr('disabled', true).val('');
            // enable
            $(".radio-child-age input[name='child_age_year_part']").attr('disabled', false);
            $(".radio-child-age input[name='child_age_month_part']").attr('disabled', false);
        }
    });

    if ( $( ".copier" ).length ) {
        $( "input.copier" ).on( "change", function() {
            if(this.checked) {
                for (i = 1; i <= 6; i++) {
                    $('.native'+' .field'+i).val($('.present'+' .field'+i).val());
                    $('.native'+' .field'+i).css({'opacity': '0.5','pointer-events': 'none'})
                }
                $('.native #survivor_native_address').empty().html($('.present #survivor_present_address').html());

                $('.native #survivor_native_address').css({'opacity': '0.5','pointer-events': 'none'})
            }

            else {
                for (i = 1; i <= 6; i++) {
                    $('.native'+' .field'+i).css({'opacity': '1.0','pointer-events': 'all'});
                }
                $('.native #survivor_native_address').css({'opacity': '1.0','pointer-events': 'all'})
            }
            
        });
    }

    if ( $( ".case_filed" ).length ) {
        $( ".case_filed" ).on( "change", function() {
            if(this.checked) {
                $('.case_doc_number').css('display','block');
            }

            else {
                $('.case_doc_number').css('display','none');
            }
        });
    }

    $('a.reply').click(function(){
        $('.reply-block').toggle();
    })

});

function propagate_to_notification(url,notf_id) {
    $.ajax({
        url: '/notifications/'+notf_id,
        cache: false,
        success: function(responses){
            console.log(responses);
            window.location.href = url;
        }
    });
}


function generate_select_options(responses){
    options = '<option value="0">Please Select</option>';
    $.each( responses, function( key, res ) {
        //console.log(res);
        options = options+'<option value="'+res.id+'">'+res.name+'</option>';
        //options = options+'<option value='+responses.id+'>responses.name</option>';
    });

    return options;
}
