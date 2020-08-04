'use strict';

const btnDropDown = document.querySelector(".btn-dropdown"),
dropDownMenu = document.querySelector(".header-dropdown-menu"),
yesterdayWriting = document.querySelector(".yesterday-writing"),
yesterdayComment = document.querySelector(".yesterday-comment");


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

function makeMouseEvent() {
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