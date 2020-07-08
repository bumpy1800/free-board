// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var selectAreaChartLabel;
var selectAreaChartData;
var selectAreaChartMax;
var dayAreaChartLabel;
var dayAreaChartData;
var dayAreaChartMax;

var ctx;
var myLineChart;

var nowMonth = $('.nowMonth').val();
var nowMonthDayCount = $('.nowMonthDayCount').val();
//var today = $('.today').val();

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/admin_gallery_stat',
     dataType: 'json',
     data: {
       'nowMonth': nowMonth,
       'statChangeBool': 0
     },
     success: function(data) {
          console.log(data['dayAreaChartData']);

          dayAreaChartLabel = data['dayAreaChartLabel'];
          dayAreaChartData = data['dayAreaChartData'];
          dayAreaChartMax = data['dayAreaChartMax'];

          monthBarChartLabel = data['monthBarChartLabel'];
          monthBarChartData = data['monthBarChartData'];
          monthBarChartMax = data['monthBarChartMax'];

          selectAreaChartLabel = data['selectAreaChartLabel'];
          selectAreaChartData = data['selectAreaChartData'];
          selectAreaChartMax = data['selectAreaChartMax'];
          gDayAreaChart(dayAreaChartLabel, dayAreaChartData, dayAreaChartMax);
          gMonthBarChart(monthBarChartLabel, monthBarChartData, monthBarChartMax);
          gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax);//가장 마지막에 myLineChart을 생성하고 destory가 되게
     },
     error: function(data) {
          console.log("error" +data);
     }
});

$('.nowMonth').change(function() {
  nowMonth = $('.nowMonth').val();
  $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type: 'post',
       url: '/admin_gallery_stat',
       dataType: 'json',
       data: {
         'nowMonth': nowMonth,
         'statChangeBool': 1
       },
       success: function(data) {
            myLineChart.destroy(); //마지막에 생성된 myLineChart를 삭제함
            selectAreaChartLabel = data['selectAreaChartLabel'];
            selectAreaChartData = data['selectAreaChartData'];
            selectAreaChartMax = data['selectAreaChartMax'];
            gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax); //가장 마지막에 myLineChart을 생성하고 destory가 되게 함
       },
       error: function(data) {
            console.log("error" +data);
       }
  });
});

function gSelectAreaChart(labels, data, max) {
  ctx = document.getElementById("gSelectAreaChart");
  myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: "개설 수",
        lineTension: 0.3,
        backgroundColor: "rgba(0, 253, 0, 0.2)",
        borderColor: "rgba(0, 253, 0, 1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(0, 253, 0, 1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(0, 253, 0, 1)",
        pointHitRadius: 50,
        pointBorderWidth: 0,
        data: data,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 31
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max,
            maxTicksLimit: 5
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}

function gDayAreaChart(labels, data, max) {
  ctx = document.getElementById("gDayAreaChart");
  myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: "개설 수",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: data,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 13
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max,
            maxTicksLimit: 5
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}

function gMonthBarChart(labels, data, max) {
  ctx = document.getElementById("gMonthBarChart");
  myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: "개설 수",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: data,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}
