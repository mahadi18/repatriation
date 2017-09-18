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
            var bangladeshi = {};
            var nepalese = {};
            var temp = {};

            res = {
                "Bangladesh": {
                    "< 12": 45,
                    "12-18": 78,
                    "18-25": 11,
                    "> 25": 11,
                    'total': 145

                },
                "Nepal": {
                    "12-18": 4,
                    "18-25": 2,
                    "> 25": 2,
                    'total': 8

                }
            };
            $.each(response, function (index, value) {
                if (index == 'Bangladesh') {
                    bangladeshi = value;
                }
                if (index == 'Nepal') {
                    nepalese = value;
                }
            });
            if (Object.keys(bangladeshi).length >= Object.keys(nepalese).length) {
                $.each(bangladeshi, function (bdKey, bdValue) {
                    if (bdKey in nepalese) {
                        $.each(nepalese, function (nKey, nValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    } else {
                        data.addRow([bdKey, bdValue, 0]);
                    }
                });
            } else {
                $.each(nepalese, function (nKey, nValue) {
                    if (nKey in bangladeshi) {
                        $.each(bangladeshi, function (bdKey, bdValue) {
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
                    // alignment: 'start',
                    maxLines : 0,
                    alignment :'center',
                    // offsetX: 200,
                    // offsetY: 15,
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
                                fontSize: 12
                            },
                            alwaysOutside: true
                        }
                    },
                    0: {
                        annotations: {
                            textStyle: {
                                color: 'black',
                                fontSize: 12
                            },
                            alwaysOutside: true
                        }
                    }
                },
                // title: 'Gender Wise Distribution',
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
                    maxAlternation: 1
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
            chart.clearChart();
            chart.draw(view, options);
        }
    });
}

google.charts.setOnLoadCallback(drawChartRepatriationByAge);

function drawChartRepatriationByAge() {
    var data = new google.visualization.DataTable();
    $.ajax({
        url: "/dashboard/repatriation-by-age",
        dataType: "json",
        async: false,
        success: function (response) {
            console.log(response);
            data.addColumn('string', 'Age-group');
            data.addColumn('number', 'BD');
            data.addColumn('number', 'NP');
            // data.addColumn({type: 'string', role: 'style'});
            var bangladeshi = {};
            var nepalese = {};
            var temp = {};

            res = {
                "bangladeshi": {
                    "< 12": 45,
                    "12-18": 78,
                    "18-25": 11,
                    "> 25": 11,
                    'total': 145

                },
                "nepalese": {
                    "12-18": 4,
                    "18-25": 2,
                    "> 25": 2,
                    'total': 8

                }
            };
            $.each(response, function (index, value) {
                if (index == 'Bangladesh') {
                    bangladeshi = value;
                }
                if (index == 'Nepal') {
                    nepalese = value;
                }
            });
            if (Object.keys(bangladeshi).length >= Object.keys(nepalese).length) {
                $.each(bangladeshi, function (bdKey, bdValue) {
                    if (bdKey in nepalese) {
                        $.each(nepalese, function (nKey, nValue) {
                            if (bdKey == nKey) {
                                data.addRow([bdKey, bdValue, nValue]);
                            }
                        });
                    } else {
                        data.addRow([bdKey, bdValue, 0]);
                    }
                });
            } else {
                $.each(nepalese, function (nKey, nValue) {
                    if (nKey in bangladeshi) {
                        $.each(bangladeshi, function (bdKey, bdValue) {
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
                    // alignment: 'start',
                    maxLines : 0,
                    alignment :'center',
                    // offsetX: 200,
                    // offsetY: 15,
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
                                fontSize: 12
                            },
                            alwaysOutside: true
                        }
                    },
                    0: {
                        annotations: {
                            textStyle: {
                                color: 'black',
                                fontSize: 12
                            },
                            alwaysOutside: true
                        }
                    }
                },
                // title: 'Rescues with different age levels',
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
                    maxAlternation: 1
                },
                vAxis: {
                    title: 'Number of Repatriation',
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
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_age_repatriate"));
            chart.clearChart();
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
            // res = {
            //     "Bangladesh": {
            //         "male": 55,
            //         "female": 87
            //     },
            //     "Nepal": {
            //         "male": 1,
            //         "female": 20
            //     },
            //     "Total": {
            //         "male": 1,
            //         "female": 107
            //     }
            // };
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
                }
            ]);
            var options = {
                // title: 'Rescues by different Gender',
                legend: {
                    position: 'top',
                    textStyle: {
                        fontSize: 14
                    }
                    // maxLines: 3
                },
                series: {
                    0: {axis: 'Male'}, // Bind series 0 to an axis named 'distance'.
                    1: {axis: 'Female'} // Bind series 1 to an axis named 'brightness'.
                },
                annotations: {
                    // 3: {
                    //     style: 'line'
                    // }
                    // highContrast: true,
                    // textStyle: {
                    //     // auraColor: 'lime',
                    //     color: '#fff',
                    //     fontSize: 12
                    // }
                },
                // logScale:true,
                width: 500,
                height: 400,
                chartArea: {width: '70%'},
                colors: ['#155719', '#EB1B69', '#B69155'],
                isStacked: 'percent',
                hAxis: {
                    // title: 'Country',
                },
                vAxis: {
                    title: 'Number of Rescues',
                    gridlines: {
                        "count": 0
                    },
                    textPosition: 'in'
                },
                bar: {groupWidth: "55%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_gender"));
            chart.draw(view, options);
        }
    });
}
/*
Repatriated Gender
 */
