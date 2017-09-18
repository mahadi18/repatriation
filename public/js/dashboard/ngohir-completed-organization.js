$(function (e) {
    getData(1);
    $('#country_id').on('change', function () {
        $('#ngohr-time-duration-table').dataTable().fnClearTable();
        console.log($(this).val())
        getData($(this).val())
    });

    function getData(country_id) {
        $.ajax({
            url: '/dashboard/organization-with-ngohr?country_id=' + country_id,
            dataType: "json",
            // async: false,
            type: "GET",
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    $('#ngohr-time-duration-table tbody').append(
                        '<tr>' +
                        '<td>' + value.name + '</td>' +
                        '<td>' + value.totalNgoHr + '</td>'+
                        '<td>' + value.nationality + '</td>'+
                        '<td>' + value.mintime + '</td>'+
                        '<td>' + value.maxtime + '</td>'+
                        '<td>' + value.avgtime + '</td>'+
                        '</tr>'
                    );
                });

                $('#ngohr-time-duration-table').DataTable({
                    "searching": false,
                    "ordering": false,
                    "paging": false,
                    "responsive": true,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bLengthChange": false,
                    "iDisplayLength": 6,
                    "bScrollCollapse": true,
                    "bDestroy": true,
                    "bRetrieve": false,
                    "autoWidth": false,
                    bAutoWidth : false,
                    "fnInitComplete": function () {
                        this.css("visibility", "visible");
                    }
                });
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
});