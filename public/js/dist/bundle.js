(()=>{"use strict";const e=document.querySelectorAll(".modoSwitch");function t(e){const t=e.target,o=t.parentElement,c=o.querySelector(".left"),a=o.querySelector(".right");t.checked?(c.classList.remove("active"),a.classList.add("active"),document.body.classList.add("dark"),localStorage.setItem("modoDark","activado")):(a.classList.remove("active"),c.classList.add("active"),document.body.classList.remove("dark"),localStorage.setItem("modoDark","desactivado"))}e.forEach((e=>{e.addEventListener("change",t)}));const o=localStorage.getItem("modoDark");e.forEach((e=>{"activado"===o&&(e.checked=!0,t({target:e}))}));const c=document.body;function a(){c.classList.toggle("mobile")}document.querySelector(".mobile-menu").addEventListener("click",a);const s=require("js-cookie");t(),a(),function(){let e=s.get("validation");console.log(e)}()})();