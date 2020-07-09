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
var pieChart;

var nowMonth = $('.nowMonth').val();
var nowMonthDayCount = $('.nowMonthDayCount').val();

var tabSelectBool = 0;
//var today = $('.today').val();

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/admin_post_stat',
     dataType: 'json',
     data: {
       'nowMonth': nowMonth,
       'statChangeBool': 0,
       'tabSelectBool':tabSelectBool
     },
     success: function(data) {
          //console.log(data['dayAreaChartData']);

          selectAreaChartLabel = data['selectAreaChartLabel'];
          selectAreaChartData = data['selectAreaChartData'];
          selectAreaChartMax = data['selectAreaChartMax'];

          dayAreaChartLabel = data['dayAreaChartLabel'];
          dayAreaChartData = data['dayAreaChartData'];
          dayAreaChartMax = data['dayAreaChartMax'];
          monthBarChartLabel = data['monthBarChartLabel'];
          monthBarChartData = data['monthBarChartData'];
          monthBarChartMax = data['monthBarChartMax'];

          cdayAreaChartLabel = data['cdayAreaChartLabel'];
          cdayAreaChartData = data['cdayAreaChartData'];
          cdayAreaChartMax = data['cdayAreaChartMax'];
          cmonthBarChartLabel = data['cmonthBarChartLabel'];
          cmonthBarChartData = data['cmonthBarChartData'];
          cmonthBarChartMax = data['cmonthBarChartMax'];

          galleryPieChartLabel = data['galleryPieChartLabel'];
          galleryPieChartData = data['galleryPieChartData'];

          gDayAreaChart(dayAreaChartLabel, dayAreaChartData, dayAreaChartMax, 0);
          gMonthBarChart(monthBarChartLabel, monthBarChartData, monthBarChartMax, 0);

          gDayAreaChart(cdayAreaChartLabel, cdayAreaChartData, cdayAreaChartMax, 1);
          gMonthBarChart(cmonthBarChartLabel, cmonthBarChartData, cmonthBarChartMax, 1);

          gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax); //마지막에 와야함

          gGalleryPieChart(galleryPieChartLabel, galleryPieChartData); //카테고리 설정차트
     },
     error: function(data) {
          console.log("error" +data);
     }
});


$('.tab_menu_btn').on('click',function(){
  $('.tab_menu_btn').removeClass('on');
  $(this).addClass('on')
});

$('.tab_menu_btn1').on('click',function(){
  $('.tab_menu_comment').hide();
  $('.tab_menu_post').show();
  tabSelectBool = 0;
  changeMonth();
});

$('.tab_menu_btn2').on('click',function(){
  $('.tab_menu_post').hide();
  $('.tab_menu_comment').show();
  tabSelectBool = 1;
  changeMonth();
});

$('.nowMonth').change(function() { //날짜 선택
  changeMonth();
});

function changeMonth() {
  nowMonth = $('.nowMonth').val();
  $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type: 'post',
       url: '/admin_post_stat',
       dataType: 'json',
       data: {
         'nowMonth': nowMonth,
         'statChangeBool': 1,
         'tabSelectBool':tabSelectBool
       },
       success: function(data) {
            myLineChart.destroy(); //마지막에 그려진  myLineChart를 삭제함
            selectAreaChartLabel = data['selectAreaChartLabel'];
            selectAreaChartData = data['selectAreaChartData'];
            selectAreaChartMax = data['selectAreaChartMax'];
            gSelectAreaChart(selectAreaChartLabel, selectAreaChartData, selectAreaChartMax); //가장 마지막에 myLineChart을 생성하고 destory가 되게 함
       },
       error: function(data) {
            console.log("error" +data);
       }
  });
}

$('.gallery_id').change(function() { //날짜 선택
  var gallery_id = $('.gallery_id').val();
  $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type: 'post',
       url: '/admin_post_stat',
       dataType: 'json',
       data: {
         'gallery_id': gallery_id,
         'statChangeBool': 2
       },
       success: function(data) {
            pieChart.destroy();
            galleryPieChartLabel = data['galleryPieChartLabel'];
            galleryPieChartData = data['galleryPieChartData'];
            gGalleryPieChart(galleryPieChartLabel, galleryPieChartData); //카테고리 설정차트
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

function gDayAreaChart(labels, data, max, gubun) {
  if(gubun == 0) {
    ctx = document.getElementById("gDayAreaChart");
  }
  else {
    ctx = document.getElementById("cDayAreaChart");
  }
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

function gMonthBarChart(labels, data, max, gubun) {
  if(gubun == 0) {
    ctx = document.getElementById("gMonthBarChart");
  }
  else {
    ctx = document.getElementById("cMonthBarChart");
  }
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

function gGalleryPieChart(labels, data) {
  ctx = document.getElementById("pieChart");
  pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745','#f07bdc', '#d96681', '#964059', '#d0671c','#fae477', '#b6c154'],
      }],
    },
  });
}
