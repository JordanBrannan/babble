$(function() {
  "use strict";

  var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
  };

  typeof Chart != 'undefined' && (
    function() {
      var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
      };

      var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var config = {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: chartColors.red,
            borderColor: chartColors.red,
            data: [
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor()
            ],
            fill: false,
          }, {
            label: "My Second dataset",
            fill: false,
            backgroundColor: chartColors.blue,
            borderColor: chartColors.blue,
            data: [
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor()
            ],
          }]
        },
        options: {
          responsive: true,
          title:{
            display:true,
            text:'Chart.js Line Chart'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Month'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Value'
              }
            }]
          }
        }
      };

      var ctx = document.getElementById("chartjs-line-1").getContext("2d");
      var myLine = new Chart(ctx, config);

      document.getElementById('randomizeData').addEventListener('click', function() {
        config.data.datasets.forEach(function(dataset) {
          dataset.data = dataset.data.map(function() {
            return randomScalingFactor();
          });
        });

        myLine.update();
      });

      var colorNames = Object.keys(chartColors);
      document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[config.data.datasets.length % colorNames.length];
        var newColor = chartColors[colorName];
        var newDataset = {
          label: 'Dataset ' + config.data.datasets.length,
          backgroundColor: newColor,
          borderColor: newColor,
          data: [],
          fill: false
        };

        for (var index = 0; index < config.data.labels.length; ++index) {
          newDataset.data.push(randomScalingFactor());
        }

        config.data.datasets.push(newDataset);
        myLine.update();
      });

      document.getElementById('addData').addEventListener('click', function() {
        if (config.data.datasets.length > 0) {
          var month = MONTHS[config.data.labels.length % MONTHS.length];
          config.data.labels.push(month);

          config.data.datasets.forEach(function(dataset) {
              dataset.data.push(randomScalingFactor());
          });

          myLine.update();
        }
      });

      document.getElementById('removeDataset').addEventListener('click', function() {
        config.data.datasets.splice(0, 1);
        myLine.update();
      });

      document.getElementById('removeData').addEventListener('click', function() {
        config.data.labels.splice(-1, 1); // remove the label first

        config.data.datets.forEach(function(dataset, datasetIndex) {
          dataset.data.pop();
        });

        myLine.update();
      });
    }(),

    function() {
      var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
      };

      var color = Chart.helpers.color;
      var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: 'Dataset 1',
          backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
          borderColor: chartColors.red,
          borderWidth: 1,
          data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
          ]
        }, {
          label: 'Dataset 2',
          backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
          borderColor: chartColors.blue,
          borderWidth: 1,
          data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
          ]
        }]
      };

      var ctx = document.getElementById("chartjs-bar-1").getContext("2d");
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Bar Chart'
          }
        }
      });
    }(),

    function() {
      var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
      };

      var color = Chart.helpers.color;
      var horizontalBarChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: 'Dataset 1',
          backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
          borderColor: chartColors.red,
          borderWidth: 1,
          data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
          ]
        }, {
          label: 'Dataset 2',
          backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
          borderColor: chartColors.blue,
          data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
          ]
        }]
      };

      var ctx = document.getElementById("chartjs-bar-2").getContext("2d");
      window.myHorizontalBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBarChartData,
        options: {
          elements: {
            rectangle: {
              borderWidth: 2,
            }
          },
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Horizontal Bar Chart'
          }
        }
      });
    }(),

    function() {
      var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
      };

      var config = {
        type: 'pie',
        data: {
          datasets: [{
            data: [
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
            ],
            backgroundColor: [
              chartColors.red,
              chartColors.orange,
              chartColors.yellow,
              chartColors.green,
              chartColors.blue,
            ],
            label: 'Dataset 1'
          }],
          labels: [
            "Red",
            "Orange",
            "Yellow",
            "Green",
            "Blue"
          ]
        },
        options: {
          responsive: true
        }
      };

      var ctx = document.getElementById("chartjs-pie").getContext("2d");
      new Chart(ctx, config);
    }(),

    function() {
      var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
      };

      var config = {
        type: 'doughnut',
        data: {
          datasets: [{
            data: [
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
            ],
            backgroundColor: [
              chartColors.red,
              chartColors.orange,
              chartColors.yellow,
              chartColors.green,
              chartColors.blue,
            ],
            label: 'Dataset 1'
          }],
          labels: [
            "Red",
            "Orange",
            "Yellow",
            "Green",
            "Blue"
          ]
        },
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Doughnut Chart'
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        }
      };

      var ctx = document.getElementById("chartjs-donut").getContext("2d");
      new Chart(ctx, config);
    }(),
    
    function() {
      var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
      };

      var color = Chart.helpers.color;
      var config = {
        type: 'radar',
        data: {
          labels: [["Eating", "Dinner"], ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Cycling", "Running"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: color(chartColors.red).alpha(0.2).rgbString(),
            borderColor: chartColors.red,
            pointBackgroundColor: chartColors.red,
            data: [
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor()
            ]
          }, {
            label: "My Second dataset",
            backgroundColor: color(chartColors.blue).alpha(0.2).rgbString(),
            borderColor: chartColors.blue,
            pointBackgroundColor: chartColors.blue,
            data: [
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor(), 
              randomScalingFactor()
            ]
          },]
        },
        options: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Radar Chart'
          },
          scale: {
            ticks: {
            beginAtZero: true
            }
          }
        }
      };
      
      new Chart(document.getElementById("chartjs-radar"), config);
    }(),

    function() {
      var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
      };
      var color = Chart.helpers.color;
      var config = {
        data: {
          datasets: [{
            data: [
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
            ],
            backgroundColor: [
              color(chartColors.red).alpha(0.5).rgbString(),
              color(chartColors.orange).alpha(0.5).rgbString(),
              color(chartColors.yellow).alpha(0.5).rgbString(),
              color(chartColors.green).alpha(0.5).rgbString(),
              color(chartColors.blue).alpha(0.5).rgbString(),
            ],
            label: 'My dataset' // for legend
          }],
          labels: [
            "Red",
            "Orange",
            "Yellow",
            "Green",
            "Blue"
          ]
        },
        options: {
          responsive: true,
          legend: {
            position: 'right',
          },
          title: {
            display: true,
            text: 'Chart.js Polar Area Chart'
          },
          scale: {
            ticks: {
            beginAtZero: true
            },
            reverse: false
          },
          animation: {
            animateRotate: false,
            animateScale: true
          }
        }
      };

      var ctx = document.getElementById("chartjs-polar-area");
      Chart.PolarArea(ctx, config);
    }()
  );
});