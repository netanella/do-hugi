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
