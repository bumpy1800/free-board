const btnSeeMore = document.querySelector("#btnSeeMore");
const seeMore = document.querySelector(".gallery-create-seemore");
const btnClose = document.querySelector("#btnClose");
const backScreen = document.querySelector(".back-screen");
const btnAlertClose = document.querySelector(".gallery-create-alert-btn");

function openSeeMore(){
    seeMore.style.display = "inline"
}

function closeSeeMore(){
    seeMore.style.display = "none"
}

function removeBackScreen(){
    backScreen.remove();
}

function init() {
    btnSeeMore.addEventListener('click', openSeeMore);
    btnClose.addEventListener('click', closeSeeMore)
    btnAlertClose.addEventListener('click', removeBackScreen);
}

init();