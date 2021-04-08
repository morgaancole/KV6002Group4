window.addEventListener('load', function() {
	'use strict';
    
    const review = document.getElementById('review');
    const showButton = document.getElementById('show');
    showButton.onclick = showForm;

    function showForm() {
        //Getting review form
        var reviewForm = document.getElementById('rev-form');
    
        //Getting the current value of the form's display property
        var displaySetting = reviewForm.style.display;
    
        //Getting toggle button
        var show = document.getElementById('show');
    
        //Toggle the form and the button text
        if (displaySetting == 'block') {

          // form is visible. hide it
          reviewForm.style.display = 'none';

          //Changing button text
          show.innerHTML = 'Leave Review';
        }
        else {
          //Showing Form
          reviewForm.style.display = 'block';

          //Changing button text
          show.innerHTML = 'Hide Form';
        }
      }

});