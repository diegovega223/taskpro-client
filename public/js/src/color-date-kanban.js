document.addEventListener("DOMContentLoaded", function () {
    var currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
    var deadlines = document.querySelectorAll(".body-task p");
  
    deadlines.forEach(function (deadline) {
      var deadlineText = deadline.textContent.replace("Deadline: ", "");
      var deadlineParts = deadlineText.split("-");
      var deadlineDate = new Date(
        deadlineParts[0],
        deadlineParts[1] - 1,
        deadlineParts[2]
      );
      deadlineDate.setHours(0, 0, 0, 0);
      if (deadlineDate < currentDate) {
        deadline.classList.add("error");
      } else {
        deadline.classList.add("success");
      }
    });
});