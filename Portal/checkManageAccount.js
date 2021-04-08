window.addEventListener("load", function () {
  "use strict";

  const personalDetails = document.getElementById("detailsForm");
  personalDetails.submit.onclick = checkPersonalDetails;

  const passwordDetails = document.getElementById("passwordForm");
  passwordDetails.submit.onclick = checkPasswordDetails;

  var strength = {
    0: "Worst",
    1: "Bad",
    2: "Weak",
    3: "Good",
    4: "Strong",
  };

  var password = document.getElementById("password");
  var meter = document.getElementById("password-strength-meter");
  var text = document.getElementById("password-strength-text");

  password.addEventListener("input", function () {
    var val = password.value;
    var result = zxcvbn(val);

    // Update the password strength meter
    meter.value = result.score;

    // Update the text indicator
    if (val !== "") {
      text.innerHTML = "Strength: " + strength[result.score];
    } else {
      text.innerHTML = "";
    }
  });

  function checkPasswordDetails() {
    const errorMsg2 = document.getElementById("errorMsg2");

    const password = document.getElementById("password");
    const passwordRepeat = document.getElementById("passwordRepeat");
    const passwordIncludesUppercase = /[A-Z]/.test(password.value);

    if (isEmpty(password.value.trim())) {
      errorMsg2.innerHTML = "Password is empty";
      password.focus();
      return false;
    } else if (isEmpty(passwordRepeat.value.trim())) {
      errorMsg2.innerHTML = "Password repeat is empty";
      passwordRepeat.focus();
      return false;
    } else if (password.value !== passwordRepeat.value) {
      errorMsg2.innerHTML = "Passwords do not match";
      return false;
    } else if (password.value.length < 8 || password.value.length > 20) {
      errorMsg2.innerHTML =
        "Password does not meet the requirements. Passwords must be between 8 & 20 characters and contain 1 uppercase letter";
      password.focus();
      return false;
    } else if (!passwordIncludesUppercase) {
      errorMsg2.innerHTML =
        "Password does not meet the requirements. Passwords must be between 8 & 20 characters and contain 1 uppercase letter";
      password.focus();
      return false;
    } else {
      return true;
    }
  }

  function checkPersonalDetails() {
    const errorMsg = document.getElementById("errorMsg");

    const firstName = document.getElementById("first");
    const lastName = document.getElementById("last");
    const address = document.getElementById("address");
    const postcode = document.getElementById("postcode");

    const email = document.getElementById("email");

    const regEx = /^[\w ]+$/;
    const emailRegEx = /[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (!isEmpty(firstName.value.trim())) {
      if (!regEx.test(firstName.value)) {
        errorMsg.innerHTML = "Firstname contains invalid characters";
        firstName.focus();
        return false;
      }
    }

    if (!isEmpty(lastName.value.trim())) {
      if (!regEx.test(lastName.value)) {
        errorMsg.innerHTML = "lastname contains invalid characters";
        lastName.focus();
        return false;
      }
    }

    if (!isEmpty(email.value.trim())) {
      if (!emailRegEx.test(email.value)) {
        errorMsg.innerHTML = "email is not vaid";
        email.focus();
        return false;
      }
    }

    if (!isEmpty(address.value.trim())) {
      if (!regEx.test(address.value)) {
        errorMsg.innerHTML = "address contains invalid characters";
        address.focus();
        return false;
      }
    }

    if (!isEmpty(postcode.value.trim())) {
      if (!regEx.test(postcode.value)) {
        errorMsg.innerHTML = "postcode contains invalid characters";
        postcode.focus();
        return false;
      } else if (postcode.value.length < 6 || postcode.value.length > 8) {
        errorMsg.innerHTML = "postcode does not meet length requirements";
        postcode.focus();
        return false;
      }
    }
  }

  function isEmpty(str) {
    if (!str || str.length === 0) {
      return true;
    } else {
      return false;
    }
  }
});
