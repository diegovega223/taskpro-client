const bodyElement = document.body;
const menu = document.querySelector(".mobile-menu");

export function mobileMenu() {

  bodyElement.classList.toggle("mobile");
}

menu.addEventListener("click", mobileMenu);