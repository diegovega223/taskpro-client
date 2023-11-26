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
  const usernameField = document.getElementById("username");
  const searchField = document.getElementById("username");
  const resultsContainer = document.getElementById("search-results");

  let userId;
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

  function handleAddButtonClick() {
    const inputValue = inputField.value.trim();

    if (inputValue) {
      addSubtaskToArrayAndPrint(inputValue);
      createSubtaskElement(inputValue);

      inputField.value = "";
    }
  }

  let usernameValue = document.getElementById("username").value;

  function handleSearchFieldInput() {
    const query = searchField.value.trim();
    const pathParts = window.location.pathname.split("/");
    const projectId = pathParts[pathParts.length - 2];
    if (query) {
      fetch(
        "/SearchProjectUser/" +
          encodeURIComponent(projectId) +
          "/" +
          encodeURIComponent(query)
      )
        .then((response) => response.json())
        .then((data) => {
          resultsContainer.innerHTML = "";
          if (data.length > 0) {
            usernameValue = data[0].name;
            userId = data[0].id;
            const div = document.createElement("div");
            div.textContent = usernameValue;
            div.className = "search-result-item";
            div.addEventListener("click", function () {
              usernameField.value = usernameValue;
            });
            resultsContainer.appendChild(div);
          }
        })
        .catch((error) => console.error("Error:", error));
    } else {
      resultsContainer.innerHTML = "";
    }
  }

  function handleDocumentClick(event) {
    if (
      !searchField.contains(event.target) &&
      !resultsContainer.contains(event.target)
    ) {
      resultsContainer.innerHTML = "";
    }
  }

  function validateFields() {
    let isValid = true;
    const errorMessageTitle = document.getElementById("error-message-title");
    const errorMessageDescription = document.getElementById(
      "error-message-description"
    );
    const errorMessageDeadline = document.getElementById(
      "error-message-deadline"
    );
    const errorMessageAssignment = document.getElementById(
      "error-message-assignment"
    );

    errorMessageTitle.textContent = "";
    errorMessageDescription.textContent = "";
    errorMessageDeadline.textContent = "";
    errorMessageAssignment.textContent = "";

    if (!titleField.value.trim()) {
      errorMessageTitle.textContent = "Title is required";
      errorMessageTitle.style.display = "block";
      isValid = false;
    }

    if (!descriptionField.value.trim()) {
      errorMessageDescription.textContent = "Description is required";
      errorMessageDescription.style.display = "block";
      isValid = false;
    }

    if (!deadlineField.value.trim()) {
      errorMessageDeadline.textContent = "The deadline is required";
      errorMessageDeadline.style.display = "block";
      isValid = false;
    } else {
      const deadlineDate = new Date(deadlineField.value);
      const currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0);
      if (deadlineDate < currentDate) {
        errorMessageDeadline.textContent = "The deadline cannot be in the past";
        errorMessageDeadline.style.display = "block";
        isValid = false;
      }
    }

    if (!usernameField.value.trim()) {
      errorMessageAssignment.textContent = "User is required";
      errorMessageAssignment.style.display = "block";
      isValid = false;
    } else {
      const userExists = usernameField.value.trim() === usernameValue;
      if (!userExists) {
        errorMessageAssignment.textContent =
          "The user does not exist in this project";
        errorMessageAssignment.style.display = "block";
        isValid = false;
      }
    }

    return isValid;
  }

  function handleAcceptButtonClick(event) {
    event.preventDefault();

    if (!validateFields()) {
      return;
    }

    const token = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content");
    const pathParts = window.location.pathname.split("/");
    const projectId = pathParts[pathParts.length - 2];
    let username = document.getElementById("username").value;
    const task = {
      title: titleField.value.trim(),
      description: descriptionField.value.trim(),
      fechaVenc: deadlineField.value,
      prioridad: priorityField.value,
      subTareas: subtasks,
      userId: userId,
      username: username,
    };

    const taskId = pathParts[pathParts.length - 1];

    fetch(`/modify-task/${projectId}/${taskId}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-Token": token,
      },
      body: JSON.stringify({
        titulo: task.title,
        descripcion: task.description,
        fechaVenc: task.fechaVenc,
        prioridad: task.prioridad,
        userId: task.userId,
        username: task.username,
        IDProyecto: projectId,
        subTareas: task.subTareas,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          const messageElement = document.querySelector("#message");
          messageElement.textContent = data.message;
        }
      })
      .catch((error) => console.error("Error:", error));
  }

  addButton.addEventListener("click", handleAddButtonClick);
  searchField.addEventListener("input", handleSearchFieldInput);
  document.addEventListener("click", handleDocumentClick);
  document
    .querySelector(".accept-button")
    .addEventListener("click", handleAcceptButtonClick);
});

const token2 = document
  .querySelector('meta[name="csrf-token"]')
  .getAttribute("content");

document
  .querySelectorAll(".existing-subtask .close-icon")
  .forEach(function (closeIcon) {
    closeIcon.addEventListener("click", function (event) {
      const subtaskId = event.target.parentElement.getAttribute("data-id");
      fetch(`/delete-subtask/${subtaskId}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-Token": token2,
        },
      })
        .then((response) => {
          if (response.ok) {
            event.target.parentElement.remove();
          } else {
            console.error("Error:", response.statusText);
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  });
