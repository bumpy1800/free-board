$(document).ready(function(){
    //방명록 년도별로 조회
    $('#select_year').change(function() { //날짜 선택
        var year = $(this).val();
        var href = $(location).attr('pathname'); //현재주소
        location.href = href + '?year=' + year;
    });
    //방명록 수정버튼
    $('.guestbook_edit').click(function() {
        var id = $(this).attr('id');
        $('#contents'+id).children('p').hide();
        $(this).hide();
        $('#update'+id).show();
        $('#close'+id).show();
        $('#contents'+id).append("<textarea id='append_tag"+id+"' style='width: 100%;'></textarea>")
    });
    //방명록 취소버튼
    $('.guestbook_close').click(function() {
        var id = $(this).attr('id');
        id = id.substring(5,99);
        $('#update'+id).hide();
        $('#close'+id).hide();
        $('#'+id).show();
        $('#append_tag'+id).remove();
        $('#contents'+id).children('p').show();
    });
    //방명록 저장버튼
    $('.guestbook_update').click(function() {
        var id = $(this).attr('id');
        id = id.substring(6,99);
        var href = $(location).attr('pathname');
        var contents = $('#append_tag'+id).val();

        $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'post',
             url: href + '/update',
             dataType: 'json',
             data: {
                 'id': id,
                 'contents': contents,
             },
             success: function(data) {
                  if(data['guestbook_update']) {
                      $('#contents'+id).html('<p>'+contents+'</p>');
                      $('#update'+id).hide();
                      $('#close'+id).hide();
                      $('#'+id).show();
                      $('#append_tag'+id).remove();
                      $('#contents'+id).children('p').show();
                  }
             },
             error: function(data) {
                  console.log("error" +data);
             }
        });
    });
    //방명록 삭제버튼
    $('.guestbook_destroy').click(function() {
        var id = $(this).attr('id');
        var href = $(location).attr('pathname');

        $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'post',
             url: href + '/destroy',
             dataType: 'json',
             data: {
                 'id': id,
             },
             success: function(data) {
                  if(data['guestbook_destroy']) {
                      $('#title'+id).remove();
                      $('#contents'+id).remove();
                      $('#writeday'+id).remove();
                  }
             },
             error: function(data) {
                  console.log("error" +data);
             }
        });
    });
    //방명록 비공개버튼
    $('.guestbook_hidden').click(function() {
        var id = $(this).attr('id');
        var href = $(location).attr('pathname');

        $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'post',
             url: href + '/hidden',
             dataType: 'json',
             data: {
                 'id': id,
             },
             success: function(data) {
                  if(data['guestbook_hidden']) {
                      location.reload();
                  }
             },
             error: function(data) {
                  console.log("error" +data);
             }
        });
    });
    //방명록 비공개버튼
    $('.guestbook_open').click(function() {
        var id = $(this).attr('id');
        var href = $(location).attr('pathname');

        $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'post',
             url: href + '/open',
             dataType: 'json',
             data: {
                 'id': id,
             },
             success: function(data) {
                  if(data['guestbook_open']) {
                      location.reload();
                  }
             },
             error: function(data) {
                  console.log("error" +data);
             }
        });
    });
});
