// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var chartLabel;
var chartData;
var dataSum = 0;
var progress = [];
var bgColor = ['#007bff', '#dc3545', '#ffc107', '#28a745','#f07bdc', '#d96681', '#964059', '#d0671c','#fae477', '#b6c154'];

var ctx;
var pieChart;

var nowMonth = $('.nowMonth').val();
var nowMonthDayCount = $('.nowMonthDayCount').val();

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/admin_visitor_refer_stat',
     dataType: 'json',
     data: {
       'nowMonth': nowMonth
     },
     success: function(data) {
       chartLabel = data['chartLabel'];
       chartData = data['chartData'];
       gPieChart(chartLabel, chartData);
       for(var i = 0; i < chartData.length; i++) {
         dataSum += chartData[i];
       }
       for(var i = 0; i < chartData.length; i++) {
          progress[i] = chartData[i]/dataSum*100;
          $(".progresses").append("<h6>"+ chartLabel[i] +"</h6><div class='progress' style='margin-bottom: 5px;'><div class='progress-bar' role='progressbar' style='background-color:" + bgColor[i] + "; width: " + progress[i] + "%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>" + progress[i] + "%</div></div>");
       }
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
       url: '/admin_visitor_refer_stat',
       dataType: 'json',
       data: {
         'nowMonth': nowMonth
       },
       success: function(data) {
            pieChart.destroy();
            chartLabel = data['chartLabel'];
            chartData = data['chartData'];
            gPieChart(chartLabel, chartData);

            $(".progresses").html("");
            for(var i = 0; i < chartData.length; i++) {
              dataSum += chartData[i];
            }
            for(var i = 0; i < chartData.length; i++) {
               progress[i] = chartData[i]/dataSum*100;
               $(".progresses").append("<h6>"+ chartLabel[i] +"</h6><div class='progress' style='margin-bottom: 5px;'><div class='progress-bar' role='progressbar' style='background-color:" + bgColor[i] + "; width: " + progress[i] + "%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>" + progress[i] + "%</div></div>");
            }
       },
       error: function(data) {
            console.log("error" +data);
       }
  });
});

function gPieChart(labels, data) {
  ctx = document.getElementById("pieChart");
  pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: bgColor,
      }],
    },
  });
}
