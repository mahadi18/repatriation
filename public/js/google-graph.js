google.charts.load('visualization', {packages: ['corechart', 'table', 'bar']});
google.charts.setOnLoadCallback(drawChartAge);

function drawChartAge() {


    var data = new google.visualization.DataTable();
    $.ajax({
        url: "/dashboard/rescues-by-age",
        dataType: "json",
        async: false,
        success: function (response) {
            // console.log(response);
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
            if (Object.keys(bangladesh).length >= Object.keys(nepal).length) {
                $.each(bangladesh, function (bdKey, bdValue) {
                    if (bdKey in nepal) {
                        $.each(nepal, function (nKey, nValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    } else {
                        data.addRow([bdKey, bdValue, 0]);
                    }
                });
            } else {
                $.each(nepal, function (nKey, nValue) {
                    if (nKey in bangladesh) {
                        $.each(bangladesh, function (bdKey, bdValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    } else {
                        data.addRow([bdKey, 0, nValue]);
                    }
                });
            }
            var options = {
                title: 'Rescues with different age levels',
                width: 900,
                height: 400,
                chartArea: {width: '60%'},
                colors: ['#006A4E', '#DC143C'],
                isStacked: false,
                hAxis: {
                    title: 'Age Level',
                },
                vAxis: {
                    title: 'Number of Rescues'
                },
                bar: {groupWidth: "85%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_age"));
            chart.draw(data, options);
        }
    });
}

google.charts.setOnLoadCallback(drawChartGender);
function drawChartGender() {
    var data = new google.visualization.DataTable();
    $.ajax({
        url: "/dashboard/rescues-by-gender",
        dataType: "json",
        async: false,
        success: function (response) {
            data.addColumn('string', 'Country');
            data.addColumn('number', 'Male');
            data.addColumn('number', 'Female');
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([key, value.male, value.female]);
            });

            var options = {
                title: 'Rescues by different Gender',
                width: 800,
                height: 400,
                chartArea: {width: '75%'},
                colors: ['#155719', '#EB1B69'],
                isStacked: false,
                hAxis: {
                    title: 'Country',
                },
                vAxis: {
                    title: 'Number of Rescues'
                },
                bar: {groupWidth: "55%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_gender"));
            chart.draw(data, options);
        }
    });
}
