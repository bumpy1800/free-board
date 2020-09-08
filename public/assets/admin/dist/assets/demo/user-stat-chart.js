// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx;
var myLineChart;
var myPieChart;
var color = new Array();

var nowMonth;
var singo_category;

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/admin_user_chart',
     dataType: 'json',
     data: {
       'chartKind': 0
     },
     success: function(data) {
         selectAreaChartLabel = data['selectAreaChartLabel'];
         selectAreaChartData = data['selectAreaChartData'];
         selectAreaChartMax = data['selectAreaChartMax'];

         dayAreaChartLabel = data['dayAreaChartLabel'];
         dayAreaChartData = data['dayAreaChartData'];
         dayAreaChartMax = data['dayAreaChartMax'];
         monthBarChartLabel = data['monthBarChartLabel'];
         monthBarChartData = data['monthBarChartData'];
         monthBarChartMax = data['monthBarChartMax'];

         pieChartLabel = data['pieChartLabel'];
         pieChartData = data['pieChartData'];

         SelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax);
         DayAreaChart(dayAreaChartLabel, dayAreaChartData, dayAreaChartMax);
         MonthBarChart(monthBarChartLabel, monthBarChartData, monthBarChartMax);
         PieChart(pieChartLabel, pieChartData);
     },
     error: function(data) {
          console.log("error" +data);
     }
});

$('.nowMonth').change(function(){ // 날짜 선택
    nowMonth = $('.nowMonth').val();
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/admin_user_chart',
         dataType: 'json',
         data: {
           'chartKind': 1,
           'nowMonth': nowMonth
         },
         success: function(data) {
             myLineChart.destroy();
             selectAreaChartLabel = data['selectAreaChartLabel'];
             selectAreaChartData = data['selectAreaChartData'];
             selectAreaChartMax = data['selectAreaChartMax'];

             SelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax);
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});
function SelectAreaChart(labels, data, max){
    ctx = document.getElementById("SelectAreaChart");
    myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: "가입 수",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
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
// Pie Chart Example
function PieChart(label, data){
     ctx = document.getElementById("pieChart");
     myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: label, //신고 항목
            datasets: [{
              data: data, //신고 수
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745','#f07bdc', '#d96681', '#964059', '#d0671c','#fae477', '#b6c154'],
            }],
          },
        });
}
// Bar Chart Example
function MonthBarChart(labels, data, max){
     ctx = document.getElementById("MonthBarChart");
     myLineChart_m = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: "가입 수",
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

function DayAreaChart(labels, data, max){
    ctx = document.getElementById("DayAreaChart");
    myLineChart_d = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: "가입 수",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
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
              maxTicksLimit: 14
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
