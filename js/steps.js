/*TABS*/
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(curr) {
    // This function will display the specified tab of the form
    var allTabs = document.getElementsByClassName("tab");
    allTabs[curr].style.display = "block";
    // fix the Previous/Next buttons:
    if (document.getElementById("prevBtn")!=null){ //if we have the prev/next buttons in the page
        if (curr == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (curr == (allTabs.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
        }
    }

    // run a function that displays the correct step indicator:
    fixStepIndicator(curr);
}

function nextPrev(num) {
    // This function will figure out which tab to display
    var allTabs = document.getElementsByClassName("tab");
    // Hide the current tab:
    allTabs[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + num;
    showTab(currentTab);
}

function fixStepIndicator(curr) {
    // remove the "active" class of all steps
    var allSteps = document.getElementsByClassName("step");
    for (var i = 0; i < allSteps.length; i++) {
        allSteps[i].className = allSteps[i].className.replace(" active", "");
    }
    //adds the "active" class to the current step:
    allSteps[curr].className += " active";
}