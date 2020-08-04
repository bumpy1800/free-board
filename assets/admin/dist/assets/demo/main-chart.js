// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

$(document).ready(function(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'post',
        url: '/admin',
        dataType: 'json',
        data: {
            'link': 1,
        },
        success: function(data) {
            var dLabel = data['dLabel'];
            var dData = data['dData'];
            var dMax = data['dMax'];
            var mLabel = data['mLabel'];
            var mData = data['mData'];
            var mMax = data['mMax'];

            dayChart(dLabel, dData, dMax);
            monthChart(mLabel, mData, mMax);
        },
        error:function(request,status,error){
            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
});

function dayChart(label, data, max) {
    var ctx = document.getElementById("myAreaChart");
    var dayChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
          label: "방문자수",
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
              maxTicksLimit: 7
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

function monthChart(label, data, max) {
    var ctx = document.getElementById("myBarChart");
    var monthChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: label,
        datasets: [{
          label: "방문자수",
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
