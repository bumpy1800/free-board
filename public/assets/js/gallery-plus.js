$(document).on("click", ".delete", function(){
    var id = $(this).attr("id");
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: '/gallery_cookiedelete/' + id,
         dataType: 'json',
         success: function(data) {
              var recentGallerys = data['list'].split("/");
              console.log(recentGallerys);

              $("#visitlist").html("");
              for(var i = recentGallerys.length-2; i >= 0; i--) {
                  if(i != 0) {
                      $("#visitlist").append("<div class='col'><span>"+ recentGallerys[i] +"</span><button id='"+ i +"' class='delete'>X</button></div><div class='clear'></div>");
                  } else {
                      $("#visitlist").append("<div class='col m-hide'><span>"+ recentGallerys[i] +"</span><button id='"+ i +"' class='delete'>X</button></div><div class='clear'></div>");

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
    id = href[0].substring(4, 99);
    page = href[1].substring(5, 99);

    var i = 0;
    var j = 0;

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: 'gallery?id='+id+'&page='+page,
         dataType: 'json',
         success: function(data) {
              console.log(data['gallerys']);

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
