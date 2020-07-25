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

var keyword_cnt = 0;
var id_cnt = 0;
var nick_cnt = 0;
var ip_cnt = 0;
$(document).on("click", "#allblock .button #block-keyword", function(){
    var keyword = $("#allblock .input #block-keyword").val();
    if(keyword == '') {
        return false;
    } else {
        var text = $("#allblock .keyword-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == keyword) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(keyword_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-keyword").val('');
    $("#allblock .keyword-list").append('<li id="'+keyword_cnt+'">'+keyword+' <i id="list-delete" type="button" class="keyword-cnt fas fa-times grey"></i></li>');
    keyword_cnt ++;
});
$(document).on("click", "#allblock .button #block-id", function(){
    var id = $("#allblock .input #block-id").val();
    if(id == '') {
        return false;
    } else {
        var text = $("#allblock .id-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == id) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(id_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-id").val('');
    $("#allblock .id-list").append('<li>'+id+' <i id="list-delete" type="button" class="id-cnt fas fa-times grey"></i></li>');
    id_cnt ++;
});
$(document).on("click", "#allblock .button #block-nick", function(){
    var nick = $("#allblock .input #block-nick").val();
    if(nick == '') {
        return false;
    } else {
        var text = $("#allblock .nick-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == nick) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(nick_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-nick").val('');
    $("#allblock .nick-list").append('<li>'+nick+' <i id="list-delete" type="button" class="nick-cnt fas fa-times grey"></i></li>');
    nick_cnt ++;
});
$(document).on("click", "#allblock .button #block-ip", function(){
    var ip = $("#allblock .input #block-ip").val();
    if(ip == '') {
        return false;
    } else {
        var text = $("#allblock .ip-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == ip) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(ip_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-ip").val('');
    $("#allblock .ip-list").append('<li>'+ip+' <i id="list-delete" type="button" class="ip-cnt fas fa-times grey"></i></li>');
    ip_cnt ++;
});


$(document).on("click", "#galleryblock #gallery-select", function(){
    var name = $("#galleryblock #gallery-name").val();
    if(name == '') {
        return false;
    }
    $("#gallery-list").html('');
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: '/gallery_search/' + name,
         dataType: 'json',
         success: function(data) {
              $.each(data['gallerys'], function(index, item) {
                  $("#gallery-list").append('<li type="button" id="gallery-value">'+item.name+'</li>');
              });
              $("#gallery-list").append('<div class="clear"></div>');
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

var g_keyword_cnt = 0;
var g_id_cnt = 0;
var g_nick_cnt = 0;
var g_ip_cnt = 0;

$(document).on("click", "#galleryblock .button #block-keyword", function(){
    var keyword = $("#galleryblock .input #block-keyword").val();
    if(keyword == '') {
        return false;
    } else {
        var text = $("#galleryblock .keyword-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == keyword) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(g_keyword_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-keyword").val('');
    $("#galleryblock .keyword-list").append('<li id="'+keyword_cnt+'">'+keyword+' <i id="list-delete" type="button" class="g-keyword-cnt fas fa-times grey"></i></li>');
    g_keyword_cnt ++;
});
$(document).on("click", "#galleryblock .button #block-id", function(){
    var id = $("#galleryblock .input #block-id").val();
    if(id == '') {
        return false;
    } else {
        var text = $("#galleryblock .id-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == id) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(g_id_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-id").val('');
    $("#galleryblock .id-list").append('<li>'+id+' <i id="list-delete" type="button" class="g-id-cnt fas fa-times grey"></i></li>');
    g_id_cnt ++;
});
$(document).on("click", "#galleryblock .button #block-nick", function(){
    var nick = $("#galleryblock .input #block-nick").val();
    if(nick == '') {
        return false;
    } else {
        var text = $("#galleryblock .nick-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == nick) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(g_nick_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-nick").val('');
    $("#galleryblock .nick-list").append('<li>'+nick+' <i id="list-delete" type="button" class="g-nick-cnt fas fa-times grey"></i></li>');
    g_nick_cnt ++;
});
$(document).on("click", "#galleryblock .button #block-ip", function(){
    var ip = $("#galleryblock .input #block-ip").val();
    if(ip == '') {
        return false;
    } else {
        var text = $("#galleryblock .ip-list").text();
        var textArr = text.split(' ');
        for(var i = 0; i < textArr.length; i ++) {
            if(textArr[i] == ip) {
                alert("이미 등록된 키워드입니다.");
                return false;
            }
        }
    }
    if(g_ip_cnt > 9) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    $(".input #block-ip").val('');
    $("#galleryblock .ip-list").append('<li>'+ip+' <i id="list-delete" type="button" class="g-ip-cnt fas fa-times grey"></i></li>');
    g_ip_cnt ++;
});

$(document).on("click", "#list-delete", function(){
    $(this).parent().remove();
    if($(this).hasClass("g-keyword-cnt") === true) {
        g_keyword_cnt --;
    } else if($(this).hasClass("g-id-cnt") === true) {
        g_id_cnt --;
    } else if($(this).hasClass("g-nick-cnt") === true) {
        g_nick_cnt --;
    } else if($(this).hasClass("g-ip-cnt") === true) {
        g_ip_cnt --;
    } else if($(this).hasClass("keyword-cnt") === true) {
        keyword_cnt --;
    } else if($(this).hasClass("id-cnt") === true) {
        id_cnt --;
    } else if($(this).hasClass("nick-cnt") === true) {
        nick_cnt --;
    } else if($(this).hasClass("ip-cnt") === true) {
        ip_cnt --;
    }
    if($(this).hasClass("cookie-delete") === true) {
        $("#cookie-delete-gallery").append('<li>'+$(this).parent().text()+'</li>');
    }
});

$(document).on("click", "#gallery-value", function(){
    var text = $(this).text();
    $('#gallery-select-name').html('['+text+']');
    $('#galleryblock input').attr('disabled', false);

    $("#galleryblock .keyword-list").html('');
    $("#galleryblock .id-list").html('');
    $("#galleryblock .nick-list").html('');
    $("#galleryblock .ip-list").html('');

    if($.cookie('['+text+']')) {
        var arr = $.cookie('['+text+']').split('/');
        var gallery_arr = [];
        for(var i = 1; i < arr.length; i++) {
            gallery_arr[i-1] = arr[i].split(' ');
        }

        g_keyword_cnt = gallery_arr[0].length-1;
        g_id_cnt = gallery_arr[1].length-1;
        g_nick_cnt = gallery_arr[2].length-1;
        g_ip_cnt = gallery_arr[3].length-1;
        for(var i = 0; i < gallery_arr[0].length; i++) {
            if(gallery_arr[0][i] != '') {
                var keyword = gallery_arr[0][i];
                $(".input #block-keyword").val('');
                $("#galleryblock .keyword-list").append('<li>'+keyword+' <i id="list-delete" type="button" class="g-keyword-cnt fas fa-times grey"></i></li>');
            }
        }
        for(var i = 0; i < gallery_arr[1].length; i++) {
            if(gallery_arr[1][i] != '') {
                var id = gallery_arr[1][i];
                $(".input #block-id").val('');
                $("#galleryblock .id-list").append('<li>'+id+' <i id="list-delete" type="button" class="g-id-cnt fas fa-times grey"></i></li>');
            }
        }
        for(var i = 0; i < gallery_arr[2].length; i++) {
            if(gallery_arr[2][i] != '') {
                var nick = gallery_arr[2][i];
                $(".input #block-nick").val('');
                $("#galleryblock .nick-list").append('<li>'+nick+' <i id="list-delete" type="button" class="g-nick-cnt fas fa-times grey"></i></li>');
            }
        }
        for(var i = 0; i < gallery_arr[3].length; i++) {
            if(gallery_arr[3][i] != '') {
                var ip = gallery_arr[3][i];
                $(".input #block-ip").val('');
                $("#galleryblock .ip-list").append('<li>'+ip+' <i id="list-delete" type="button" class="g-ip-cnt fas fa-times grey"></i></li>');
            }
        }
    }
});

$(document).on("click", "#block-save", function(){
    var all_keyword = $("#allblock .keyword-list").text();
    var all_id = $("#allblock .id-list").text();
    var all_nick = $("#allblock .nick-list").text();
    var all_ip = $("#allblock .ip-list").text();
    var block_gallery = $('#gallery-select-name').text();

    $.cookie('all_keyword', all_keyword);
    $.cookie('all_id', all_id);
    $.cookie('all_nick', all_nick);
    $.cookie('all_ip', all_ip);

    if(block_gallery != '' && block_gallery != null) {
        var cookie_gallery = $('#cookie-gallery').text();
        var cookie_delete_gallery = $('#cookie-delete-gallery').text();
        var block_keyword = $("#galleryblock .keyword-list").text();
        var block_id = $("#galleryblock .id-list").text();
        var block_nick = $("#galleryblock .nick-list").text();
        var block_ip = $("#galleryblock .ip-list").text();
        var gallery_names = '';
        var gallery = block_gallery + '/' + block_keyword + '/' + block_id + '/' + block_nick + '/' + block_ip;

        if(block_gallery == '[갤러리]') {
            block_gallery = '';
        }

        if(cookie_delete_gallery != '' && cookie_delete_gallery != null) {
            cookie_delete_gallery = cookie_delete_gallery.split(' ');
            gallery_names = $.cookie('gallery_names').split(' ');

            for(var i = 0; i < cookie_delete_gallery.length; i++) {
                $.removeCookie(cookie_delete_gallery[i]);
                for(var j = 0; j < gallery_names.length; j++) {
                    if(cookie_delete_gallery[i] == gallery_names[j]) {
                        gallery_names[j] = '';
                    }
                }
            }
            gallery_names = gallery_names.join(' ');
            $.cookie('gallery_names', gallery_names);
        }

        if($.cookie('gallery_names')) {
            if(block_gallery != '' && $.cookie('gallery_names').indexOf(block_gallery) != -1) {
                gallery_names = $.cookie('gallery_names');
            } else {
                gallery_names = $.cookie('gallery_names') + ' ' + block_gallery;
            }
        } else {
            gallery_names = block_gallery;
        }

        $.cookie('gallery_names', gallery_names);
        $.cookie(block_gallery, gallery);
    }
    location.reload();
});

$(document).on("click", "#blockConfig", function(){
    $("#allblock .keyword-list").html('');
    $("#allblock .id-list").html('');
    $("#allblock .nick-list").html('');
    $("#allblock .ip-list").html('');
    $("#galleryblock #cookie-gallery").html('');

    if($.cookie('all_keyword')) {
        var cookie_all_keyword = $.cookie('all_keyword');
        cookie_all_keyword = cookie_all_keyword.split(" ");
        keyword_cnt = cookie_all_keyword.length-1;
        for(var i = 0; i < cookie_all_keyword.length; i++) {
            if(cookie_all_keyword[i] != '') {
                $("#allblock .keyword-list").append('<li>'+cookie_all_keyword[i]+' <i id="list-delete" type="button" class="keyword-cnt fas fa-times grey"></i></li>');
            }
        }
    }
    if($.cookie('all_id')) {
        var cookie_all_id = $.cookie('all_id');
        cookie_all_id = cookie_all_id.split(" ");
        id_cnt = cookie_all_id.length-1;
        for(var i = 0; i < cookie_all_id.length; i++) {
            if(cookie_all_id[i] != '') {
                $("#allblock .id-list").append('<li>'+cookie_all_id[i]+' <i id="list-delete" type="button" class="id-cnt fas fa-times grey"></i></li>');
            }
        }
    }
    if($.cookie('all_nick')) {
        var cookie_all_nick = $.cookie('all_nick');
        cookie_all_nick = cookie_all_nick.split(" ");
        nick_cnt = cookie_all_nick.length-1;
        for(var i = 0; i < cookie_all_nick.length; i++) {
            if(cookie_all_nick[i] != '') {
                $("#allblock .nick-list").append('<li>'+cookie_all_nick[i]+' <i id="list-delete" type="button" class="nick-cnt fas fa-times grey"></i></li>');
            }
        }
    }
    if($.cookie('all_ip')) {
        var cookie_all_ip = $.cookie('all_ip');
        cookie_all_ip = cookie_all_ip.split(" ");
        ip_cnt = cookie_all_ip.length-1;
        for(var i = 0; i < cookie_all_ip.length; i++) {
            if(cookie_all_ip[i] != '') {
                $("#allblock .ip-list").append('<li>'+cookie_all_ip[i]+' <i id="list-delete" type="button" class="ip-cnt fas fa-times grey"></i></li>');
            }
        }
    }
    if($.cookie('gallery_names')) {
        var gallery_names = $.cookie('gallery_names').split(" ");
        for(var i = 0; i < gallery_names.length; i++) {
            if(gallery_names[i] != '') {
                $("#galleryblock #cookie-gallery").append('<li>'+gallery_names[i]+' <i id="list-delete" type="button" class="cookie-delete fas fa-times grey"></i></li>');
            }
        }
        $("#galleryblock #cookie-gallery").append('<div class="clear"></div>');
    }
});

$(document).on("click", ".link-gallery-top #next, .link-gallery-top #prev", function(e){
    e.preventDefault(); //a태그 이벤트 중지

    var href = $(this).attr("href");
    href = href.split('&');
    var id = href[0].substring(4, 99);
    var page = href[1].substring(5, 99);

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'get',
         url: '/gallery_link_gallery?id='+id+'&page='+page,
         dataType: 'json',
         success: function(data) {
              var content = '';
              var add_link_gallerys_data = data['add_link_gallerys']['data'];
              var pagination = '';
              var prev_page_url = data['add_link_gallerys']['prev_page_url'];
              var next_page_url = data['add_link_gallerys']['next_page_url'];
              var current_page = data['add_link_gallerys']['current_page'];
              var last_page = data['add_link_gallerys']['last_page'];

              pagination += '해당 갤러리를 연관 갤러리로 추가한 갤러리';
              pagination += '<ul class="pagination" style="margin-bottom: 0px;">';
              if(prev_page_url != null) {
                  pagination += '<li class=".prev"><a id="prev" href="'+ prev_page_url +'" rel="prev" onclick="return false;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>';
              } else {
                  pagination += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></li>';
              }
              pagination += '&nbsp;<li class="currentPage">' + current_page + '/' + last_page + '</li>&nbsp;';
              if(next_page_url != null) {
                  pagination += '<li class=".next"><a id="next" href="' + next_page_url + '" rel="next" onclick="return false;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
              } else {
                  pagination += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></li>';
              }
              pagination += '</ul>';

              $.each(add_link_gallerys_data, function(index, item) {
                  content += '<li>'+ item.gallery_name +'</li>';
              });
              content += '<div class="clear"></div>';

              $('.in-page').html(pagination);
              $('.add-gallery').html(content);

         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

function rep_form(id) {
    $('#'+id).html("<div id='rep_box' class='cmt_write_box'> <div class='left'> <div class='user_info_input'> <input type='text' name='name' placeholder='닉네임' value='' maxlength='20'> </div> <div class='user_info_input'> <input type='password' name='password' placeholder='비밀번호' value='' maxlength='20'> </div> </div> <div class='cmt_txt right'> <div class='cmt_write'> <textarea name='content' maxlength='400' placeholder='타인의 권리를 침해하거나 명예를 훼손하는 댓글은 운영원칙 및 관련 법률에 제재를 받을 수 있습니다.&#13;&#10;Shift+Enter 키를 동시에 누르면 줄바꿈이 됩니다.'></textarea> </div> <div class='cmt_txt_bot'> <div class='right'> <button class='btn_save btn_blue' type='submit' name='button'>등록</button> </div> </div> </div> </div>");
    if($('#'+id).css("display") == "none") {
        $('#'+id).show();
    } else {
        $('#'+id).hide();
    }
}

$(document).on("click", "#all-post", function(){
    location.href="?";
});
$(document).on("click", "#concept-post", function(){
    location.href="?head=개념";
});

$(document).on("click", "#good-button", function(){
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/plusGoodPoint',
         dataType: 'json',
         data: {
             'id': $('.view_headtext').attr('id'),
         },
         success: function(data) {
             if(data['status']) {
                 location.reload();
             } else {
                 alert("이미 등록한 게시물 입니다.")
             }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$(document).on("click", "#bad-button", function(){
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/plusBadPoint',
         dataType: 'json',
         data: {
             'id': $('.view_headtext').attr('id'),
         },
         success: function(data) {
             if(data['status']) {
                 location.reload();
             } else {
                 alert("이미 등록한 게시물 입니다.")
             }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$(document).on("click", "#police-button", function(){
    location.href="/report";
});

$(document).on("click", "#fb-share-btn", function(){
    var url = '';
    var description = '';
    url = $(location).attr('href');
    description = $('.view_content #view_content').text();
    description = description.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
    // 페이스북
    $('meta[name="og:url"]').attr('content', url);
    $('meta[name="og:description"]').attr('content', description);
    window.open('http://www.facebook.com/sharer/sharer.php?u='+url, '', 'width=400, height=430');
});

$(document).on("click", "#twitter-share-btn", function(){
    var url = '';
    var title = '';
    url = $(location).attr('href');
    title = $('.view_subtitle').text();
    window.open('https://twitter.com/intent/tweet?text='+title+'&url='+url, '', 'width=400, height=430');
});

$(document).on("click", "#band-share-btn", function(){
    var route = '';
    var body = '';
    var title = '';
    route = $(location).attr('hostname');

    title = '[' + $('.view_subtitle').text() + ']';
    body = $('.view_content #view_content').text();
    body = body.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
    body = title + body;
    body = encodeURIComponent(body);
    window.open('https://band.us/plugin/share?body='+body+'&route='+route, '', 'width=400, height=600');
});

$(document).on("click", "#share-button", function(){
    var title = '';
    var description = '';
    var imageUrl = '';

    title = $('.view_subtitle').text();
    description = $('.view_content #view_content').text();
    description = description.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
    imageUrl = $('.view_content #thumbnail').val();
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createDefaultButton({
      container: '#kakao-share-btn',
      objectType: 'feed',
      content: {
        title: title,
        description: description,
        imageUrl: imageUrl,
        link: {
          mobileWebUrl: 'https://developers.kakao.com',
          webUrl: 'https://developers.kakao.com'
        }
      },
      social: {
        likeCount: 286,
        commentCount: 45,
        sharedCount: 845
      },
      buttons: [
        {
          title: '웹으로 보기',
          link: {
            mobileWebUrl: 'https://developers.kakao.com',
            webUrl: 'https://developers.kakao.com'
          }
        },
        {
          title: '앱으로 보기',
          link: {
            mobileWebUrl: 'https://developers.kakao.com',
            webUrl: 'https://developers.kakao.com'
          }
        }
      ]
    });
});

function copy_trackback(address) {
	var IE=(document.all)?true:false;
	if (IE) {
		if(confirm("해당 글의 주소를 클립보드에 복사하시겠습니까?"))
			window.clipboardData.setData("Text", address);
	} else {
		temp = prompt("해당 글의 주소입니다. \nCtrl+C를 눌러 클립보드로 복사하세요", address);
	}
}

$(document).on("click", ".btn_cmt_refresh", function(){
    location.reload();
});

$(document).on("click", ".btn_cmt_close", function(){
    if($('.comment_box').css("display") == "none") {
        $('.comment_box').show();
        $('.btn_cmt_close').html("댓글닫기<i class='fas fa-caret-up pdL6'></i>");
    } else {
        $('.comment_box').hide();
        $('.btn_cmt_close').html("댓글열기<i class='fas fa-caret-down pdL6'></i>");
    }
});

$(document).ready(function(){
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/gallery_link_gallery',
         dataType: 'json',
         data: {
             'link': $('.title').attr('id'),
         },
         success: function(data) {
              var link_gallerys = data['link_gallerys'];
              var add_link_gallerys = data['add_link_gallerys']['data'];
              var content = '';
              content += '<div class="link-gallery-top">해당 갤러리가 연관 갤러리로 추가한 갤러리</div>';
              content += '<ul class="link-gallery">';
              $.each(link_gallerys, function(index, item) {
                  content += '<li>'+ item.gallery_name +'</li>';
              });
              content += '<div class="clear"></div>';
              content += '</ul>';
              content += '</div>';
              content += '<div style="float:left;" class="link-gallery-top in-page">해당 갤러리를 연관 갤러리로 추가한 갤러리';
              content += '<ul class="pagination" style="margin-bottom: 0px;">';
              if(data['add_link_gallerys']['prev_page_url'] != null) {
                  content += '<li class=".prev"><a id="prev" href="'+ data['add_link_gallerys']['prev_page_url'] +'" rel="prev" onclick="return false;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>';
              } else {
                  content += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></li>';
              }
              content += '&nbsp;<li class="currentPage">' + data['add_link_gallerys']['current_page'] + '/' + data['add_link_gallerys']['last_page'] + '</li>&nbsp;';
              if(data['add_link_gallerys']['next_page_url'] != null) {
                  content += '<li class=".next"><a id="next" href="' + data['add_link_gallerys']['next_page_url'] + '" rel="next" onclick="return false;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
              } else {
                  content += '<li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></li>';
              }
              content += '</ul></div>';

              content += '<ul class="link-gallery add-gallery">';
              $.each(add_link_gallerys, function(index, item) {
                  content += '<li>'+ item.gallery_name +'</li>';
              });
              content += '<div class="clear"></div>';
              content += '</ul>';
              content += '</div>';
              $('#link-gallery').attr("data-content",content);
         },
         error: function(data) {
              console.log("error" +data);
         }
    });

    $('[data-toggle="popover"]').popover({
        html: true
    })

    var post_cnt = 30;
    var title = $(".mainLeft .gallery-top .title").text();
    var text = '';

    if($.cookie('['+title+']')) {
        var cookie = $.cookie('['+title+']').split('/');
        var keyword = cookie[1].split(" ");
        var id = cookie[2].split(" ");
        var nick = cookie[3].split(" ");
        var ip = cookie[4].split(" ");

        console.log($.cookie('['+title+']'));

        for(var j = 0; j < post_cnt; j++) {
            text = $('#p'+j+' .post_title #title').text();
            for(var i = 0; i < keyword.length; i++) {
                if(keyword[i] != '' && text.indexOf(keyword[i]) != -1) {
                    $('#p'+j).css('opacity', 0.1);
                }
            }
        }
        for(var j = 0; j < post_cnt; j++) {
            text = $('#p'+j+' .post_user .uid').text();
            for(var i = 0; i < id.length; i++) {
                if(id[i] != '' && text.indexOf(id[i]) != -1) {
                    $('#p'+j).css('opacity', 0.1);
                }
            }
        }
        for(var j = 0; j < post_cnt; j++) {
            text = $('#p'+j+' .post_user .nickname').text();
            for(var i = 0; i < nick.length; i++) {
                if(nick[i] != '' && text.indexOf(nick[i]) != -1) {
                    $('#p'+j).css('opacity', 0.1);
                }
            }
        }
        for(var j = 0; j < post_cnt; j++) {
            text = $('#p'+j+' .post_user .ip').text();
            for(var i = 0; i < ip.length; i++) {
                if(ip[i] != '' && text.indexOf(ip[i]) != -1) {
                    $('#p'+j).css('opacity', 0.1);
                }
            }
        }
    } else {
        if($.cookie('all_keyword')) {
            var cookie_all_keyword = $.cookie('all_keyword');
            cookie_all_keyword = cookie_all_keyword.split(" ");

            for(var j = 0; j < post_cnt; j++) {
                text = $('#p'+j+' .post_title #title').text();
                for(var i = 0; i < cookie_all_keyword.length; i++) {
                    if(cookie_all_keyword[i] != '' && text.indexOf(cookie_all_keyword[i]) != -1) {
                        $('#p'+j).css('opacity', 0.1);
                    }
                }
            }
        }
        if($.cookie('all_id')) {
            var all_id = $.cookie('all_id');
            all_id = all_id.split(" ");
            for(var j = 0; j < post_cnt; j++) {
                text = $('#p'+j+' .post_user .uid').text();
                for(var i = 0; i < all_id.length; i++) {
                    if(all_id[i] != '' && text.indexOf(all_id[i]) != -1) {
                        $('#p'+j).css('opacity', 0.1);
                    }
                }
            }
        }
        if($.cookie('all_nick')) {
            var all_nick = $.cookie('all_nick');
            all_nick = all_nick.split(" ");

            for(var j = 0; j < post_cnt; j++) {
                text = $('#p'+j+' .post_user .nickname').text();
                for(var i = 0; i < all_nick.length; i++) {
                    if(all_nick[i] != '' && text.indexOf(all_nick[i]) != -1) {
                        $('#p'+j).css('opacity', 0.1);
                    }
                }
            }
        }
        if($.cookie('all_ip')) {
            var all_ip = $.cookie('all_ip');
            all_ip = all_ip.split(" ");

            for(var j = 0; j < post_cnt; j++) {
                text = $('#p'+j+' .post_user .ip').text();
                for(var i = 0; i < all_ip.length; i++) {
                    if(all_ip[i] != '' && text.indexOf(all_ip[i]) != -1) {
                        $('#p'+j).css('opacity', 0.1);
                    }
                }
            }
        }
    }

    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('6c28b937db9abdf57390862e1b94f1ef');
});
