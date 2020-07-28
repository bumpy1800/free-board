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

    $.cookie('all_keyword', all_keyword, { path : '/' });
    $.cookie('all_id', all_id, { path : '/' });
    $.cookie('all_nick', all_nick, { path : '/' });
    $.cookie('all_ip', all_ip, { path : '/' });

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
                $.removeCookie(cookie_delete_gallery[i], { path : '/' });
                for(var j = 0; j < gallery_names.length; j++) {
                    if(cookie_delete_gallery[i] == gallery_names[j]) {
                        gallery_names[j] = '';
                    }
                }
            }
            gallery_names = gallery_names.join(' ');
            $.cookie('gallery_names', gallery_names, { path : '/' });
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

        $.cookie('gallery_names', gallery_names, { path : '/' });
        $.cookie(block_gallery, gallery, { path : '/' });
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

$(document).ready(function(){
    $(function () {
        $('[data-toggle="popover"]').popover({
            html: true
        })
    })

    var post_cnt = $("#post_cnt option:selected").val();
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
