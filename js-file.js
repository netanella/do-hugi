/*SCROLLING BAR*/
/*this function moves a positioned element right or left
according to given 'dir' and px */

function scrollBar(el,dir,pxMove) {
    var scrollItem = document.getElementById(el);
    scrollItem.style.transition = "all 0.5s ease-in-out";
    var currentPos = getElementRight(scrollItem);
    if (dir === 'right' && currentPos!=0){ //prevent over-scrolling
        scrollItem.style.right = currentPos + pxMove + "px";
    }
    if (dir === 'left' && hiddenItems(el) ) { //prevent over-scrolling
        scrollItem.style.right = currentPos - pxMove +"px";
    }
}

/*this function retrieves the element's css "right" value and converts it to int*/
function getElementRight(el){
    if (isNaN(parseInt(el.style.right))){
        return 0;
    }
    else return parseInt(el.style.right);
}

/*checks if height of element is greater than its contained child
(if so - it means hidden items are still remaining)*/
function hiddenItems(el){
    var child = document.getElementById(el).firstElementChild;
    var childHeight = child.offsetHeight;
    if (document.getElementById(el).offsetHeight > childHeight){
        return true;
    }
    else return false;
}

/*CONFIRM BOX*/
//pop up confirmation before signing up or canceling hug registration
var signup = document.getElementById('signup');
var cancel = document.getElementById('cancel');

// if i have more than one method use addEventListener()
var alert = new customConfirm();

function customConfirm(){
    var overlay = document.getElementById('dialogoverlay');
    var box = document.getElementById('dialogbox');
    this.render = function(display){
        overlay.style.display = 'block';
        box.style.display = 'block';
        document.getElementById('dialogboxhead').innerHTML = 'שים לב!';
        document.getElementById('dialogboxbody').innerHTML = display;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick=alert.ok()>כן</button>';
    }
    this.ok = function() {
        overlay.style.display = 'none';
        box.style.display = 'none';
    }
    this.cancel = function() {

    }
}

function signupHug() {
    var conf = confirm("אתה עומד להרשם לחוג. האם תרצה להמשיך?");
    if(conf == false) {
        signup.checked = false;
        cancel.checked = true;
    }
}

function cancelHug() {
    var conf = confirm("אתה עומד לבטל את הרשמתך. האם תרצה להמשיך?");
    if(conf == false) {
        cancel.checked = false;
        signup.checked = true;
    }
}


//'אתה עומד לבטל את הרשמתך. האם תרצה להמשיך?'//