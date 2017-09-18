$(function (e) {
    getData('Bangladesh');
    $('#country').on('change', function () {
        $('#organization-cases').dataTable().fnClearTable();
        getData($(this).val())
    });

    function getData(country) {
        $.ajax({
            url: '/dashboard/initiation-by-org?country=' + country,
            dataType: "json",
            async: false,
            type: "GET",
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    $('#organization-cases tbody').append(
                        '<tr><td>'
                        + value.organization
                        + '</td><td>'
                        + value.litigations
                        + '</td></tr>'
                    );
                });

                $('#organization-cases').DataTable({
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