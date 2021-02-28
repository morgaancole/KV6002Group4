window.addEventListener('load', function() {
    'use strict';
    const jobForm = document.getElementById('jobForm');

    let button = jobForm.myBtn;

    button.onclick = readMore;


function readMore() {  
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
    let display = false;
 
    display = !display;

    if (display === false) {
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}


});