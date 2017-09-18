google.charts.load('current', {packages: ['corechart', 'table', 'bar']});
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
    var dataTable = new google.visualization.DataTable();
    var data = new google.visualization.DataTable();
    var jsonData = $.ajax({
        url: "/dashboard/rescues-by-age",
        dataType: "json",
        async: false,
        success: function (response) {
            console.log(response)
            data.addColumn('string', 'Age-group');
            data.addColumn('number', 'Bangladesh');
            data.addColumn('number', 'Nepal');
            // data.addColumn({type: 'string', role: 'style'});
            var bangladesh = {};
            var nepal = {};
            var temp = {};
            $.each(response, function (index, value) {
                if (index == 'Bangladesh') {
                    bangladesh = value;
                }
                if (index == 'Nepal') {
                    nepal = value;
                }
            });

            console.log(Object.keys(bangladesh).length);
            console.log(Object.keys(nepal).length);
            // console.log(nepal.size());
            console.log(bangladesh);
            console.log(nepal);
            if (Object.keys(bangladesh).length >= Object.keys(nepal).length) {
                $.each(bangladesh, function (bdKey, bdValue) {
                    if (bdKey in nepal) {
                        $.each(nepal, function (nKey, nValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    }
                    else {
                        data.addRow([bdKey, bdValue, 0]);
                    }
                });
            }
            else {
                $.each(nepal, function (nKey, nValue) {
                    if (nKey in bangladesh) {
                        $.each(bangladesh, function (bdKey, bdValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    }
                    else {
                        data.addRow([bdKey, 0, nValue]);
                    }
                });
            }
            var options = {
                title: 'Rescues with different ages',
                chartArea: {width: '50%'},
                colors: ['#b0120a', '#ffab91'],
                isStacked: false,
                hAxis: {
                    title: 'Age',
                    minValue: 0
                },
                vAxis: {
                    title: 'Number of Rescues'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_age"));
            chart.draw(data, options);
        }
    });
}
//end of drawchart()