google.charts.setOnLoadCallback(drawChartRepatriatedGender);
function drawChartRepatriatedGender() {
    var data = new google.visualization.DataTable();
    $.ajax({
        url: "/dashboard/repatriation-by-gender",
        dataType: "json",
        async: false,
        success: function (response) {
            // console.log(response);
            // res = {
            //     "Bangladesh": {
            //         "male": 55,
            //         "female": 87
            //     },
            //     "Nepal": {
            //         "male": 1,
            //         "female": 20
            //     },
            //     "Total": {
            //         "male": 1,
            //         "female": 107
            //     }
            // };
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
                }
            ]);
            var options = {
                // title: 'Rescues by different Gender',
                legend: {
                    position: 'top',
                    textStyle: {
                        fontSize: 14
                    }
                    // maxLines: 3
                },
                series: {
                    0: {axis: 'Male'}, // Bind series 0 to an axis named 'distance'.
                    1: {axis: 'Female'} // Bind series 1 to an axis named 'brightness'.
                },
                annotations: {
                    // 3: {
                    //     style: 'line'
                    // }
                    // highContrast: true,
                    // textStyle: {
                    //     // auraColor: 'lime',
                    //     color: '#fff',
                    //     fontSize: 12
                    // }
                },
                // logScale:true,
                width: 500,
                height: 400,
                chartArea: {width: '70%'},
                colors: ['#155719', '#EB1B69', '#B69155'],
                isStacked: 'value',
                hAxis: {
                    // title: 'Country',
                },
                vAxis: {
                    title: 'Number of Repatriation',
                    gridlines: {
                        "count": 0
                    },
                    textPosition: 'out'
                },
                bar: {groupWidth: "55%"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_gender-repatriate"));
            chart.draw(view, options);
        }
    });
}

google.charts.setOnLoadCallback(drawYearWiseRescuesGraph);

function drawYearWiseRescuesGraph() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('number', 'BD');
    data.addColumn('number', 'NP');
    data.addColumn('number', 'Total');
    $.ajax({
        url: "/dashboard/year-wise-rescues",
        dataType: "json",
        async: false,
        success: function (response) {
            // console.log(response);
            $.each(response, function (index, item) {
                data.addRow([item.year.toString(), item.bd, item.nepal, item.total]);
            });
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2, {
                    calc: "stringify",
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation"
                },
                3, {
                    calc: "stringify",
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation"
                }

            ]);

            var options = {
                width: 500,
                height: 400,
                pointSize: 20,
                legend: {
                    position: 'top',
                    textStyle: {
                        fontSize: 14
                    }
                    // maxLines: 3
                },
                series: {
                    0: {
                        color: '#006A4E',
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }, 1: {
                        color: '#DC143C',
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }, 2: {
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }
                },
                chartArea: {
                    width: '65%'
                },
                hAxis: {
                    title: 'Year',
                    colors: ['#006A4E', '#DC143C'],
                    showTextEvery: '1',
                    textPosition: 'out',
                    // slantedText: true,
                    maxAlternation: 1
                },
                vAxis: {
                    title: 'Number of rescues',
                    textPosition: 'out',
                    // logScale:true,viewWindowMode: 'explicit',
                    // viewWindow: {
                    //     //max: 180,
                    //     min: 0,
                    // },
                    colors: ['#006A4E', '#DC143C'],
                    gridlines: {
                        "count": 5
                    }
                },
                //tooltip: {trigger: 'none'},
                annotations: {
                    //alwaysOutside: false,
                }

            };
            // var chart = new google.visualization.BarChart(document.getElementById('chart_year'));
            // chart.draw(view, options);
            var chart = new google.visualization.LineChart(document.getElementById('chart_year'));

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
    data.addColumn('number', 'Total');
    $.ajax({
        url: "/dashboard/year-wise-repatriation",
        dataType: "json",
        async: false,
        success: function (response) {
            // console.log(response);
            $.each(response, function (index, item) {
                data.addRow([item.year.toString(), item.bd, item.nepal, item.total]);
            });
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2, {
                    calc: "stringify",
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation"
                },
                3, {
                    calc: "stringify",
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation"
                }

            ]);

            var options = {
                width: 500,
                height: 400,
                pointSize: 20,
                legend: {
                    position: 'top',
                    textStyle: {
                        fontSize: 14
                    }
                    // maxLines: 3
                },
                series: {
                    0: {
                        color: '#006A4E',
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }, 1: {
                        color: '#DC143C',
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }, 2: {
                        annotations: {
                            textStyle: {
                                fontSize: 12,
                                color: 'red',
                                textAlign: 'center',
                                verticalAlign: 'middle'
                            }
                        }
                    }
                },
                chartArea: {
                    width: '65%'
                },
                hAxis: {
                    title: 'Year',
                    colors: ['#006A4E', '#DC143C'],
                    showTextEvery: '1',
                    textPosition: 'out',
                    // slantedText: true,
                    maxAlternation: 1
                },
                vAxis: {
                    title: 'Number of Repatriation',
                    textPosition: 'out',
                    // logScale:true,viewWindowMode: 'explicit',
                    // viewWindow: {
                    //     //max: 180,
                    //     min: 0,
                    // },
                    colors: ['#006A4E', '#DC143C'],
                    gridlines: {
                        "count": 5
                    }
                },
                //tooltip: {trigger: 'none'},
                annotations: {
                    //alwaysOutside: false,
                }

            };
            // var chart = new google.visualization.BarChart(document.getElementById('chart_year'));
            // chart.draw(view, options);
            var chart = new google.visualization.LineChart(document.getElementById('chart_year-repatriate'));

            chart.draw(view, options);
        }
    });
}