document.addEventListener("DOMContentLoaded", function () {
  const addButton = document.querySelector(".add-task-button");
  const inputField = document.querySelector(
    '.input-project[name="subtask-title"]'
  );
  const subtaskList = document.querySelector(".subtask-box ol");
  const titleField = document.querySelector(
    '.input-project[placeholder="Title"]'
  );
  const descriptionField = document.querySelector(
    '.input-project[placeholder="Description"]'
  );
  const deadlineField = document.querySelector("#Deadline");
  const priorityField = document.querySelector("#Prioridad");
  const usernameField = document.querySelector("#username");

  const searchField = document.querySelector("#username");
  const resultsContainer = document.querySelector("#search-results");

  let subtasks = [];

  function addSubtaskToArrayAndPrint(inputValue) {
    if (!subtasks) {
      subtasks = [];
    }
    subtasks.push(inputValue);
  }

  function createSubtaskElement(inputValue) {
    const listItem = document.createElement("li");
    listItem.classList.add("subtask");

    const textNode = document.createElement("span");
    textNode.textContent = inputValue;
    listItem.appendChild(textNode);

    const closeButton = document.createElement("span");
    closeButton.classList.add("material-icons");
    closeButton.textContent = "highlight_off";

    closeButton.addEventListener("click", function () {
      subtaskList.removeChild(listItem);
      if (subtasks && subtasks.length > 0) {
        const index = subtasks.indexOf(inputValue);
        if (index > -1) {
          subtasks.splice(index, 1);
        }
      }
    });

    listItem.appendChild(closeButton);
    subtaskList.appendChild(listItem);
  }

  addButton.addEventListener("click", function () {
    const inputValue = inputField.value.trim();

    if (inputValue) {
      addSubtaskToArrayAndPrint(inputValue);
      createSubtaskElement(inputValue);

      inputField.value = "";
    }
  });

  searchField.addEventListener("input", function () {
    const query = this.value.trim();

    if (query) {
      fetch("/search/" + encodeURIComponent(query))
        .then((response) => response.json())
        .then((data) => {
          resultsContainer.innerHTML = "";
          data.forEach((user) => {
            const div = document.createElement("div");
            div.textContent = user.name;
            div.className = "search-result-item";
            div.addEventListener("click", function () {
              searchField.value = user.name;
            });
            resultsContainer.appendChild(div);
          });
        })
        .catch((error) => console.error("Error:", error));
    } else {
      resultsContainer.innerHTML = "";
    }
  });

  document
    .querySelector(".accept-button")
    .addEventListener("click", function (event) {
      event.preventDefault();
      const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      const pathParts = window.location.pathname.split("/");
      const projectId = pathParts[pathParts.length - 1];

      const task = {
        title: titleField.value.trim(),
        description: descriptionField.value.trim(),
        fechaVenc: deadlineField.value,
        prioridad: priorityField.value,
        estado: "por hacer",
        subTareas: subtasks,
      };

      fetch(`/create-task/${projectId}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-Token": token,
        },
        body: JSON.stringify(task),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);
          }
        })
        .catch((error) => console.error("Error:", error));
    });
});
