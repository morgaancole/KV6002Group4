/**
 * Javascript to hide & show the new vacancies form
 * @author Morgan Wheatman
 */
 window.addEventListener('load', function() {
	'use strict';
    
    const vacancy = document.getElementById('vacancy');
    const showButton = document.getElementById('show');
    showButton.onclick = showForm;

    function showForm() {
        //Getting vacancy form
        var vacancyForm = document.getElementById('vac-form');
    
        //Getting the current value of the form's display property
        var displaySetting = vacancyForm.style.display;
    
        //Getting toggle button
        var show = document.getElementById('show');
    
        //Toggle the form and the button text
        if (displaySetting == 'block') {

          // form is visible. hide it
          vacancyForm.style.display = 'none';

          //Changing button text
          show.innerHTML = 'Create Job';
        }
        else {
          //Showing Form
          vacancyForm.style.display = 'block';

          //Changing button text
          show.innerHTML = 'Hide Form';
        }
      }

});