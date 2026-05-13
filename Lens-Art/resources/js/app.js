import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
  setupBurgerMenu();
});

const setupBurgerMenu = () => {
  const menuToggle = document.getElementById("menuToggle");
  const navMenu = document.getElementById("navMenu");

  if (!menuToggle || !navMenu) return;

  menuToggle.addEventListener("click", (event) => {
    event.stopPropagation();
    menuToggle.classList.toggle("active");
    navMenu.classList.toggle("show");
  });

  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      menuToggle.classList.remove("active");
      navMenu.classList.remove("show");
    });
  });

  document.addEventListener("click", (event) => {
    const isClickInsideMenu = navMenu.contains(event.target);
    const isClickToggle = menuToggle.contains(event.target);

    if (!isClickInsideMenu && !isClickToggle) {
      menuToggle.classList.remove("active");
      navMenu.classList.remove("show");
    }
  });
};
