document.addEventListener("DOMContentLoaded", function () {
  var currentDate = new Date();
  currentDate.setHours(0, 0, 0, 0); // Set the time to midnight
  var deadline = document.querySelector("#deadline");

  var deadlineText = deadline.textContent.replace("Deadline: ", "");
  var deadlineParts = deadlineText.split("-");
  var deadlineDate = new Date(
      deadlineParts[0],
      deadlineParts[1] - 1,
      deadlineParts[2]
  );
  deadlineDate.setHours(0, 0, 0, 0); // Set the time to midnight

  if (deadlineDate < currentDate) {
      deadline.classList.add("error");
  } else {
      deadline.classList.add("success");
  }
});