'use strict';

const btnDropDown = document.querySelector(".btn-dropdown"),
dropDownMenu = document.querySelector(".header-dropdown-menu"),
yesterdayWriting = document.querySelector(".yesterday-writing"),
yesterdayComment = document.querySelector(".yesterday-comment"),
btnMobileLogin = document.querySelector("#btn-mobile-login");


function showDropDown() {
    if(dropDownMenu.classList.contains("none")){
        dropDownMenu.classList.remove("none");
    } else {
        removeDropDown();
    }
}

function removeDropDown() {
    if(!dropDownMenu.classList.contains("none")){
        dropDownMenu.classList.add("none");
    }
}

function openLoginForm() {
    const backCover = document.createElement('div');
    const innerCode = `
    <div class="mobile-login-form">
        <i class="fas fa-times"></i>
        <div class="mobile-login-title">sjinside 로그인</div>
        <div class="mobile-login-input">
            <input type="text" class="mobile-login-id" placeholder="아이디"/>
            <input type="text" class="mobile-login-pw" placeholder="비밀번호" />
        </div>
        <div class="mobile-login-save-box">
            <input type="checkbox" class="btn-mobile-idcheck">
            <span>아이디 저장</span>
        </div>
        <button class="btn-mobile-login">로그인</button>
        <div class="mobile-login-etc">
            <button>아이디ㆍ비밀번호 찾기</button>
            <span>계정이 없으신가요?<button>회원가입</button></span>
        </div>
    </div>
    `
    backCover.classList.add("back-cover");
    backCover.innerHTML = innerCode;

    const body = document.querySelector("body");
    body.append(backCover);
    const loginForm = body.querySelector(".back-cover");
    const bntClose = loginForm.querySelector(".fas");
    bntClose.addEventListener('click', closeLoginForm);
}

function closeLoginForm() {
    const loginForm = document.querySelector(".back-cover");
    loginForm.remove();
}

function makeMouseEvent() {
    btnMobileLogin.addEventListener("click", openLoginForm);
    btnDropDown.addEventListener("click", showDropDown);
}

function yesterdayInfoAnim() {
    if(yesterdayComment.classList.contains("down")) {
        yesterdayComment.classList.add("anim");
        setTimeout(() => {
            yesterdayComment.classList.remove("anim");
            yesterdayComment.classList.remove("down");
            yesterdayWriting.classList.add("down");
        }, 290);
    } else if(yesterdayWriting.classList.contains("down")) {
        yesterdayWriting.classList.add("anim");
        setTimeout(() => {
            yesterdayWriting.classList.remove("anim");
            yesterdayWriting.classList.remove("down");
            yesterdayComment.classList.add("down");
        }, 290);
    }
}

function init() {
    makeMouseEvent();
    setInterval(yesterdayInfoAnim, 5000);
}

init();