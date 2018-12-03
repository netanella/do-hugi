//pop up confirmation before signing up or canceling hug registration
var signup = document.getElementById('signup');
var cancel = document.getElementById('cancel');

function signupAlert() {
    if(signup.checked){
        var conf = confirm("אתה עומד להרשם לחוג. האם תרצה להמשיך?");
        if(conf == false) {
            signup.checked = false;
            cancel.checked = true;
        }
    }
}

function cancelAlert() {
    if(cancel.checked){
        var conf = confirm("אתה עומד לבטל את הרשמתך. האם תרצה להמשיך?");
        if(conf == false) {
            cancel.checked = false;
            signup.checked = true;
        }
    }
}
/*
function scrollRight(el) {
    var scrolling = document.getElementById(el);
    scrolling.style.left = "50px";
}
*/

function scrollItem(el,dir) {
    var scrollItems = document.getElementsByClassName(el);
    for (var i=0; i < scrollItems.length ; i++){
        scrollItems[i].style.transition = "all 2s ease-in-out";
        if (dir === 'right'){
            scrollItems[i].style.left =  scrollItems[i].style.left + 40 +"px";
        }
        if (dir === 'left') {
            scrollItems[i].style.left =  scrollItems[i].style.left - 40 +"px";
        }
    }
}



/*.scroll-items:hover a{
    animation: scrollBar-left 5s linear infinite;
}

@keyframes scrollBar-left {
    100% {
        transform: translateX(-66.6666%);
    }
}*/