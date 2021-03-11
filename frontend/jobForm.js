window.addEventListener('load', function() {
	'use strict';
    
    const jobForm = document.getElementById('jobForm');
    //jobForm.onchange = checkJobBox;

    jobForm.onchange = checkJobBox;

    function checkJobBox(){

        let submitButton = jobForm.btn_app_send;
        
        if(jobForm.consentCheck.checked){
            submitButton.disabled = false;

        }else{
            submitButton.disabled = true;
            
        }

    }

});