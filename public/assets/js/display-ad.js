'use strict';

const dislpayAdMenuItem = document.querySelectorAll(".display-ad-header-menu-item"),
header = document.querySelector(".display-ad-header"),
inputFile = document.querySelector("#upload-file");

function darkerHeader(){
    if(window.scrollY!=0 && !header.classList.contains("dark")) {
        header.classList.add("dark");
    } else if(window.scrollY==0 && header.classList.contains("dark")) {
        header.classList.remove("dark");
    }
}

function makeDisplayAdMenuItemEffect(element) {
    if(!element.classList.contains("active")) {
        const menuline = element.querySelector(".menuline");
        menuline.classList.remove("off");
        menuline.classList.add("on");
    }
}

function delDisplayAdMenuItemEffect(element) {
    if(!element.classList.contains("active")) {
        const menuline = element.querySelector(".menuline");
        menuline.classList.remove("on");
        menuline.classList.add("off");
    }
}

function makeMenuMouseEvent() {
    dislpayAdMenuItem.forEach(element => {
        element.addEventListener('mouseover', ()=> {
            makeDisplayAdMenuItemEffect(element) });
        element.addEventListener('mouseout', ()=> {
            delDisplayAdMenuItemEffect(element) });
    });
}

function fileUpload(event) {
    const fileText = document.querySelector(".input-filebox");
    fileText.value = event.target.value;
}

function init() {
    window.addEventListener('scroll', darkerHeader);
    if(inputFile != null) {
        inputFile.addEventListener('change', ()=>{
            fileUpload(event);
        });
    }
    makeMenuMouseEvent();
}

init();