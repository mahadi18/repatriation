google.charts.load('visualization', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStateWiseRepatriateGraphBD);
function drawStateWiseRepatriateGraphBD() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'State');
    data.addColumn('number', 'Rescued');
    // data.addColumn('number', 'NP');
    $.ajax({
        url: "/dashboard/state-wise-repatriate?country_id=" + 1,
        dataType: "json",
        async: false,
        success: function (response) {
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([value.state, value.rescues]);
            });

            var options = {
                // title: 'Repatriation of Bangladesh',
                chartArea: {left: 20, top: 50, width: "85%", height: "65%"},
                legend: {alignment: "center", position: "labeled"},
                toolip: {text: "both"},
                pieSliceText: "value",
                pieHole: 0,
                width: 500,
                height: 400,
                sliceVisibilityThreshold: 0
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart-bangladesh-repatriate'));
            chart.draw(data, options);
        }
    });
}

google.charts.setOnLoadCallback(drawStateWiseRepatriateGraphNP);
function drawStateWiseRepatriateGraphNP() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'State');
    data.addColumn('number', 'Rescued');
    // data.addColumn('number', 'NP');
    $.ajax({
        url: "/dashboard/state-wise-repatriate?country_id=" + 3,
        dataType: "json",
        async: false,
        success: function (response) {
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([value.state, value.rescues]);
            });

            var options = {
                // title: 'Repatriation of Nepal',
                width: 500,
                height: 400,
                chartArea: {left: 20, top: 50, width: "75%", height: "55%"},
                legend: {alignment: "center", position: "labeled"},
                toolip: {text: "both"},
                pieSliceText: "value",
                pieHole: 0,
                sliceVisibilityThreshold: 0

            };

            var chart = new google.visualization.PieChart(document.getElementById('chart-nepal-repatriate'));
            chart.draw(data, options);
        }
    });
}
google.charts.setOnLoadCallback(drawStateWiseRescuesGraphBD);
function drawStateWiseRescuesGraphBD() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'State');
    data.addColumn('number', 'Rescued');
    // data.addColumn('number', 'NP');
    $.ajax({
        url: "/dashboard/state-wise-rescues?country_id=" + 1,
        dataType: "json",
        async: false,
        success: function (response) {
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([value.state, value.rescues]);
            });

            var options = {
                // title: 'Repatriation of Bangladesh',
                chartArea: {left: 20, top: 50, width: "85%", height: "65%"},
                legend: {alignment: "center", position: "labeled"},
                toolip: {text: "both"},
                pieSliceText: "value",
                pieHole: 0,
                width: 500,
                height: 400,
                sliceVisibilityThreshold: 0
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart-bangladesh'));
            chart.draw(data, options);
        }
    });
}

google.charts.setOnLoadCallback(drawStateWiseRescuesGraphNP);
function drawStateWiseRescuesGraphNP() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'State');
    data.addColumn('number', 'Rescued');
    // data.addColumn('number', 'NP');
    $.ajax({
        url: "/dashboard/state-wise-rescues?country_id=" + 3,
        dataType: "json",
        async: false,
        success: function (response) {
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([value.state, value.rescues]);
            });

            var options = {
                // title: 'Repatriation of Nepal',
                width: 500,
                height: 400,
                chartArea: {left: 20, top: 50, width: "75%", height: "55%"},
                legend: {alignment: "center", position: "labeled"},
                toolip: {text: "both"},
                pieSliceText: "value",
                pieHole: 0,
                sliceVisibilityThreshold: 0

            };

            var chart = new google.visualization.PieChart(document.getElementById('chart-nepal'));
            chart.draw(data, options);
        }
    });
}