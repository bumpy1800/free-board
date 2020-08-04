$(document).on("click", "#user_save, #user_security", function(){
    if($(this).val() == 0) {
        $(this).val('1');
    } else {
        $(this).val('0');
    }
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
         url: '?rank='+rank+'&page='+page,
         dataType: 'json',
         success: function(data) {
              var value = '';
              var length = data['liveGallerys']['data'].length;
              i = data['rank'];
              $.each(data['liveGallerys']['data'], function(index, item) {
                  value += '<div class="ranking-left">';
                  value += '<h6>';
                  value += '<a href="gallery/'+item.gallery_link+'" class="badge badge-primary">'+i+'</a>';
                  value += '&nbsp;';
                  value += '<a href="gallery/'+item.gallery_link+'">'+item.gallery_name+'</a>';
                  value += '</h6>';
                  value += '</div>';
                  value += '<div class="clear"></div>';
                  i ++;
              });

              if(length < 10) {
                  for(var i = 0; i < 10-length; i++) {
                      value += '<div class="ranking-left">';
                      value += '<h6>';
                      value += '<a></a>';
                      value += '&nbsp;';
                      value += '<a></a>';
                      value += '</h6>';
                      value += '</div>';
                      value += '<div class="clear"></div>';
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
              pagination += '' + i + '위 - ' + (i+10) + '위</a></b></li>&nbsp;';
              pagination += '</ul></nav>';

              $('#lg-dropdown').html(value);
              $('#live-pagination').html(pagination);
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});
