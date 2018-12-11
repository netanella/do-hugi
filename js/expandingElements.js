/*USER PAGE - SHOW MORE ITEMS*/
//this function creates a "show more" button that reveals additional items and collapses

window.addEventListener('load', function(){
    var btn = document.getElementById('showAllAttended');
    var lst = document.getElementById('attended-list');
    hideLongLists(btn,lst,4);
});

//listener for attended list in hug page
document.getElementById('showAllAttended').addEventListener('click', function(){
    expandORcollapse('showAllAttended', 'attended-list',4);
});

//hiding items greater than 'showNum'
function hideLongLists(btn, lst, showNum) {
    if (showNum < lst.childElementCount) {
        hideElements(btn, lst,showNum);
    }
}

//expands or collapses the list
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

