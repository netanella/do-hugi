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

var confirm = new customConfirm();

function customConfirm(){
    var overlay = document.getElementById('dialogoverlay');
    var box = document.getElementById('dialogbox');
    this.pop = function(message,op){
        overlay.style.display = 'block';
        box.style.display = 'block';
        document.getElementById('dialogboxhead').innerHTML = 'שים לב!';
        document.getElementById('dialogboxbody').innerHTML = message;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="confirm.ok(\''+op+'\')">המשך</button> <button onclick="confirm.cancel(\''+op+'\')">ביטול</button>';
    }
    this.ok = function() {
        overlay.style.display = 'none';
        box.style.display = 'none';
    }
    this.cancel = function(op) {
        overlay.style.display = 'none';
        box.style.display = 'none';
        var cancel = document.getElementById('cancel');
        var signup = document.getElementById('signup');
        if (op === 'signup'){
            cancel.checked = true;
            signup.checked = false;
        }
        if (op === 'cancel'){
            cancel.checked = false;
            signup.checked = true;
        }
    }
}

/*USER PAGE SETTINGS ON SCROLL*/

window.addEventListener('scroll', function () {
    if (document.documentElement.scrollTop < 400) {
        selectSection('section1');
    }
    else {
        selectSection('section2');
    }
});

window.addEventListener('load', function(){
    selectSection('section1');
});

function selectSection(id){
    var allSections = document.getElementById('sideNav').children;
    for (var i=0; i < allSections.length ; i++){ //back to default color
        allSections[i].style.color = 'black';
        allSections[i].style.background = 'inherit';
    }
    document.getElementById(id).style.color = 'white';
    document.getElementById(id).style.background = '#0d3042';
}

/*USER PAGE - SHOW MORE ITEMS*/
//this function creates a "show more" button that reveals additional items and collapses

window.addEventListener('load', function(){
    var btn = document.getElementById('showAllAttended');
    var lst = document.getElementById('attended-list');
    hideLongLists(btn,lst,4);
});

document.getElementById('showAllAttended').addEventListener('click', function(){
    expandORcollapse('showAllAttended', 'attended-list',4);
});

function hideLongLists(btn, lst, showNum) {
    if (showNum < lst.childElementCount) {
        hideElements(btn, lst,showNum);
    }
}

function expandORcollapse(btnID, lstID, showNum){
    var btn = document.getElementById(btnID);
    var lst = document.getElementById(lstID);
    if (btn.innerHTML == "+הצג הכל"){
        showAll(lst);
        displayHidebtn(btn);
    }
    else {
        hideElements(btn,lst,showNum);
        displayShowbtn(btn);
    }
}

function displayShowbtn(btn) {
    btn.innerHTML= "+הצג הכל";
    btn.style.display ="inline-block";
}

function displayHidebtn(btn) {
    btn.innerHTML= "-מזער";
}

function hideElements(btn,lst,showNum) {
    var listlis = lst.children;
    for (var i=showNum; i<listlis.length ; i++){
        listlis[i].style.height = '0';
        listlis[i].style.border = 'none';
    }
    displayShowbtn(btn);
}

function showAll (list) {
    var listlis = list.children;
    for(var i=0; i<listlis.length; i++){
        listlis[i].style.border = '1px solid black';
        listlis[i].style.height = '150px';
    }
}
