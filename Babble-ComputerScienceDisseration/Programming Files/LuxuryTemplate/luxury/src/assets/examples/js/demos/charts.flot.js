$(function() {
  var colors = {
    primary   : "#9FA8DA",
    success   : "#A5D6A7",
    info      : "#80DEEA",
    warning   : "#FFE082",
    danger    : "#EF9A9A",
    faded     : '#EEEEEE'
  };


  /*
  * Realtime Chart Example
  */
  !function() {
    var data = [],
      totalPoints = 300;
    function getRandomData() {
      if (data.length > 0)
        data = data.slice(1);
      // Do a random walk

      while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50,
          y = prev + Math.random() * 10 - 5;

        if (y < 0) {
          y = 0;
        } else if (y > 100) {
          y = 100;
        }

        data.push(y);
      }

      var res = [];
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }
      return res;
    }

    var plot = $.plot("#flot-realtime", [ getRandomData() ], {
      series: {
        shadowSize: 0,
        lines: {
          lineWidth: 0,
          fill: true,
          fillColor: colors.faded
        }
      },
      yaxis: {
        min: 0,
        max: 100
      },
      xaxis: {
        show: false
      },
      grid: { show: true, borderWidth: 0, color: colors.faded }
    });

    !function update() {
      plot.setData([getRandomData()]);
      plot.draw();
      setTimeout(update, 30);
    }();
  }(),


  /*
  * Line Chart Examples
  */
  function() {
    var d1 = [], d2 = [];
    for (var i = 0; i < 14; i += 0.5) {
      d1.push([i, Math.sin(i)]);
    }

    for (var i = 0; i < 14; i += 0.5) {
      d2.push([i, Math.sin(i)]);
    }

    $.plot("#flot-line-basic", [d1], {
      series: {
        lines:{ show: true, fill: false }
      },
      colors: [colors.faded],
      grid: { show: true, borderWidth: 0, color: colors.faded },
    });

    $.plot("#flot-line-area",
      [{
          data: d1,
          lines: {
            lineWidth: 0,
            show: true,
            fill: true,
            fillColor: colors.faded
          }
        }, {
          data: d2,
          lines: {
            lineWidth: 0,
            show: true,
            fill: true,
            fillColor: colors.faded
          },
        }
      ], {
      series: {
        
      },
      grid: { show: true, borderWidth: 0, color: colors.faded },
    });
  }(),


  /*
  * Pie Chart examples
  */
  function() {
    function labelFormatter(label, series) {
      return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

    var data = [], series = 3;
    for (var i = 0; i < series; i++) {
      data[i] = {
        label: "Series" + (i + 1),
        data: Math.floor(Math.random() * 100) + 1
      }
    }

    // Pie 1 - Default pie chart
    $.plot($('#flot-pie-1'), data, {
      series: { pie: { show: true } },
      colors: [colors.primary, colors.faded, colors.warning]
    });

    // Pie 2 - Combined Slice
    $.plot($('#flot-pie-2'), data, {
      series: {
        pie: { 
          show: true,
          combine: {
            color: "#999",
            threshold: 0.05
          }
        }
      },
      legend: { show: false },
      colors: [colors.primary, colors.faded, colors.warning]
    });

    // Pie 3 - Custom Label Formatter
    $.plot($('#flot-pie-3'), data, {
      series: {
        pie: { 
          show: true,
          radius: 1,
          label: {
            show: true,
            radius: 1,
            formatter: labelFormatter,
            background: {
              opacity: 0.8
            }
          }
        }
      },
      legend: { show: false },
      colors: [colors.primary, colors.faded, colors.warning]
    });

    // Pie 4 - Rectangular Pie
    $.plot('#flot-pie-4', data, {
      series: {
        pie: { 
          show: true,
          radius: 500,
          label: {
            show: true,
            formatter: labelFormatter,
            threshold: 0.1
          }
        }
      },
      legend: { show: false },
      colors: [colors.primary, colors.faded, colors.warning]
    });

    // Pie 5 - Donut Hole
    $.plot($('#flot-pie-5'), data, {
      series: {
        pie: { 
          innerRadius: 0.5,
          show: true
        }
      },
      colors: [colors.primary, colors.faded, colors.warning]
    });

    // Pie 6 - Interactivity
    $.plot($('#flot-pie-6'), data, {
      series: {
        pie: { 
          show: true
        }
      },
      grid: {
        hoverable: true,
        clickable: true
      },
      colors: [colors.primary, colors.faded, colors.warning]
    });
  }(),


  /*
  * Bar Chart Examples
  */
  function() {
    var d1 = [], d2 = [], d3 = [];
    for (var i = 0; i <= 6; i += 1) {
      d1.push([i, parseInt(Math.random() * 30)]);
    }

    for (var i = 0; i <= 6; i += 1) {
      d2.push([i, parseInt(Math.random() * 30)]);
    }

    for (var i = 1; i <= 6; i += 1) {
      d3.push([parseInt(Math.random() * 30), i]);
    }

    $.plot("#flot-bar-basic", [ d1 ], {
      series: {
        stack: false,
        bars: {
          show: true,
          barWidth: 0.55,
          lineWidth: 0
        }
      },
      grid: { show: true, borderWidth: 0, color: colors.faded },
      colors: [colors.primary]
    });

    // bar horizontal
    $.plot("#flot-bar-horizontal", [ d3 ], {
      series: {
        stack: true,
        bars: {
          show: true,
          barWidth: 0.55,
          lineWidth: 0,
          horizontal: true
        }
      },
      grid: { show: true, borderWidth: 0, color: colors.faded },
      colors: [colors.primary]
    });

    // bar Categories
    var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]];
    $.plot("#flot-bar-categories", [ data ], {
      series: {
        bars: {
          show: true,
          lineWidth: 0,
          barWidth: 0.55,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      },
      grid:{ show: true, borderWidth: 0, color: colors.faded },
      colors: [colors.warning]
    });

    // bar stacked
    $.plot("#flot-bar-stacked", [ d1, d2 ], {
      series: {
        stack: false,
        bars: {
          show: true,
          barWidth: 0.55,
          lineWidth: 0
        }
      },
      grid: { show: true, borderWidth: 0, color: colors.faded },
      colors: [colors.warning, colors.danger]
    });
  }();
});