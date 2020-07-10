// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var selectAreaChartLabel;
var selectAreaChartData;
var selectAreaChartMax;

var ctx;
var myLineChart;

var nowMonth = $('.nowMonth').val();
var nowMonthDayCount = $('.nowMonthDayCount').val();

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/admin_visitor_stat_change',
     dataType: 'json',
     data: {
       'nowMonth': nowMonth
     },
     success: function(data) {
          selectAreaChartLabel = data['selectAreaChartLabel'];
          selectAreaChartData = data['selectAreaChartData'];
          selectAreaChartMax = data['selectAreaChartMax'];
          gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax);
     },
     error: function(data) {
          console.log("error" +data);
     }
});

$('.nowMonth').change(function() { //날짜 선택
  nowMonth = $('.nowMonth').val();
  $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type: 'post',
       url: '/admin_visitor_stat_change',
       dataType: 'json',
       data: {
         'nowMonth': nowMonth
       },
       success: function(data) {
            myLineChart.destroy();
            selectAreaChartLabel = data['selectAreaChartLabel'];
            selectAreaChartData = data['selectAreaChartData'];
            selectAreaChartMax = data['selectAreaChartMax'];
            gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax);
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
