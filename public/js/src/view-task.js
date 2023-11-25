function updateSubTask(id, finalizada) {
  fetch(`/modify-subtask/${id}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-Token": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
    body: JSON.stringify({ finalizada }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert(data.message);
      }
    })
    .catch((error) => console.error("Error:", error));
}

window.addEventListener("DOMContentLoaded", (event) => {
  const checkboxes = document.querySelectorAll(
    '.sub-task input[type="checkbox"]'
  );
  const completedPercentage = document.getElementById("completedPercentage");

  function updateCompletedPercentage() {
    const totalSubTasks = checkboxes.length;
    if (totalSubTasks === 0) {
      completedPercentage.textContent = "There are no tasks";
    } else {
      const completedSubTasks = Array.from(checkboxes).filter(
        (checkbox) => checkbox.checked
      ).length;
      completedPercentage.textContent =
        ((completedSubTasks / totalSubTasks) * 100).toFixed(2) + "%";
    }
  }

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      updateSubTask(this.dataset.id, this.checked);
      updateCompletedPercentage();
    });
  });

  updateCompletedPercentage();
});

document
.getElementById("deleteButton")
.addEventListener("click", function () {
  document.getElementById("deleteModal").style.display = "block";
  document.getElementById("confirmDelete").href = this.dataset.deleteUrl;
});

document
.getElementById("cancelButton")
.addEventListener("click", function () {
  document.getElementById("deleteModal").style.display = "none";
});