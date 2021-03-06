let pop_box;
let getImgUrl = '';

function open(getImgUrl) {
    const imgUrl = getImgUrl;
    const body = document.querySelector('body');
    pop_box = document.createElement('div');
    pop_box.classList.add("pop-box");
    const inner_html = `
    <img src="data:image/png;base64,${imgUrl}" alt="팝업 이미지" class="pop-img">
    <div class="pop-menu">
        <div class="pop-today-close">
            <span>오늘 하루 열지 않음</span>
            <input id="todayClose" type="checkbox">
        </div>
        <div class="pop-close">X 닫기</div>`;

    pop_box.innerHTML = inner_html;
    const btnClose = pop_box.querySelector(".pop-close");
    btnClose.addEventListener('click', close);
    body.append(pop_box);
    pop_box.draggable = true;
    pop_box.style.left = "200px";
    pop_box.style.top = "200px";
}

function close() {
    todayCloseCheck();
    pop_box.remove();
}

function todayCloseCheck() {
    checkbox = pop_box.querySelector("#todayClose");
    if(checkbox.checked) {
        setCookie('pop', 'todayClose', 1);
    }
}

function setCookie(name, value, expiredays ) {
    var todayDate = new Date();
    todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);
    if ( todayDate > new Date() )  {
        expiredays = expiredays - 1;
    }
    todayDate.setDate( todayDate.getDate() + expiredays );
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function getCookie(name) {
    var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return value? value[2] : null;
}

function init() {
    $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'post',
         url: 'getPopupImage',
         dataType: 'json',
         success: function(data) {
             getImgUrl = data['image'];
             if(getImgUrl != '') {
                 if(getCookie('pop') !== "todayClose") open(getImgUrl);
                 $( '.pop-box' ).draggable();
             }
         },
         error: function(data) {
              console.log("error" +data);
         }
    });
}

window.onload = () => {
    init();
}
