/**
 * @author Morgan Wheatman
 */
 window.addEventListener('load', function() {
	'use strict';
    
    const vacancy = document.getElementById('vacancy');

    const showButton = document.getElementById('show');

    showButton.onclick = showForm;

    let showFlag = false;

    function showForm(){

        alert("test");

    
        var form = document.getElementById('vacform');
 
        if(showFlag == false){
            form.style.display = "hidden"; 
            showFlag = true;

        }else{
            form.style.display = "block"; 
            showFlag = false;
        }

    }

});