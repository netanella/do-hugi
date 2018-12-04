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


//this function moves all relative-positioned items with class 'cls' 40px right or left according to 'dir'
function scrollItem(cls,dir,pxMove) {
    var scrollItems = document.getElementsByClassName(cls);
    for (var i=0; i < scrollItems.length ; i++){
        scrollItems[i].style.transition = "all 0.5s ease-in-out";
        var currentPos = getElementLeft(scrollItems[i]);
        if (dir === 'right'){
            scrollItems[i].style.left = currentPos + pxMove + "px";
        }
        if (dir === 'left' && currentPos!=0) { //don't over scroll
            scrollItems[i].style.left = currentPos - pxMove +"px";
        }
    }
}

function getElementLeft(el){
    if (isNaN(parseInt(el.style.left))){
        return 0;
    }
    else return parseInt(el.style.left);
}
