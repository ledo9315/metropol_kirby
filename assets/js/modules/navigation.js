export function initNavigation() {
  const menuButton = document.getElementById("menu-button");
  const menu = document.getElementById("menu");
  const menuClose = document.getElementById("menu-close");
  const dropdownButton = document.querySelector(".group button");
  const dropdownMenu = document.querySelector(".group ul");

  if (menuButton && menu) {
    menuButton.addEventListener("click", function () {
      const isHidden = menu.classList.contains("hidden");
      menu.classList.toggle("hidden");
      menuButton.setAttribute("aria-expanded", !isHidden);
      menuButton.setAttribute(
        "aria-label",
        isHidden ? "Menü schließen" : "Menü öffnen"
      );
    });
  }

  if (menuClose && menu) {
    menuClose.addEventListener("click", function () {
      menu.classList.add("hidden");
      menuButton.setAttribute("aria-expanded", "false");
      menuButton.setAttribute("aria-label", "Menü öffnen");
    });
  }

  window.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && menu && !menu.classList.contains("hidden")) {
      menu.classList.add("hidden");
      menuButton.setAttribute("aria-expanded", "false");
      menuButton.setAttribute("aria-label", "Menü öffnen");
    }
  });

  if (dropdownButton && dropdownMenu) {
    dropdownButton.addEventListener("focus", () => {
      dropdownMenu.classList.remove("opacity-0", "pointer-events-none");
      dropdownMenu.classList.add("opacity-100", "pointer-events-auto");
      dropdownButton.setAttribute("aria-expanded", "true");
    });

    dropdownButton.addEventListener("blur", (e) => {
      setTimeout(() => {
        if (!dropdownMenu.contains(document.activeElement)) {
          dropdownMenu.classList.remove("opacity-100", "pointer-events-auto");
          dropdownMenu.classList.add("opacity-0", "pointer-events-none");
          dropdownButton.setAttribute("aria-expanded", "false");
        }
      }, 200);
    });

    dropdownButton.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        const isExpanded =
          dropdownButton.getAttribute("aria-expanded") === "true";
        dropdownButton.setAttribute("aria-expanded", !isExpanded);
        if (!isExpanded) {
          dropdownMenu.classList.remove("opacity-0", "pointer-events-none");
          dropdownMenu.classList.add("opacity-100", "pointer-events-auto");
        } else {
          dropdownMenu.classList.remove("opacity-100", "pointer-events-auto");
          dropdownMenu.classList.add("opacity-0", "pointer-events-none");
        }
      }
    });

    document.addEventListener("click", (e) => {
      if (
        !dropdownButton.contains(e.target) &&
        !dropdownMenu.contains(e.target)
      ) {
        dropdownMenu.classList.remove("opacity-100", "pointer-events-auto");
        dropdownMenu.classList.add("opacity-0", "pointer-events-none");
        dropdownButton.setAttribute("aria-expanded", "false");
      }
    });
  }
}
