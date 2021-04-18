window.addEventListener("load", function() {
  "use strict";

  const submitTimesheet = document.getElementById("timesheetForm");
  submitTimesheet.submit.onclick = checkTimesheet;

  function checkTimesheet() {
    let year = document.getElementById("year");
    let month = document.getElementById("month");
    let day = document.getElementById("day");

    let location = document.getElementById("siteLocation");
    let desc = document.getElementById("desc");

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

    const regEx = /^[\w!?,. -]+$/;

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
    } else if (!regEx.test(location.value)) {
      errorMsg.innerHTML = "Entered location contains invalid characters";
      location.focus();
      return false;
    } else if (!regEx.test(desc.value)) {
      errorMsg.innerHTML = "Entered Description contains invalid characters";
      desc.focus();
      return false;
    } else {
      return true;
    }
  }
});
