var rank = 0;
var changeData = [];
var length;

function liveGalleryChange(){
    var change_box = $("#change_rank, .change_name");
    change_box.fadeOut('fast', change());
    change_box.fadeIn(1000);
};

function change() {
    if(rank >= length) {
        rank = 0;
    }
    $("#change_rank").html(rank + 1);
    $(".change_name").html(changeData[rank]);
    rank ++;
}

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'get',
     url: 'gallery?changeGallery=1',
     dataType: 'json',
     success: function(data) {
          var i = 0;
          $.each(data['liveChanges']['data'], function(index, item) {
              changeData[i] = item.gallery_name;
              i ++;
          });
          length = changeData.length;
          $("#change_rank").html(rank + 1);
          $(".change_name").html(changeData[rank]);
          rank ++;
     },
     error: function(data) {
          console.log("error" +data);
     }
});
setInterval('liveGalleryChange()', 3000);

$(document).on("click", ".delete", function(){
    var id = $(this).attr("id");
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: '/gallery_cookiedelete/' + id,
         dataType: 'json',
         success: function(data) {
              var recentGallerys = data['list'].split("/");
              $("#visitlist").html("");
              for(var i = recentGallerys.length-2; i >= 0; i--) {
                  if(i != 0) {
                      $("#visitlist").append("<div class='col'><span>"+ recentGallerys[i] +"</span><button id='"+ i +"' class='delete'><i class='fas fa-times grey'></i></button></div><div class='clear'></div>");
                  } else {
                      $("#visitlist").append("<div class='col m-hide'><span>"+ recentGallerys[i] +"</span><button id='"+ i +"' class='delete'><i class='fas fa-times grey'></i></button></div><div class='clear'></div>");

                  }
              }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$(document).on("click", "#next, #prev", function(){
    var href = $(this).attr("href");
    href = href.split('&');
    var id = href[0].substring(4, 99);
    var page = href[1].substring(5, 99);

    var i = 0;
    var j = 0;

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: 'gallery?id='+id+'&page='+page,
         dataType: 'json',
         success: function(data) {
              var value = '<thead><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead>';
              $.each(data['gallerys']['data'], function(index, item) {
                  if(i % 70 == 0) {
                      value += '<tr>';
                  }
                  if(j % 10 == 0) {
                      value += '<td width="14.2%">';
                  }
                  value += '<h6><a href="gallery/'+ item.link +'">'+ item.name +'</a></h6>';

                  if(j % 10 == 9) {
                      value += '</td>';
                  }
                  if(i % 70 == 69) {
                      value += '</tr>';
                  }
                  i ++;
                  j ++;
              });
              i = 0;
              j = 0;
              $("#table"+data['id']).html("");
              $("#table"+data['id']).append(value);

              var pagination = ''

              pagination = '<nav style="display: inline-block;">';
              pagination += '<ul class="pagination" style="margin-bottom: 0px;">';

              if(data['gallerys']['prev_page_url'] != null) {
                  pagination += '<li class=".prev"><a id="prev" href="'+ data['gallerys']['prev_page_url'] +'" rel="prev" onclick="return false;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>';
              } else {
                  pagination += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></li>';
              }
              pagination += '&nbsp;<li class="currentPage">' + data['gallerys']['current_page'] + '/' + data['gallerys']['last_page'] + '</li>&nbsp;';

              if(data['gallerys']['next_page_url'] != null) {
                  pagination += '<li class=".next"><a id="next" href="' + data['gallerys']['next_page_url'] + '" rel="next" onclick="return false;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
              } else {
                  pagination += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></li>';
                  //pagination += '<li class=".next"><a id="next" href="' + data['gallerys']['next_page_url'] + '" rel="next" onclick="return false;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
              }
              pagination += '</ul></nav>';

              $('#page'+id).html(pagination);


         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$(document).on("click", ".lg-next", function(e){
    var href = $(this).attr("href");
    href = href.split('&');
    var rank = href[0].substring(6, 99);
    var page = href[1].substring(5, 99);
    var i = 0;

    e.stopPropagation(); // 드롭박스 클릭시 다시 올라가는거 방지

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: 'gallery?rank='+rank+'&page='+page,
         dataType: 'json',
         success: function(data) {
              var value = '';
              var liveArr = [];
              i = data['rank'];
              $.each(data['liveGallerys']['data'], function(index, item) {
                  value += '<a class="dropdown-item badge-drop-a" href="' + item.gallery_link + '">';
                  value += '<span class="badge badge-cg-live badge-in">' + i + '</span>' + item.gallery_name;
                  value += '</a>';
                  liveArr[""+ i +""] = item.gallery_name;
                  i ++;
              });

              var pagination = ''
              pagination += '<nav style="display: inline-block; margin-right: 10px;">';
              pagination += '<ul class="pagination" style="margin-bottom: 0px;">';

              i = Number(data['rank']) + 10;
              if(data['liveGallerys']['next_page_url'] == null) {
                  i = 1;
                  href = data['liveGallerys']['first_page_url'];
              } else {
                  href = data['liveGallerys']['next_page_url'];
              }
              href = href.split('&');
              rank = i;
              page = href[1].substring(5, 99);
              href = '?rank='+ rank +'&page=' + page;
              pagination += '&nbsp;<li><b><a class="lg-next" href="' + href + '" onclick="return false;">';
              pagination += '' + i + '위 - ' + (i+10) + '위</a></b></li>&nbsp;';
              pagination += '</ul></nav>';


              value += '<div class="live-pagination">';
							value += '<div id="live-pagination" style="float: right;">';
							value += pagination;
							value += '</div>';
							value += '<div class="clear"></div>';
							value += '</div>';
              $('#lg-dropdown').html(value);
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: 'week-gallerys',
     dataType: 'json',
     success: function(data) {
         var i = 0;
         var cnt = data['weekGallerys'].length;
         var content = '';
         var title = '';
         var rank = 0;
         $.each(data['weekGallerys'], function(index, item) {
             rank = i + 1;
             if(i % 20 == 0) {
                 if(i == 0) {
                     content += '<ul class="week-gallery-rank">';
                 } else {
                     content += '<ul class="week-gallery-rank week-gallery-rank-next">';
                 }
             }
             content += '<li><a href="gallery/'+ item.gallery_link +'">'+ rank +'. '+ item.gallery_name +'</a></li>';
             if(i % 20 == 19) {
                 content += '</ul>';
             } else if(i == cnt-1) {
                 content += '</ul>';
             }
             i ++;
         });
         title += '<b class="popTitle">주간 흥한갤 전체 순위</b>&nbsp;';
         title += '<small>(전체 갤러리 순위에서 100위 내에 해당될 경우 흥한갤이 됩니다.)</small>';

         $('.allrank').attr("data-original-title",title);
         $('.allrank').attr("data-content",content);
     },
     error: function(data) {
          console.log("error" +data);
     }
});

$(function () {
    $('[data-toggle="popover"]').popover({
        html: true
    })
})
