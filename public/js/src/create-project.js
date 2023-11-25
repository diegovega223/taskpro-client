function buscarUsuario() {
  var query = this.value;
  if (query != "") {
    fetch("/search/" + query)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(manejarResultadosBusqueda)
      .catch((error) => {
        console.error(
          "Ha habido un problema con tu operación de búsqueda:",
          error
        );
      });
  }
}

let searchResultsData = [];

function manejarResultadosBusqueda(data) {
  var searchResults = document.getElementById("search-results");
  searchResults.innerHTML = "";
  if (Array.isArray(data)) {
    searchResultsData = data; 
    data.forEach((user) => {
      var result = document.createElement("div");
      result.textContent = user.name;
      result.className = "search-result-item";
      result.addEventListener("click", function () {
        document.getElementById("user-search").value = user.name;
        searchResults.innerHTML = "";
      });
      searchResults.appendChild(result);
    });
  } else {
    console.error("Los datos no son un array:", data);
  }
}

function asignarRol() {
  var username = document.getElementById("user-search").value;
  var role = document.getElementById("rol").value;
  var userExists = searchResultsData.some(function (user) {
    return user.name === username;
  });

  var userAlreadyAssigned = userRoles.some(function (userRole) {
    return userRole.username === username;
  });

  if (userExists && !userAlreadyAssigned) {
    let userRole = {
      username: username,
      role: role,
    };
    userRoles.push(userRole);
    document.getElementById("error-message").style.display = "none";
    crearBloqueUsuarioAsignado(username, role);
    document.getElementById("user-search").value = "";
    console.log(userRoles);
  } else if (userAlreadyAssigned) {
    document.getElementById("error-message").innerText =
      username + " has already been assigned!";
    document.getElementById("error-message").style.display = "block";
  } else {
    document.getElementById("error-message").innerText =
      username + " does not exist!";
    document.getElementById("error-message").style.display = "block";
  }
}

document.getElementById("assign-button").addEventListener("click", function () {
  let inputUsername = document.getElementById("user-search").value;
  let role = document.getElementById("rol").value;
  let searchResultItems = document.querySelectorAll(".search-result-item");
  let userExists = false;

  for (let item of searchResultItems) {
    if (item.innerText === inputUsername) {
      userExists = true;
      break;
    }
  }

  if (userExists) {
    userRoles.push({ username: inputUsername, role: role });
    document.getElementById("error-message").style.display = "none";
    crearBloqueUsuarioAsignado(inputUsername, role);
  } else {
    document.getElementById("error-message").innerText =
      inputUsername + " no existe!";
    document.getElementById("error-message").style.display = "block";
  }
});

function crearBloqueUsuarioAsignado(username, role) {
  var assignedUserProject = document.createElement("div");
  assignedUserProject.className = "assigned-user-project";

  var profile = document.createElement("div");
  profile.className = "profile";

  var letter = document.createElement("p");
  letter.innerText = username.charAt(0).toUpperCase();

  var letterRole = document.createElement("div");
  letterRole.className = "letter-role";
  letterRole.innerText = role.charAt(0).toUpperCase();

  var name = document.createElement("p");
  name.innerText = username;

  var icon = document.createElement("span");
  icon.className = "material-icons";
  icon.innerText = "disabled_by_default";

  icon.addEventListener("click", function () {
    eliminarUsuarioAsignado(username, assignedUserProject);
  });

  profile.appendChild(letter);
  assignedUserProject.appendChild(profile);
  assignedUserProject.appendChild(letterRole);
  assignedUserProject.appendChild(name);
  assignedUserProject.appendChild(icon);

  var assingBox = document.querySelector(".assing-box");

  assingBox.appendChild(assignedUserProject);
}

function eliminarUsuarioAsignado(username, assignedUserProject) {
  userRoles = userRoles.filter(function (userRole) {
    return userRole.username !== username;
  });
  assignedUserProject.remove();
}

function createProject() {
  var title = document.querySelector("input[name='title']").value;
  var description = document.querySelector(
    "textarea[name='description']"
  ).value;
  var dateIni = document.querySelector("input[name='date-ini']").value;
  var timeIni = document.querySelector("input[name='time-ini']").value;
  var dateFin = document.querySelector("input[name='date-fin']").value;
  var timeFin = document.querySelector("input[name='time-fin']").value;

  var fechaIni = dateIni + " " + timeIni + ":00";
  var fechaFin = dateFin + " " + timeFin + ":00";

  var data = {
    title: title,
    description: description,
    fechaIni: fechaIni,
    fechaFin: fechaFin,
    userRoles: userRoles,
  };

  fetch("/create-project", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then(function (response) {
      if (response.ok) {
        window.location.href = "/project";
      } else {
        throw new Error("Error: " + response.statusText);
      }
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".create-button button")
    .addEventListener("click", function (event) {
      event.preventDefault();
      createProject();
    });
});

let userRoles = [];
let username = document.getElementById("user-owner").innerText;
userRoles.push({ username: username, role: "owner" });

document.getElementById("user-search").addEventListener("keyup", buscarUsuario);
document.getElementById("assign-button").addEventListener("click", asignarRol);
