window.addEventListener('load', function() {
	'use strict';

    const contactForm = document.getElementById('contact');

    contactForm.submit.onclick = checkConsent;

    var consentSelected = false;

    function checkConsent(_evt){
		var consent = contactForm.consent;


        if(consent.value == "selectOption"){
            consentSelected = false;
        }else{
            consentSelected = true;
        }
		
		if(consentSelected == false){
			_evt.preventDefault();
			alert("Please select select Yes or No");
		}
	}
	 
});