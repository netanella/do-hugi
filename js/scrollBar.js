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

    return document.getElementById(el).offsetHeight > childHeight;

}

