const modoSwitches = document.querySelectorAll(".modoSwitch");

export function cambiarModo(event) {
  const switchInput = event.target;
  const switchLabel = switchInput.parentElement;
  const leftText = switchLabel.querySelector(".left");
  const rightText = switchLabel.querySelector(".right");

  if (switchInput.checked) {
    leftText.classList.remove("active");
    rightText.classList.add("active");
    document.body.classList.add("dark");
    localStorage.setItem("modoDark", "activado");
  } else {
    rightText.classList.remove("active");
    leftText.classList.add("active");
    document.body.classList.remove("dark");
    localStorage.setItem("modoDark", "desactivado");
  }
}

modoSwitches.forEach((switchInput) => {
  switchInput.addEventListener("change", cambiarModo);
});

const modoAlmacenado = localStorage.getItem("modoDark");
modoSwitches.forEach((switchInput) => {
  if (modoAlmacenado === "activado") {
    switchInput.checked = true;
    cambiarModo({ target: switchInput });
  }
});
