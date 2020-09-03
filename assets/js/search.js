$(document).on("click", "#live-pagination .lg-next", function(e){
    var href = $(this).attr("href");
    href = href.split('&');
    var rank = href[0].substring(6, 99);
    var page = href[1].substring(5, 99);
    var i = 0;

    e.stopPropagation(); // 드롭박스 클릭시 다시 올라가는거 방지

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: '?rank='+rank+'&page='+page,
         dataType: 'json',
         success: function(data) {
             var value = '';
             var length = data['liveGallerys']['data'].length;
             var gubun = 0;
             var i = data['rank'];

             $.each(data['liveGallerys']['data'], function(index, item) {
                 if(gubun < 5) {
                     if(gubun % 5 == 0) {
                          value += '<div class="ranking-left">';
                     }
                     value += '<h6>';
                     value += '<a href="gallery/'+item.gallery_link+'" class="badge badge-primary">'+i+'</a>';
                     value += ' <a href="gallery/'+item.gallery_link+'">'+item.gallery_name+'</a>';
                     value += '</h6>';
                     if(gubun % 5 == 4 || length == gubun + 1) {
                         value += '</div>';
                     }
                 }

                 if(gubun > 4) {
                     if(gubun % 5 == 0) {
                          value += '<div class="ranking-right">';
                     }
                     value += '<h6>';
                     value += '<a href="gallery/'+item.gallery_link+'" class="badge badge-primary">'+i+'</a>';
                     value += ' <a href="gallery/'+item.gallery_link+'">'+item.gallery_name+'</a>';
                     value += '</h6>';
                     if(gubun % 5 == 4 || length == gubun + 1) {
                         value += '</div>';
                     }
                 }
                 i ++;
                 gubun ++;
             });

              if(length < 10) {
                  var remainText = '';
                  var remainCnt = 10 - length;
                  if(remainCnt <= 5) {
                      // liveGallerys 오른쪽 공백 채우기
                      value += '<div class="ranking-right">'
                      for(var i = 0; i < remainCnt; i++) {
                          value += '<h6>';
                          value += '<a href="#" class="badge badge-primary"></a>';
                          value += ' <a href="#">&nbsp;</a>';
                          value += '</h6>';
                      }
                      value += '</div>'
                  } else {
                      // LiveGallery 왼쪽 공백 채우기
                      for(var i = 0; i < remainCnt - 5; i ++) {
                          remainText += '<h6>';
                          remainText += '<a href="#" class="badge badge-primary"></a>';
                          remainText += ' <a href="#">&nbsp;</a>';
                          remainText += '</h6>';
                      }
                      // liveGallerys 오른쪽 공백 채우기
                      value += '<div class="ranking-right">'
                      for(var i = 0; i < 5; i++) {
                          value += '<h6>';
                          value += '<a href="#" class="badge badge-primary"></a>';
                          value += ' <a href="#">&nbsp;</a>';
                          value += '</h6>';
                      }
                      value += '</div>'
                  }
              }

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
             pagination += '' + i + '위 - ' + (i+9) + '위</a></b></li>&nbsp;';
             pagination += '</ul></nav>';

             $('#lg-dropdown').html(value);
             $('#live-pagination').html(pagination);
         },
         error:function(request,status,error){
             alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
         }
    });
});
