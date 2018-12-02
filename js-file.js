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

function scrollRight() {
    //not working
    //var scrollItems = document.getElementsByClassName('userBox');
    //scrollItems.style.transform = "rotate(7deg)";
}




/*.scroll-items:hover a{
    animation: scrollBar-left 5s linear infinite;
}

@keyframes scrollBar-left {
    100% {
        transform: translateX(-66.6666%);
    }
}*/