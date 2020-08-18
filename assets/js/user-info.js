var timer;

$(document).on("click", "#send-code", function(){
    if($.cookie('timeover')) {
        alert('이전에 발송된 유효한 코드가 있습니다. 인증 시간(5분) 만료 후에 재발송 가능합니다.');
        return false;
    }
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/user-info-sendEmail',
         dataType: 'json',
         success: function(data) {
             if(data['status'] == 1) {
                 $('.s-cnt').html('인증 코드 입력까지 남은 시간은 <b id="s-cnt" style="color: red;">5분 00초</b> 입니다.');

                 var date = new Date();
                 date.setTime(date.getTime() + 5*60*1000); // 5분
                 $.cookie('timeover', '1', { expires: date });

                 var count = 300000; //5분
                 timer = setInterval(function() {
                    count = count - 1000;
                    var minutes = Math.floor(count / 60000);
                    var seconds = Math.floor((count % 60000) / 1000);

                    $('#s-cnt').text(minutes + '분'+ seconds + '초');
                    if(count <= 0) {
                       clearInterval(timer);
                       $.removeCookie('timeover');
                       $('.s-cnt').html('인증시간이 만료되었습니다. 재발급 받으세요');
                    }
                 }, 1000);
             } else {
                 alert('실패');
             }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});

$(document).on("click", "#check-code", function(){
    var code = $('.check-code').val();
    var last = $('#check-code').attr('class');
    var email = $('#wait-email').val();

    if(last == '' || last == null) {
        last = '';
    }
    if(email == '' || email == null) {
        email = '';
    }

    if(code == '') {
        alert('인증 코드를 입력해주세요.');
        return false;
    }

    if($.cookie('timeover')) {
        $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'post',
             url: '/user-info-checkCode',
             dataType: 'json',
             data: {
                 'code': code,
                 'last': last,
                 'email': email,
             },
             success: function(data) {
                 if(data['last'] == 1) {
                     alert("이메일이 변경되었습니다.");
                     clearInterval(timer);
                     $.removeCookie('timeover');
                     location.reload();
                     return false;
                 }
                 if(data['status'] == 1) {
                     alert("인증되었습니다.");
                     clearInterval(timer);
                     $.removeCookie('timeover');

                     $('.modal-body .email-box p').remove();

                     var text = '<li>새로운 이메일로 변경하시려면 이메일 인증을 진행하셔야 합니다.</li>';
                         text += '<li>이메일 변경을 하시려면 변경하고자 하는 이메일을 정확하게 입력하여 주시기 바랍니다.</li>';
                         text += '<li>이미 인증된 이메일과 다른 이메일을 입력해 주셔야 합니다.</li>';
                         text += '<li>변경하는 이메일은 아이디/비밀번호 찾기에도 이용되기 때문에 실제 사용하는 이메일을 입력하여 주시기 바랍니다.</li>';
                         $('.modal-body ul').html(text);

                        text = '<div class="change-email-form">';
                        text += '<div class="change-email">';
                        text += '<input id="email-front" class="check-code" type="text" value="">';
                        text += '<span>@</span>';
                        text += '<input id="email-back" class="check-code" type="text" value="">';
                        text += '</div>';
                        text += '<div class="email-select">';
                        text += '<select id="email-select">';
                        text += '<option value="" selected>이메일 선택</option>';
                        text += '<option value="naver.com">naver.com</option>';
                        text += '<option value="nate.com">nate.com</option>';
                        text += '<option value="gmail.com">gmail.com</option>';
                        text += '<option value="hanmail.com">hanmail.com</option>';
                        text += '<option value="daum.net">daum.net</option>';
                        text += '<option value="yahoo.com">yahoo.com</option>';
                        text += '<option value="">직접입력</option>';
                        text += '</select>';
                        text += '</div>';
                        text += '</div>';
                        $('.modal-body .email-box .form-group').html(text);
                        $('.s-cnt').html('실제 사용하는 이메일을 입력해 주세요');

                        text = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
                        text += '<button type="button" class="btn btn-primary last-check">다음</button>';
                        $('.modal-footer').html(text);

                        var check = RegExp(/^[0-9a-z]+$/);
                        $("#email-front").keyup(function() {
                            var val = $(this).val();
                            if(check.test(val)) {
                                if(val.length > 5) {
                                    $('.s-cnt').html('사용 가능한 이메일입니다.');
                                }
                            } else {
                                $('.s-cnt').html('<span style="color: red;">이메일을 바르게 입력해주세요.</span>');
                            }
                        });

                        $('#email-select').change(function() { //날짜 선택
                            var val = $('#email-select option:selected').val();
                            $('#email-back').val(val);
                        });

                 } else {
                     alert('인증에 실패하였습니다. 다시 입력해주세요.');
                 }
             },
             error: function(data) {
                  console.log("error" +data);
             }
        });
    } else {
        alert('인증 코드를 발급받아주세요.');
        return false;
    }
});

$(document).on("click", ".last-check", function(){
    var email = $('#email-front').val();
    email += '@';
    email += $('#email-back').val();
    $('.modal-footer').append('<input id="wait-email" type="hidden" value='+email+'>');

    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: '/user-info-sendEmail',
         dataType: 'json',
         data: {
             'email': email,
         },
         success: function(data) {
             if(data['status'] == 1) {
                 alert('인증 코드가 전송되었습니다. 인증 코드를 입력해주세요.');
                 var text = '<div class="code" style="width: 100%;">'
                     text += '<input class="check-code" type="text" value="" placeholder="인증 코드 입력">'
                     text += '<button type="submit" id="check-code" class="last">확인</button>'
                     text += '</div>'
                 $('.modal-body .email-box .form-group').html(text);

                 $('.s-cnt').html('인증 코드 입력까지 남은 시간은 <b id="s-cnt" style="color: red;">5분 00초</b> 입니다.');

                 var date = new Date();
                 date.setTime(date.getTime() + 5*60*1000); // 5분
                 $.cookie('timeover', '1', { expires: date });

                 var count = 300000; //5분
                 timer = setInterval(function() {
                    count = count - 1000;
                    var minutes = Math.floor(count / 60000);
                    var seconds = Math.floor((count % 60000) / 1000);

                    $('#s-cnt').text(minutes + '분'+ seconds + '초');
                    if(count <= 0) {
                       clearInterval(timer);
                       $.removeCookie('timeover');
                       $('.s-cnt').html('인증시간이 만료되었습니다. 재발급 받으세요');
                    }
                 }, 1000);
             } else {
                 alert('실패');
             }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
});
