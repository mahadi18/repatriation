var Script = function () {

    //morris chart

    $(function () {
      // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
      var tax_data = [
           {"period": "2011 Q3", "licensed": 3407, "sorned": 660},
           {"period": "2011 Q2", "licensed": 3351, "sorned": 629},
           {"period": "2011 Q1", "licensed": 3269, "sorned": 618},
           {"period": "2010 Q4", "licensed": 3246, "sorned": 661},
           {"period": "2009 Q4", "licensed": 3171, "sorned": 676},
           {"period": "2008 Q4", "licensed": 3155, "sorned": 681},
           {"period": "2007 Q4", "licensed": 3226, "sorned": 620},
           {"period": "2006 Q4", "licensed": 3245, "sorned": null},
           {"period": "2005 Q4", "licensed": 3289, "sorned": null}
      ];
      // Morris.Line({
      //   element: 'hero-graph',
      //   data: tax_data,
      //   xkey: 'period',
      //   ykeys: ['licensed', 'sorned'],
      //   labels: ['Licensed', 'Off the road'],
      //   lineColors:['#8075c4','#6883a3']
      // });

      Morris.Donut({
        element: 'hero-donut',
        data: [
          {label: 'Completed', value: 25 },
          {label: 'In Progress', value: 40 },
          {label: 'Unassigned', value: 25 },
          {label: 'Critical', value: 10 }
        ],
          colors: ['#41cac0', '#49e2d7', '#34a39b', '#FF6C60'],
        formatter: function (y) { return y + "%" }
      });

      // Morris Donut Chart
      Morris.Donut({
        element: 'hero-donut-1',
        data: [
          {label: 'Live', value: 25 },
          {label: 'Unresolved', value: 40 },
          {label: 'Critical', value: 25 },
          {label: 'Completed', value: 10 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });
      
      // Morris Donut Chart
      Morris.Donut({
        element: 'hero-donut-2',
        data: [
          {label: 'Live', value: 42 },
          {label: 'Unresolved', value: 37 },
          {label: 'Critical', value: 13 },
          {label: 'Completed', value: 8 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });
      
      Morris.Donut({
        element: 'hero-donut-3',
        data: [
          {label: 'Live', value: 22 },
          {label: 'Unresolved', value: 13 },
          {label: 'Critical', value: 37 },
          {label: 'Completed', value: 28 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });
      
      
      Morris.Donut({
        element: 'hero-donut-4',
        data: [
          {label: 'Live', value: 42 },
          {label: 'Unresolved', value: 37 },
          {label: 'Critical', value: 13 },
          {label: 'Completed', value: 8 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });
      
      
      Morris.Donut({
        element: 'hero-donut-5',
        data: [
          {label: 'Live', value: 29 },
          {label: 'Unresolved', value: 34 },
          {label: 'Critical', value: 26 },
          {label: 'Completed', value: 11 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });
      
      
      Morris.Donut({
        element: 'hero-donut-6',
        data: [
          {label: 'Live', value: 19 },
          {label: 'Unresolved', value: 31 },
          {label: 'Critical', value: 37 },
          {label: 'Completed', value: 13 }
        ],
        colors: ["#57C8F2", "#F8D347", "#FF6C60",  "#6CCA9C"],
        formatter: function (y) { return y + " cases" }
      });

      Morris.Area({
        element: 'hero-area',
        data: [
          {period: '2010 Q1', Rescued: 2666, Repatriated: null},
          {period: '2010 Q2', Rescued: 2778, Repatriated: 2294},
          {period: '2010 Q3', Rescued: 4912, Repatriated: 1969},
          {period: '2010 Q4', Rescued: 3767, Repatriated: 3597},
          {period: '2011 Q1', Rescued: 6810, Repatriated: 1914},
          {period: '2011 Q2', Rescued: 5670, Repatriated: 4293},
          {period: '2011 Q3', Rescued: 4820, Repatriated: 3795},
          {period: '2011 Q4', Rescued: 15073, Repatriated: 5967},
          {period: '2012 Q1', Rescued: 10687, Repatriated: 4460},
          {period: '2012 Q2', Rescued: 8432, Repatriated: 5713}
        ],

          xkey: 'period',
          ykeys: ['Rescued', 'Repatriated'],
          labels: ['Rescued', 'Repatriated'],
          hideHover: 'auto',
          lineWidth: 1,
          pointSize: 5,
          lineColors: ['#4a8bc2', '#ff6c60'],
          fillOpacity: 0.5,
          smooth: true
      });

      // Morris.Bar({
      //   element: 'hero-bar',
      //   data: [
      //     {device: 'iPhone', geekbench: 136},
      //     {device: 'iPhone 3G', geekbench: 137},
      //     {device: 'iPhone 3GS', geekbench: 275},
      //     {device: 'iPhone 4', geekbench: 380},
      //     {device: 'iPhone 4S', geekbench: 655},
      //     {device: 'iPhone 5', geekbench: 1571}
      //   ],
      //   xkey: 'device',
      //   ykeys: ['geekbench'],
      //   labels: ['Geekbench'],
      //   barRatio: 0.4,
      //   xLabelAngle: 35,
      //   hideHover: 'auto',
      //   barColors: ['#6883a3']
      // });

      new Morris.Line({
        element: 'examplefirst',
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value'],
        data: [
          {year: '2008', value: 20},
          {year: '2009', value: 10},
          {year: '2010', value: 5},
          {year: '2011', value: 5},
          {year: '2012', value: 20}
        ]
      });

      $('.code-example').each(function (index, el) {
        eval($(el).text());
      });
    });

}();




