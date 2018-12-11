
    var myIndex = 0;
    slider();

    function slider() {
        var i;
        var slides = document.getElementsByClassName("hugSlide");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > slides.length) {myIndex = 1}
        slides[myIndex-1].style.display = "block";
        setTimeout(slider, 3000);
    }

