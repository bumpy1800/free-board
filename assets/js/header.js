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
    const backCover = document.querySelector(".back-cover");
    backCover.classList.add("on");

    const bntClose = backCover.querySelector(".fas");
    bntClose.addEventListener('click', closeLoginForm);
}

function closeLoginForm() {
    const backCover = document.querySelector(".back-cover");
    backCover.classList.remove("on");
}

function makeMouseEvent() {
    if(btnMobileLogin !== null)btnMobileLogin.addEventListener("click", openLoginForm);
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
