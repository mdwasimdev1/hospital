import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    // Mobile menu toggle
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const hamburger = document.getElementById("hamburger");
    const closeIcon = document.getElementById("close");

    if (menuToggle) {
        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            hamburger.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
        });
    }
});

// Dropdown toggle with auto-close others
window.toggleDropdown = function (menuId) {
    // Close all dropdowns first
    document.querySelectorAll(".dropdown").forEach(drop => drop.classList.add("hidden"));
    document.querySelectorAll("svg[id^='icon-']").forEach(icon => icon.classList.remove("rotate-180"));

    // Open the clicked one
    const menu = document.getElementById(menuId);
    const icon = document.getElementById("icon-" + menuId);
    if (menu) {
        menu.classList.toggle("hidden");
    }
    if (icon) {
        icon.classList.toggle("rotate-180");
    }
}
