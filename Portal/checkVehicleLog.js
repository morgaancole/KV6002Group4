window.addEventListener("load", function() {
  "use strict";

  const submitVL = document.getElementById("VLForm");
  submitVL.submit.onclick = checkVL;

  function checkVL() {
    let year = document.getElementById("year");
    let month = document.getElementById("month");
    let day = document.getElementById("day");

    let milage = document.getElementById("currentmilage");
    let issues = document.getElementById("issues");

    const currentYear = new Date()
      .getFullYear()
      .toString()
      .substr(-2);

    let currentMonth = new Date().getMonth() + 1;
    currentMonth = currentMonth.toString();

    const currentDay = new Date().getDate().toString();

    const errorMsg = document.getElementById("errorMsg");

    let newDay = "";
    if (currentDay <= 9) {
      newDay = "0" + currentDay;
    } else {
      newDay = currentDay;
    }

    let newMonth = "";
    if (currentMonth <= 9) {
      newMonth = "0" + currentMonth;
    } else {
      newMonth = currentMonth;
    }

    const regEx = /^[\w!?,. \-/]+$/;
    const numRegEx = /^[0-9]+$/;

    if (year.value > currentYear) {
      errorMsg.innerHTML = "Year can't be in advance of todays date";
      year.focus();
      return false;
    } else if (month.value > newMonth) {
      errorMsg.innerHTML = "Month can't be in advance of todays date";
      month.focus();
      return false;
    } else if (day.value > newDay) {
      errorMsg.innerHTML = "Date can't be in advance of todays date";
      day.focus();
      return false;
    } else if (!numRegEx.test(milage.value)) {
      errorMsg.innerHTML = "Milage contains invalid characters";
      milage.focus();
      return false;
    } else if (!regEx.test(issues.value)) {
      errorMsg.innerHTML = "Issues description contains invalid characters";
      issues.focus();
      return false;
    } else {
      return true;
    }
  }
});
