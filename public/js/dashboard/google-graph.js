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
            data.addColumn('number', 'BD');
            data.addColumn('number', 'NP');
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

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                }, 2,
                {
                    calc: "stringify",
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation"
                }
            ]);
            var options = {
                legend: {
                    position: 'top',
                    maxLines: 5,
                    textStyle: {
                        color: 'black',
                        fontSize: 16
                    }
                },
                series: {
                    1: {
                        annotations: {
                            textStyle: {
                                color: 'black',
                                fontSize: 16,
                            },
                            alwaysOutside: true
                        },
                    },
                    0: {
                        annotations: {
                            textStyle: {
                                color: 'black',
                                fontSize: 16,
                            },
                            alwaysOutside: true
                        },
                    }
                },
                title: 'Rescues with different age levels',
                width: 500,
                height: 400,
                chartArea: {left: '15%', width: '80%', height: '75%'},
                colors: ['#006A4E', '#DC143C'],
                isStacked: false,
                titlePosition: 'out',
                axisTitlesPosition: 'out',
                hAxis: {
                    title: 'Age Level',
                    showTextEvery: '1',
                    textPosition: 'out',
                    // slantedText: true,
                    maxAlternation: 1,
                },
                vAxis: {
                    title: 'Number of Rescues',
                    textPosition: 'out',
                    // logScale:true,viewWindowMode: 'explicit',
                    // viewWindow: {
                    //     //max: 180,
                    //     min: 0,
                    // },

                    gridlines: {
                        "count": 10
                    }
                },
                bar: {groupWidth: "85%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_age"));
            chart.draw(view, options);
        }
    });
}

/*Rescues by gender*/
google.charts.setOnLoadCallback(drawChartGender);
function drawChartGender() {
    var data = new google.visualization.DataTable();
    $.ajax({
        url: "/dashboard/rescues-by-gender",
        dataType: "json",
        async: false,
        success: function (response) {
            // console.log(response);
            data.addColumn('string', 'Country');
            data.addColumn('number', 'Male');
            data.addColumn('number', 'Female');
            $.each(response, function (key, value) {
                // console.log(value);
                data.addRow([key, value.male, value.female]);
            });
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2,
                {
                    calc: "stringify",
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation"
                },
            ]);
            var options = {
                title: 'Rescues by different Gender',
                legend: {
                    position: 'top',
                    textStyle: {
                        fontSize: 14
                    },
                    maxLines: 3
                },
                series: {
                    0: {axis: 'Male'}, // Bind series 0 to an axis named 'distance'.
                    1: {axis: 'Female'} // Bind series 1 to an axis named 'brightness'.
                },
                // logScale:true,
                width: 500,
                height: 400,
                chartArea: {width: '70%'},
                colors: ['#155719', '#EB1B69'],
                isStacked: false,
                hAxis: {
                    title: 'Country',
                },
                vAxis: {
                    title: 'Number of Rescues',
                    gridlines: {
                        "count": 10
                    }
                },
                bar: {groupWidth: "55%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_gender"));
            chart.draw(view, options);
        }
    });
}

google.charts.setOnLoadCallback(drawYearWiseRepatriateGraph);
function drawYearWiseRepatriateGraph() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('number', 'BD');
    data.addColumn('number', 'NP');
    $.ajax({
        url: "/dashboard/year-wise-rescues",
        dataType: "json",
        async: false,
        success: function (response) {
            var bangladesh = {};
            var nepal = {};
            // console.log(response);
            res =
            {
                "Bangladesh": {
                    "2016": 5,
                    "2017": 1,
                    "2018": 15
                },
                "Nepal": {
                    "2016": 1,
                    "2019": 10,
                }
            };
            // $.each(response, function (index, value) {
            //
            //     if (index == 'Bangladesh') {
            //         bangladesh = value;
            //     }
            //     if (index == 'Nepal') {
            //         nepal = value;
            //     }
            // });

          // response = response;

            const parse = val => isNaN(val) ? val : Number(val)

            const tablerize = (obj, unique) => {
                const columns = Object.keys(obj)
                const table = [[unique, ...columns]]
                // indexed by the unique key
                const indexed = {}

                // sort by the index
                columns.forEach((key, ii) => {
                    return Object.keys(obj[key]).forEach((prop) => {
                        if (!indexed[prop]) {
                    indexed[prop] = {}
                }
                indexed[prop][ii] = obj[key][prop]
            })
            })

                // add to the output table
                Object.keys(indexed).forEach(key => {
                    table.push([
                        parse(key),
                    // return the value at the key index
                        ...columns.map((k, ii) => parse(indexed[key][ii]) || 0)
            ])
            })
                return table
            }
            table =   tablerize(response, 'Year')
            table.shift()
            $.each(table, function (index, value) {
                data.addRow([value[0].toString(), value[1], value[2]]);
                // console.log(value);
            });
            // console.log(
            //     table
            // )

            // if (Object.keys(bangladesh).length >= Object.keys(nepal).length) {
            //     $.each(bangladesh, function (bdKey, bdValue) {
            //         if (bdKey in nepal) {
            //             $.each(nepal, function (nKey, nValue) {
            //                 if (bdKey == nKey) {
            //                     data.addRow([bdKey.toString(), bdValue, nValue]);
            //                 }
            //             });
            //         } else {
            //             data.addRow([bdKey.toString(), bdValue, 0]);
            //         }
            //     });
            // } else {
            //     $.each(nepal, function (nKey, nValue) {
            //         if (nKey in bangladesh) {
            //             $.each(bangladesh, function (bdKey, bdValue) {
            //                 if (bdKey == nKey) {
            //                     data.addRow([bdKey.toString(), bdValue, nValue]);
            //                 }
            //             });
            //         } else {
            //             data.addRow([bdKey.toString(), 0, nValue]);
            //         }
            //     });
            // }
        }
    });
    // var data = google.visualization.arrayToDataTable([
    //     ['Year', 'banglladesh', 'nepal'],
    //     ['2019', 10, 12],
    //     ['2018', 1, 0],
    //     ['2017', 17, 10],
    //     ['2016', 1, 11],
    //     ['2015', 16, 0],
    // ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2,
        {
            calc: "stringify",
            sourceColumn: 2,
            type: "string",
            role: "annotation"
        }
    ]);

    var options = {
        title: 'Year wise rescued by Country',
        width: 500,
        height: 400,
        legend: {
            position: 'top',
            textStyle: {
                fontSize: 14
            },
            maxLines: 3
        },
        chartArea: { width: '70%'},
        bar: {groupWidth: "85%"},
        colors: ['#006A4E', '#DC143C'],
        vAxis: {title: 'Year of Repatriation'},
        hAxis: {
            title: 'Number of Rescued',
            gridlines: {
                "count":-1
            }
        },
        // seriesType: 'bars',
        // series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_year'));
    chart.draw(view, options);
}