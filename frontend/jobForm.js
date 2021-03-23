/**
 * @author Morgan Wheatman
 */
window.addEventListener('load', function() {
	'use strict';
    
    const jobForm = document.getElementById('jobForm');
    //jobForm.onchange = checkJobBox;

    jobForm.onchange = checkJobBox;

    function checkJobBox(){
        const consentText = document.getElementById('consentText');

        let submitButton = jobForm.btn_app_send;
        
        if(jobForm.consentCheck.checked){
            consentText.style.color = "#222221"; 
            consentText.style.fontWeight = "normal";
            submitButton.disabled = false;

        }else{
            consentText.style.color = "#FE0212";
            consentText.style.fontWeight = "bold";
            submitButton.disabled = true;
        }

    }

});